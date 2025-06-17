<?php

namespace App\Entity;

use DateTimeImmutable;

class Task
{
    public function __construct(
        private ?int $id,
        private ?string $uuid,
        private User $user,
        private string $title,
        private ?string $description,
        private Status $status,
        private DateTimeImmutable $dueDate,
        private string $priority,
        private Category $category,
        private DateTimeImmutable $createdAt,
        private DateTimeImmutable $updatedAt,
        private ?DateTimeImmutable $deletedAt
    ) {}

    public function toArray(): array
    {
        return [
            'id' => $this->uuid,
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status->description(),
            'dueDate' => $this->dueDate->format('d/m/Y'),
            'priority' => $this->priority,
            'category' => $this->category->description(),
        ];
    }
}