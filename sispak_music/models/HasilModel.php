<?php
require_once __DIR__ . '/../config/database.php';

class HasilModel {

    private $db;

    public function __construct() {
        $this->db = getConnection();
    }

public function save($id_user, $data) {

        $stmt = $this->db->prepare("
            INSERT INTO hasil (
                id_user,
                skor_teknik,
                skor_ritme,
                skor_ekspresi,
                skor_teori,
                skor_kreativitas,
                skor_total,
                level
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ");

        return $stmt->execute([
            $id_user,
            $data['skor_teknik'],
            $data['skor_ritme'],
            $data['skor_ekspresi'],
            $data['skor_teori'],
            $data['skor_kreativitas'],
            $data['skor_total'],
            $data['level']
        ]);
    }



    public function getByUser($id_user) {

        $stmt = $this->db->prepare("
            SELECT * FROM hasil
            WHERE id_user = ?
            ORDER BY tanggal DESC
        ");

        $stmt->execute([$id_user]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function getAll() {
        $stmt = $this->db->query("
            SELECT h.*, u.nama 
            FROM hasil h
            JOIN users u ON h.id_user = u.id_user
            ORDER BY h.tanggal DESC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countUsers() {
        $stmt = $this->db->query("SELECT COUNT(DISTINCT id_user) as total FROM hasil");
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function getRiwayatByUser($id_user) {

    $stmt = $this->db->prepare("
        SELECT *
        FROM hasil
        WHERE id_user = ?
        ORDER BY tanggal DESC
    ");

    $stmt->execute([$id_user]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

    public function getAllWithUser() {

        $stmt = $this->db->query("
            SELECT h.*, u.nama
            FROM hasil h
            JOIN users u ON h.id_user = u.id_user
            ORDER BY h.tanggal DESC
        ");

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



}
