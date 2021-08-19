<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->renderable(function (Throwable $e, $request) {
            return $this->handleException($request, $e);
        });
    }

    private function handleException($request, Throwable $e): JsonResponse
    {
        if ($e instanceof NotFoundHttpException) {
            return response()->json([
                'status' => false,
                'code' => $e->getStatusCode(),
                'message' => 'There are no query results for the resource you have requested.',
            ], $e->getStatusCode());
        }

        if ($e instanceof HttpException) {
            return response()->json([
                'status' => false,
                'code' => $e->getStatusCode(),
                'message' => $e->getMessage(),
            ], $e->getStatusCode());
        }

        if ($e instanceof AuthenticationException) {
            return response()->json([
                'status' => false,
                'code' => Response::HTTP_UNAUTHORIZED,
                'message' => $e->getMessage(),
            ],Response::HTTP_UNAUTHORIZED);
        }

        return response()->json([
            'status' => false,
            'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
            //'message' => 'Server error',
            'message' => $e->getMessage(),
        ], Response::HTTP_INTERNAL_SERVER_ERROR);

    }
}
