<?php

namespace App\Repository;

use App\Entity\Payment2;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Payment2>
 */
class Payment2Repository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Payment2::class);
    }

    public function persist(Payment2 $payment): void
    {
        try {

            $em = $this->getEntityManager();
            $em->persist($payment);
            $em->flush();
        } catch (\Exception $e) {
            dd($e);
            throw new \Exception('Não foi possivel salvar o pagamento na base de dados.');
        }
    }

    //    /**
    //     * @return Payment2[] Returns an array of Payment2 objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Payment2
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
