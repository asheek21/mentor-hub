<?php

namespace App\Enums;

enum OnboardingStage: string
{
    case FIRST_STEP = 'first_step';
    case SECOND_STEP = 'second_step';
    case THIRD_STEP = 'third_step';
    case FOURTH_STEP = 'fourth_step';
    case COMPLETED = 'completed';

    public function step(): int
    {
        return match ($this) {
            self::FIRST_STEP => 1,
            self::SECOND_STEP => 2,
            self::THIRD_STEP => 3,
            self::FOURTH_STEP => 4,
            self::COMPLETED => 5,
        };
    }
}
