<?php

namespace App\Tests\Application;

use App\Application\DTO\PaymentDto;
use App\Application\PaymentService;
use PHPUnit\Framework\TestCase;
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
//        $this->messageBusInterfaceMock->expects($this->once())->method('dispatch');

        $paymentDto = new PaymentDto(
            "5eec725c-ad2d-4f7e-9582-6663c8f06953",
            51.10,
            "BRL",
            "pix"
        );

        $this->instance->create($paymentDto);
    }
}
