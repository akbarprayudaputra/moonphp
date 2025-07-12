<?php

namespace Moonphp\Moonphp\Controllers\User;

use Moonphp\Moonphp\Exception\DuplicateEmailException;
use Moonphp\Moonphp\Helpers\Json;
use Moonphp\Moonphp\Helpers\Validator;
use Moonphp\Moonphp\Helpers\XSS;
use Moonphp\Moonphp\Services\UserService;

class AddNewUserController extends Validator
{
    private UserService $userService;

    public function __construct()
    {
        $this->userService = new UserService();
    }

    public function addNewUser()
    {
        $json = file_get_contents("php://input");
        $data = json_decode($json, true);
        $sanitized = XSS::sanitize($data);

        $errors = $this->validate($sanitized, [
            'name' => 'required',
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        if (!empty($errors)) {
            http_response_code(400);
            echo Json::encode($errors);
            exit;
        }

        try {
            $result = $this->userService->add($sanitized);

            http_response_code(201);
            echo Json::encode([
                'message' => $result['message'] ?? 'User created successfully',
                'user' => $result['user'] ?? null,
            ]);
        } catch (DuplicateEmailException $th) {
            http_response_code(409);
            echo Json::encode([
                'message' => 'Gagal menambahkan user: ' . $th->getMessage(),
            ]);
        }
    }
}