<?php

namespace App\Actions\Payments;

use App\DTO\StripeContext;
use App\Services\Payment\Stripe\StripeGateway;
use Closure;

class CreateStripePriceAction
{
    public function handle(StripeContext $data, Closure $next)
    {
        $mentor = $data->mentor;

        $rate = (float) ($mentor->mentorProfile->hourly_rate);
        $hourlyRate = (int) round($rate * 100);

        /** @var StripeGateway $stripeGateway */
        $stripeGateway = $data->stripeGateway;

        $price = $stripeGateway->createPrice([
            'currency' => 'inr',
            'unit_amount' => $hourlyRate,
            'product' => $data->productId,
        ]);

        $data->priceId = $price->id;

        return $next($data);
    }
}
