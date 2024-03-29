<?php

// Database configuration
$host = "localhost";
$username = "root";
$password = "";
$dbname = "ecommerce_db";

// Create a PDO connection
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Display error message if connection fails
    die("Connection failed: " . $e->getMessage());
}

?>
