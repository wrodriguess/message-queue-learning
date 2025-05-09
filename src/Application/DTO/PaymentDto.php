<?php

namespace App\Application\DTO;

class PaymentDto
{
    public function __construct(
        private string $userId,
        private float $value,
        private string $currencyCode,
        private string $method
    ) {
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

    public function method(): string
    {
        return $this->method;
    }
}