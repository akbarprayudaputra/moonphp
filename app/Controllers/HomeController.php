<?php

namespace Moonphp\Moonphp\Controllers;

use Moonphp\Moonphp\App\View;

class HomeController
{
    public function index(): void
    {
        echo View::render("home/index", [
            'title' => 'Home Page',
            'message' => 'Welcome to the Home Page!'
        ]);
    }

    public function detail(int $id): void
    {
        echo "Detail Page for ID: $id";
    }
}