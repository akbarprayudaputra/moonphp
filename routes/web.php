<?php

use Moonphp\Moonphp\App\Router;
use Moonphp\Moonphp\Controllers\HomeController;

Router::add("GET", "/", "HomeController", "index");
Router::add("GET", "/home", HomeController::class, "index");
Router::add("GET", "/home/([0-9])", HomeController::class, "detail");