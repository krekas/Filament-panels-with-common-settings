<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum Platform: string implements HasLabel
{
    case Booking = 'booking';
    case Hotel = 'hotel';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Booking => 'Booking Panel',
            self::Hotel => 'Hotel Panel',
        };
    }
}
