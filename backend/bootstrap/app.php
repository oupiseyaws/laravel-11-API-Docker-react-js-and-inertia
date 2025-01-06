<?php

use App\Models\ApiRequest;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;



return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        apiPrefix: 'api/',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {

        // RouteNotFoundException
        $exceptions->renderable(function (\Symfony\Component\Routing\Exception\RouteNotFoundException $e, $request) {

            if ($request->is('api/*')) {
                ApiRequest::Add($request);
                return response()->json($response, 401);
            }
            return null; // Let the default exception handler handle it
        });

        $exceptions->renderable(function (NotFoundHttpException $e, $request) {
            if ($request->is('api/*')) {
                ApiRequest::Add($request);
                return response()->json([], 404);
            }
            return null; // Let the default exception handler handle it
        });

        // UniqueConstraintViolationException
        $exceptions->renderable(function (\Illuminate\Database\QueryException $e, $request) {
            if ($e->errorInfo[1] === 1062) {
                ApiRequest::Add($request);
                return response()->json($response, 409);
            }
            return null; // Let the default exception handler handle it
        });

    })
    ->create();
