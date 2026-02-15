<?php
require_once __DIR__ . '/../config/database.php';

class UserModel {

    private $db;

    public function __construct() {
        $this->db = getConnection();
    }

    public function getByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $stmt = $this->db->prepare("
            INSERT INTO users (nama, email, password, role)
            VALUES (?, ?, ?, ?)
        ");
        return $stmt->execute([
            $data['nama'],
            $data['email'],
            $data['password'],
            $data['role']
        ]);
    }
}
