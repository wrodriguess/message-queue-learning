<?php

namespace App\Repository\Contracts;

use App\Entity\Category;
use App\Entity\User;

interface CategoryRepositoryInterface
{
    public function getById(int $id, User $user): Category;
}