<?php

declare(strict_types=1);

namespace app\Core\Router;

/**
 * Регистрирует маршруты приложения и передаёт HTTP-запрос
 * соответствующему контроллеру и его action.
 */
class Router
{
    /**
     * Зарегистрированные маршруты приложения.
     *
     * Каждый маршрут содержит HTTP-метод, URI,
     * имя класса контроллера и вызываемый action.
     *
     * @var array<int, array{
     *     method: string,
     *     uri: string,
     *     controller: string,
     *     action: string
     * }>
     */
    private array $routes = [];

    /**
     * Регистрирует новый маршрут.
     *
     * HTTP-метод сохраняется в верхнем регистре,
     * чтобы последующее сравнение не зависело от регистра.
     */
    public function add(string $method, string $uri, string $controller, string $action): void
    {
        $this->routes[] = [
            'method' => strtoupper($method),
            'uri' => $uri,
            'controller' => $controller,
            'action' => $action
        ];
    }

    /**
     * Сопоставляет текущий HTTP-запрос с зарегистрированным маршрутом
     * и вызывает соответствующий action контроллера.
     */
    public function dispatch(): void
    {
        // REQUEST_URI может содержать query string.
        // Для поиска маршрута используется только путь запроса.
        $uri = $_SERVER['REQUEST_URI'];
        $uri = parse_url($uri, PHP_URL_PATH);
        $path = is_string($uri) ? $uri : '';
        $method = strtoupper($_SERVER['REQUEST_METHOD']);
        $allowedMethods = [];
        foreach ($this->routes as $route) {
            if ($path === $route['uri']) {
                $allowedMethods[] = $route['method'];
            }

            if ($method === $route['method'] && $path === $route['uri']) {
                $controller = $route['controller'];
                $action = $route['action'];

                // Перед созданием объекта проверяем,
                // что зарегистрированный класс существует.
                if (!class_exists($controller)) {
                    $this->notFound();
                    return;
                }

                $controllerObject = new $controller();

                // is_callable() проверяет, что action существует,
                // доступен извне и действительно может быть вызван.
                if (!is_callable([$controllerObject, $action])) {
                    $this->notFound();
                    return;
                }

                $controllerObject->$action();

                return;
            }
        }
        if (!empty($allowedMethods)) {
            $this->methodNotAllowed($allowedMethods);
        } else {
            $this->notFound();
        }
    }

    /**
     * Формирует простой HTTP-ответ для ненайденного маршрута
     * или недоступного обработчика.
     */
    private function notFound(): void
    {
        http_response_code(404);
        echo "404 Not Found";
    }

    private function methodNotAllowed(array $allowedMethods): void
    {
        http_response_code(405);
        header("Allow: " . implode(', ', $allowedMethods));
    }
}
