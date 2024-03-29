<?php

// Include the Database class
require_once('Database.php');

// Order class for handling order-related operations
class Order {
    // Database connection
    private $db;

    // Constructor to initialize the database connection
    public function __construct() {
        $this->db = new Database();
    }

    // Method to get all orders
    public function getAllOrders() {
        $sql = "SELECT * FROM tb_order";
        return $this->db->fetchAll($sql);
    }

    // Method to get an order by ID
    public function getOrderById($order_id) {
        $sql = "SELECT * FROM tb_order WHERE order_id = ?";
        return $this->db->fetchSingle($sql, [$order_id]);
    }

    // Method to insert a new order
    public function insertOrder($order_id_user, $order_tgl, $order_kode, $order_ttl, $order_ongkir, $order_byr_deadline, $updated_at) {
        $sql = "INSERT INTO tb_order (order_id_user, order_tgl, order_kode, order_ttl, order_ongkir, order_byr_deadline, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $this->db->executeQuery($sql, [$order_id_user, $order_tgl, $order_kode, $order_ttl, $order_ongkir, $order_byr_deadline, $updated_at]);
        return $this->db->getLastInsertedId();
    }

    // Method to update an order
    public function updateOrder($order_id, $order_id_user, $order_tgl, $order_kode, $order_ttl, $order_ongkir, $order_byr_deadline, $updated_at) {
        $sql = "UPDATE tb_order SET order_id_user = ?, order_tgl = ?, order_kode = ?, order_ttl = ?, order_ongkir = ?, order_byr_deadline = ?, updated_at = ? WHERE order_id = ?";
        $this->db->executeQuery($sql, [$order_id_user, $order_tgl, $order_kode, $order_ttl, $order_ongkir, $order_byr_deadline, $updated_at, $order_id]);
    }

    // Method to delete an order
    public function deleteOrder($order_id) {
        $sql = "DELETE FROM tb_order WHERE order_id = ?";
        $this->db->executeQuery($sql, [$order_id]);
    }
}

?>
