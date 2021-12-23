<?php

namespace ThreeSidedCube\LaravelApiErrors\Tests\Unit;

use ThreeSidedCube\LaravelApiErrors\ApiErrorResponse;
use ThreeSidedCube\LaravelApiErrors\Exceptions\ApiErrorException;
use ThreeSidedCube\LaravelApiErrors\Tests\TestCase;

class ApiErrorResponseTest extends TestCase
{
    public function test_it_can_create_an_api_error_response_from_an_exception()
    {
        $exception = new class extends ApiErrorException {
            public function code(): string
            {
                return 'test_code';
            }

            public function message(): string
            {
                return 'This is a test message';
            }

            public function statusCode(): int
            {
                return 403;
            }
        };

        $response = ApiErrorResponse::fromException($exception);

        $expectedError = [
            'error' => [
                'code' => 'test_code',
                'message' => 'This is a test message',
            ],
        ];

        $this->assertEquals(403, $response->status());
        $this->assertSame($response->content(), json_encode($expectedError));
    }

    public function test_it_can_create_an_api_error_response()
    {
        $response = ApiErrorResponse::create('test_code', 'This is a test message', '403');

        $expectedError = [
            'error' => [
                'code' => 'test_code',
                'message' => 'This is a test message',
            ],
        ];

        $this->assertEquals(403, $response->status());
        $this->assertSame($response->content(), json_encode($expectedError));
    }
}
