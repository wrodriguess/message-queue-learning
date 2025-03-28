<?php

namespace App\Application;

use App\Application\DTO\PaymentDto;
use App\Entity\Payment;
use App\Entity\Payment2;
use App\Repository\Payment2Repository;
use App\Repository\PaymentRepository;
use App\ValueObject\Currency;
use App\ValueObject\PaymentMethodValueObject;
use App\ValueObject\Value;

class CreatePayment
{
    // TODO: testes unitários (controller, serviço, entidade e valueObject)
    // TODO: criar exceção de domínio
    public function __construct(
        private PaymentRepository $paymentRepository,
        private Payment2Repository $payment2Repository
    )
    {
    }

    public function execute(PaymentDto $paymentDto): payment
    {
        // 1. Buscar o userId (validar se usuário existe)
        // $user = $this->userRepository->getById($paymentDto->userId());

        // [DÚVIDA]: ao invés de enum em Currency e PaymentMethod pensei em criar objetos de valores com clausolas de
        // guarda, porém optei por enum, mas essa abordagem com construtor estático não é usual para mim

        // [DUVIDA2]: Não sei se vale a pena criar objeto de valor para value, currency e paymentMethod por serem
        // tão simples

        $payment = new Payment(
            $paymentDto->userId(),
            new Value($paymentDto->value()),
            Currency::fromString($paymentDto->currencyCode()),
            PaymentMethodValueObject::fromString($paymentDto->paymentMethod())
        );

        $payment2 = new Payment2(
            $paymentDto->userId(),
            $paymentDto->value(),
            $paymentDto->currencyCode(),
            $paymentDto->paymentMethod()
        );
        $this->payment2Repository->persist($payment2);

        // TODO: não consegui criar a migration, criei a tabela direto no banco de dados
        /*
        CREATE TABLE payment.payment (
            id INT auto_increment NOT NULL,
            user_id varchar(32) NOT NULL,
            value DECIMAL NOT NULL,
            currency varchar(3) NOT NULL,
            payment_method varchar(14) NULL,
            PRIMARY KEY (id)
        )
        ENGINE=InnoDB
        DEFAULT CHARSET=utf8
        COLLATE=utf8_general_ci;
         */
//        $this->paymentRepository->persist($payment2);
        dd('1');

        return $payment;
    }

}