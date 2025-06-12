<?php

namespace App\Application;

use App\Repository\Contracts\TaskRepositoryInterface;
use DateTimeImmutable;
use App\Application\DTO\TaskDto;
use App\Entity\Task;

class TaskService
{
    public function __construct(private TaskRepositoryInterface $taskRepository)
    {
    }

    public function create(int $userId, TaskDto $taskDto): Task
    {
        $task = new Task(
            null,
            "c07819d9-0032-4148-9018-b79901e740b0",
            $userId,
            $taskDto->title(),
            $taskDto->description(),
            $taskDto->statusId(),
            new DateTimeImmutable($taskDto->dueDate()),
            $taskDto->priority(),
            $taskDto->categoryId(),
            new DateTimeImmutable(),
            new DateTimeImmutable(),
            new DateTimeImmutable(),
        );

        // Salvar no banco de dados
        $this->taskRepository->create($task);

        return $task;
    }
}