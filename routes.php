<?php

require_once 'controllers/AuthController.php';
require_once 'controllers/AdminController.php';
require_once 'controllers/MusisiController.php';
require_once 'controllers/AsesmenController.php';

$page = $_GET['page'] ?? 'login';

switch ($page) {

    // =====================
    // AUTH
    // =====================

    case 'login':
        (new AuthController())->login();
        break;

    case 'register':
        (new AuthController())->register();
        break;

    case 'logout':
        (new AuthController())->logout();
        break;


    // =====================
    // ADMIN
    // =====================

    case 'admin_dashboard':
        (new AdminController())->dashboard();
        break;

    case 'kelola_pertanyaan':
        (new AdminController())->kelolaPertanyaan();
        break;

    case 'laporan':
        (new AdminController())->laporan();
        break;

    case 'edit_pertanyaan':
        (new AdminController())->editPertanyaan();
        break;

    case 'hapus_pertanyaan':
        (new AdminController())->hapusPertanyaan();
        break;

    case 'kelola_rule':
        (new AdminController())->kelolaRule();
        break;

    case 'hapus_rule':
        (new AdminController())->hapusRule();
        break;




    // =====================
    // MUSISI
    // =====================

    case 'musisi_dashboard':
        (new MusisiController())->dashboard();
        break;

    case 'asesmen':
        (new AsesmenController())->index();
        break;

    case 'submit_asesmen':
        (new AsesmenController())->submit();
        break;

    case 'hasil':
        (new AsesmenController())->hasil();
        break;

    case 'riwayat':
        (new AsesmenController())->riwayat();
        break;



    default:
        echo "404 - Halaman tidak ditemukan";
        break;
}
