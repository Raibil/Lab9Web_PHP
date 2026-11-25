<?php
// modules/barang/edit.php - form dan proses ubah barang
$error = '';
$id = filter_var($_POST['id'] ?? $_GET['id'] ?? null, FILTER_VALIDATE_INT);

if ($id === false || $id === null) {
    echo '<p class="alert">Data tidak tersedia.</p><p><a href="index.php?page=barang/list">Kembali</a></p>';
    return;
}

if (isset($_POST['submit'])) {
    if (!csrf_valid()) {
        $error = 'Permintaan tidak valid. Muat ulang halaman lalu coba lagi.';
    } else {
        $nama       = trim($_POST['nama'] ?? '');
        $kategori   = $_POST['kategori'] ?? '';
        $harga_jual = (int) ($_POST['harga_jual'] ?? 0);
        $harga_beli = (int) ($_POST['harga_beli'] ?? 0);
        $stok       = (int) ($_POST['stok'] ?? 0);

        if ($nama === '' || !in_array($kategori, daftarKategori(), true)) {
            $error = 'Nama dan kategori wajib diisi dengan benar.';
        } else {
            $gambar = isset($_FILES['file_gambar']) ? uploadGambar($_FILES['file_gambar']) : null;

            if (!empty($gambar)) {
                $stmt = mysqli_prepare($conn, "UPDATE data_barang SET nama=?, kategori=?, harga_jual=?, harga_beli=?, stok=?, gambar=? WHERE id_barang=?");
                mysqli_stmt_bind_param($stmt, "ssiiisi", $nama, $kategori, $harga_jual, $harga_beli, $stok, $gambar, $id);
            } else {
                $stmt = mysqli_prepare($conn, "UPDATE data_barang SET nama=?, kategori=?, harga_jual=?, harga_beli=?, stok=? WHERE id_barang=?");
                mysqli_stmt_bind_param($stmt, "ssiiii", $nama, $kategori, $harga_jual, $harga_beli, $stok, $id);
            }
            mysqli_stmt_execute($stmt);

            redirect('barang/list');
        }
    }
}

// Ambil data barang yang akan diubah
$stmt = mysqli_prepare($conn, "SELECT * FROM data_barang WHERE id_barang = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$data = $result ? mysqli_fetch_assoc($result) : null;

if (!$data) {
    echo '<p class="alert">Data tidak tersedia.</p><p><a href="index.php?page=barang/list">Kembali</a></p>';
    return;
}
?>
<?php if ($error !== ''): ?>
<p class="alert"><?= e($error) ?></p>
<?php endif; ?>
<form method="post" action="index.php?page=barang/edit&amp;id=<?= (int) $data['id_barang'] ?>" enctype="multipart/form-data">
    <?= csrf_field() ?>
    <div class="input">
        <label>Nama Barang</label>
        <input type="text" name="nama" value="<?= e($data['nama']) ?>" />
    </div>
    <div class="input">
        <label>Kategori</label>
        <select name="kategori">
            <?php foreach (daftarKategori() as $k): ?>
            <option <?= selected($k, $data['kategori']) ?> value="<?= e($k) ?>"><?= e($k) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="input">
        <label>Harga Jual</label>
        <input type="text" name="harga_jual" value="<?= e($data['harga_jual']) ?>" />
    </div>
    <div class="input">
        <label>Harga Beli</label>
        <input type="text" name="harga_beli" value="<?= e($data['harga_beli']) ?>" />
    </div>
    <div class="input">
        <label>Stok</label>
        <input type="text" name="stok" value="<?= e($data['stok']) ?>" />
    </div>
    <div class="input">
        <label>File Gambar</label>
        <input type="file" name="file_gambar" />
    </div>
    <div class="submit">
        <input type="hidden" name="id" value="<?= (int) $data['id_barang'] ?>" />
        <input type="submit" name="submit" value="Simpan" />
    </div>
</form>
