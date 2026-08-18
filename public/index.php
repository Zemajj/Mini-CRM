<?php

declare(strict_types=1);

use app\Core\Router\Router;
use app\Controllers\HomeController;
use app\Controllers\LoginController;

require __DIR__ . '/../bootstrap.php';

$router = new Router();

$router->add('GET', '/home', HomeController::class, 'home');
$router->add('POST', '/login', LoginController::class, 'login');

$router->dispatch();
