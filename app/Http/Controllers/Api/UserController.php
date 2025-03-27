<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserLoginRequest;
use App\Http\Requests\Api\UserRegisterRequest;
use App\Http\Resources\Api\User\UserLoginResource;
use App\Http\Resources\Api\User\UserRegisterResource;
use App\RestFullApi\Facade\ApiResponse;
use App\Services\UserService;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function __construct(private UserService $UserService)
    {

    }

    public function register(UserRegisterRequest $request)
    {
        $user = $this->UserService->registerUser($request->validated());
        return ApiResponse::withData(new UserRegisterResource($user))->withMessage('Register User Successfully')->withStatus(Response::HTTP_OK)->Builder();
    }

    public function login(UserLoginRequest $request)
    {
        $user = $this->UserService->loginUser($request->validated());
        if (empty($user)) {
            return ApiResponse::withData([])->withMessage('Invalid credentials')->withStatus(Response::HTTP_UNAUTHORIZED)->Builder();
        } else {
            return ApiResponse::withData(new UserLoginResource($user))->withMessage('Login User SuccessFully')->withStatus(Response::HTTP_OK)->Builder();
        }
    }

    public function logout()
    {
        $logout = $this->UserService->logout(
            userId: auth()->user()->id
        );
        if ($logout) {
            return ApiResponse::withData([])->withMessage('Logout SuccessFully')->withStatus(Response::HTTP_OK)->Builder();
        }
    }
}
