<?php

namespace App\Services\Payment\Stripe;

use App\Interface\PaymentGateway;
use Stripe\Checkout\Session;
use Stripe\Price;
use Stripe\Product;
use Stripe\StripeClient;

class StripeGateway implements PaymentGateway
{
    public StripeClient $stripe;

    public function __construct()
    {
        $this->stripe = new StripeClient(config('services.stripe.secret_key'));
    }

    public function charge(float $amount, array $meta_data) {}

    public function createPaymentSession(array $meta_data): Session
    {
        $options = [
            'ui_mode' => 'embedded',
            'currency' => 'INR',
            'mode' => 'payment',
        ];

        $options = array_merge($options, $meta_data);

        return $this->stripe->checkout->sessions->create($options);
    }

    public function createProduct(string $name): Product
    {
        return $this->stripe->products->create([
            'name' => $name,
        ]);
    }

    public function createPrice(array $data): Price
    {
        return $this->stripe->prices->create($data);
    }

    public function retrieveSession(string $sessionId): Session
    {
        return $this->stripe->checkout->sessions->retrieve($sessionId);
    }
}
