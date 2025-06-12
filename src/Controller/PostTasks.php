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

class PostTasks
{
    public function __construct(private TaskService $taskService)
    {
    }

    #[Route('/tasks', name: 'tasks', methods: ['POST'])]
    public function handle(Request $request): JsonResponse
    {
        $data = $request->toArray();

        try {
            v::key('title', v::stringType()->notEmpty())
                ->key('description', v::stringType(), false)
                ->key('statusId', v::intType()->notEmpty())
                ->key('dueDate', v::date())
                ->key('priority', v::in(['low', 'medium', 'hight']))
                ->key('categoryId', v::intType()->notEmpty())
                ->assert($data);

            $taskDto = new TaskDto(
                $data['title'],
                $data['description'] ?? null,
                $data['statusId'],
                $data['dueDate'],
                $data['priority'],
                $data['categoryId']
            );

            $task = $this->taskService->create($this->getUserId(), $taskDto);

            $payload = $task->toArray();
            $statusCode = Response::HTTP_OK;
        } catch(NestedValidationException $e) {
            $payload = [
                'status' => 'error',
                'type' => 'ValidationError',
                'message' => 'Houve um erro ao validar o corpo da requisição',
                'erros' => $e->getMessages(),
            ];

            $statusCode = Response::HTTP_UNPROCESSABLE_ENTITY;
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
