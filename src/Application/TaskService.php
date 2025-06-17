<?php

namespace App\Application;

use App\Repository\Contracts\CategoryRepositoryInterface;
use App\Repository\Contracts\StatusRepositoryInterface;
use App\Repository\Contracts\TaskRepositoryInterface;
use App\Repository\Contracts\UserRepositoryInterface;
use DateTimeImmutable;
use App\Application\DTO\TaskDto;
use App\Entity\Task;
use Symfony\Component\Uid\Uuid;

class TaskService
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
        private StatusRepositoryInterface $statusRepository,
        private CategoryRepositoryInterface $categoryRepository,
        private TaskRepositoryInterface $taskRepository,
    )
    {
    }

    public function create(int $userId, TaskDto $taskDto): Task
    {
        $user = $this->userRepository->getById($userId);
        $status = $this->statusRepository->getById($taskDto->statusId());
        $category = $this->categoryRepository->getById($taskDto->categoryId(), $user);

        $task = new Task(
            null,
            Uuid::v7(),
            $user,
            $taskDto->title(),
            $taskDto->description(),
            $status,
            new DateTimeImmutable($taskDto->dueDate()),
            $taskDto->priority(),
            $category,
            new DateTimeImmutable(),
            new DateTimeImmutable(),
            new DateTimeImmutable(),
        );

        $this->taskRepository->create($task);

        return $task;
    }

    public function getById($id, $userId): Task
    {
        $user = $this->userRepository->getById($userId);

        return $this->taskRepository->getById($id, $user);
    }

    public function findAll($userId): ?array
    {
        $user = $this->userRepository->getById($userId);

        $taskList = $this->taskRepository->findAllByUser($user);

        $output = [];

        foreach ($taskList as $task) {
            $output[] = $task->toArray();
        }

        return $output;
    }
}