<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    /**
     * @param  mixed  $data
     * @param  array<string, mixed>  $meta
     */
    protected function success($data = [], int $status = 200, array $meta = []): JsonResponse
    {
        $dataBody = [
            'success' => true,
            'data' => $data,
        ];

        if (! empty($meta)) {
            $dataBody = array_merge($dataBody, $meta);
        }

        return response()->json($dataBody, $status);
    }

    protected function failed(string $message, int $status = 400, array $errors = []): JsonResponse
    {
        $dataBody = [
            'success' => false,
            'message' => $message,
        ];

        if (! empty($errors)) {
            $dataBody['errors'] = $errors;
        }

        return response()->json($dataBody, $status);
    }
}
