<?php

/*
 * Класс основной маршрутизации
 */

namespace app\Core\Router;

class Router
{


    private array $routes = []; // массив для хранения всех путей



    // Регистрация маршрутов: GET или POST
    public function add($method, $uri, $controller): void
    {
        $this->routes[] = [
            'method' => $method,
            'uri' => $uri,
            'controller' => $controller
        ];

    }



    public function dispatch()
    {

    }

//    public function notFound()
//    {
//        if( $this->routes !== ['uri']) {
//            return error_log("Not found");
//        }
//    }

    /*
     * 	• У этого класса будет внутренний список маршрутов.
	•	Я смогу зарегистрировать маршруты через метод add(method, uri, controller).
	•	У него будет метод dispatch(), который:
	•	читает текущий URI и HTTP метод,
	•	ищет совпадающий маршрут,
	•	создаёт контроллер,
	•	вызывает нужный метод.
	•	Если маршрут не найден — вызывается notFound().
     */
}