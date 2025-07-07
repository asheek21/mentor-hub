<?php

namespace App\Enums;

enum AdvanceBookingWindow: string
{
    case SAMEDAY = 'same_day';
    case TWENTYFOURHOURS = '24_hours';
    case FOURTYEIGHTHOURS = '48_hours';
    case ONEWEEK = '1_week';
    case ONEMONTH = '1_month';

    public function label(): string
    {
        return match ($this) {
            self::SAMEDAY => 'Same day booking allowed',
            self::TWENTYFOURHOURS => '24 hours advance required',
            self::FOURTYEIGHTHOURS => '48 hours advance required',
            self::ONEWEEK => '1 week advance required',
            self::ONEMONTH => '1 month advance required',
        };
    }
}
