<?php

namespace Cube\LaravelApiErrors\Tests;

use Cube\LaravelApiErrors\ApiErrorServiceProvider;
use Illuminate\Foundation\Application;
use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    /**
     * Get the packages service providers.
     *
     * @param  Application  $app
     * @return string[]
     */
    protected function getPackageProviders($app): array
    {
        return [
            ApiErrorServiceProvider::class,
        ];
    }
}
