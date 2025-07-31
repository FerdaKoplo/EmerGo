<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum KategoriLaporan: string implements HasColor, HasLabel
{
    case Damkar = 'damkar';
    case Ambulance = 'ambulance';
    case SAR = 'sar';
    case Polisi = 'polisi';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Damkar => 'Damkar',
            self::Ambulance => 'Ambulance',
            self::SAR => 'SAR',
            self::Polisi => 'Polisi',
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::Damkar => 'danger',
            self::Ambulance => 'warning',
            self::SAR => 'success',
            self::Polisi => 'primary',
        };
    }
}