<?php

namespace Moonphp\Moonphp\App;

class Router
{
    private static $routes = [];

    public static function add(string $method, string $path, string $controller, string $function, array $middlewares = []): void
    {
        self::$routes[] = [
            "method" => $method,
            "path" => $path,
            "controller" => $controller,
            "function" => $function,
            "middlewares" => $middlewares
        ];
    }

    public static function run(): void
    {
        $path = "/";

        if (isset($_SERVER["PATH_INFO"])) {
            $path = $_SERVER["PATH_INFO"];
        }

        $method = $_SERVER["REQUEST_METHOD"];

        foreach (self::$routes as $route) {
            $pattern = "#^" . $route["path"] . "$#";
            if (preg_match($pattern, $path, $variables) && $method == $route["method"]) {
                if (!class_exists($route["controller"])) {
                    throw new \Exception("Controller {$route['controller']} tidak ditemukan", 404);
                }

                foreach ($route["middlewares"] as $middleware) {
                    if (!class_exists($middleware)) {
                        throw new \Exception("Middleware '{$middleware}' tidak ditemukan", 404);
                    }

                    $middlewareInstance = new $middleware;
                    if (method_exists($middlewareInstance, 'before')) {
                        $middlewareInstance->before();
                    }
                }

                $controller = new $route["controller"];
                $function = $route["function"];

                array_shift($variables); // Menghapus elemen pertama yang merupakan path itu sendiri
                call_user_func_array([$controller, $function], $variables);

                return;
            }
        }

        throw new \Exception("Route tidak ditemukan pada path: $path dan method: $method", 404);
    }
}