<?php

// Database class for handling database connection and queries
class Database {
    // Properties for database connection
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "ecommerce_db";
    private $pdo;

    // Constructor to establish connection
    public function __construct() {
        try {
            $this->pdo = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->password);
            // Set the PDO error mode to exception
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    // Method to execute SQL queries
    public function executeQuery($sql, $params = []) {
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            die("Query failed: " . $e->getMessage());
        }
    }

    // Method to fetch single row from database
    public function fetchSingle($sql, $params = []) {
        $stmt = $this->executeQuery($sql, $params);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Method to fetch multiple rows from database
    public function fetchAll($sql, $params = []) {
        $stmt = $this->executeQuery($sql, $params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Method to get last inserted ID
    public function getLastInsertedId() {
        return $this->pdo->lastInsertId();
    }
}

?>
