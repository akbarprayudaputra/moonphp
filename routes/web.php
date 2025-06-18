<?php

use Moonphp\Moonphp\App\Router;
use Moonphp\Moonphp\Controllers\HomeController;

Router::add("GET", "/", HomeController::class, "index");
Router::add("GET", "/detail/([0-9])", HomeController::class, "detail");