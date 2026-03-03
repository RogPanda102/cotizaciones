<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\EstadoPedido;
use App\Enums\EstadoRequisicion;

class Requisicion extends Model
{
    protected $table = 'requisiciones';

    protected $casts = [
        'estado' => EstadoRequisicion::class,
    ];

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
