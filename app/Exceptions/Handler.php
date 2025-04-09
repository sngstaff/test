<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Configuration\Exceptions as BaseExceptions;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler
{
    public function __invoke(BaseExceptions $exceptions): BaseExceptions
    {
        $exceptions->dontReport([
            ControlledException::class
        ]);

        $exceptions->renderable(function (Throwable $e, $request) {
            if (!$request->expectsJson()) {
                return response()->json(['message' => 'ACCEPT_JSON_ERROR']);
            }

            if ($e instanceof QueryException) {
                if ($e->getCode() === '23503') {
                    return response()->json(['message' => 'FOREIGN_KEY_VIOLATION'], 400);
                }

                if ($e->getCode() === '23505') {
                    return response()->json(['message' => 'DUPLICATE_ENTRY'], 400);
                }

                return response()->json(['message' => 'DATABASE_ERROR'], 500);
            }

            if ($e instanceof ValidationException) {
                return false;
            }

            if ($e instanceof NotFoundHttpException || $e instanceof ModelNotFoundException) {
                return response()->json(['message' => 'NOT_FOUND'], 404);
            }

            if ($e instanceof AuthenticationException) {
                return response()->json(['message' => 'UNAUTHORIZED'], 401);
            }

            if ($e instanceof ControlledException) {
                return response()->json(['message' => $e->getMessage()], 400);
            }

            return response()->json(['message' =>  $e->getMessage()], 500);
        });

        return $exceptions;
    }
}
