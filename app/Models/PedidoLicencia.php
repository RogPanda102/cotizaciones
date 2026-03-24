<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PedidoLicencia extends Model
{
    protected $fillable = [
        'pedido_id',
        'nombre_licencia',
        'tipo_licencia',
        'numero_usuarios',
        'costo_renovacion',
        'fecha_inicio',
        'fecha_fin',
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }

    public function getDiasRestantesAttribute()
    {
        if (!$this->fecha_fin) return null;

        return Carbon::now()->diffInDays($this->fecha_fin, false);
    }
}
