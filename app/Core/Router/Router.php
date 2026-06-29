<?php

/*
 * Класс основной маршрутизации
 */

namespace app\Core\Router;


class Router
{
    private array $routes = [];

    // Регистрация маршрутов: GET и POST
    public function add(string $method, string $uri, string $controller, string $action): void
    {
        $this->routes[] = [
            'method' => $method,
            'uri' => $uri,
            'controller' => $controller,
            'action' => $action
        ];

    }


    public function dispatch(): void
    {
        $uri = $_SERVER['REQUEST_URI'];
        $uri = parse_url($uri, PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];
        foreach ($this->routes as $route) {
            if ($method === $route['method'] && $uri === $route['uri']) {
                $controller = $route['controller'];
                $action = $route['action'];

                $controllerObject = new $controller();
                $controllerObject->$action();

                return;
            }
        }
        http_response_code(404);
        echo '404 Not Found';
    }


    /*
     * 	• У этого класса будет внутренний список маршрутов.
	•	Я смогу зарегистрировать маршруты через метод add(method, uri, controller и action).
	•	У него будет метод dispatch(), который:
	•	читает текущий URI и HTTP метод,
	•	ищет совпадающий маршрут,
	•	создаёт контроллер,
	•	вызывает нужный метод.
	•	Если маршрут не найден — вызывается notFound().
     */
}