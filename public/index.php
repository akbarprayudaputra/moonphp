<?php

use Moonphp\Moonphp\App\Router;

require_once __DIR__ . '/../vendor/autoload.php';

Router::add("GET", "/", "HomeController", "index");

try {
    Router::run();
} catch (\Throwable $th) {
    echo $th->getMessage();
}