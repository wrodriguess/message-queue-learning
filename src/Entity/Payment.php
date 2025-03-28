<?php

namespace App\Entity;

use App\ValueObject\Currency;
use App\ValueObject\PaymentMethodValueObject;
use App\ValueObject\Value;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DoctrinePaymentRepository")
 * @ORM\Table(name="payment")
 */
class Payment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
    */
    private int $id;
    /**
     * @ORM\Column(type="string", length=255)
    */
    private string $userId;
    /**
     * @ORM\Embedded(class="App\ValueObject\Value", columnPrefix=false)
    */
    private Value $value;
    /**
     * @ORM\Embedded(class="App\ValueObject\Currency", columnPrefix="currency_")
    */
    private Currency $currency;
    /**
     * @ORM\Embedded(class="App\ValueObject\PaymentMethodValueObject", columnPrefix="payment_method_")
    */
    private PaymentMethodValueObject $paymentMethod;

    public function __construct(
        string $userId,
        Value $value,
        Currency $currency,
        PaymentMethodValueObject $paymentMethod
    )
    {
        $this->userId = $userId;
        $this->value = $value;
        $this->currency = $currency;
        $this->paymentMethod = $paymentMethod;
    }

    public function userId(): string
    {
        return $this->userId;
    }

    public function value(): float
    {
        // O correto é eu retornar o float direto?
        return $this->value->amount();

        // Ou retornar o objeto de valor e onde for usar chamo o getter do objeto de valor?
        // return $this->value;
    }

    public function currency(): string
    {
        return $this->currency->value();
    }

    public function paymentMethod(): string
    {
        return $this->paymentMethod->value();
    }

    public function toArray(): array
    {
        return [
            'userId' => $this->userId,
            'value' => $this->value,
            'currency' => $this->currency->value(),
            'paymentMethod' => $this->paymentMethod->value()
        ];
    }
}