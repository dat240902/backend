<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use \Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use PDOException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
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


    public function render($request, Throwable $e)
    {
        if ($e instanceof ModelNotFoundException) {
            return response()->json([
                'success' => 'false',
                'message' => 'Record not found.',
            ], 404);
        }

        if ($e instanceof PDOException) {
            echo $e->getMessage();
            return response()->json([
                'success' => 'false',
                'message' => 'Something wrong happened',
            ], 400);
        }

        if ($e instanceof AuthorizationException) {
            return response()->json([
            'message' => 'Not authenticated'
            ],401);
        }

        return parent::render($request, $e);
    }
}
