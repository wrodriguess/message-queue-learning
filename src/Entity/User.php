<?php

namespace App\Entity;

class User
{
    public function __construct(
        private int $id,
        private string $name
    ) {}

    public function Id(): int
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }
}