<?php
require_once __DIR__ . '/../../core/auth_check.php';
cek_role('admin');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Pertanyaan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Segoe UI';
            background: #2c3e50;
            color: white;
            padding: 20px;
        }
        .box {
            max-width: 600px;
            margin: auto;
            background: rgba(255,255,255,0.1);
            padding: 20px;
            border-radius: 10px;
        }
        input, select, textarea {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border-radius: 8px;
            border: none;
        }
        button {
            background: #1abc9c;
            padding: 10px;
            border: none;
            border-radius: 8px;
            color: white;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="box">
    <h2>Edit Pertanyaan</h2>

    <form method="POST">
        <label>Kategori</label>
        <select name="id_kategori" required>
            <option value="1" <?= $editData['id_kategori']==1?'selected':''; ?>>Teknik Dasar</option>
            <option value="2" <?= $editData['id_kategori']==2?'selected':''; ?>>Ritme & Tempo</option>
            <option value="3" <?= $editData['id_kategori']==3?'selected':''; ?>>Musikalitas & Ekspresi</option>
            <option value="4" <?= $editData['id_kategori']==4?'selected':''; ?>>Teori Musik</option>
            <option value="5" <?= $editData['id_kategori']==5?'selected':''; ?>>Kreativitas</option>
        </select>

        <label>Pertanyaan</label>
        <textarea name="pertanyaan" required><?= $editData['pertanyaan']; ?></textarea>

        <button type="submit">Update Pertanyaan</button>
    </form>
</div>

</body>
</html>
