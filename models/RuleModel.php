<?php
require_once __DIR__ . '/../config/database.php';

class RuleModel {

    private $db;

    public function __construct() {
        $this->db = getConnection();
    }

    /* =========================
       AMBIL SEMUA RULE (SORTED)
    ========================== */
    public function getAllSorted() {
        $stmt = $this->db->query("
            SELECT * FROM rule_base
            ORDER BY min_skor ASC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /* =========================
       TAMBAH RULE BARU
    ========================== */
    public function create($data) {

        $stmt = $this->db->prepare("
            INSERT INTO rule_base (min_skor, max_skor, hasil)
            VALUES (?, ?, ?)
        ");

        return $stmt->execute([
            $data['min_skor'],
            $data['max_skor'],
            $data['hasil']
        ]);
    }

    /* =========================
       HAPUS RULE
    ========================== */
    public function delete($id) {

        $stmt = $this->db->prepare("
            DELETE FROM rule_base
            WHERE id_rule = ?
        ");

        return $stmt->execute([$id]);
    }

    /* =========================
       CEK OVERLAP RENTANG
    ========================== */
    public function isOverlap($min, $max) {

        $stmt = $this->db->prepare("
            SELECT id_rule FROM rule_base
            WHERE (
                (? BETWEEN min_skor AND max_skor)
                OR
                (? BETWEEN min_skor AND max_skor)
                OR
                (min_skor BETWEEN ? AND ?)
                OR
                (max_skor BETWEEN ? AND ?)
            )
        ");

        $stmt->execute([$min, $max, $min, $max, $min, $max]);

        return $stmt->rowCount() > 0;
    }
}
