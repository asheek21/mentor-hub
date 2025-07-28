<?php

namespace App\Enums;

enum BookingTransactionType: string
{
    case PAYMENT = 'payment';
    case REFUND = 'refund';
}
