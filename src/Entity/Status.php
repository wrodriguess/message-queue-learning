<?php

namespace App\Entity;

class Status
{
    public function __construct(
        private int $id,
        private string $description
    ) {}

    public function Id(): int
    {
        return $this->id;
    }

    public function description(): string
    {
        return $this->description;
    }
}