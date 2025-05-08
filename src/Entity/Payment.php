<?php

namespace App\Entity;

use App\Repository\PaymentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PaymentRepository::class)]
class Payment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 36)]
    private string $userId;

    #[ORM\Column(length: 3)]
    private float $value;

    #[ORM\Column(length: 3)]
    private string $currencyCode;

    #[ORM\Column(length: 14)]
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
