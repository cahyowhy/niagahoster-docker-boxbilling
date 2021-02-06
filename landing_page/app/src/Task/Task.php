<?php

namespace NiagahosterTest\Task;

use \PDOException;
use NiagahosterTest\Core\DatabaseConnection;

class Task
{
    private $conn;

    function __construct()
    {
        $this->conn = DatabaseConnection::getInstance()->getConnection();
    }

    /**
     * override on child
     */
    function startTask()
    {
    }

    function createTable($fields, $tableName, $useIdPrimary = true)
    {
        try {
            $this->conn->exec("DROP TABLE IF EXISTS " . $tableName);
        } catch (PDOException $e) {
            print($e->getMessage() . "\n");
        }

        $queryString = "CREATE TABLE IF NOT EXISTS $tableName ( ";
        if ($useIdPrimary) $queryString .= "id INT NOT NULL AUTO_INCREMENT, ";

        foreach ($fields as $key => $arrValue) {
            if (empty($arrValue['type'])) {
                $queryString = "";
                break;
            }

            $queryString .= $key . " " . $arrValue['type'];

            if (!empty($arrValue['length'])) $queryString .= "(" . $arrValue['length'] . ")";
            if (!empty($arrValue['mustnotnull'])) $queryString .= " NOT NULL";
            $queryString .= ", ";
        }

        if (!empty($queryString)) {
            if ($useIdPrimary) $queryString .= "PRIMARY KEY (id)";
            $queryString .= " )";

            try {
                $this->conn->exec($queryString);
                print("Created $tableName Table.\n");
            } catch (PDOException $e) {
                print($e->getMessage() . "\n");
            }
        }
    }
}
