<?php

namespace App\Database;

use PDO;
use PDOException; 

class Database {
    private static $host = 'localhost';
    private static $db_name = 'task_db';
    private static $username = 'root';
    private static $password = 'Str0ngP@ssw0rd!';
    private static $conn;

    public static function connect() {
        self::$conn = null;

        try {
            $dsn = 'mysql:host=' . self::$host . ';dbname=' . self::$db_name;
            self::$conn = new PDO($dsn, self::$username, self::$password);
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Connection Error: ' . $e->getMessage();
        }

        return self::$conn;
    }
}
