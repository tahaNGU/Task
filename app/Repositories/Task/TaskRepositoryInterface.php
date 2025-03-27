<?php

namespace App\Repositories\Task;

interface TaskRepositoryInterface
{
    public function store(array $data):array;

    public function getWhere(array $where,int $nPage):array;

    public function updateWhere(array $data,array $where):array;

    public function deleteWhere(array $where):void;

    public function firstWhere(array $where):array;
}
