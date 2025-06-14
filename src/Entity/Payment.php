<?php

namespace App\Entity;

class Payment
{
    private ?int $id = null;
    private string $userId;
    private float $value;
    private string $currencyCode;
    private string $method;

    public function __construct(
        string $userId,
        float $value,
        string $currencyCode,
        string $method
    )
    {
        $this->userId = $userId;
        $this->value = $value;
        $this->currencyCode = $currencyCode;
        $this->method = $method;
    }

    public function id(): int
    {
        return $this->id;
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

    public function toArray(): array
    {
        return [
            'userId' => $this->userId,
            'value' => $this->value,
            'currency' => $this->currencyCode,
            'paymentMethod' => $this->method
        ];
    }
}
