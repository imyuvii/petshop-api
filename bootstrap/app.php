<?php

use App\Http\Middleware\JWTMiddleware;
use App\Services\ExceptionHandlerService;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'auth.jwt' => JWTMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $handler = new ExceptionHandlerService();

        $exceptions->shouldRenderJsonWhen(fn (Request $request, \Throwable $e) => $handler->shouldRenderJsonWhen($request, $e));

        $exceptions->render(function (\Throwable $e, Request $request) use ($handler) {
            return $handler->renderJsonResponse($e);
        });
    })->create();
