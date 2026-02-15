<?php
require_once __DIR__ . '/../../core/auth_check.php';
cek_role('musisi');

$riwayat = $riwayat ?? [];
$title = "Dashboard Musisi";

require __DIR__ . '/../layout/header.php';
require __DIR__ . '/../layout/sidebar.php';
?>

<div class="content">

    <div style="margin-bottom:30px;">
        <h1>Halo, <?= htmlspecialchars($_SESSION['user']['nama']); ?> 👋</h1>
        <p>Siap mengukur level skill musikmu hari ini?</p>
        <a href="index.php?page=asesmen" 
           style="display:inline-block;margin-top:15px;padding:10px 18px;background:#1abc9c;border-radius:8px;text-decoration:none;color:white;">
            Mulai Uji Skill Musik
        </a>
    </div>
<h2>Apa saja yang diuji?</h2>
    <div style="display:flex;flex-wrap:wrap;gap:15px;margin-bottom:30px;">

        <?php
        $cards = [
            "🎹" => ["Teknik Dasar","Tingkatkan kontrol & akurasi permainanmu"],
            "🥁" => ["Ritme & Tempo","Seberapa stabil tempo kamu?"],
            "🎤" => ["Ekspresi & Musikalitas","Bermain dengan rasa & dinamika"],
            "🎼" => ["Teori Musik","Pahami struktur & progresi lagu"],
            "✨" => ["Kreativitas","Improvisasi & cipta karya"]
        ];
        ?>

        <?php foreach ($cards as $emoji => $data): ?>
            <div style="flex:1 1 250px;background:rgba(255,255,255,0.08);padding:20px;border-radius:12px;">
                <div style="font-size:40px;"><?= $emoji ?></div>
                <h3><?= $data[0] ?></h3>
                <p><?= $data[1] ?></p>
            </div>
        <?php endforeach; ?>

    </div>

    <!-- RIWAYAT -->
    <div style="background:rgba(255,255,255,0.08);padding:20px;border-radius:12px;">
        <h3>📜 Riwayat Tes Skill</h3>

        <?php if (!empty($riwayat)): ?>
            <table style="width:100%;border-collapse:collapse;margin-top:15px;">
                <thead>
                    <tr style="background:rgba(0,0,0,0.3);">
                        <th style="padding:10px;text-align:left;">Tanggal</th>
                        <th style="padding:10px;text-align:left;">Level</th>
                        <th style="padding:10px;text-align:left;">Total</th>
                        <th style="padding:10px;text-align:left;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($riwayat as $r): ?>
                        <tr>
                            <td style="padding:10px;">
                                <?= date('d M Y H:i', strtotime($r['tanggal'])) ?>
                            </td>
                            <td style="padding:10px;">
                                <?= htmlspecialchars($r['level']) ?>
                            </td>
                            <td style="padding:10px;">
                                <?= $r['skor_total'] ?>
                            </td>
                            <td style="padding:10px;">
                                <a href="index.php?page=hasil"
                                    style="background:#3498db;padding:5px 10px;border-radius:6px;text-decoration:none;color:white;">
                                    Lihat
                                </a>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p style="margin-top:10px;">Belum ada riwayat tes.</p>
        <?php endif; ?>
    </div>

</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>
