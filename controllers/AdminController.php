<?php
require_once __DIR__ . '/../core/auth_check.php';
require_once __DIR__ . '/../models/PertanyaanModel.php';
require_once __DIR__ . '/../models/HasilModel.php';
require_once __DIR__ . '/../models/RuleModel.php';

class AdminController {

    private $pertanyaanModel;
    private $hasilModel;
    private $ruleModel;

    public function __construct() {
        cek_role('admin');

        $this->pertanyaanModel = new PertanyaanModel();
        $this->hasilModel      = new HasilModel();
        $this->ruleModel       = new RuleModel();
    }

    /* =========================
       DASHBOARD
    ========================== */
    public function dashboard() {
        $totalMusisi = $this->hasilModel->countUsers();
        require __DIR__ . '/../views/admin/dashboard.php';
    }

    /* =========================
       KELOLA PERTANYAAN
    ========================== */
    public function kelolaPertanyaan() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $data = [
                'id_kategori' => $_POST['id_kategori'],
                'pertanyaan'  => $_POST['pertanyaan']
            ];

            $this->pertanyaanModel->create($data);
        }

        $pertanyaan = $this->pertanyaanModel->getAll();
        require __DIR__ . '/../views/admin/kelola_pertanyaan.php';
    }

    public function editPertanyaan() {

        $id = $_GET['id'] ?? null;

        if (!$id) {
            header("Location: index.php?page=kelola_pertanyaan");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $data = [
                'id_kategori' => $_POST['id_kategori'],
                'pertanyaan'  => $_POST['pertanyaan']
            ];

            $this->pertanyaanModel->update($id, $data);

            header("Location: index.php?page=kelola_pertanyaan");
            exit;
        }

        $editData = $this->pertanyaanModel->getById($id);
        require __DIR__ . '/../views/admin/edit_pertanyaan.php';
    }

    public function hapusPertanyaan() {

        $id = $_GET['id'] ?? null;

        if ($id) {
            $this->pertanyaanModel->delete($id);
        }

        header("Location: index.php?page=kelola_pertanyaan");
        exit;
    }

    /* =========================
       KELOLA RULE
    ========================== */
    public function kelolaRule() {

        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $min   = floatval($_POST['min_skor']);
            $max   = floatval($_POST['max_skor']);
            $hasil = $_POST['hasil'];

            if ($min >= $max) {
                $error = "Skor minimum harus lebih kecil dari skor maksimum.";
            } 
            elseif ($this->ruleModel->isOverlap($min, $max)) {
                $error = "Rentang skor bertabrakan dengan aturan yang sudah ada.";
            } 
            else {
                $this->ruleModel->create([
                    'min_skor' => $min,
                    'max_skor' => $max,
                    'hasil'    => $hasil
                ]);
            }
        }

        $rules = $this->ruleModel->getAllSorted();
        require __DIR__ . '/../views/admin/kelola_rule.php';
    }

    public function hapusRule() {

        $id = $_GET['id'] ?? null;

        if ($id) {
            $this->ruleModel->delete($id);
        }

        header("Location: index.php?page=kelola_rule");
        exit;
    }

    /* =========================
       LAPORAN
    ========================== */
    public function laporan() {
        $data = $this->hasilModel->getAllWithUser();
        require __DIR__ . '/../views/admin/laporan.php';
    }

}
