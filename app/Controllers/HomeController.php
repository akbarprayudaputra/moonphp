<?php

namespace Moonphp\Moonphp\Controllers;

class HomeController
{
    public function index(): void
    {
        echo "Welcome to the Home Page!";
    }

    public function detail(int $id): void
    {
        echo "Detail Page for ID: $id";
    }
}