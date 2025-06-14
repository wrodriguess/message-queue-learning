<?php

namespace App\Tests\Application;

use App\Application\DTO\PaymentDto;
use App\Application\PaymentService;
use App\Message\SavePaymentMessage;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\MessageBusInterface;

class PaymentServiceTest extends TestCase
{
    private MessageBusInterface $messageBusInterfaceMock;
    private PaymentService $instance;

    public function setUp(): void
    {
        $this->messageBusInterfaceMock = $this->createMock(MessageBusInterface::class);

        $this->instance = new PaymentService($this->messageBusInterfaceMock);
    }

    public function testCreatePaymentShouldWork(): void
    {
        $paymentDto = new PaymentDto(
            "123",
            100.50,
            "BRL",
            "pix"
        );

        $message = new SavePaymentMessage(
            $paymentDto->userId(),
            $paymentDto->value(),
            $paymentDto->currencyCode(),
            $paymentDto->method()
        );

        $this->messageBusInterfaceMock
            ->expects($this->once())
            ->method('dispatch')
            ->with($message)
            ->willReturn(new Envelope($message));

        $this->instance->create($paymentDto);
    }
}
