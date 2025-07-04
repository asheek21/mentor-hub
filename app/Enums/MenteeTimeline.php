<?php

namespace App\Enums;

enum MenteeTimeline: string
{
    case ONE_TWO_MONTHS = '1-2_months';
    case THREE_SIX_MONTHS = '3-6_months';
    case SIX_TWELEVE_MONTHS = '6-12_months';
    case ONE_PLUS_YEARS = '1+_years';

    public function label()
    {
        return match ($this) {
            self::ONE_TWO_MONTHS => '1-2 Months',
            self::THREE_SIX_MONTHS => '3-6 Months',
            self::SIX_TWELEVE_MONTHS => '6-12 Months',
            self::ONE_PLUS_YEARS => '1+ Years',
        };
    }
}
