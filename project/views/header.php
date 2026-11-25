<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
    <title><?= e($title) ?> - Data Barang</title>
</head>
<body>
    <div class="container">
        <nav>
            <a href="index.php?page=dashboard" class="<?= $activePage === 'dashboard' ? 'active' : '' ?>">Dashboard</a>
            <a href="index.php?page=barang/list" class="<?= in_array($activePage, ['barang/list', 'barang/edit'], true) ? 'active' : '' ?>">Data Barang</a>
            <a href="index.php?page=barang/add" class="<?= $activePage === 'barang/add' ? 'active' : '' ?>">Tambah Barang</a>
        </nav>
        <h1><?= e($title) ?></h1>
        <div class="main">
