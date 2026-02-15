<?php
require_once __DIR__ . '/../config/database.php';

class RekomendasiModel {

    private $db;

    public function __construct() {
        $this->db = getConnection();
    }

    /*
        Ambil rekomendasi berdasarkan:
        - Nama kategori
        - Skor kategori
    */
    public function getByKategori($nama_kategori, $skor) {

        $stmt = $this->db->prepare("
            SELECT *
            FROM rekomendasi
            WHERE kategori_target = ?
            AND ? <= batas_skor
        ");

        $stmt->execute([$nama_kategori, $skor]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
