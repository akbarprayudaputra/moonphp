<?php

use Moonphp\Moonphp\App\Router;
use Moonphp\Moonphp\Controllers\Auth\LoginController;
use Moonphp\Moonphp\Controllers\Auth\LogoutController;
use Moonphp\Moonphp\Controllers\HomeController;
use Moonphp\Moonphp\Controllers\User\AddNewUserController;
use Moonphp\Moonphp\Middleware\Auth;

Router::add("GET", "/", HomeController::class, "index");
Router::add("GET", "/detail/([0-9])", HomeController::class, "detail");

Router::add("POST", "/auth/login", LoginController::class, "login");
Router::add("POST", "/auth/register", AddNewUserController::class, "AddNewUser");
Router::add("POST", "/auth/logout", LogoutController::class, "logout", [Auth::class]);