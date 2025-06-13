<?php

namespace App\Entity;

use PHPUnit\Framework\TestCase;

class PaymentTest extends TestCase
{
    public function testCreatePaymentWithValidDataShouldWork(): void
    {
        $payment = new Payment(
            "5eec725c-ad2d-4f7e-9582-6663c8f06953",
            51.10,
            "BRL",
            "pix"
        );

        $this->assertInstanceOf(Payment::class, $payment);
    }

    // IMPLEMENTAR EXCEÇÕES QUE ESTÃO ENCAPSULADAS NOS OBJETOS DE VALOR
}
