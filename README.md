# Laravel API Errors

[![Latest Version on Packagist](https://img.shields.io/packagist/v/3sidedcube/laravel-api-errors.svg?style=flat-square)](https://packagist.org/packages/3sidedcube/laravel-api-errors)
[![Total Downloads](https://img.shields.io/packagist/dt/3sidedcube/laravel-api-errors.svg?style=flat-square)](https://packagist.org/packages/3sidedcube/laravel-api-errors)
![GitHub Actions](https://github.com/3sidedcube/laravel-api-errors/actions/workflows/run-tests.yml/badge.svg)

This package provides an easy way to manage and handle error response for JSON API's.

## Installation

You can install the package via composer:

```bash
composer require 3sidedcube/laravel-api-errors
```

## Usage

There are 2 ways of generating an API error response:

### API Error Exception

This package provides an exception called `ApiErrorException` which you can extend. There are 3 methods which can
be set (2 of which are required):

- `code()` - This is a short string indicating the error code (required).
- `message()` - A human-readable message providing more details about the error (required).
- `statusCode()` - This HTTP status code of the error response. By default, this is set to 400 and is optional.

Once you have an exception, you can use the `fromException()` method to generate an API error response:

```php
use Cube\LaravelApiErrors\ApiErrorResponse;
use Cube\LaravelApiErrors\Exceptions\ApiErrorException;

class UserBannedException extends ApiErrorException
{
    /**
     * A short error code describing the error.
     *
     * @return string
     */
    public function code(): string
    {
        return 'user_account_banned';
    }

    /**
     * A human-readable message providing more details about the error.
     *
     * @return string
     */
    public function message(): string
    {
        return 'User account banned.';
    }

    /**
     * The api error status code.
     *
     * @return int
     */
    public function statusCode(): int
    {
        return 403;
    }
}

$exception = new UserBannedException();

// This will return an instance of JsonResponse
$response = ApiErrorResponse::fromException($exception);
```

Returning this response would generate the following json response:

```json
{
    "error": {
        "code": "user_account_banned",
        "message": "User account banned."
    }
}
```

### Passing data directly

Alternatively you can use the `create()` method to create an API error response:

```php
use Cube\LaravelApiErrors\ApiErrorResponse;

// This will return an instance of JsonResponse
$response = ApiErrorResponse::create('user_account_banned', 'User account banned.', 403);
```

Returning this response would generate the following json response:

```json
{
    "error": {
        "code": "user_account_banned",
        "message": "User account banned."
    }
}
```

### Testing

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

-   [Ben Sherred](https://github.com/benshered)
-   [All Contributors](../../contributors)

## License

Laravel Horizon is open-sourced software licensed under the [MIT license](LICENSE.md).
