<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Requisicion extends Model
{
    protected $table = 'requisiciones';

    protected $fillable = [
        'folio_externo',
        'descripcion',
        'monto_estimado',
        'estado'
    ];

    public function pedido()
    {
        return $this->hasOne(Pedido::class);
    }
}
