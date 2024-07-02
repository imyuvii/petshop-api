<?php

namespace App\Services;

use App\Traits\ApiResponse;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class ExceptionHandlerService
{
    use ApiResponse;

    public function shouldRenderJsonWhen(Request $request, \Throwable $e): bool
    {
        return $request->is('api/*') || $request->expectsJson();
    }

    public function renderJsonResponse(\Throwable $e): JsonResponse
    {
        $response = match (true) {
            $e instanceof AuthenticationException => ['status' => 401, 'message' => 'Invalid credentials.'],
            $e instanceof TokenInvalidException => ['status' => 401, 'message' => 'The provided token is invalid.'],
            $e instanceof TokenExpiredException => ['status' => 401, 'message' => 'The token has expired.'],
            $e instanceof JWTException => ['status' => 401, 'message' => 'An error occurred while parsing the token.'],
            $e instanceof NotFoundHttpException => ['status' => 404, 'message' => 'The requested resource could not be found.'],
            $e instanceof ValidationException => ['status' => 422, 'message' => 'Validation errors occurred.', 'errors' => $e->errors()],
            default => ['status' => 500, 'message' => 'Internal Server Error', 'errors' => ['message' => $e->getMessage()]],
        };

        return $this->failed($response['message'], $response['status'], $response['errors'] ?? []);
    }
}
