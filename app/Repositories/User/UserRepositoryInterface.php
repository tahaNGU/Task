<?php

namespace App\Repositories\User;

interface UserRepositoryInterface
{
    public function store(array $data):mixed;
    public function getWhere(array $where):mixed;
}
