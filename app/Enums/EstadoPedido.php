<?php
namespace App\Enums;

enum EstadoPedido: string
{
    case EN_PROCESO = 'en_proceso';
    case FACTURADO  = 'facturado';
    case ENTREGADO  = 'entregado';
    case PAGADO     = 'pagado';
    

    public function label(): string
    {
        return match($this) {
            self::EN_PROCESO => 'En proceso',
            self::FACTURADO  => 'Facturado',
            self::ENTREGADO  => 'Entregado',
            self::PAGADO     => 'Pagado',
            
        };
    }
    public function siguientesEstados(): array
    {
        return match($this) {
            self::EN_PROCESO => [self::FACTURADO],
            self::FACTURADO  => [self::ENTREGADO],
            self::ENTREGADO  => [self::PAGADO],
            self::PAGADO     => [],
        };
    }
    public function puedeCambiarA(self $nuevoEstado): bool
    {
        return in_array($nuevoEstado, $this->siguientesEstados(), true);
    }
}