<?php

namespace App\Actions\Booking;

use App\Enums\BookingTransactionStatus;
use App\Enums\BookingTransactionType;
use App\Enums\PaymentProvider;
use App\Models\Booking;
use App\Models\BookingTransaction;

class CreateBookingTransactionAction
{
    public function execute(Booking $booking, string $stripeSessionId, array $metaData = []): BookingTransaction
    {
        /** @var BookingTransaction */
        return $booking->bookingTransactions()->updateOrCreate(
            [
                'booking_id' => $booking->id,
                'reference_id' => $stripeSessionId,
                'type' => BookingTransactionType::PAYMENT,
            ],
            [
                'provider' => PaymentProvider::STRIPE,
                'status' => BookingTransactionStatus::PENDING,
                'price' => $booking->price,
                'metadata' => $metaData,
            ]);
    }
}
