<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Exception;
use App\Entity\Payment;

class DoctrinePaymentRepository extends ServiceEntityRepository implements PaymentRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Payment::class);
    }

    public function persist(Payment $payment): void
    {
//        try {
//            $this->connection->beginTransaction();

            $sql = "INSERT INTO payment
                    (user_id, value, currency_currency_code, payment_method_payment_method)
                    VALUES (:user_id, :value, :currency_currency_code, :payment_method_payment_method);";

            $stmt = $this
                ->getEntityManager()
                ->getConnection()
                ->prepare($sql);

            $stmt->bindValue(':user_id', $payment->userId());
            $stmt->bindValue(':value', $payment->value());
            $stmt->bindValue(':currency_currency_code', $payment->currency());
            $stmt->bindValue(':payment_method_payment_method', $payment->paymentMethod());

            $stmt->executeQuery();

//            $em = $this->getEntityManager();
//            $em->persist($payment);
//            $em->flush();
//        } catch (Exception $e) {
//            dd($e);
//            throw new Exception('Não foi possivel salvar o pagamento na base de dados.');
//        }
    }
}