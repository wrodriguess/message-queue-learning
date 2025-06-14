<?php

namespace App\Application;

use App\Application\DTO\PaymentDto;
use App\Message\SavePaymentMessage;
use Symfony\Component\Messenger\MessageBusInterface;

class PaymentService
{
    public function __construct(private MessageBusInterface $bus)
    {
    }

    public function create(PaymentDto $paymentDto): void
    {
        $message = new SavePaymentMessage(
            $paymentDto->userId(),
            $paymentDto->value(),
            $paymentDto->currencyCode(),
            $paymentDto->method()
        );

        $this->bus->dispatch($message);
    }
}
