<?php

namespace Moonphp\Moonphp\Services;

use Moonphp\Moonphp\Models\User;

class UserService
{
    public function add(array $data)
    {
        $user = new User();
        $user->create($data);

        if (!$user) {
            throw new \Exception("User model not found", 500);
        }

        return [
            "message" => "User created successfully",
            "user" => [
                "name" => $data['name'] ?? null,
                "username" => $data['username'] ?? null,
                "email" => $data['email'] ?? null
            ] ?: null
        ];
    }
}