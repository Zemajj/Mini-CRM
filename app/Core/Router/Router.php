<?php

/*
 * Класс основной маршрутизации
 */

namespace app\Core\Router;


class Router
{
    private array $routes = [];

    // Регистрация маршрутов
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
}