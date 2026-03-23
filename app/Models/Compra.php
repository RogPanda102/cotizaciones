<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    protected $fillable = [
        'pedido_id',
        'fecha',
        'cantidad',
        'unidad',
        'proveedor',
        'descripcion',
        'monto',
    ];

    protected $casts = [
        'fecha' => 'date',
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }

    public function total()
    {
        return $this->cantidad * $this->monto;
    }
}
