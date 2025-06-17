<?php

use Moonphp\Moonphp\App\Router;
use Moonphp\Moonphp\Controllers\HomeController;

require_once __DIR__ . '/../vendor/autoload.php';

Router::add("GET", "/", "HomeController", "index");
Router::add("GET", "/home", HomeController::class, "index");

try {
    Router::run();
} catch (\Throwable $th) {
    $data = [
        "status" => "error",
        "message" => $th->getMessage(),
        "code" => $th->getCode()
    ];

    require_once __DIR__ . '/../app/Views/errors/404.php';
}