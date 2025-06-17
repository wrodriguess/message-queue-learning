<?php

namespace App\Repository\Contracts;

use App\Entity\Status;

interface StatusRepositoryInterface
{
    public function getById(int $id): Status;
}