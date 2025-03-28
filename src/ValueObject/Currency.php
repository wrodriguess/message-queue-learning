<?php

namespace App\ValueObject;

use Exception;
use ValueError;
use App\Enum\CurrencyCode;

/**
 * @ORM\Embeddable
*/
final class Currency
{
    /**
     * @ORM\Column(type="string", length=3)
    */
    private CurrencyCode $currencyCode;

    public function __construct(CurrencyCode $currencyCode)
    {
        $this->currencyCode = $currencyCode;
    }

    public static function fromString(string $currencyCode): self
    {
        try {
            return new self(CurrencyCode::from($currencyCode));
        } catch (ValueError $e) {
            throw new Exception(sprintf('"%s" não é uma moeda válida.', $currencyCode));
        }
    }

    public function value(): string
    {
        return $this->currencyCode->value;
    }
}