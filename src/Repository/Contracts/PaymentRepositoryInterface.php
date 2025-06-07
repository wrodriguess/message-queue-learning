<?php

namespace App\Repository\Contracts;

use App\Entity\Payment;

interface PaymentRepositoryInterface
{
    public function create(Payment $payment): void;
}