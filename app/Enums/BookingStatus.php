<?php

namespace App\Enums;

enum BookingStatus: string
{
    case PENDING = 'pending';
    case CONFIRMED = 'confirmed';
    case CANCELLED = 'cancelled';
    case COMPLETED = 'completed';
    case RESCHEDULED = 'rescheduled';
    case MENTEENOSHOW = 'menteenoshow';
    case MENTORNOSHOW = 'mentornoshow';
}
