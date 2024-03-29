<?php

// Include the Database class
require_once('Database.php');

// OrderDetail class for handling order detail-related operations
class OrderDetail {
    // Database connection
    private $db;

    // Constructor to initialize the database connection
    public function __construct() {
        $this->db = new Database();
    }

    // Method to get all order details
    public function getAllOrderDetails() {
        $sql = "SELECT * FROM tb_order_detail";
        return $this->db->fetchAll($sql);
    }

    // Method to get order details by order ID
    public function getOrderDetailsByOrderId($order_id) {
        $sql = "SELECT * FROM tb_order_detail WHERE detail_id_order = ?";
        return $this->db->fetchAll($sql, [$order_id]);
    }

    // Method to get order details by product ID
    public function getOrderDetailsByProductId($product_id) {
        $sql = "SELECT * FROM tb_order_detail WHERE detail_id_produk = ?";
        return $this->db->fetchAll($sql, [$product_id]);
    }

    // Method to insert a new order detail
    public function insertOrderDetail($detail_id_order, $detail_id_produk, $detail_harga, $detail_jml) {
        $sql = "INSERT INTO tb_order_detail (detail_id_order, detail_id_produk, detail_harga, detail_jml) VALUES (?, ?, ?, ?)";
        $this->db->executeQuery($sql, [$detail_id_order, $detail_id_produk, $detail_harga, $detail_jml]);
    }

    // Method to update an order detail
    public function updateOrderDetail($detail_id_order, $detail_id_produk, $detail_harga, $detail_jml) {
        $sql = "UPDATE tb_order_detail SET detail_harga = ?, detail_jml = ? WHERE detail_id_order = ? AND detail_id_produk = ?";
        $this->db->executeQuery($sql, [$detail_harga, $detail_jml, $detail_id_order, $detail_id_produk]);
    }

    // Method to delete an order detail
    public function deleteOrderDetail($detail_id_order, $detail_id_produk) {
        $sql = "DELETE FROM tb_order_detail WHERE detail_id_order = ? AND detail_id_produk = ?";
        $this->db->executeQuery($sql, [$detail_id_order, $detail_id_produk]);
    }
}

?>
