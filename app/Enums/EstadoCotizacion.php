<?php
namespace App\Enums;

enum EstadoCotizacion: string
{
    case ENVIADO = 'enviado';
    case RESPALDO  = 'respaldo';
    case NO_COTIZA     = 'no_cotiza';

    public function label(): string
    {
        return match($this) {
            self::ENVIADO => 'Enviado',
            self::RESPALDO  => 'Respaldo',
            self::NO_COTIZA     => 'No cotizada',
        };
    }
    public function puedeTransicionarA(self $nuevo): bool
    {
        return match ($this) {
            self::ENVIADO => in_array($nuevo, [
                self::RESPALDO,
                self::NO_COTIZA
            ]),

            self::RESPALDO => in_array($nuevo, [
                self::ENVIADO,
                self::NO_COTIZA
            ]),

            self::NO_COTIZA => false, // estado final
        };
    }

    public function color(): string
    {
        return match($this) {
            self::ENVIADO => 'primary',
            self::RESPALDO => 'warning',
            self::NO_COTIZA => 'dark',
        };
    }
}