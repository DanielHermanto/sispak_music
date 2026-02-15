<?php
require_once __DIR__ . '/../config/database.php';

class JawabanModel {

    private $db;

    public function __construct() {
        $this->db = getConnection();
    }

    public function save($id_user, $id_pertanyaan, $nilai) {
        $stmt = $this->db->prepare("
            INSERT INTO jawaban (id_user, id_pertanyaan, nilai)
            VALUES (?, ?, ?)
        ");
        return $stmt->execute([$id_user, $id_pertanyaan, $nilai]);
    }

    public function hitungSkorPerKategori($id_user) {

        $stmt = $this->db->prepare("
            SELECT k.nama_kategori, k.bobot, AVG(j.nilai) as rata_rata
            FROM jawaban j
            JOIN pertanyaan p ON j.id_pertanyaan = p.id_pertanyaan
            JOIN kategori k ON p.id_kategori = k.id_kategori
            WHERE j.id_user = ?
            GROUP BY k.id_kategori
        ");

        $stmt->execute([$id_user]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
