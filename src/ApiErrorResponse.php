<?php

namespace ThreeSidedCube\LaravelApiErrors;

use ThreeSidedCube\LaravelApiErrors\Exceptions\ApiErrorException;
use Illuminate\Http\JsonResponse;

class ApiErrorResponse
{
    /**
     * Create an API error response from an exception.
     *
     * @param  ApiErrorException  $exception
     * @return JsonResponse
     */
    public static function fromException(ApiErrorException $exception): JsonResponse
    {
        return static::asJson($exception->code(), $exception->message(), $exception->statusCode());
    }

    /**
     * Crate a new API error response.
     *
     * @param  string  $code
     * @param  string  $message
     * @param  int  $statusCode
     * @return JsonResponse
     */
    public static function create(string $code, string $message, int $statusCode = 400): JsonResponse
    {
        return static::asJson($code, $message, $statusCode);
    }

    /**
     * Get the API Error response as a json response.
     *
     * @param  string  $code
     * @param  string  $message
     * @param  int  $statusCode
     * @return JsonResponse
     */
    protected static function asJson(string $code, string $message, int $statusCode = 400): JsonResponse
    {
        return response()->json([
            'error' => [
                'code' => $code,
                'message' => $message,
            ],
        ], $statusCode);
    }
}
