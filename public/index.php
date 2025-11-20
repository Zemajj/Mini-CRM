<?php

// подключение автозагрузки классов
require_once __DIR__. '/../vendor/autoload.php';


use app\Core\Database\Database;
use app\Model\User;
use app\Core\BaseController\BaseController;
use app\Core\Router\Router;

// Создание объекта роутер
 $router = new Router();


 // Регистрация маршрутов
 $router->add('GET', '/', 'HomeController');
 $router->add('POST', '/login', 'LoginController');


