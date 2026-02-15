<?php
require_once __DIR__ . '/../../core/auth_check.php';
cek_role('musisi');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Riwayat Asesmen</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Segoe UI';
            background: linear-gradient(135deg, #141e30, #243b55);
            color: white;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: rgba(255,255,255,0.1);
            border-radius: 12px;
            overflow: hidden;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background: rgba(0,0,0,0.3);
        }

        tr:nth-child(even) {
            background: rgba(255,255,255,0.05);
        }

        .btn {
            background: #1abc9c;
            padding: 5px 10px;
            border-radius: 6px;
            text-decoration: none;
            color: white;
        }
    </style>
</head>

<body>

<h2>📜 Riwayat Asesmen Skill</h2>

<?php if (!empty($riwayat)): ?>
<table>
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Total Skor</th>
            <th>Level</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($riwayat as $r): ?>
        <tr>
            <td><?= date('d M Y H:i', strtotime($r['tanggal'])); ?></td>
            <td><?= $r['skor_total']; ?></td>
            <td><?= $r['level']; ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php else: ?>
    <p>Belum ada riwayat asesmen.</p>
<?php endif; ?>

<br>
<a href="index.php?page=musisi_dashboard" class="btn">← Kembali</a>

</body>
</html>
