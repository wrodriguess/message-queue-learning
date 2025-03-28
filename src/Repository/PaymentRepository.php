<?php

namespace App\Repository;

use App\Entity\Payment;

interface PaymentRepository
{
    public function persist(Payment $payment): void;
}