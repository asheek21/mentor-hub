<?php

namespace App\Enums;

enum SessionFrequency: string
{
    case WEEKLYSESSION = 'weekly';
    case EVERYTWOWEEKSSESSION = 'every_two_weeks';
    case MONTHLYSESSION = 'monthly';
    case ASNEEDED = 'as_needed';

    public function label()
    {
        return match ($this) {
            self::WEEKLYSESSION => 'Weekly Session',
            self::EVERYTWOWEEKSSESSION => 'Every 2 Weeks',
            self::MONTHLYSESSION => 'Monthly Sessions',
            self::ASNEEDED => 'As Needed Basis',
        };
    }
}
