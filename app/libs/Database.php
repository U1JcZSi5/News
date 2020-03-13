<?php

namespace libs;

class Database
{
    protected $results;
    private $host = 'localhost';
    private $user = 'root';
    private $pass = '';
    private $dbname = 'news';

    protected function connect()
    {
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;

        try {
            $pdo = new \PDO($dsn, $this->user, $this->pass);
            $pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);
            return $pdo;
        } catch (\PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

    protected function select_or_delete($action, $table, $conditions = [])
    {
        $sql = "{$action} FROM $table";

        if (empty($conditions)) {
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute();
            $this->results = $stmt->fetchAll();
            return $this;
        } else {
            #Creates an sql query based on conditions

            $i = 0;
            $values = array();
            foreach ($conditions as $key => $value) {
                $values[] = $value;
                if ($i == 0) {
                    $sql = $sql . " WHERE $key=?";
                } else {
                    $sql = $sql . " AND $key=?";
                }
                $i++;
            }

            $stmt = $this->connect()->prepare($sql);
            $stmt->execute($values);
            $this->results = $stmt->fetchAll();
            return $this;
        }
    }

    protected function add($table, $data)
    {
        $sql = "INSERT INTO $table (";

        $i = 1;
        $placeholders = "(";
        $values = array();
        # Loop that creates and sql string and extracts values to be executed
        foreach ($data as $key => $value) {
            $values[] = $value;
            if ($i < sizeof($data)) {
                $sql = $sql . $key . ', ';
                $placeholders = $placeholders . '?, ';
            } else {
                $sql = $sql . $key . ")";
                $placeholders = $placeholders . '?)';
            }
            $i++;
        }

        $sql = $sql . ' VALUES' . $placeholders;
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute($values);
    }

    public function update($table, $colum_name, $column_value, $data)
    {
        $sql = "UPDATE $table SET ";
        $i = 0;
        foreach ($data as $key => $value) {
            $values[] = $value;
            if ($i == 0) {
                $sql = $sql . "`$key` = ?";
            } else {
                $sql = $sql . ", `$key` = ?";
            }
            $i++;
        }
        $sql = $sql . " WHERE `$colum_name` = $column_value";
        dd($sql);
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute($values);
    }
}
