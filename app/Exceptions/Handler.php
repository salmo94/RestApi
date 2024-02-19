<?php

namespace App\Exceptions;

use ErrorException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

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

    public function render($request, Throwable $e)
    {
        if ($e instanceof QueryException && $e->errorInfo[1] == 1062) {
            return response()->json(['error' => 'Duplicate entry'], 500);
        }

        if ($e instanceof ModelNotFoundException || $e instanceof NotFoundHttpException) {
            return response()->json(['error' => 'Model not found'], 404);
        }

        if ($e instanceof ErrorException && str_contains($e->getMessage(), 'Attempt to read property')) {
            $matches = [];
            preg_match('/"([^"]+)"/', $e->getMessage(), $matches);
            $property = $matches[1] ?? 'unknown property';

            return response()->json(['error' => "Attempt to read property '$property' on null"], 500);
        }

        return parent::render($request, $e);
    }
}
