<?php

namespace App\Jobs\StripeWebhooks;

use App\Actions\Booking\CreateBookingTransactionAction;
use App\Enums\BookingPaymentStatus;
use App\Enums\BookingStatus;
use App\Enums\BookingTransactionStatus;
use App\Enums\BookingTransactionType;
use App\Models\Booking;
use App\Models\BookingTransaction;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\WebhookClient\Models\WebhookCall;

class HandleCheckoutSession implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /** @var \Spatie\WebhookClient\Models\WebhookCall */
    public $webhookCall;

    public function __construct(WebhookCall $webhookCall)
    {
        $this->webhookCall = $webhookCall;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $payload = $this->webhookCall->payload;

        $data = $payload['data']['object'];

        $paymentStatus = $data['payment_status'];

        $referenceId = $data['id'];

        $bookingId = $data['metadata']['booking_id'];

        $booking = Booking::find($bookingId);

        $bookingTransaction = BookingTransaction::where('reference_id', $referenceId)
            ->where('booking_id', $bookingId)
            ->where('type', BookingTransactionType::PAYMENT)->first();

        if (! $bookingTransaction) {
            $bookingTransaction = app(CreateBookingTransactionAction::class)->execute(
                $booking,
                $referenceId
            );
        }

        info('webhook', [
            'bookingTransaction' => $bookingTransaction,
            'bookingId' => $bookingId,
            'paymentStatus' => $paymentStatus,
            'referenceId' => $referenceId,
        ]);

        if ($paymentStatus == 'paid') {
            $bookingTransaction->update([
                'status' => BookingTransactionStatus::COMPLETED,
                'metadata' => $data,
            ]);

            $booking->update([
                'status' => BookingStatus::CONFIRMED,
                'payment_status' => BookingPaymentStatus::PAID,
            ]);
        }

        if ($paymentStatus == 'unpaid') {

        }
    }
}
