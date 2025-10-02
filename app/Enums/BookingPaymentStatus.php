<?php

namespace App\Enums;

enum BookingPaymentStatus: string
{
    case UNPAID = 'unpaid';
    case INITIATED = 'initiated';
    case PAID = 'paid';
    case FAILED = 'failed';
    case REFUNDED = 'refunded';
}
