<?php

namespace App\Repository;

use Exception;
use App\Entity\Payment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Payment>
 */
class PaymentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Payment::class);
    }

    public function persist(Payment $payment): void
    {
        try {

            $em = $this->getEntityManager();
            $em->persist($payment);
            $em->flush();
        } catch (Exception $e) {
            dd($e);
            throw new Exception('Não foi possivel salvar o pagamento na base de dados.');
        }
    }
}
