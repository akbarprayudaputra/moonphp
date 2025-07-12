<?php

namespace Moonphp\Moonphp\Controllers;

use Moonphp\Moonphp\App\View;
use Moonphp\Moonphp\Helpers\Json;
use Moonphp\Moonphp\Models\User;

class HomeController
{
    public function index(): void
    {
        echo Json::encode([
            'status' => 'success',
            'message' => "Welcome",
        ]);
    }

    // public function detail(int $id): void
    // {
    //     echo Json::encode([
    //         'status' => 'success',
    //         'message' => "Detail page for user with ID: $id",
    //     ]);
    // }
}