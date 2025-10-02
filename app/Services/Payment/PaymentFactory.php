<?php

namespace App\Services\Payment;

use App\Enums\PaymentProvider;
use App\Interface\PaymentGateway;
use App\Services\Payment\Stripe\StripeGateway;

class PaymentFactory
{
    public static function make(PaymentProvider $provider): PaymentGateway
    {
        return new StripeGateway;

        // return match ($provider) {
        //     PaymentProvider::STRIPE => new StripeGateway,
        //     default => throw new \Exception("Unsupported gateway: $provider"),
        // };
    }
}
