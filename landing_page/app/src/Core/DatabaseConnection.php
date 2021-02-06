<?php

namespace NiagahosterTest\Core;

use \PDO;
use \PDOException;

class DatabaseConnection
{
    private static $instance;
    private $db_conn;

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new DatabaseConnection();

            try {
                $db_host = getenv('DB_HOST');
                $db_name = getenv('DB_NAME');
                $db_user = getenv('DB_USER');
                $db_password = getenv('DB_PASS');

                $dsn = "mysql:host=" . $db_host . ";dbname=" . $db_name;
                self::$instance->db_conn = new PDO($dsn, $db_user, $db_password);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        return self::$instance;
    }

    public function getConnection(): PDO
    {
        return $this->db_conn;
    }
}
