<?php

namespace NiagahosterTest\Model;

use NiagahosterTest\Core\DatabaseConnection;
use \PDO;

class Model
{
    private $conn;

    public $table_name;

    public $fields;

    function __construct()
    {
        $this->conn = DatabaseConnection::getInstance()->getConnection();
    }

    function extractWhereValues($params): array
    {
        $queryWhereValues = [];
        $queryWhere = [];

        if (!empty($params) && is_array($params)) {
            foreach ($params as $key => $value) {
                array_push($queryWhere, "$key = ?");
                array_push($queryWhereValues, $value);
            }

            return array($queryWhere, $queryWhereValues);
        }

        return array();
    }

    function count($params)
    {
        $queryString = "SELECT COUNT(*) FROM " . $this->table_name;
        $whereValues = $this->extractWhereValues($params);
        $queryWhereValues = [];
        if (!empty($whereValues)) {
            $queryString = $queryString . " WHERE " . join(" AND ", $whereValues[0]);
            $queryWhereValues = $whereValues[1];
        }

        $query = $this->conn->prepare($queryString);
        $query->execute($queryWhereValues);

        return $query->fetchColumn();
    }

    function findById($id, $fields = [])
    {
        $fieldsFmt = !empty($fields) ? join(",", $fields) : "*";
        $queryString = "SELECT $fieldsFmt FROM " . $this->table_name . " WHERE id = ?";
        $query = $this->conn->prepare($queryString);
        $query->execute([$id]);

        return $query->fetch(PDO::FETCH_ASSOC);
    }

    function update($id, $params): bool
    {
        $queryString = "UPDATE " . $this->table_name . " SET ";
        $fields = array_map(function ($item) {
            return $item . " = ?";
        }, array_values(array_keys($params)));
        $fields = !empty($fields) ? join(", ", $fields) : "";

        if (empty($fields)) {
            return false;
        }

        $queryString .= $fields . " WHERE id = $id";
        $queryValues = array_values($params);

        $query = $this->conn->prepare($queryString);
        $query->execute($queryValues);

        return $query->rowCount() > 0;
    }

    function find($params = null, $fields = []): array
    {
        $fieldsFmt = !empty($fields) ? join(",", $fields) : "*";
        $queryString = "SELECT $fieldsFmt FROM " . $this->table_name;

        $whereValues = $this->extractWhereValues($params);
        $queryWhereValues = [];
        if (!empty($whereValues)) {
            $queryString = $queryString . " WHERE " . join(" AND ", $whereValues[0]);
            $queryWhereValues = $whereValues[1];
        }

        $query = $this->conn->prepare($queryString);
        $query->execute($queryWhereValues);

        $row_count = $query->rowCount();

        if ($row_count > 0) {
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        return array();
    }

    function create($params): bool
    {
        if (!empty($params) && is_array($params)) {
            $params_fmt = array_intersect_key($params, array_flip($this->fields));
            $valid = !empty($params_fmt) && is_array($params_fmt);

            if ($valid) {
                $queryString = "INSERT INTO " . $this->table_name . " (" . join(",", $this->fields) . " ) VALUES";
                $queryString .= " (" . join(",", array_fill(0, count($this->fields), "?")) . ")";

                $queryValues = [];
                foreach ($this->fields as $field) {
                    array_push($queryValues, $params_fmt[$field] ?? null);
                }

                $query = $this->conn->prepare($queryString);
                $query->execute($queryValues);

                return $query->rowCount();
            }
        }

        return false;
    }

    function delete($id): bool
    {
        $queryString = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $query = $this->conn->prepare($queryString);
        $query->execute([$id]);

        return $query->rowCount();
    }
}
