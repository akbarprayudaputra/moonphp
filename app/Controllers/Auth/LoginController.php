<?php

namespace Moonphp\Moonphp\Controllers\Auth;

use Moonphp\Moonphp\Helpers\Json;
use Moonphp\Moonphp\Helpers\Validator;
use Moonphp\Moonphp\Helpers\XSS;
use Moonphp\Moonphp\Services\AuthService;

class LoginController extends Validator
{

    private AuthService $authService;

    public function __construct()
    {
        $this->authService = new AuthService();
    }

    public function login()
    {
        $json = file_get_contents("php://input");
        $data = json_decode($json, true);
        $sanitized = XSS::sanitize($data);

        $errors = $this->validate($sanitized, [
            'username' => 'required',
            'password' => 'required',
        ]);

        if (!empty($errors)) {
            http_response_code(400);
            echo Json::encode($errors);
            exit;
        }

        try {
            $result = $this->authService->login($sanitized['username'], $sanitized['password']);

            http_response_code(200);
            echo Json::encode($result);
        } catch (\Exception $th) {
            http_response_code($th->getCode() ?: 500);
            echo Json::encode([
                'message' => $th->getMessage(),
            ]);
        }
    }
}