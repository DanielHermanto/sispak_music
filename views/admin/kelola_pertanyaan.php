<?php
require_once __DIR__ . '/../../core/auth_check.php';
cek_role('admin');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Kelola Pertanyaan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #1e1e2f, #2c3e50);
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
            max-width: 1100px;
            margin: auto;
        }

        .card {
            background: rgba(255,255,255,0.1);
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 30px;
        }

        h3 {
            margin-top: 0;
        }

        input, select, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            margin-bottom: 15px;
            border-radius: 8px;
            border: none;
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

        .badge {
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 12px;
            background: #3498db;
        }

        .btn-edit {
            background: #3498db;
            padding: 5px 10px;
            border-radius: 6px;
            text-decoration: none;
            color: white;
            font-size: 13px;
        }

        .btn-delete {
            background: #e74c3c;
            padding: 5px 10px;
            border-radius: 6px;
            text-decoration: none;
            color: white;
            font-size: 13px;
        }

        .action-group {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .back-btn {
            color: white;
            text-decoration: none;
            background: #e67e22;
            padding: 6px 10px;
            border-radius: 6px;
        }

        /* Responsive Table */
        @media (max-width: 768px) {
            table, thead, tbody, th, td, tr {
                display: block;
            }

            thead {
                display: none;
            }

            tr {
                margin-bottom: 15px;
                background: rgba(255,255,255,0.1);
                padding: 10px;
                border-radius: 10px;
            }

            td {
                padding: 6px 0;
            }

            .action-group {
                margin-top: 10px;
            }
        }
    </style>
</head>

<body>

<header>
    <h2>Kelola Pertanyaan</h2>
    <a href="index.php?page=admin_dashboard" class="back-btn">← Dashboard</a>
</header>

<div class="container">

    <!-- FORM TAMBAH -->
    <div class="card">
        <h3>➕ Tambah Pertanyaan Baru</h3>

        <form method="POST">
            <label>Kategori</label>
            <select name="id_kategori" required>
                <option value="">-- Pilih Kategori --</option>
                <option value="1">Teknik Dasar</option>
                <option value="2">Ritme & Tempo</option>
                <option value="3">Musikalitas & Ekspresi</option>
                <option value="4">Teori Musik</option>
                <option value="5">Kreativitas</option>
            </select>

            <label>Pertanyaan</label>
            <textarea name="pertanyaan" rows="3" required></textarea>

            <button type="submit">💾 Simpan Pertanyaan</button>
        </form>
    </div>

    <!-- TABEL DATA -->
    <div class="card">
        <h3>📋 Daftar Pertanyaan</h3>

        <table>
            <thead>
                <tr>
                    <th width="50">No</th>
                    <th width="200">Kategori</th>
                    <th>Pertanyaan</th>
                    <th width="150">Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php if (!empty($pertanyaan)): ?>
                    <?php $no = 1; foreach ($pertanyaan as $p): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td>
                                <span class="badge">
                                    <?= htmlspecialchars($p['nama_kategori']); ?>
                                </span>
                            </td>
                            <td><?= htmlspecialchars($p['pertanyaan']); ?></td>
                            <td>
                                <div class="action-group">
                                    <a href="index.php?page=edit_pertanyaan&id=<?= $p['id_pertanyaan']; ?>" class="btn-edit">
                                        Edit
                                    </a>

                                    <a href="index.php?page=hapus_pertanyaan&id=<?= $p['id_pertanyaan']; ?>"
                                       onclick="return confirm('Yakin ingin menghapus pertanyaan ini?')"
                                       class="btn-delete">
                                        Hapus
                                    </a>
                                </div>c
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">Belum ada pertanyaan.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

    </div>

</div>

</body>
</html>
