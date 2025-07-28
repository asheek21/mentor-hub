<?php

namespace App\Enums;

enum MenteeBookingSessionStatus: string
{
    case PENDING = 'pending';
    case COMPLETED = 'completed';
    case FAILED = 'failed';
}
