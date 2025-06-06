<?php

namespace App\MessageHandler;

use App\Entity\Payment;
use App\Message\SavePaymentMessage;
use App\Repository\Contracts\PaymentRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final class SavePaymentHandler
{
    public function __construct(
        private PaymentRepositoryInterface $paymentRepository
    ) {
    }

    public function __invoke(SavePaymentMessage $message)
    {
        $payment = new Payment(
            $message->userId(),
            $message->value(),
            $message->currencyCode(),
            $message->paymentMethod()
        );

        $this->paymentRepository->persist($payment);
    }
}