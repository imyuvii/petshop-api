<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\LoginRequest;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function createUser(CreateUserRequest $request): JsonResponse
    {
        $validatedData = $request->validated();
        $user = $this->userService->register($validatedData);

        return response()->json(['success' => true, 'data' => $user], 201);
    }

    public function loginUser(LoginRequest $request): JsonResponse
    {
        $credentials = $request->validated();
        $authData = $this->userService->authenticate($credentials);

        return response()->json(['success' => true, 'data' => $authData]);
    }
}
