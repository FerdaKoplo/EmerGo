<?php
namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum StatusKejadian: string implements HasColor, HasLabel
{
    case Accepted = 'accepted';
    case Arrived = 'arrived';
    case Finishing = 'finishing';
    case Done = 'done';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Accepted => 'Accepted',
            self::Arrived => 'Arrived',
            self::Finishing => 'Finishing',
            self::Done => 'Done',
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::Accepted => 'warning',
            self::Arrived => 'info',
            self::Finishing => 'primary',
            self::Done => 'success',
        };
    }
}