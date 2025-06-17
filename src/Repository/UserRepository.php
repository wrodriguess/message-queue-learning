<?php

namespace App\Repository;

use Exception;
use App\Entity\User;
use App\Repository\Contracts\UserRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<User>
 */
class UserRepository extends ServiceEntityRepository implements UserRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function getById(int $id): User
    {
        $em = $this->getEntityManager();
        $user = $em->find(User::class, $id);

        if ($user === null) {
            // TODO: adicionar exceção de dominio
            throw new Exception('Usuário não encontrado.');
        }

        return $user;
    }
}
