<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;


class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Exception|Throwable $exception)
    {

        switch ($exception) {

            case $exception instanceof ValidationException && $request->wantsJson():
                return response()->json(['message' => 'Input values are incorrect',
                    'errors' => $exception->errors()], 422);

            case $exception instanceof ModelNotFoundException && $request->wantsJson():
                return response()->json(['message' => 'Not Found!'], 404);

            case $exception instanceof AuthenticationException && $request->wantsJson():
                return response()->json(['message' => 'Unauthorized'], 401);

            case $exception instanceof HttpException && $request->wantsJson():
                return response()->json(['message' => 'Forbidden'], 403);
        }


//        if ($exception instanceof \ErrorException && $request->wantsJson()) {
//            return response()->json(['message' => 'Internal server error', 'errors' => $exception->getMessage()],
//                500);
//        }

        return parent::render($request, $exception);
    }
}
