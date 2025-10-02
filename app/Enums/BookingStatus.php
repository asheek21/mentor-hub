<?php

namespace App\Enums;

enum BookingStatus: string
{
    case PENDING = 'pending';
    case CONFIRMED = 'confirmed';
    case CANCELLED = 'cancelled';
    case AUTOCANCELLED = 'autocancelled';
    case COMPLETED = 'completed';
    case RESCHEDULED = 'rescheduled';
    case MENTEENOSHOW = 'menteenoshow';
    case MENTORNOSHOW = 'mentornoshow';

    public function label()
    {
        return match ($this) {
            self::PENDING => 'Pending',
            self::CONFIRMED => 'Confirmed',
            self::CANCELLED => 'Cancelled',
            self::COMPLETED => 'Completed',
            self::RESCHEDULED => 'Rescheduled',
            self::MENTEENOSHOW => 'Mentee No Show',
            self::MENTORNOSHOW => 'Mentor No Show',
            self::AUTOCANCELLED => 'Auto Cancelled',
        };
    }
}
