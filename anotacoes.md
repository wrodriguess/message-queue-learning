# Ajustes / Melhorias

## Testes unitários

Implementar testes unitários:
- Controller
- Service
- Entidade
- Objetos de valor

## Exceção de dominio

Criar exceção de dominio e substituir as exceções genericas

## CreatePayment
- TODO: Adicionar autenticação na API
- TODO: swagger
- Simular a busca do userId
  // 1. Buscar o userId (validar se usuário existe)
  // $user = $this->userRepository->getById($paymentDto->userId());

## Implementar a entidade utilizando objetos de valor
// TODO: não consegui implementar utilizando objeto de valor
//        $payment = new Payment(
//            $paymentDto->userId(),
//            new Value($paymentDto->value()),
//            Currency::fromString($paymentDto->currencyCode()),
//            PaymentMethodValueObject::fromString($paymentDto->paymentMethod())
//        );

## Implementar RabbitMQ
implemente RabbitMQ para comunicação assíncrona

## Utilizar SOLID
siga os princípios SOLID para garantir boas práticas de desenvolvimento.

O objetivo é criar um fluxo eficiente para processar pagamentos de forma escalável e desacoplada.

## PHPMD

## DÚVIDAS

### 1
// [DÚVIDA]: ao invés de enum em Currency e PaymentMethod pensei em criar objetos de valores com clausolas de
// guarda, porém optei por enum, mas essa abordagem com construtor estático não é usual para mim

### 2
// [DUVIDA2]: Não sei se vale a pena criar objeto de valor para value, currency e paymentMethod por serem
// tão simples

### 3
Não consegui implementar a inversão de dependencia, criando PaymentRepository como interface e DoctrinePaymentRepository
sendo a implementação real