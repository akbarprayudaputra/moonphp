<?php

namespace Moonphp\Moonphp\Middleware;

use Moonphp\Moonphp\App\Middleware;

class Auth implements Middleware
{
    public function before(): void
    {
        // if (!isset($_SESSION["user"])) {
        //     header("Location: /login");
        //     exit;
        // }

        if (!isset($_COOKIE['X-TOKEN'])) {
            throw new \Exception("Anda belum login!", 401);
        }
    }
}