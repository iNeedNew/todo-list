<?php

namespace App\Http\Response;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ApiAuthResponse extends JsonResponse
{
    public static function json(?string $message = null, ?array $data = null, int $httpCode = 200): JsonResponse
    {
        $response = [];

            is_null($message) ?: $response['message'] = $message;
            is_null($data) ?: $response['data'] = $data;

        return response()->json(
            $response,
            $httpCode
        );
    }
}
