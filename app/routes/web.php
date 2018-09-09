<?php

use App\Controllers\AuthController;
use App\Controllers\GamesController;
use App\Controllers\StatisticsController;
use App\Middleware\AuthMiddleware;
use App\Middleware\GuestMiddleware;

$app->get('/points', StatisticsController::class . ':points');

$app->group('', function () use ($app) {
    $app->get('/', GamesController::class . ':index')->setName('home');

    $app->get('/logout', AuthController::class . ':logout')->setName('auth.logout');
})->add(new AuthMiddleware($container)); // add auth middleware

$app->group('', function () use ($app) {
    $app->get('/login', AuthController::class . ':loginForm')->setName('auth.login');
    $app->get('/register', AuthController::class . ':registerForm')->setName('auth.register');

    $app->post('/login', AuthController::class . ':login');
    $app->post('/register', AuthController::class . ':register');
})->add(new GuestMiddleware($container)); // add guest middleware
