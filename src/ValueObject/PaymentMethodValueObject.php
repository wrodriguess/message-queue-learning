<?php

namespace App\ValueObject;

use Exception;
use ValueError;
use App\Enum\PaymentMethod;

/**
 * @ORM\Embeddable
*/
final class PaymentMethodValueObject
{
    /**
     * @ORM\Column(type="string")
    */
    private PaymentMethod $paymentMethod;

    public function __construct(PaymentMethod $paymentMethod)
    {
        $this->paymentMethod = $paymentMethod;
    }

    public static function fromString(string $paymentMethod): self
    {
        try {
            return new self(PaymentMethod::from($paymentMethod));
        } catch (ValueError $e) {
            throw new Exception(sprintf('"%s" não é um método de pagamento válido.', $paymentMethod));
        }
    }

    public function value(): string
    {
        return $this->paymentMethod->value;
    }
}