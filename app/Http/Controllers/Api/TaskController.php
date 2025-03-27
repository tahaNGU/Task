<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreTaskRequest;
use App\Http\Requests\Api\UpdateTaskRequest;
use App\Http\Resources\Api\Task\TaskResource;
use App\Http\Resources\Api\Task\TaskResourceCollection;
use App\Http\Resources\Api\Task\TaskStoreResource;
use App\Http\Resources\Api\Task\TaskUpdateResource;
use App\RestFullApi\Facade\ApiResponse;
use App\Services\TaskService;
use Symfony\Component\HttpFoundation\Response;

class TaskController extends Controller
{
    public function __construct(private TaskService $taskService)
    {

    }

    public function create(StoreTaskRequest $request)
    {
        $task = $this->taskService->storeTask(
            data: $request->validated(),
            userId: auth()->user()->id
        );
        return ApiResponse::withData(new TaskStoreResource($task))->withMessage('Added Task Successfully')->withStatus(Response::HTTP_OK)->Builder();
    }

    public function update(UpdateTaskRequest $request)
    {
        $task = $this->taskService->updateTask(
            data: $request->validated(),
            userId: auth()->user()->id
        );
        return ApiResponse::withData(new TaskUpdateResource($task))->withMessage('Updated Task Successfully')->withStatus(Response::HTTP_OK)->Builder();
    }

    public function getTask(int $task)
    {
        $task = $this->taskService->getTask(
            userId: auth()->user()->id,
            taskId: $task
        );
        if ($task) {
            return ApiResponse::withData(new TaskResource($task))->withMessage('Task')->withStatus(Response::HTTP_OK)->Builder();
        }else{
            return ApiResponse::withData([])->withMessage('Task Not Found')->withStatus(Response::HTTP_NOT_FOUND)->Builder();
        }
    }

    public function getTasks()
    {
        $tasks = $this->taskService->getTasks(
            userId: auth()->user()->id,
        );
        return ApiResponse::withData(new TaskResourceCollection($tasks))->withMessage('Tasks')->withStatus(Response::HTTP_OK)->Builder();
    }

}
