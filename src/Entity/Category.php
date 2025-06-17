<?php

namespace App\Entity;

class Category
{
    public function __construct(
        private int $id,
        private User $user,
        private string $description
    ) {}

    public function Id(): int
    {
        return $this->id;
    }

    public function user(): User
    {
        return $this->user;
    }

    public function description(): string
    {
        return $this->description;
    }
}