<?php
require_once __DIR__ . '/../config/database.php';

class PertanyaanModel {

    private $db;

    public function __construct() {
        $this->db = getConnection();
    }

    public function getAll() {
        $stmt = $this->db->query("
            SELECT p.*, k.nama_kategori 
            FROM pertanyaan p
            JOIN kategori k ON p.id_kategori = k.id_kategori
            ORDER BY p.id_kategori ASC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $stmt = $this->db->prepare("
            INSERT INTO pertanyaan (id_kategori, pertanyaan)
            VALUES (?, ?)
        ");
        return $stmt->execute([
            $data['id_kategori'],
            $data['pertanyaan']
        ]);
    }

    public function getById($id) {
    $stmt = $this->db->prepare("SELECT * FROM pertanyaan WHERE id_pertanyaan = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

    public function update($id, $data) {
        $stmt = $this->db->prepare("
            UPDATE pertanyaan
            SET id_kategori = ?, pertanyaan = ?
            WHERE id_pertanyaan = ?
        ");
        return $stmt->execute([
            $data['id_kategori'],
            $data['pertanyaan'],
            $id
        ]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM pertanyaan WHERE id_pertanyaan = ?");
        return $stmt->execute([$id]);
    }

}
