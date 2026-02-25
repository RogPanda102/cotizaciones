<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    protected $fillable = [
        'pedido_id',
        'proveedor',
        'descripcion',
        'monto',
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }
}
