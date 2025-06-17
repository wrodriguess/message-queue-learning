<?php

namespace App\Controller;

use App\Application\DTO\TaskDto;
use App\Application\TaskService;
use DomainException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class GetTaskById
{
    public function __construct(private TaskService $taskService)
    {
    }

    #[Route('/tasks/{id}', name: 'getTaskById', methods: ['GET'])]
    public function handle(string $id): JsonResponse
    {
        try {
            $userId = $this->getUserId();

            $task = $this->taskService->getById($id, $userId);

            $payload = $task->toArray();
            $statusCode = Response::HTTP_OK;
        } catch (DomainException $e) {
            $payload = [
                'status' => 'error',
                'type' => $e->getType(),
                'message' => $e->getMessage(),
            ];

            $statusCode = Response::HTTP_BAD_REQUEST;
        }

        return new JsonResponse($payload, $statusCode);
    }

    private function getUserId(): int
    {
        return 1;
    }
}
