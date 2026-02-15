<?php
require_once __DIR__ . '/../../core/auth_check.php';
cek_role('admin');

$title = "Laporan Hasil Asesmen";
require __DIR__ . '/../layout/header.php';
require __DIR__ . '/../layout/sidebar.php';

$data = $data ?? [];
?>

<div class="content">

    <h1 style="margin-bottom:20px;">📊 Laporan Hasil Asesmen Musisi</h1>

    <?php if (!empty($data)): ?>

        <div style="overflow-x:auto;">
            <table style="width:100%;border-collapse:collapse;background:rgba(255,255,255,0.05);">

                <thead>
                    <tr style="background:rgba(0,0,0,0.4);">
                        <th style="padding:10px;">No</th>
                        <th style="padding:10px;">Nama</th>
                        <th style="padding:10px;">Tanggal</th>
                        <th style="padding:10px;">Total</th>
                        <th style="padding:10px;">Level</th>
                        <th style="padding:10px;">Teknik</th>
                        <th style="padding:10px;">Ritme</th>
                        <th style="padding:10px;">Ekspresi</th>
                        <th style="padding:10px;">Teori</th>
                        <th style="padding:10px;">Kreativitas</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($data as $row): ?>
                        <tr style="border-bottom:1px solid rgba(255,255,255,0.1);">

                            <td style="padding:8px;"><?= $no++; ?></td>
                            <td style="padding:8px;"><?= htmlspecialchars($row['nama']); ?></td>
                            <td style="padding:8px;">
                                <?= date('d M Y H:i', strtotime($row['tanggal'])); ?>
                            </td>
                            <td style="padding:8px;"><?= $row['skor_total']; ?></td>
                            <td style="padding:8px;">
                                <span style="background:#1abc9c;padding:4px 8px;border-radius:6px;">
                                    <?= htmlspecialchars($row['level']); ?>
                                </span>
                            </td>

                            <td style="padding:8px;"><?= $row['skor_teknik']; ?></td>
                            <td style="padding:8px;"><?= $row['skor_ritme']; ?></td>
                            <td style="padding:8px;"><?= $row['skor_ekspresi']; ?></td>
                            <td style="padding:8px;"><?= $row['skor_teori']; ?></td>
                            <td style="padding:8px;"><?= $row['skor_kreativitas']; ?></td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>
        </div>

    <?php else: ?>
        <p>Belum ada data asesmen.</p>
    <?php endif; ?>

</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>
