<?php

namespace App\Repository\Contracts;

use App\Entity\User;

interface UserRepositoryInterface
{
    public function getById(int $id): User;
}