<?php
require_once __DIR__ . '/../../core/auth_check.php';
cek_role('admin');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pengaturan Level Penilaian</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
            max-width: 1000px;
            margin: auto;
        }

        .card {
            background: rgba(255,255,255,0.1);
            padding: 25px;
            border-radius: 15px;
            margin-bottom: 30px;
        }

        h2, h3 {
            margin-top: 0;
        }

        label {
            font-weight: 500;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            margin-bottom: 15px;
            border-radius: 8px;
            border: none;
        }

        .row {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .col {
            flex: 1 1 200px;
        }

        button {
            padding: 10px 15px;
            background: #1abc9c;
            border: none;
            border-radius: 8px;
            color: white;
            cursor: pointer;
        }

        button:hover {
            background: #16a085;
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

        .btn-delete {
            background: #e74c3c;
            padding: 5px 10px;
            border-radius: 6px;
            text-decoration: none;
            color: white;
            font-size: 13px;
        }

        .back-btn {
            color: white;
            text-decoration: none;
            background: #e67e22;
            padding: 6px 10px;
            border-radius: 6px;
        }

        .info-box {
            background: rgba(255,255,255,0.08);
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .row {
                flex-direction: column;
            }

            table, thead, tbody, th, td, tr {
                display: block;
            }

            thead {
                display: none;
            }

            tr {
                margin-bottom: 15px;
                padding: 10px;
                border-radius: 10px;
            }
        }
    </style>
</head>

<body>

<header>
    <h2>Pengaturan Level Skill Musik</h2>
    <a href="index.php?page=admin_dashboard" class="back-btn">← Dashboard</a>
</header>

<div class="container">

    <!-- FORM TAMBAH RULE -->
    <div class="card">
        <h3>Tambah Aturan Level Baru</h3>

        <div class="info-box">
            Tentukan rentang total skor untuk setiap level skill.  
            Sistem akan otomatis menentukan level berdasarkan skor yang diperoleh musisi.
        </div>

        <?php if (!empty($error)): ?>
            <div style="background:#e74c3c;padding:10px;border-radius:8px;margin-bottom:15px;">
                <?= $error; ?>
            </div>
        <?php endif; ?>


        <form method="POST">

            <label>Pilih Level Skill</label>
            <select name="hasil" required>
                <option value="">-- Pilih Level --</option>
                <option value="Pemula">Pemula</option>
                <option value="Dasar">Dasar</option>
                <option value="Menengah">Menengah</option>
                <option value="Mahir">Mahir</option>
                <option value="Profesional">Profesional</option>
            </select>

            <div class="row">
                <div class="col">
                    <label>Skor Minimum</label>
                    <input type="number" step="0.1" name="min_skor" placeholder="Contoh: 3.0" required>
                </div>

                <div class="col">
                    <label>Skor Maksimum</label>
                    <input type="number" step="0.1" name="max_skor" placeholder="Contoh: 4.0" required>
                </div>
            </div>

            <button type="submit">Simpan Aturan Level</button>

        </form>
    </div>

    <!-- DAFTAR RULE -->
    <div class="card">
        <h3>Daftar Aturan Level</h3>

        <table>
            <thead>
                <tr>
                    <th width="60">ID</th>
                    <th>Rentang Skor</th>
                    <th width="200">Level</th>
                    <th width="100">Aksi</th>
                </tr>
            </thead>

           <tbody>
    <?php if (!empty($rules)): ?>
        <?php foreach ($rules as $r): ?>
            <tr>
                <td><?= $r['id_rule']; ?></td>

                <td>
                    <?= number_format($r['min_skor'],1); ?>
                    –
                    <?= number_format($r['max_skor'],1); ?>
                </td>

                <td><?= htmlspecialchars($r['hasil']); ?></td>

                <td>
                    <a href="index.php?page=hapus_rule&id=<?= $r['id_rule']; ?>"
                       onclick="return confirm('Yakin ingin menghapus aturan ini?')"
                       class="btn-delete">
                       Hapus
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="4">Belum ada aturan level.</td>
        </tr>
    <?php endif; ?>
</tbody>
        </table>
    </div>

</div>

</body>
</html>
