<?php
$role = $_SESSION['user']['role'] ?? '';
?>

<style>
.sidebar {
    width: 220px;
    background: #111;
    padding: 20px;
}

.sidebar a {
    display: block;
    color: white;
    text-decoration: none;
    padding: 10px;
    border-radius: 6px;
    margin-bottom: 8px;
    background: rgba(255,255,255,0.05);
    transition: 0.3s;
}

.sidebar a:hover {
    background: rgba(255,255,255,0.15);
}

@media (max-width: 768px) {
    .sidebar {
        width: 100%;
        display: flex;
        overflow-x: auto;
        gap: 10px;
    }

    .sidebar a {
        flex: 1;
        text-align: center;
        white-space: nowrap;
    }
}
</style>

<div class="sidebar">

<?php if ($role === 'admin'): ?>

    <a href="index.php?page=admin_dashboard">🏠 Dashboard</a>
    <a href="index.php?page=kelola_pertanyaan">❓ Kelola Pertanyaan</a>
    <a href="index.php?page=kelola_rule">🧠 Kelola Rule</a>
    <a href="index.php?page=laporan">📊 Laporan</a>

<?php elseif ($role === 'musisi'): ?>

    <a href="index.php?page=musisi_dashboard">🏠 Dashboard</a>
    <a href="index.php?page=asesmen">🎯 Mulai Tes</a>
    <a href="index.php?page=hasil">📈 Hasil Terakhir</a>

<?php endif; ?>

</div>
