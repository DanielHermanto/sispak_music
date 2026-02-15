<?php
require_once __DIR__ . '/../config/database.php';

class InferenceEngine {

    private $db;

    public function __construct() {
        $this->db = getConnection();
    }

    public function proses($dataKategori) {

        $totalSkor = 0;

        $skor = [
            'skor_teknik' => 0,
            'skor_ritme' => 0,
            'skor_ekspresi' => 0,
            'skor_teori' => 0,
            'skor_kreativitas' => 0,
            'skor_total' => 0,
            'level' => 'Belum Ditentukan'
        ];

        foreach ($dataKategori as $kategori) {

            $nama  = $kategori['nama_kategori'];
            $bobot = $kategori['bobot'];
            $rata  = $kategori['rata_rata'];

            $skorBobot = ($rata * $bobot) / 100;

            switch ($nama) {
                case 'Teknik Dasar':
                    $skor['skor_teknik'] = round($rata,2);
                    break;

                case 'Ritme & Tempo':
                    $skor['skor_ritme'] = round($rata,2);
                    break;

                case 'Musikalitas & Ekspresi':
                    $skor['skor_ekspresi'] = round($rata,2);
                    break;

                case 'Teori Musik':
                    $skor['skor_teori'] = round($rata,2);
                    break;

                case 'Kreativitas':
                    $skor['skor_kreativitas'] = round($rata,2);
                    break;
            }

            $totalSkor += $skorBobot;
        }

        $totalSkor = round($totalSkor,2);

        $skor['skor_total'] = $totalSkor;
        $skor['level'] = $this->tentukanLevel($totalSkor);

        return $skor;
    }

    private function tentukanLevel($total) {

        $stmt = $this->db->prepare("
            SELECT hasil
            FROM rule_base
            WHERE ? BETWEEN min_skor AND max_skor
            LIMIT 1
        ");

        $stmt->execute([$total]);
        $level = $stmt->fetchColumn();

        return $level ?: "Belum Ditentukan";
    }
}
