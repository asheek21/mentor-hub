<?php

namespace App\Enums;

enum YearsOfExperience: string
{
    case ONETOTWOYEARS = '1-2_years';
    case THREETOFIVEYEARS = '3-5_years';
    case SIXTOEIGHTYEARS = '6-8_years';
    case NINEPLUSYEARS = '9+_years';

    public function label()
    {
        return match ($this) {
            self::ONETOTWOYEARS => '1-2 years',
            self::THREETOFIVEYEARS => '3-5 years',
            self::SIXTOEIGHTYEARS => '6-8 years',
            self::NINEPLUSYEARS => '9+ years',
        };
    }
}
