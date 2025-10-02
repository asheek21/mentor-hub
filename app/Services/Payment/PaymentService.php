<?php

namespace App\Services\Payment;

use App\Interface\PaymentGateway;

class PaymentService
{
    public function __construct(public PaymentGateway $paymentGateway) {}

    public function process(int $amount, array $meta = []): string
    {
        return $this->paymentGateway->charge($amount, $meta);
    }
}
