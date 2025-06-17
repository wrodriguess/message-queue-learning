<?php

namespace App\Repository;

use App\Entity\User;
use Exception;
use App\Entity\Task;
use App\Repository\Contracts\TaskRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Task>
 */
class TaskRepository extends ServiceEntityRepository implements TaskRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Task::class);
    }

    public function create(Task $task): void
    {
        $em = $this->getEntityManager();
        $em->persist($task);
        $em->flush();
    }

    public function getById(string $id, User $user): Task
    {
        $em = $this->getEntityManager();
        $task = $em
            ->getRepository(Task::class)
            ->findOneBy(['uuid' => $id, 'user' => $user]);

        if ($task === null) {
            // TODO: adicionar exceção de dominio
            throw new Exception('Tarefa não encontrada.');
        }

        return $task;
    }

    public function findAllByUser(User $user): array
    {
        $em = $this->getEntityManager();
        $taskList = $em
            ->getRepository(Task::class)
            ->findBy(['user' => $user]);

        return $taskList ?? [];
    }
}
