<?php

use Moonphp\Moonphp\App\Router;
use Moonphp\Moonphp\Database\Database;

require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/../routes/web.php';

try {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../");
    $dotenv->load();

    Database::getConnection();

    Router::run();
} catch (\Throwable $th) {
    switch ($_ENV["API"]) {
        case 'true':
            header("Content-Type: application/json");
            http_response_code($th->getCode() ?: 500);
            echo json_encode(array("error" => $th->getMessage()));
            break;

        default:
            $data = [
                "status" => "error",
                "message" => $th->getMessage(),
                "code" => $th->getCode()
            ];

            require_once __DIR__ . '/../app/Views/errors/404.php';
            break;
    }
}