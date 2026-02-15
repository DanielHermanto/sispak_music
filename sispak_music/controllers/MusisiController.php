<?php
require_once __DIR__ . '/../core/auth_check.php';
require_once __DIR__ . '/../models/HasilModel.php';

class MusisiController {

    private $hasilModel;

    public function __construct() {
        cek_role('musisi');
        $this->hasilModel = new HasilModel();
    }

    public function dashboard() {

        $id_user = $_SESSION['user']['id'];

        $riwayat = $this->hasilModel->getRiwayatByUser($id_user);

        require __DIR__ . '/../views/musisi/dashboard.php';
    }

}
