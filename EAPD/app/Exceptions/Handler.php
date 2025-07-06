<?php

namespace App\Exceptions;

use App\Helpers\ApiResponser;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function render($request, Throwable $e)
    {
        // Check if this is an API request
        if ($this->isApiRequest($request)) {
            return $this->handleApiException($request, $e);
        }

        return parent::render($request, $e);
    }

    protected function isApiRequest($request): bool
    {
        // Check multiple conditions to determine if this is an API request
        return $request->wantsJson() || 
               $request->is('api/*') || 
               $request->expectsJson() ||
               str_contains($request->header('Accept', ''), 'application/json') ||
               $request->ajax();
    }

    protected function handleApiException($request, Throwable $exception)
    {
         \Log::info('API Exception Handler Called', [
        'exception' => get_class($exception),
        'message' => $exception->getMessage(),
        'is_api' => $this->isApiRequest($request),
        'request_path' => $request->path(),
        'accept_header' => $request->header('Accept'),
        'wants_json' => $request->wantsJson(),
    ]);
        // Handle Authentication Exception
        if ($exception instanceof AuthenticationException) {
            return ApiResponser::unauthorizedResponse('Authentication required');
        }

        // Handle Model Not Found Exception
        if ($exception instanceof ModelNotFoundException) {
            $model = strtolower(class_basename($exception->getModel()));
            return ApiResponser::notFoundResponse("No {$model} found with the specified ID.");
        }

        // Handle 404 Not Found
        if ($exception instanceof NotFoundHttpException) {
            return ApiResponser::notFoundResponse('The requested resource was not found.');
        }

        // Handle Method Not Allowed
        if ($exception instanceof MethodNotAllowedHttpException) {
            return ApiResponser::errorResponse('The specified method for the request is invalid.', 405);
        }

        // Handle Validation Exception
        if ($exception instanceof ValidationException) {
            return ApiResponser::validationErrorResponse(
                $exception->errors(),
                $exception->getMessage()
            );
        }

        // Handle other HTTP exceptions
        if ($exception instanceof \Symfony\Component\HttpKernel\Exception\HttpException) {
            return ApiResponser::errorResponse(
                $exception->getMessage() ?: 'HTTP Error',
                $exception->getStatusCode()
            );
        }

        // For development, show detailed error message
        if (config('app.debug')) {
            return ApiResponser::serverErrorsResponse(
                $exception->getMessage() . ' in ' . $exception->getFile() . ':' . $exception->getLine()
            );
        }

        // For production, show generic error message
        return ApiResponser::serverErrorsResponse('Something went wrong. Please try again later.');
    }
}