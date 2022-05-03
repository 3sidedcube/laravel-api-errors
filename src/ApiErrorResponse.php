<?php

namespace ThreeSidedCube\LaravelApiErrors;

use Illuminate\Http\JsonResponse;
use ThreeSidedCube\LaravelApiErrors\Exceptions\ApiErrorException;

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
        return static::asJson($exception->code(), $exception->message(), $exception->statusCode(), $exception->meta());
    }

    /**
     * Crate a new API error response.
     *
     * @param  string  $code
     * @param  string  $message
     * @param  int  $statusCode
     * @param  array  $meta
     * @return JsonResponse
     */
    public static function create(string $code, string $message, int $statusCode = 400, array $meta = []): JsonResponse
    {
        return static::asJson($code, $message, $statusCode, $meta);
    }

    /**
     * Get the API Error response as a json response.
     *
     * @param  string  $code
     * @param  string  $message
     * @param  int  $statusCode
     * @param  array  $meta
     * @return JsonResponse
     */
    protected static function asJson(string $code, string $message, int $statusCode = 400, array $meta = []): JsonResponse
    {
        $data = [
            'error' => [
                'code' => $code,
                'message' => $message,
            ],
        ];

        if (! empty($meta)) {
            $data['error']['meta'] = $meta;
        }

        return response()->json($data, $statusCode);
    }
}
