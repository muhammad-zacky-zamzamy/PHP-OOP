<?php

// Include the Database class
require_once('Database.php');

// Users class for handling user-related operations
class Users {
    // Database connection
    private $db;

    // Constructor to initialize the database connection
    public function __construct() {
        $this->db = new Database();
    }

    // Method to get all users
    public function getAllUsers() {
        $sql = "SELECT * FROM tb_users";
        return $this->db->fetchAll($sql);
    }

    // Method to get a user by ID
    public function getUserById($user_id) {
        $sql = "SELECT * FROM tb_users WHERE user_id = ?";
        return $this->db->fetchSingle($sql, [$user_id]);
    }

    // Method to insert a new user
    public function insertUser($user_email, $user_password, $user_nama, $user_alamat, $user_hp, $user_usia, $user_role, $user_aktif, $created_at, $updated_at) {
        $sql = "INSERT INTO tb_users (user_email, user_password, user_nama, user_alamat, user_hp, user_usia, user_role, user_aktif, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $this->db->executeQuery($sql, [$user_email, $user_password, $user_nama, $user_alamat, $user_hp, $user_usia, $user_role, $user_aktif, $created_at, $updated_at]);
        return $this->db->getLastInsertedId();
    }

    // Method to update a user
    public function updateUser($user_id, $user_email, $user_password, $user_nama, $user_alamat, $user_hp, $user_usia, $user_role, $user_aktif, $updated_at) {
        $sql = "UPDATE tb_users SET user_email = ?, user_password = ?, user_nama = ?, user_alamat = ?, user_hp = ?, user_usia = ?, user_role = ?, user_aktif = ?, updated_at = ? WHERE user_id = ?";
        $this->db->executeQuery($sql, [$user_email, $user_password, $user_nama, $user_alamat, $user_hp, $user_usia, $user_role, $user_aktif, $updated_at, $user_id]);
    }

    // Method to delete a user
    public function deleteUser($user_id) {
        $sql = "DELETE FROM tb_users WHERE user_id = ?";
        $this->db->executeQuery($sql, [$user_id]);
    }
}

?>
