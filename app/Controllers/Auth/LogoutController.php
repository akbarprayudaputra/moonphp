<?php

namespace Moonphp\Moonphp\Controllers\Auth;

class LogoutController
{
    private \Moonphp\Moonphp\Services\AuthService $authService;

    public function __construct()
    {
        $this->authService = new \Moonphp\Moonphp\Services\AuthService();
    }

    public function logout()
    {
        try {
            $result = $this->authService->logout();

            http_response_code(200);
            echo json_encode($result);
        } catch (\Exception $th) {
            http_response_code($th->getCode() ?: 500);
            echo json_encode([
                'message' => $th->getMessage(),
            ]);
        }
    }
}