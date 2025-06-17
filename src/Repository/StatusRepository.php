<?php

namespace App\Repository;

use Exception;
use App\Entity\Status;
use App\Repository\Contracts\StatusRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Status>
 */
class StatusRepository extends ServiceEntityRepository implements StatusRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Status::class);
    }

    public function getById(int $id): Status
    {
        $em = $this->getEntityManager();
        $status = $em->find(Status::class, $id);

        if ($status === null) {
            // TODO: adicionar exceção de dominio
            throw new Exception('Status desconhecido.');
        }

        return $status;
    }
}
