<?php
if (!isset($_SESSION)) {
    session_start();
}

$namaUser = $_SESSION['user']['nama'] ?? 'User';
$roleUser = $_SESSION['user']['role'] ?? '';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'SkillTune'; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: #0f2027;
            color: white;
        }

        .topbar {
            height: 60px;
            background: linear-gradient(90deg, #141e30, #243b55);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
        }

        .brand {
            font-weight: bold;
            font-size: 18px;
        }

        .user-info {
            font-size: 14px;
        }

        .logout {
            background: #e74c3c;
            padding: 6px 12px;
            border-radius: 6px;
            text-decoration: none;
            color: white;
            margin-left: 10px;
        }

        .layout {
            display: flex;
            min-height: calc(100vh - 60px);
        }

        .content {
            flex: 1;
            padding: 20px;
            background: linear-gradient(135deg, #203a43, #2c5364);
        }

        @media (max-width: 768px) {
            .layout {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>

<div class="topbar">
    <div class="brand">SkillTune</div>

    <div class="user-info">
        <?= htmlspecialchars($namaUser); ?> (<?= $roleUser; ?>)
        <a class="logout" href="index.php?page=logout">Logout</a>
    </div>
</div>

<div class="layout">
