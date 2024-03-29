<?php

// Include the Database class
require_once('Database.php');

// Kategori class for handling category-related operations
class Kategori {
    // Database connection
    private $db;

    // Constructor to initialize the database connection
    public function __construct() {
        $this->db = new Database();
    }

    // Method to get all categories
    public function getAllKategori() {
        $sql = "SELECT * FROM tb_kategori";
        return $this->db->fetchAll($sql);
    }

    // Method to get a category by ID
    public function getKategoriById($kat_id) {
        $sql = "SELECT * FROM tb_kategori WHERE kat_id = ?";
        return $this->db->fetchSingle($sql, [$kat_id]);
    }

    // Method to insert a new category
    public function insertKategori($kat_nama, $kat_keterangan, $created_at, $updated_at) {
        $sql = "INSERT INTO tb_kategori (kat_nama, kat_keterangan, created_at, updated_at) VALUES (?, ?, ?, ?)";
        $this->db->executeQuery($sql, [$kat_nama, $kat_keterangan, $created_at, $updated_at]);
        return $this->db->getLastInsertedId();
    }

    // Method to update a category
    public function updateKategori($kat_id, $kat_nama, $kat_keterangan, $updated_at) {
        $sql = "UPDATE tb_kategori SET kat_nama = ?, kat_keterangan = ?, updated_at = ? WHERE kat_id = ?";
        $this->db->executeQuery($sql, [$kat_nama, $kat_keterangan, $updated_at, $kat_id]);
    }

    // Method to delete a category
    public function deleteKategori($kat_id) {
        $sql = "DELETE FROM tb_kategori WHERE kat_id = ?";
        $this->db->executeQuery($sql, [$kat_id]);
    }
}

?>
