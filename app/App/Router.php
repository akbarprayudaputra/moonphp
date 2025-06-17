<?php

namespace Moonphp\Moonphp\App;

class Router
{
    private static $routes = [];

    public static function add(string $method, string $path, string $controller, string $function): void
    {
        self::$routes[] = [
            "method" => $method,
            "path" => $path,
            "controller" => $controller,
            "function" => $function
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
            if ($path == $route["path"] && $method == $route["method"]) {
                echo "Running controller: " . $route["controller"] . " and function: " . $route["function"];
                return;
            }
        }

        throw new \Exception("Route not found for path: $path and method: $method", 404);
    }
}