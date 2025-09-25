<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Illuminate\Auth\AuthenticationException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
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
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Override render supaya error JWT balikin JSON, bukan HTML
     */
    // public function render($request, Throwable $exception)
    // {
    //     if ($exception instanceof TokenExpiredException) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Token has expired'
    //         ], 401);
    //     }

    //     if ($exception instanceof TokenInvalidException) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Token is invalid'
    //         ], 401);
    //     }

    //     if ($exception instanceof JWTException) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Token not provided'
    //         ], 401);
    //     }

    //     if ($exception instanceof UnauthorizedHttpException) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Unauthorized'
    //         ], 401);
    //     }

    //     return parent::render($request, $exception);
    // }



    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return response()->json([
            'success' => false,
            'message' => 'Unauthenticated'
        ], 401);
    }
}
