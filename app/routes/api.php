<?php

use App\Controllers\StatisticsController;
use App\Controllers\UsersController;
use App\Middleware\AuthMiddleware;

$app->get('/ranking', UsersController::class . ':best');

$app->group('', function () use ($app) {
    $app->get('/user/fetch', UsersController::class . ':show');

    $app->post('/click', UsersController::class . ':click');
    $app->post('/sec', UsersController::class . ':sec');

    $app->post('/buy/{type}', StatisticsController::class . ':buy');
})->add(new AuthMiddleware($container));
