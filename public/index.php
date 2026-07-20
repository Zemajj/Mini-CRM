<?php
// Строгость
declare(strict_types=1);

require __DIR__ . '/../bootstrap.php';

use app\Core\Router\Router;
use app\Controllers\HomeController;
use app\Controllers\LoginController;

// Создание объекта роутер
$router = new Router();


// Регистрация маршрутов
$router->add('GET', '/home', HomeController::class, 'home');
$router->add('POST', '/login', LoginController::class, 'login');

$router->dispatch();

