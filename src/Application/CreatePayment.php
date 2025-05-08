<?php

namespace App\Application;

use App\Application\DTO\PaymentDto;
use App\Entity\Payment;
use App\Message\SavePaymentMessage;
use Symfony\Component\Messenger\MessageBusInterface;

class CreatePayment
{
    public function __construct(private MessageBusInterface $bus)
    {
    }

    public function execute(PaymentDto $paymentDto): Payment
    {
        $payment = new Payment(
            $paymentDto->userId(),
            $paymentDto->value(),
            $paymentDto->currencyCode(),
            $paymentDto->method()
        );

        $message = new SavePaymentMessage(
            $paymentDto->userId(),
            $paymentDto->value(),
            $paymentDto->currencyCode(),
            $paymentDto->method()
        );

        $this->bus->dispatch($message);

        return $payment;
    }

}