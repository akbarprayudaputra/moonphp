<?php

namespace Moonphp\Moonphp\Models;

use Moonphp\Moonphp\Database\Database;
use PDO;

class Token
{
    // PDO
    private PDO $pdo;
    // Table Name
    private string $table = 'user_tokens';
    // Constuctor to initialize PDO connection
    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    // Create a new token
    public function createToken($payload): void
    {
        $jwt = \Firebase\JWT\JWT::encode($payload, (string) getenv('APP_KEY'), 'HS256');
        $expiredAt = date('Y-m-d H:i:s', time() + 3600);

        $this->insert((int) $payload['id'], $jwt, $expiredAt);

        setcookie("X-TOKEN", $jwt, [
            'expires' => time() + 3600,
            'path' => '/',
            'domain' => 'localhost',
            'secure' => false,       // dev mode → disable secure
            'httponly' => true,
            'samesite' => 'Strict'
        ]);
    }

    public function unsetToken(string $token): void
    {
        $this->delete($_COOKIE['X-TOKEN']);
        setcookie("X-TOKEN", '', [
            'expires' => time() - 3600,
            'path' => '/',
            'domain' => 'localhost',
            'secure' => false,       // dev mode → disable secure
            'httponly' => true,
            'samesite' => 'Strict'
        ]);
    }

    // Insert token into database
    public function insert(int $user_id, string $token, $expired_at): bool
    {
        $stmt = $this->pdo->prepare("INSERT INTO {$this->table} (user_id, token, expired_at) VALUES (?,?,?)");
        return $stmt->execute([$user_id, $token, $expired_at]);
    }

    public function delete(string $token): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM {$this->table} WHERE token = ?");
        return $stmt->execute([$token]);
    }
}