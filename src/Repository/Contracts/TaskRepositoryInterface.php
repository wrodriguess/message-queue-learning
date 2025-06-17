<?php

namespace App\Repository\Contracts;

use App\Entity\Task;
use App\Entity\User;

interface TaskRepositoryInterface
{
    public function create(Task $task): void;
    public function getById(string $id, User $user): Task;
    public function findAllByUser(User $user): array;
}