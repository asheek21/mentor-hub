<?php

namespace App\Enums;

enum MaximumBookingWindow: string
{
    case ONEWEEK = '1_week';
    case TWOWEEKS = '2_weeks';
    case ONEMONTH = '1_month';
    case THREEMONTHS = '3_months';

    public function label(): string
    {
        return match ($this) {
            self::ONEWEEK => '1 Week ahead',
            self::TWOWEEKS => '2 Weeks ahead',
            self::ONEMONTH => '1 Month ahead',
            self::THREEMONTHS => '3 Months ahead',
        };
    }

    public function day()
    {
        return match ($this) {
            self::ONEWEEK => 7,
            self::TWOWEEKS => 14,
            self::ONEMONTH => 30,
            self::THREEMONTHS => 90,
        };
    }
}
