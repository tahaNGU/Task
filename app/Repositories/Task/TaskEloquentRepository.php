<?php

namespace App\Repositories\Task;

use App\Models\Task;

class TaskEloquentRepository implements TaskRepositoryInterface
{
    public function store(array $data):array
    {
        return Task::create($data)->toArray();
    }

    public function getWhere(array $where,int $nPage=20):mixed
    {
        return Task::where($where)->get();
    }

    public function updateWhere(array $data,array $where) :array
    {

        Task::where($where)->update($data);
        return Task::where($where)->first()->toArray();
    }

    public function deleteWhere(array $where):void
    {
        Task::where($where)->delete();
    }

    public function getWhereFirst(array $where):array
    {
        return Task::where($where)->first()?->toArray() ?? [];
    }
}
