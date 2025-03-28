<?php

namespace App\Application;

use App\Application\DTO\PaymentDto;
use App\Entity\Payment;
use App\Repository\PaymentRepository;
use App\ValueObject\Currency;
use App\ValueObject\PaymentMethodValueObject;
use App\ValueObject\Value;

class CreatePayment
{
    public function __construct(
        private PaymentRepository $paymentRepository
    )
    {
    }

    public function execute(PaymentDto $paymentDto): Payment
    {
        $payment = new Payment(
            $paymentDto->userId(),
            $paymentDto->value(),
            $paymentDto->currencyCode(),
            $paymentDto->paymentMethod()
        );

        // Publicar a solicitação de pagamento em uma fila do RabbitMQ.
        // Retornar uma resposta de sucesso imediatamente após enfileirar a mensagem.

        // Criar um consumidor que:
        // - Leia mensagens da fila do RabbitMQ.
        // - Salve o pagamento no banco de dados
        $this->paymentRepository->persist($payment);

        return $payment;
    }

}