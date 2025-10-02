<?php

namespace App\Actions\Payments;

use App\DTO\StripeContext;
use App\Services\Payment\Stripe\StripeGateway;
use Closure;
use Illuminate\Support\Str;

class CreateStripeProductAction
{
    public string $heading = '1-on-1 Mentorship with {mentor_name}';

    public function handle(StripeContext $data, Closure $next)
    {
        $mentor = $data->mentor;

        $this->heading = Str::replace('{mentor_name}', $mentor->full_name, $this->heading);

        /** @var StripeGateway $stripeGateway */
        $stripeGateway = $data->stripeGateway;

        $product = $stripeGateway->createProduct($this->heading);

        $data->productId = $product->id;

        return $next($data);
    }
}
