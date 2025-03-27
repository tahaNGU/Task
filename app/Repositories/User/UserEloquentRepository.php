<?php

namespace App\Repositories\User;

use App\Models\User;

class UserEloquentRepository implements UserRepositoryInterface
{
    public function store(array $data) :mixed
    {
        return User::create($data);
    }

    public function getWhere(array $where): mixed
    {
        return User::where($where)->first();
    }
}
