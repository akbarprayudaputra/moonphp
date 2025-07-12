<?php

namespace Moonphp\Moonphp\Services;

use Exception;
use Moonphp\Moonphp\Models\Token;
use Moonphp\Moonphp\Models\User;

class AuthService
{
    public function login(string $username, string $password): array
    {
        $user = new User();
        $user = $user->findByUsername($username);

        if (empty($user)) {
            throw new Exception("User not found", code: 404);
        }

        if (!password_verify($password, $user['password'])) {
            throw new Exception("Username dan Password tidak sesuai.", code: 400);
        }

        $payload = [
            'id' => $user['id'],
            'username' => $user['username']
        ];

        $token = new Token();
        $token->createToken($payload);

        return [
            'message' => 'Login berhasil',
        ];
    }

    public function logout()
    {
        if (!isset($_COOKIE['X-TOKEN'])) {
            throw new Exception("Tidak ada token yang ditemukan", code: 400);
        }

        $token = new Token();
        $token->unsetToken($_COOKIE['X-TOKEN']);

        return [
            'message' => 'Logout berhasil',
        ];
    }
}