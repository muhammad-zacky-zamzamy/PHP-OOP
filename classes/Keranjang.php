<?php

// Include the Database class
require_once('Database.php');

// Keranjang class for handling cart-related operations
class Keranjang {
    // Database connection
    private $db;

    // Constructor to initialize the database connection
    public function __construct() {
        $this->db = new Database();
    }

    // Method to get all items in the cart for a user
    public function getUserCart($user_id) {
        $sql = "SELECT * FROM tb_keranjang WHERE ker_id_user = ?";
        return $this->db->fetchAll($sql, [$user_id]);
    }

    // Method to add a new item to the cart
    public function addToCart($user_id, $cart_id, $harga, $jumlah) {
        $sql = "INSERT INTO tb_keranjang (ker_id_user, ker_id_produk, ker_harga, ker_jml) VALUES (?, ?, ?, ?)";
        $this->db->executeQuery($sql, [$user_id, $cart_id, $harga, $jumlah]);
    }

    // Method to update an item in the cart
    public function updateCartItem($cart_id, $harga, $jumlah) {
        $sql = "UPDATE tb_keranjang SET ker_jml = ?, ker_harga = ? WHERE ker_id = ?";
        $this->db->executeQuery($sql, [$jumlah, $harga, $cart_id]);
    }

    // Method to remove an item from the cart
    public function removeFromCart($cart_id) {
        $sql = "DELETE FROM tb_keranjang WHERE ker_id = ?";
        $this->db->executeQuery($sql, [$cart_id]);
    }
}

?>
