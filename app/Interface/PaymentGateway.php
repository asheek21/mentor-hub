<?php

namespace App\Interface;

interface PaymentGateway
{
    public function charge(float $amount, array $meta_data);

    public function createPaymentSession(array $meta_data);
}
