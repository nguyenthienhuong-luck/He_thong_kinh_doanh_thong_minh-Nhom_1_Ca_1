<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\CheckLogin;
use App\Http\Middleware\CheckPermission;
use App\Http\Middleware\CheckPremium;

return Application::configure(basePath: dirname(__DIR__))
  ->withRouting(
    web: __DIR__ . '/../routes/web.php',
    commands: __DIR__ . '/../routes/console.php',
    health: '/up',
  )
  ->withMiddleware(function (Middleware $middleware) {
    $middleware->alias([
      'checkLogin' => CheckLogin::class,
      'checkPermission' => CheckPermission::class,
      'checkPremium' => CheckPremium::class
    ]);
  })
  ->withExceptions(function (Exceptions $exceptions) {
    //
  })->create();
