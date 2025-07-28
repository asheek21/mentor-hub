<?php

namespace App\Actions\Payments;

use App\Enums\PaymentProvider;
use App\Services\Payment\PaymentFactory;
use App\Services\Payment\Stripe\StripeGateway;

class StripeSessionVerificationAction
{
    public function execute(string $stripeSession)
    {
        $PaymentProvider = PaymentProvider::from(config('services.payment_provider'));

        /** @var StripeGateway $stripeGateway */
        $stripeGateway = PaymentFactory::make($PaymentProvider);

        $checkoutSession = $stripeGateway->retrieveSession($stripeSession);

        dd($checkoutSession);
    }
}
