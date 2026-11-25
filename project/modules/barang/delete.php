<?php
// modules/barang/delete.php - hapus barang (hanya lewat POST + token CSRF)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && csrf_valid()) {
    $id = filter_var($_POST['id'] ?? null, FILTER_VALIDATE_INT);

    if ($id !== false && $id !== null) {
        $stmt = mysqli_prepare($conn, "DELETE FROM data_barang WHERE id_barang = ?");
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
    }
}

// Membuka URL ini lewat GET tidak menghapus apa pun
redirect('barang/list');
