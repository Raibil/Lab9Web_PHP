<?php
// index.php - titik masuk aplikasi sekaligus router
session_start();
ob_start(); // supaya redirect() di modul tetap berfungsi setelah header dimuat

require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/helpers/functions.php';

// Whitelist rute: hanya halaman di daftar ini yang boleh diakses
$routes = [
    'dashboard'    => ['file' => __DIR__ . '/views/dashboard.php',     'title' => 'Dashboard'],
    'barang/list'  => ['file' => __DIR__ . '/modules/barang/list.php', 'title' => 'Data Barang'],
    'barang/add'   => ['file' => __DIR__ . '/modules/barang/add.php',  'title' => 'Tambah Barang'],
    'barang/edit'  => ['file' => __DIR__ . '/modules/barang/edit.php', 'title' => 'Ubah Barang'],
    'barang/delete'=> ['file' => __DIR__ . '/modules/barang/delete.php', 'title' => 'Hapus Barang'],
];

$page = $_GET['page'] ?? 'dashboard';

if (!is_string($page) || !array_key_exists($page, $routes)) {
    http_response_code(404);
    $activePage  = '';
    $title       = '404 - Halaman tidak ditemukan';
    $contentFile = __DIR__ . '/views/404.php';
} else {
    $activePage  = $page;
    $title       = $routes[$page]['title'];
    $contentFile = $routes[$page]['file'];
}

require_once __DIR__ . '/views/header.php';
require $contentFile;
require_once __DIR__ . '/views/footer.php';
