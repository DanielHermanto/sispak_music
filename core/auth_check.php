<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * Cek apakah user sudah login
 */
function cek_login() {
    if (!isset($_SESSION['user'])) {
        header("Location: index.php?page=login");
        exit;
    }
}

/**
 * Cek role user
 */
function cek_role($role) {

    cek_login();

    if ($_SESSION['user']['role'] !== $role) {

        // Jika admin coba akses musisi atau sebaliknya
        if ($_SESSION['user']['role'] === 'admin') {
            header("Location: index.php?page=admin_dashboard");
        } else {
            header("Location: index.php?page=musisi_dashboard");
        }
        exit;
    }
}
