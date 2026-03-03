<?php
namespace App\Enums;

enum EstadoRequisicion: string
{
    case PENDIENTE = 'pendiente';
    case ADJUDICADA  = 'adjudicada';
    case NO_ADJUDICADA     = 'no_adjudicada';
    case ARCHIVADA    = 'archivada';

    public function label(): string
    {
        return match($this) {
            self::PENDIENTE => 'Pendiente',
            self::ADJUDICADA  => 'Adjudicada',
            self::NO_ADJUDICADA     => 'No adjudicada',
            self::ARCHIVADA    => 'Archivada',
        };
    }
}