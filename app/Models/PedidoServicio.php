<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PedidoServicio extends Model
{
    protected $fillable = [
        'pedido_id',
        'descripcion_servicio',
        'fecha_inicio',
        'fecha_fin',
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }

    // 🔥 cálculo útil
    public function getDiasRestantesAttribute()
    {
        if (!$this->fecha_fin) return null;

        return Carbon::now()->diffInDays($this->fecha_fin, false);
    }
}
