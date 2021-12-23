<?php

namespace ThreeSidedCube\LaravelApiErrors\Exceptions;

use ThreeSidedCube\LaravelApiErrors\ApiErrorResponse;
use Exception;
use Illuminate\Http\JsonResponse;

abstract class ApiErrorException extends Exception
{
    /**
     * A short error code describing the error.
     *
     * @return string
     */
    abstract public function code(): string;

    /**
     * A human-readable message providing more details about the error.
     *
     * @return string
     */
    abstract public function message(): string;

    /**
     * The api error status code.
     *
     * @return int
     */
    public function statusCode(): int
    {
        return 400;
    }

    /**
     * Report the exception.
     *
     * @return bool
     */
    public function report(): bool
    {
        return false;
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @return JsonResponse
     */
    public function render(): JsonResponse
    {
        return ApiErrorResponse::fromException($this);
    }
}
