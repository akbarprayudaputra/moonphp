<?php

use Moonphp\Moonphp\App\Router;

require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/../routes/web.php';

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