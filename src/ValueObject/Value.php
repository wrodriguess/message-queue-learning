<?php

namespace App\ValueObject;

use Exception;

/**
 * @ORM\Embeddable
*/
final class Value
{
    /**
     * @ORM\Column(type="float")
    */
    private float $amount;

    public function __construct(float $amount)
    {
        if ($amount < 0) {
            throw new Exception('Valor não pode ser negativo.');
        }

        $this->amount = $amount;
    }

    public function amount(): float
    {
        return $this->amount;
    }
}