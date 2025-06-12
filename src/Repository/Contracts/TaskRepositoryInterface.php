<?php

namespace App\Repository\Contracts;

use App\Entity\Task;

interface TaskRepositoryInterface
{
    public function create(Task $task): void;
}