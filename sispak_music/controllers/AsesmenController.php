<?php
require_once __DIR__ . '/../core/auth_check.php';
require_once __DIR__ . '/../models/PertanyaanModel.php';
require_once __DIR__ . '/../models/JawabanModel.php';
require_once __DIR__ . '/../models/HasilModel.php';
require_once __DIR__ . '/../models/RekomendasiModel.php'; // ✅ TAMBAHKAN INI
require_once __DIR__ . '/../core/inference_engine.php';

class AsesmenController {

    private $pertanyaanModel;
    private $jawabanModel;
    private $hasilModel;

    public function __construct() {
        cek_role('musisi');
        $this->pertanyaanModel = new PertanyaanModel();
        $this->jawabanModel = new JawabanModel();
        $this->hasilModel = new HasilModel();
    }

    /* =========================
       TAMPILKAN HALAMAN ASESMEN
    ========================== */
    public function index() {

        $pertanyaan = $this->pertanyaanModel->getAll();
        require __DIR__ . '/../views/musisi/asesmen.php';
    }

    /* =========================
       SUBMIT JAWABAN
    ========================== */
    public function submit() {

        $id_user = $_SESSION['user']['id'];
        $jawaban = $_POST['jawaban'];

        // Simpan jawaban
        foreach ($jawaban as $id_pertanyaan => $nilai) {
            $this->jawabanModel->save($id_user, $id_pertanyaan, $nilai);
        }

        // Hitung skor kategori
        $skorKategori = $this->jawabanModel->hitungSkorPerKategori($id_user);

        // Jalankan inference engine
        $engine = new InferenceEngine();
        $hasilInferensi = $engine->proses($skorKategori);

        // Simpan hasil akhir
        $this->hasilModel->save($id_user, $hasilInferensi);

        header("Location: index.php?page=hasil");
        exit;
    }

    /* =========================
       TAMPILKAN HASIL
    ========================== */
  public function hasil() {

        $id_user = $_SESSION['user']['id'];

        // Kalau ada ID dari riwayat → tampilkan yang dipilih
        if (isset($_GET['id'])) {
            $hasil = $this->hasilModel->getById($_GET['id']);
        } else {
            $hasil = $this->hasilModel->getByUser($id_user);
        }

        require_once __DIR__ . '/../models/RekomendasiModel.php';
        $rekomModel = new RekomendasiModel();

        $rekomendasiList = [];

        if ($hasil) {

            $kategoriSkor = [
                "Teknik Dasar" => $hasil['skor_teknik'] ?? 0,
                "Ritme & Tempo" => $hasil['skor_ritme'] ?? 0,
                "Musikalitas & Ekspresi" => $hasil['skor_ekspresi'] ?? 0,
                "Teori Musik" => $hasil['skor_teori'] ?? 0,
                "Kreativitas" => $hasil['skor_kreativitas'] ?? 0
            ];

            foreach ($kategoriSkor as $kategori => $skor) {

                // Ambil rekomendasi jika skor di bawah atau sama dengan batas
                $rekom = $rekomModel->getByKategori($kategori, $skor);

                if (!empty($rekom)) {
                    $rekomendasiList[$kategori] = $rekom;
                }
            }
        }

        require __DIR__ . '/../views/musisi/hasil.php';
    }




    public function riwayat() {

        $id_user = $_SESSION['user']['id'];

        require_once __DIR__ . '/../models/HasilModel.php';
        $hasilModel = new HasilModel();

        $riwayat = $hasilModel->getByUser($id_user);

        require __DIR__ . '/../views/musisi/riwayat.php';
    }

}
