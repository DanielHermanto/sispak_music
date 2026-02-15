<?php
function getConnection() {
    static $pdo;
    if (!$pdo) {
        $pdo = new PDO("mysql:host=localhost;dbname=db_sispak_music", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    return $pdo;
}
