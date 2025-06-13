<?php

namespace App\Controller;

use App\Application\PaymentService;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class PostPaymentTest extends TestCase
{
    private PaymentService $paymentServiceMock;
    private PostPayment $instance;

    public function setUp(): void
    {
        $this->paymentServiceMock = $this->createMock(PaymentService::class);
        $this->instance = new PostPayment($this->paymentServiceMock);
    }

    /**
     * @dataProvider dataProvider
     */
    public function testPayment(array $payload, string $expectedMessage, int $httpCode): void
    {
        $requestStub = $this->createStub(Request::class);
        $requestStub->method('toArray')->willReturn($payload);

        $actual = $this->instance->handle($requestStub);

        $this->assertInstanceOf(JsonResponse::class, $actual);
        $this->assertEquals($httpCode, $actual->getStatusCode());
        $this->assertEquals($expectedMessage, (string) $actual->getContent());
    }

    private function dataProvider(): array
    {
        return [
            'valid payload' => [
                $this->validPayload(),
                '[]',
                201
            ],
            'user_id equals null' => [
                array_merge($this->validPayload(), ["user_id" => ""]),
                '{"status":"error","type":"ValidationError","message":"Houve um erro ao validar o corpo da requisi\u00e7\u00e3o","erros":["user_id must not be empty"]}',
                422
            ],
            'value equals string' => [
                array_merge($this->validPayload(), ["value" => "cem reais"]),
                '{"status":"error","type":"ValidationError","message":"Houve um erro ao validar o corpo da requisi\u00e7\u00e3o","erros":["value must be of the type float"]}',
                422
            ],
            'currency_code equals unknown' => [
                array_merge($this->validPayload(), ["currency_code" => "JPY"]),
                '{"status":"error","type":"ValidationError","message":"Houve um erro ao validar o corpo da requisi\u00e7\u00e3o","erros":["currency_code must be in { \u0022BRL\u0022, \u0022USD\u0022, \u0022EUR\u0022 }"]}',
                422
            ],
            'payment_method equals unknown' => [
                array_merge($this->validPayload(), ["payment_method" => "permuta"]),
                '{"status":"error","type":"ValidationError","message":"Houve um erro ao validar o corpo da requisi\u00e7\u00e3o","erros":["payment_method must be in { \u0022cartao_credito\u0022, \u0022pix\u0022, \u0022boleto\u0022 }"]}',
                422
            ],
        ];
    }

    private function validPayload(): array
    {
        return [
            "user_id" => "5eec725c-ad2d-4f7e-9582-6663c8f06953",
            "value" => 51.10,
            "currency_code" => "BRL",
            "payment_method" => "pix"
        ];
    }
}
