<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class ApiExceptionHandler extends ExceptionHandler
{
    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\JsonResponse
     */
    public function render($request, Exception $exception)
    {
        // Handle specific exception types
        if ($exception instanceof ValidationException) {
            return $this->convertValidationExceptionToResponse($exception, $request);
        }

        if ($exception instanceof AuthenticationException) {
            return $this->unauthenticated($request, $exception);
        }

        if ($exception instanceof ModelNotFoundException) {
            return response()->json(['error' => 'Resource not found'], JsonResponse::HTTP_NOT_FOUND);
        }

        if ($exception instanceof HttpException) {
            return $this->convertHttpExceptionToResponse($exception);
        }

        // Handle generic internal server error
        return $this->prepareJsonResponse($exception);
    }

    /**
     * Convert a validation exception into a JSON response.
     *
     * @param  \Illuminate\Validation\ValidationException  $e
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    protected function convertValidationExceptionToResponse(ValidationException $e, $request)
    {
        return response()->json(['errors' => $e->errors()], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * Convert an authentication exception into a JSON response.
     *
     * @param  \Illuminate\Auth\AuthenticationException  $e
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    protected function unauthenticated($request, AuthenticationException $e)
    {
        return response()->json(['error' => 'Unauthenticated.'], JsonResponse::HTTP_UNAUTHORIZED);
    }

    /**
     * Convert an HTTP exception into a JSON response.
     *
     * @param  \Symfony\Component\HttpKernel\Exception\HttpException  $e
     * @return \Illuminate\Http\JsonResponse
     */
    protected function convertHttpExceptionToResponse(HttpException $e)
    {
        return response()->json(['error' => $e->getMessage()], $e->getStatusCode());
    }

    /**
     * Prepare a JSON response for the given exception.
     *
     * @param  \Exception  $e
     * @return \Illuminate\Http\JsonResponse
     */
    protected function prepareJsonResponse(Exception $e)
    {
        $statusCode = $this->isHttpException($e) ? $e->getStatusCode() : JsonResponse::HTTP_INTERNAL_SERVER_ERROR;

        return response()->json(['error' => 'Something went wrong. Please try again.'], $statusCode);
    }
}
