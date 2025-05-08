<?php

namespace App\Message;

final class SavePaymentMessage
{
    public function __construct(
        private string $userId,
        private float $value,
        private string $currencyCode,
        private string $paymentMethod
    )
    {
    }

    public function userId(): string
    {
        return $this->userId;
    }

    public function value(): float
    {
        return $this->value;
    }

    public function currencyCode(): string
    {
        return $this->currencyCode;
    }

    public function paymentMethod(): string
    {
        return $this->paymentMethod;
    }
}