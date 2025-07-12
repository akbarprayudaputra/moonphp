<?php

namespace Moonphp\Moonphp\Models;

use Moonphp\Moonphp\Database\Database;
use Moonphp\Moonphp\Exception\DuplicateEmailException;
use PDO;

class User
{
    private PDO $pdo;
    private string $table = 'users';

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    public function find(int $id): ?array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function findByUsername(string $username): ?array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function all(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM {$this->table}");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(array $data): bool
    {
        $password = password_hash($data['password'], PASSWORD_BCRYPT);

        try {
            $stmt = $this->pdo->prepare(
                "INSERT INTO {$this->table} (name, username, email, password) VALUES (?, ?, ?, ?)"
            );
            return $stmt->execute([
                $data['name'],
                $data['username'],
                $data['email'],
                $password
            ]);
        } catch (\PDOException $e) {
            if ($e->getCode() === '23000') {
                throw new DuplicateEmailException();
            }
            throw $e;
        }

    }
}