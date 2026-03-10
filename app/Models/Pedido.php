<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\EstadoPedido;
use Carbon\Carbon;

class Pedido extends Model
{

    protected $casts = [
        'estado' => EstadoPedido::class,
        'fecha_adjudicacion' => 'date',
        'fecha_entrega' => 'date',
        'fecha_facturacion' => 'date',
        'dias_entrega' => 'integer',
        'fecha_pago' => 'date',
    ];

    protected $fillable = [
        'requisicion_id',
        'dependencia_id',
        'monto_total_aprobado',
        'fecha_adjudicacion',
        'fecha_entrega',
        'fecha_facturacion',
        'tipo_dias',
        'dias_credito',
        'dias_entrega',
        'estado'
    ];

    public function requisicion()
    {
        return $this->belongsTo(Requisicion::class);
    }

    public function dependencia()
    {
        return $this->belongsTo(Dependencia::class);
    }

    public function compras()
    {
        return $this->hasMany(Compra::class);
    }

    // Total gastado en compras
    public function totalGastado()
    {
        return $this->compras()->sum('monto');
    }

    // Utilidad del pedido
    public function utilidad()
    {
        return $this->monto_total_aprobado - $this->totalGastado();
    }

    // Indica si hubo pérdida
    public function tienePerdida()
    {
        return $this->utilidad() < 0;
    }

    protected static function booted()
    {
        static::saving(function ($pedido) {

            if (
                $pedido->fecha_adjudicacion &&
                $pedido->dias_entrega &&
                (
                    $pedido->isDirty('fecha_adjudicacion') ||
                    $pedido->isDirty('dias_entrega')
                )
            ) {

                $fecha = Carbon::parse($pedido->fecha_adjudicacion);
                $dias = $pedido->dias_entrega;

                if ($pedido->tipo_dias === 'naturales') {

                    $pedido->fecha_entrega = $fecha->copy()->addDays($dias);

                } else {

                    $agregados = 0;

                    while ($agregados < $dias) {
                        $fecha->addDay();

                        if (!$fecha->isWeekend()) {
                            $agregados++;
                        }
                    }

                    $pedido->fecha_entrega = $fecha;
                }
            }

            if (
            $pedido->estado === EstadoPedido::PAGADO &&
            $pedido->isDirty('estado')
            ) {

                $pedido->fecha_pago = now();

                if ($pedido->fecha_entrega) {

                    $diferencia = now()->diffInDays($pedido->fecha_entrega, false);

                    $pedido->dias_retraso = $diferencia < 0
                        ? abs($diferencia)
                        : 0;
                }
            }
        });
    }

    public function getDiasRestantesAttribute()
    {
        if ($this->estado === EstadoPedido::PAGADO) {
        return null;
        }

        if (!$this->fecha_entrega) {
            return null;
        }

        $hoy = now()->copy()->startOfDay();
        $entrega = $this->fecha_entrega->copy()->startOfDay();

        return (int) $hoy->diffInDays($entrega, false);
    }
}
