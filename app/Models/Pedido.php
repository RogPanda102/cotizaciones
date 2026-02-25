<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = [
        'requisicion_id',
        'dependencia_id',
        'monto_total_aprobado',
        'fecha_adjudicacion',
        'fecha_entrega',
        'fecha_facturacion',
        'tipo_dias',
        'dias_credito',
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
}
