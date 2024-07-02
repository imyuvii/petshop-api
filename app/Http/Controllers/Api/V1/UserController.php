<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\LoginRequest;
use App\Services\UserService;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    use ApiResponse;

    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @OA\Post(
     *     path="/api/v1/user/register",
     *     tags={"User"},
     *     summary="Register a new user",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *              mediaType="application/x-www-form-urlencoded",
     *              @OA\Schema(ref="#/components/schemas/CreateUserRequest")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="User registered successfully",
     *         @OA\JsonContent(ref="#/components/schemas/User")
     *     ),
     *     @OA\Response(response=422, description="Validation Error"),
     *     @OA\Response(response=500, description="Server Error")
     * )
     */
    public function createUser(CreateUserRequest $request): JsonResponse
    {
        $validatedData = $request->validated();
        $user = $this->userService->register($validatedData);

        return $this->success($user, 201);
    }

    /**
     * @OA\Post(
     *     path="/api/v1/user/login",
     *     tags={"User"},
     *     summary="Login user",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(ref="#/components/schemas/LoginRequest")
     *         )
     *     ),
     *     @OA\Response(response="200", description="Successful login"),
     *     @OA\Response(response=401, description="Unauthorized"),
     *     @OA\Response(response=422, description="Validation Error"),
     *     @OA\Response(response=500, description="Server Error")
     * )
     */
    public function loginUser(LoginRequest $request): JsonResponse
    {
        $credentials = $request->validated();
        $authData = $this->userService->authenticate($credentials);

        return $this->success($authData);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/user/logout",
     *     tags={"User"},
     *     summary="Logout user",
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(response=401, description="Unauthorized"),
     *     @OA\Response(response=422, description="Validation Error"),
     *     @OA\Response(response=500, description="Server Error")
     * )
     */
    public function logout(): JsonResponse
    {
        $this->userService->logout();
        return $this->success([], 204);
    }
}
