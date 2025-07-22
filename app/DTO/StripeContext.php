<?php

namespace App\DTO;

use App\Interface\PaymentGateway;
use App\Models\User;

class StripeContext
{
    public function __construct(
        public User $mentor,
        public PaymentGateway $stripeGateway,
        public ?string $productId = null,
        public ?string $priceId = null,
    ) {}
}
