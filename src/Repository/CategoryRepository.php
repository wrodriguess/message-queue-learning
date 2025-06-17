<?php

namespace App\Repository;

use App\Entity\Category;
use App\Entity\User;
use App\Repository\Contracts\CategoryRepositoryInterface;
use Exception;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Category>
 */
class CategoryRepository extends ServiceEntityRepository implements CategoryRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
    }

    public function getById(int $id, User $user): Category
    {
        $em = $this->getEntityManager();
        $category = $em
            ->getRepository(Category::class)
            ->findOneBy(['id' => $id, 'user' => $user]);

        if ($category === null) {
            // TODO: adicionar exceção de dominio
            throw new Exception('Categoria não encontrada.');
        }

        return $category;
    }
}
