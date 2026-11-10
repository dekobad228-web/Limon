<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use App\Exceptions\{InvalidUserTockenException, InvalidChatTockenException};

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        channels: __DIR__ . '/../routes/channels.php',
        web: [__DIR__ . '/../routes/web.php', __DIR__ . '/../routes/auth.php'],
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->redirectGuestsTo(fn() => route('login.index'));
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (InvalidUserTockenException $e, Request $request) {
            return redirect()->route('user.start', [$request->user()]);
        });
        $exceptions->render(function (InvalidChatTockenException $e, Request $request) {
            return redirect()->route('user.chats.list', [$request->user()]);
        });
    })->create();
