<?php

namespace Moonphp\Moonphp\Models;

use Moonphp\Moonphp\Database\Database;
use PDO;

class User
{
    private $table = 'users';
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    public function find($id): mixed
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function all(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM {$this->table}");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data): bool
    {
        $password = password_hash($data['password'], PASSWORD_BCRYPT);
        $stmt = $this->pdo->prepare("INSERT INTO {$this->table} (name, email, password) VALUES (?, ?, ?)");
        return $stmt->execute([$data['name'], $data['email'], $password]);
    }
}
