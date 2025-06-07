<?php

namespace App\Repository;

use App\Entity\Payment;
use App\Repository\Contracts\PaymentRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Payment>
 */
class PaymentRepository extends ServiceEntityRepository implements PaymentRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Payment::class);
    }

    public function create(Payment $payment): void
    {
        $em = $this->getEntityManager();
        $em->persist($payment);
        $em->flush();
    }
}
