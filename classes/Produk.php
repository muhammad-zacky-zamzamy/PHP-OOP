<?php

// Termasuk kelas Database
require_once('Database.php');

// Kelas Produk untuk menangani operasi terkait produk
class Produk {
    // Koneksi database
    private $db;

    // Konstruktor untuk menginisialisasi koneksi database
    public function __construct() {
        $this->db = new Database();
    }

    // Metode untuk mendapatkan semua produk
    public function getAllProduk() {
        $sql = "SELECT * FROM tb_produk";
        return $this->db->fetchAll($sql);
    }

    // Metode untuk mendapatkan produk berdasarkan ID
    public function getProdukById($produk_id) {
        $sql = "SELECT * FROM tb_produk WHERE produk_id = ?";
        return $this->db->fetchSingle($sql, [$produk_id]);
    }

    // Metode untuk memasukkan produk baru
    public function insertProduk($produk_id_kat, $produk_id_user, $produk_kode, $produk_nama, $produk_hrg, $produk_keterangan, $produk_stock, $produk_photo, $created_at, $updated_at) {
        $sql = "INSERT INTO tb_produk (produk_id_kat, produk_id_user, produk_kode, produk_nama, produk_hrg, produk_keterangan, produk_stock, produk_photo, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $this->db->executeQuery($sql, [$produk_id_kat, $produk_id_user, $produk_kode, $produk_nama, $produk_hrg, $produk_keterangan, $produk_stock, $produk_photo, $created_at, $updated_at]);
        return $this->db->getLastInsertedId();
    }

    // Metode untuk memperbarui produk
    public function updateProduk($produk_id, $produk_id_kat, $produk_id_user, $produk_kode, $produk_nama, $produk_hrg, $produk_keterangan, $produk_stock, $produk_photo, $updated_at) {
        $sql = "UPDATE tb_produk SET produk_id_kat = ?, produk_id_user = ?, produk_kode = ?, produk_nama = ?, produk_hrg = ?, produk_keterangan = ?, produk_stock = ?, produk_photo = ?, updated_at = ? WHERE produk_id = ?";
        $this->db->executeQuery($sql, [$produk_id, $produk_id_kat, $produk_id_user, $produk_kode, $produk_nama, $produk_hrg, $produk_keterangan, $produk_stock, $produk_photo, $updated_at]);
    }

    // Metode untuk menghapus produk
    public function deleteProduk($produk_id) {
        $sql = "DELETE FROM tb_produk WHERE produk_id = ?";
        $this->db->executeQuery($sql, [$produk_id]);
    }
}

?>
