<?php

namespace App\Services\PaymentSystems;


use App\Plan;

interface PaymentSystemInterface
{
    public function pay(string $paymentMethod, Plan $plan);
}
