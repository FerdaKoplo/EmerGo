<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum StatusLaporan: string implements HasColor, HasLabel
{
    case Waiting = 'waiting';
    case Accepted = 'accepted';
    case Arrived = 'arrived';
    case Helping = 'helping';
    case Finishing = 'finishing';
    case Done = 'done';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Waiting => 'Waiting',
            self::Accepted => 'Accepted',
            self::Arrived => 'Arrived',
            self::Helping => 'Helping',
            self::Finishing => 'Finishing',
            self::Done => 'Done',
        };
    }

    public function getColor(): string | array | null
    {
               return match ($this) {
            self::Waiting => 'secondary',
            self::Accepted => 'warning',
            self::Arrived => 'info',
            self::Helping => 'primary',
            self::Finishing => 'success',
            self::Done => 'success', 
        };
    }
}