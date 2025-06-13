<?php

namespace App\Controller;

use DomainException;
use App\Application\PaymentService;
use App\Application\DTO\PaymentDto;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class PostPayment
{
    public function __construct(private PaymentService $paymentService)
    {
    }

    #[Route('/payments', name: 'payments', methods: ['POST'])]
    public function handle(Request $request): JsonResponse
    {
        $data = $request->toArray();

        try {
            v::key('user_id', v::stringType()->notEmpty())
                ->key('value', v::floatType()->positive()->notEmpty())
                ->key('currency_code', v::in(['BRL', 'USD', 'EUR']))
                ->key('payment_method', v::in(['cartao_credito', 'pix', 'boleto']))
                ->assert($data);

            $paymentDto = new PaymentDto(
                $data['user_id'],
                $data['value'],
                $data['currency_code'],
                $data['payment_method']
            );

            $payment = $this->paymentService->create($paymentDto);

            $payload = $payment->toArray();
            $statusCode = Response::HTTP_CREATED;
        } catch(NestedValidationException $e) {
            $payload = [
                'status' => 'error',
                'type' => 'ValidationError',
                'message' => 'Houve um erro ao validar o corpo da requisição',
                'erros' => $e->getMessages(),
            ];

            $statusCode = Response::HTTP_UNPROCESSABLE_ENTITY;
        } catch (DomainException $e) {
            $payload = [
                'status' => 'error',
                'type' => $e->getType(),
                'message' => $e->getMessage(),
            ];

            $statusCode = Response::HTTP_BAD_REQUEST;
        }

        return new JsonResponse($payload, $statusCode);
    }
}
