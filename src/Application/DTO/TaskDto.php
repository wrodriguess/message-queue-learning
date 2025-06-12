<?php

namespace App\Application\DTO;

class TaskDto
{
    public function __construct(
        private string $title,
        private ?string $description,
        private int $statusId,
        private string $dueDate,
        private string $priority,
        private int $categoryId
    ) {
    }

    public function title(): string
    {
        return $this->title;
    }

    public function description(): ?string
    {
        return $this->description;
    }

    public function statusId(): int
    {
        return $this->statusId;
    }

    public function dueDate(): string
    {
        return $this->dueDate;
    }

    public function priority(): string
    {
        return $this->priority;
    }

    public function categoryId(): int
    {
        return $this->categoryId;
    }
}
