<?php

/*
 * Класс основной маршрутизации
 */

namespace app\Core\Router;

class Router
{
    protected array $routes = [];

    public function addRoute($route, $controller, $action): void
    {
        $this->routes[$route] = ['controller' => $controller, 'action' => $action];
    }

    /**
     * @throws \Exception
     */
    public function dispatch($uri): void
    {
        if (array_key_exists($uri, $this->routes)) {
            $controller = $this->routes[$uri]['controller'];
            $action = $this->routes[$uri]['action'];

            $controller = new $controller();
            $controller->$action();
        } else {
            throw new \RuntimeException("Route $uri not found");
        }
    }

}