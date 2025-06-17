<?php

namespace App\Controller;

use App\Application\TaskService;
use DomainException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class GetTasks
{
    public function __construct(private TaskService $taskService)
    {
    }

    #[Route('/tasks', name: 'getTasks', methods: ['GET'])]
    public function handle(): JsonResponse
    {
        try {
            $userId = $this->getUserId();

            $payload = $this->taskService->findAll($userId);

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
        return 2;
    }
}
