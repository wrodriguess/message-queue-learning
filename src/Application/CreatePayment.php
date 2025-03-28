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
    // TODO: testes unitários (controller, serviço, entidade e valueObject)
    // TODO: criar exceção de domínio
    public function __construct(
        private PaymentRepository $paymentRepository
    )
    {
    }

    public function execute(PaymentDto $paymentDto): Payment
    {
        // 1. Buscar o userId (validar se usuário existe)
        // $user = $this->userRepository->getById($paymentDto->userId());

        // [DÚVIDA]: ao invés de enum em Currency e PaymentMethod pensei em criar objetos de valores com clausolas de
        // guarda, porém optei por enum, mas essa abordagem com construtor estático não é usual para mim

        // [DUVIDA2]: Não sei se vale a pena criar objeto de valor para value, currency e paymentMethod por serem
        // tão simples

        $payment2 = new Payment(
            $paymentDto->userId(),
            $paymentDto->value(),
            $paymentDto->currencyCode(),
            $paymentDto->paymentMethod()
        );
        $this->paymentRepository->persist($payment2);

        return $payment2;
    }

}