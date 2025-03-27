<?php

namespace App\Services;

use App\Repositories\Task\TaskRepositoryInterface;

class TaskService
{
    /**
     * Create a new class instance.
     */
    public function __construct(private TaskRepositoryInterface $taskRepositoryInterface)
    {
        
    }

    public function storeTask(array $data,int $userId):array
    {
        $data['user_id']=$userId;
        $data["finished_at"]=$data["finished_at"] ?? null;
        return $this->taskRepositoryInterface->store($data);
    }

    public function updateTask(array $data,int $userId) :array
    {
        $where['user_id']=$userId;
        return $this->taskRepositoryInterface->updateWhere($data,$where);
    }
}
