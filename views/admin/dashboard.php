<?php
require_once __DIR__ . '/../../core/auth_check.php';
cek_role('admin');

$title = "Dashboard Admin";
require __DIR__ . '/../layout/header.php';
require __DIR__ . '/../layout/sidebar.php';
?>

<div class="content">

    <h1 style="margin-bottom:20px;">🎵 Dashboard Admin</h1>

    <!-- CARDS -->
    <div style="display:flex;flex-wrap:wrap;gap:15px;margin-bottom:30px;">

        <div style="flex:1 1 250px;background:rgba(255,255,255,0.08);padding:20px;border-radius:12px;">
            <div style="font-size:40px;">🎼</div>
            <h3>Total Musisi Terdaftar</h3>
            <p style="font-size:28px;margin:10px 0;">
                <?= $totalMusisi ?? 0 ?>
            </p>
        </div>

        <div style="flex:1 1 250px;background:rgba(255,255,255,0.08);padding:20px;border-radius:12px;">
            <div style="font-size:40px;">🧠</div>
            <h3>Sistem Pakar</h3>
            <p style="font-size:20px;margin:10px 0;color:#1abc9c;">
                Aktif
            </p>
        </div>

        <div style="flex:1 1 250px;background:rgba(255,255,255,0.08);padding:20px;border-radius:12px;">
            <div style="font-size:40px;">🖥️</div>
            <h3>Status Server</h3>
            <p style="font-size:20px;margin:10px 0;color:#2ecc71;">
                Online
            </p>
        </div>

    </div>

    <!-- MENU CEPAT -->
    <div style="display:flex;flex-wrap:wrap;gap:10px;">

        <a href="index.php?page=kelola_pertanyaan"
           style="flex:1 1 200px;text-align:center;padding:12px;background:#3498db;color:white;text-decoration:none;border-radius:8px;">
            ❓ Kelola Pertanyaan
        </a>

        <a href="index.php?page=kelola_rule"
           style="flex:1 1 200px;text-align:center;padding:12px;background:#9b59b6;color:white;text-decoration:none;border-radius:8px;">
            🧠 Kelola Rule
        </a>

        <a href="index.php?page=laporan"
           style="flex:1 1 200px;text-align:center;padding:12px;background:#e67e22;color:white;text-decoration:none;border-radius:8px;">
            📊 Lihat Laporan
        </a>

    </div>

</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>
