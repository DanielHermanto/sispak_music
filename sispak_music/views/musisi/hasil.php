<?php
require_once __DIR__ . '/../../core/auth_check.php';
cek_role('musisi');

if (!$hasil) {
    echo "Belum ada hasil asesmen.";
    exit;
}

$rekomendasiList = $rekomendasiList ?? [];

/* Warna level dinamis */
$levelColor = "#1abc9c";

switch ($hasil['level']) {
    case 'Profesional':
        $levelColor = "#f1c40f";
        break;
    case 'Mahir':
        $levelColor = "#2ecc71";
        break;
    case 'Menengah':
        $levelColor = "#3498db";
        break;
    case 'Dasar':
        $levelColor = "#e67e22";
        break;
    case 'Pemula':
        $levelColor = "#e74c3c";
        break;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Hasil Asesmen</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #141e30, #243b55);
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
            max-width: 900px;
            margin: auto;
        }

        .level-box {
            text-align: center;
            padding: 30px 20px;
            background: rgba(255,255,255,0.1);
            border-radius: 15px;
            margin-bottom: 30px;
        }

        .level-box h1 {
            margin: 0;
            font-size: 34px;
        }

        .kategori-box {
            margin-bottom: 15px;
        }

        .kategori-box h4 {
            margin: 5px 0;
        }

        .progress {
            background: rgba(255,255,255,0.2);
            border-radius: 20px;
            overflow: hidden;
            height: 20px;
        }

        .progress-bar {
            height: 100%;
            background: #1abc9c;
            text-align: right;
            padding-right: 5px;
            line-height: 20px;
            font-size: 12px;
        }

        .btn {
            display: block;
            text-align: center;
            margin-top: 25px;
            padding: 12px;
            background: #3498db;
            border-radius: 8px;
            text-decoration: none;
            color: white;
        }

        .btn:hover {
            background: #2980b9;
        }

        .rekom-box {
            margin-top: 35px;
            padding: 20px;
            background: rgba(255,255,255,0.1);
            border-radius: 15px;
        }

        canvas {
            margin-top: 30px;
        }

        @media (max-width: 600px) {
            .level-box h1 {
                font-size: 24px;
            }
        }
    </style>
</head>

<body>

<header>
    <h2>Ringkasan Kemampuan Bermusik <?= htmlspecialchars($_SESSION['user']['nama']); ?> </h2>
    <!-- <h1>Halo, 👋</h1> -->
    <a href="index.php?page=musisi_dashboard" style="color:white;">Dashboard</a>
</header>

<div class="container">

    <!-- LEVEL -->
    <div class="level-box">
        <h1 style="color: <?= $levelColor ?>;">
            <?= $hasil['level']; ?>
        </h1>
        <p>Total Skor: <strong><?= $hasil['skor_total']; ?></strong> / 5.00</p>
        <p><?= date('d M Y H:i', strtotime($hasil['tanggal'])); ?></p>
    </div>

    <!-- DETAIL SKOR -->
    <?php
    $kategoriData = [
        "Teknik Dasar" => $hasil['skor_teknik'],
        "Ritme & Tempo" => $hasil['skor_ritme'],
        "Musikalitas & Ekspresi" => $hasil['skor_ekspresi'],
        "Teori Musik" => $hasil['skor_teori'],
        "Kreativitas" => $hasil['skor_kreativitas']
    ];

    foreach ($kategoriData as $nama => $skor):
        $persen = ($skor / 5) * 100;
    ?>
        <div class="kategori-box">
            <h4><?= $nama; ?> (<?= $skor; ?>)</h4>
            <div class="progress">
                <div class="progress-bar" style="width: <?= $persen; ?>%;">
                    <?= round($persen); ?>%
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <!-- RADAR CHART -->
    <div style="max-width:500px; margin:auto;">
        <canvas id="radarChart"></canvas>
    </div>

    <!-- REKOMENDASI -->
    <?php if (!empty($rekomendasiList)): ?>
        <div class="rekom-box">
            <h3>Rekomendasi Pengembangan Untuk Asah Skill Musik Kamu</h3>
            <?php foreach ($rekomendasiList as $kategori => $list): ?>
                <p><strong><?= $kategori ?></strong></p>
                <ul>
                    <?php foreach ($list as $r): ?>
                        <li><?= $r['isi_rekomendasi']; ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <a class="btn" href="index.php?page=asesmen">Ulangi Ujian Skill</a>

</div>

<script>
new Chart(document.getElementById('radarChart'), {
    type: 'radar',
    data: {
        labels: ['Teknik', 'Ritme', 'Ekspresi', 'Teori', 'Kreativitas'],
        datasets: [{
            label: 'Skill Musik',
            data: [
                <?= $hasil['skor_teknik']; ?>,
                <?= $hasil['skor_ritme']; ?>,
                <?= $hasil['skor_ekspresi']; ?>,
                <?= $hasil['skor_teori']; ?>,
                <?= $hasil['skor_kreativitas']; ?>
            ],
            backgroundColor: 'rgba(26,188,156,0.2)',
            borderColor: '#1abc9c',
            pointBackgroundColor: '#1abc9c'
        }]
    },
    options: {
        responsive: true,
        scales: {
            r: {
                min: 0,
                max: 5,
                ticks: { stepSize: 1 }
            }
        }
    }
});
</script>

</body>
</html>
