<?php
require_once __DIR__ . '/../../core/auth_check.php';
cek_role('musisi');

/*
$pertanyaan berasal dari:
AsesmenController -> index()
$pertanyaan = $this->pertanyaanModel->getAll();
*/
?>

<!DOCTYPE html>
<html>
<head>
    <title>Asesmen Skill Musik</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #1c1c1c, #2c3e50);
            color: white;
        }

        header {
            padding: 15px 20px;
            background: rgba(0,0,0,0.4);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .container {
            padding: 20px;
        }

        .kategori {
            margin-bottom: 30px;
            padding: 15px;
            background: rgba(255,255,255,0.08);
            border-radius: 10px;
        }

        .kategori h3 {
            margin-top: 0;
        }

        .pertanyaan {
            margin-bottom: 15px;
        }

        .skala {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .skala label {
            background: #34495e;
            padding: 5px 10px;
            border-radius: 6px;
            cursor: pointer;
        }

        input[type="radio"] {
            margin-right: 3px;
        }

        button {
            width: 100%;
            padding: 12px;
            background: #1abc9c;
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background: #16a085;
        }

        @media (max-width: 600px) {
            .skala {
                gap: 5px;
            }
        }
    </style>
</head>

<body>

<header>
    <h2>🎼 Asesmen Skill Musik</h2>
    <a href="index.php?page=musisi_dashboard" style="color:white;">← Kembali</a>
</header>

<div class="container">

<form method="POST" action="index.php?page=submit_asesmen">

<?php
$currentKategori = '';
$no = 1;

foreach ($pertanyaan as $p):

    if ($currentKategori !== $p['nama_kategori']) {
        if ($currentKategori !== '') {
            echo "</div>"; // tutup kategori sebelumnya
        }

        $currentKategori = $p['nama_kategori'];
        echo "<div class='kategori'>";
        echo "<h3>🎵 $currentKategori</h3>";
    }
?>

    <div class="pertanyaan">
        <p><?= $no++; ?>. <?= $p['pertanyaan']; ?></p>

        <div class="skala">
            <?php for ($i = 1; $i <= 5; $i++): ?>
                <label>
                    <input type="radio" 
                           name="jawaban[<?= $p['id_pertanyaan']; ?>]" 
                           value="<?= $i; ?>" required>
                    <?= $i; ?>
                </label>
            <?php endfor; ?>
        </div>
    </div>

<?php endforeach; ?>

</div>

<button type="submit">🚀 Kirim & Lihat Hasil</button>

</form>

</div>

</body>
</html>
