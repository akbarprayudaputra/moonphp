<?php

namespace Moonphp\Moonphp\Database;

use PDO;

class Database
{
    private static $instance;
    private $connection;

    private function __construct()
    {
        $this->connection = new PDO(
            'mysql:host=localhost;dbname=' . ($_ENV["DB_NAME"] ?? 'moonphp'),
            $_ENV["DB_USER"] ?? 'root',
            $_ENV["DB_PASSWORD"] ?? 'password'
        );
    }

    public static function getConnection()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance->connection;
    }
}