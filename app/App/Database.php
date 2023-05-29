<?php

namespace NextG\Autoreply\App;

use PDO;
use PDOException;

class Database
{
    private $conn;
    private $statement;

    public function __construct()
    {
        $datasource = 'mysql:host=' . Configuration::$DB_HOST . ';dbname=' . Configuration::$DB_NAME . ';';
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        try {
            $this->conn = new PDO($datasource, Configuration::$DB_USER, Configuration::$DB_PASS, $options);
        } catch (PDOException $e) {
            print "ERROR " . $e->getMessage() . '<br>';
            die();
        }
    }

    public function query($query)
    {
        $this->statement = $this->conn->prepare($query);
        $this->conn->beginTransaction();
    }

    public function bindData($key, $value)
    {
        switch (true) {
            case is_int($value):
                $type = PDO::PARAM_INT;
                break;
            case is_bool($value):
                $type = PDO::PARAM_BOOL;
                break;
            case is_null($value):
                $type = PDO::PARAM_NULL;
                break;
            default:
                $type = PDO::PARAM_STR;
                break;
        }

        $this->statement->bindValue($key, $value, $type);
    }

    public function execute()
    {
        try {
            $result = $this->statement->execute();
            $this->conn->commit();
            return $result;
        } catch (PDOException $e) {
            $this->conn->rollBack();
            throw $e; // Melempar kembali exception untuk penanganan kesalahan
        }
    }

    public function fetchAll()
    {
        $this->execute();
        return $this->statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function fetch()
    {
        $this->execute();
        return $this->statement->fetch(PDO::FETCH_ASSOC);
    }

    public function affectedRows()
    {
        $this->execute();
        return $this->statement->rowCount();
    }
}
