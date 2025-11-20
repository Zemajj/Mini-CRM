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
if ($_SERVER['REQUEST_METHOD'] === 'GET' || $_SERVER['REQUEST_URI'] === 'uri')  {

}
    }

    public function notFound()
    {

    }

    /*
     * 	• У этого класса будет внутренний список маршрутов.
	•	Я смогу зарегистрировать маршруты через метод add(method, url, controller).
	•	У него будет метод dispatch(), который:
	•	читает текущий URL и HTTP метод,
	•	ищет совпадающий маршрут,
	•	создаёт контроллер,
	•	вызывает нужный метод.
	•	Если маршрут не найден — вызывается notFound().
     */
}