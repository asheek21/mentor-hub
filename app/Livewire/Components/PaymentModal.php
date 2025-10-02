<?php

namespace App\Livewire\Components;

use App\Enums\PaymentProvider;
use App\Livewire\Booking\BookingPage;
use App\Models\User;
use App\Services\Payment\PaymentFactory;
use Livewire\Attributes\On;

class PaymentModal extends BaseComponent
{
    public User $mentor;

    public string $menteeProfileUuid;

    public string $clientSecret = '';

    public function render()
    {
        return view('livewire.components.payment-modal');
    }

    public function createCheckoutSession(int $bookingId)
    {
        $this->mentor->mentorProfile->loadMissing('mentorRate');

        $PaymentProvider = PaymentProvider::from(config('services.payment_provider'));

        // app(ProductAndPriceService::class)->createProductAndPrice($this->mentor) ;
        // dd(1);

        $priceId = $this->mentor->mentorProfile->mentorRate->stripe_price_id;

        $checkoutSession = PaymentFactory::make($PaymentProvider)->createPaymentSession([
            'client_reference_id' => $this->mentor->uuid,
            'line_items' => [[
                'price' => $priceId,
                'quantity' => 1,
            ]],
            'metadata' => [
                'booking_id' => $bookingId,
            ],
            'customer_email' => $this->user->email,
            'return_url' => route('mentor.booking').'?session_id={CHECKOUT_SESSION_ID}&mSid='.$this->menteeProfileUuid,
        ]);

        $this->clientSecret = $checkoutSession->client_secret;

    }

    #[On('open-checkout-modal')]
    public function openCheckoutModal(int $bookingId)
    {
        $this->createCheckoutSession($bookingId);

        $this->dispatch('checkout-created', $this->clientSecret);
    }

    #[On('checkout-closed')]
    public function checkoutClosed()
    {
        $this->clientSecret = '';

        $this->dispatch('checkout-closed')->to(BookingPage::class);
    }
}
