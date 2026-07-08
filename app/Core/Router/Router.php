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
        $path = is_string($uri) ? $uri : '';
        $method = strtoupper($_SERVER['REQUEST_METHOD']);
        foreach ($this->routes as $route) {
            if ($method === $route['method'] && $path === $route['uri']) {
                $controller = $route['controller'];
                $action = $route['action'];

                if (!class_exists($controller)) {
                    $this->notFound();
                    return;
                }

                $controllerObject = new $controller();

                if (!method_exists($controllerObject, $action)) {
                    $this->notFound();
                    return;
                }

                $controllerObject->$action();

                return;
            }
        }
        $this->notFound();
    }

    // Отправляет ответ 404, если подходящий маршрут не найден
    private function notFound(): void
    {
        http_response_code(404);
        echo "404 Not Found";
    }
}