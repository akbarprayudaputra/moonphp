<?php

namespace Moonphp\Moonphp\Database;

use PDO;
use PDOException;

class Database
{
    private static $instance;
    private $connection;

    private function __construct()
    {
        try {
            $this->connection = new PDO(
                'mysql:host=localhost;dbname=' . ($_ENV["DB_NAME"] ?? 'moonphp'),
                $_ENV["DB_USER"] ?? 'root',
                $_ENV["DB_PASSWORD"] ?? 'password'
            );
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new \Exception("Connection failed: " . $e->getMessage(), 500);
        }
    }

    public static function getConnection()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance->connection;
    }
}