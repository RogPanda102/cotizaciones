<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\EstadoCotizacion;

class Cotizacion extends Model
{
    protected $table = 'cotizaciones';

    protected $casts = [
        'estado' => EstadoCotizacion::class,
    ];

    protected $fillable = [
        'folio_externo',
        'descripcion',
        'estado'
    ];

    public function pedido()
    {
        return $this->hasOne(Pedido::class);
    }
}
