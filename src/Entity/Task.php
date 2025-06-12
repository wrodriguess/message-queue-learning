<?php

namespace App\Entity;

use DateTimeImmutable;

class Task
{
    public function __construct(
        private ?int $id,
        private ?string $uuid,
        private int $userId,
        private string $title,
        private ?string $description,
        private int $statusId,
        private DateTimeImmutable $dueDate,
        private string $priority,
        private string $category,
        private DateTimeImmutable $createdAt,
        private DateTimeImmutable $updatedAt,
        private ?DateTimeImmutable $deletedAt
    ) {}

    public function toArray(): array
    {
        return [
            'array' => 'ok'
        ];
    }
}