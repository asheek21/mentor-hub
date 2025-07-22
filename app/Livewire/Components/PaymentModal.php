<?php

namespace App\Livewire\Components;

use App\Enums\PaymentProvider;
use App\Models\User;
use App\Services\Payment\PaymentFactory;
use Livewire\Component;

class PaymentModal extends Component
{
    public function render()
    {
        return view('livewire.components.payment-modal');
    }

    public function createCheckoutSession()
    {
        // $this->mentor->mentorProfile->loadMissing('mentorRate');

        // $PaymentProvider = PaymentProvider::from(config('services.payment_provider'));

        // // app(ProductAndPriceService::class)->createProductAndPrice($this->mentor) ;
        // // dd(1);

        // $priceId = $this->mentor->mentorProfile->mentorRate->stripe_price_id;

        // $checkoutSession = PaymentFactory::make($PaymentProvider)->createPaymentSession([
        //     'client_reference_id' => $this->mentor->uuid,
        //     'line_items' => [[
        //         'price' => $priceId,
        //         'quantity' => 1,
        //     ]],
        //     'customer_email' => $this->user->email,
        //     'return_url' => route('mentor.profile', ['mentor' => $this->mentor]).'?session_id={CHECKOUT_SESSION_ID}',
        // ]);

        // $this->dispatch('checkout-created', $checkoutSession->client_secret);
    }
}
