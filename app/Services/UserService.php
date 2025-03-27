<?php

namespace App\Services;

use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function __construct(private UserRepositoryInterface $userRepositoryInterface)
    {
        
    }
    public function registerUser(array $data)
    {
        $data=$this->userRepositoryInterface->store($data);
        $data['token']=$data->createToken('web-token')->plainTextToken;
        return $data->toArray();
    }
    public function loginUser(array $data){
        $where["email"]=$data["email"];
        $user=$this->userRepositoryInterface->getWhere($where) ?? [];
        if (!$user || !Hash::check($data["password"], $user["password"])) {
            return [];
        }
        $user["token"]=$user->createToken('web-token')->plainTextToken;
        return $user;
    }
    public function logout(int $userId){
        $where["id"]=$userId;
        $user=$this->userRepositoryInterface->getWhere(
            where: $where
        );
        return $user->tokens()->delete();
    }
}
