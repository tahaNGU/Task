<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreTaskRequest;
use App\Http\Requests\Api\UpdateTaskRequest;
use App\Http\Resources\Api\TaskStoreResource;
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
        $task=$this->taskService->storeTask(
            data:$request->validated(),
            userId:auth()->user()->id
        );
        return ApiResponse::withData(new TaskStoreResource($task))->withMessage('Added Task Successfully')->withStatus(Response::HTTP_OK)->Builder();
    }

    public function update(UpdateTaskRequest $request) 
    {   
        $task=$this->taskService->updateTask(
            data:$request->validated(),
            userId:auth()->user()->id
        );
        return ApiResponse::withData(new TaskStoreResource($task))->withMessage('Updated Task Successfully')->withStatus(Response::HTTP_OK)->Builder();
    }
}
