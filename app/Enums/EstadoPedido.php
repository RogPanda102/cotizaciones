<?php
namespace App\Enums;

enum EstadoPedido: string
{
    case EN_PROCESO = 'en_proceso';
    case FACTURADO  = 'facturado';
    case PAGADO     = 'pagado';
    case VENCIDO    = 'vencido';

    public function label(): string
    {
        return match($this) {
            self::EN_PROCESO => 'En proceso',
            self::FACTURADO  => 'Facturado',
            self::PAGADO     => 'Pagado',
            self::VENCIDO    => 'Vencido',
        };
    }
}