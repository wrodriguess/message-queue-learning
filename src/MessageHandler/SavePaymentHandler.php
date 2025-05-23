<?php

namespace App\MessageHandler;

use App\Entity\Payment;
use App\Message\SavePaymentMessage;
use App\Repository\PaymentRepository;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final class SavePaymentHandler
{
    public function __construct(
        private PaymentRepository $paymentRepository
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