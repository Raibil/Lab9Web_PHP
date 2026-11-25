<?php
// modules/barang/add.php - form dan proses tambah barang
$error = '';

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

            $stmt = mysqli_prepare($conn, "INSERT INTO data_barang (nama, kategori, harga_jual, harga_beli, stok, gambar) VALUES (?, ?, ?, ?, ?, ?)");
            mysqli_stmt_bind_param($stmt, "ssiiis", $nama, $kategori, $harga_jual, $harga_beli, $stok, $gambar);
            mysqli_stmt_execute($stmt);

            redirect('barang/list');
        }
    }
}
?>
<?php if ($error !== ''): ?>
<p class="alert"><?= e($error) ?></p>
<?php endif; ?>
<form method="post" action="index.php?page=barang/add" enctype="multipart/form-data">
    <?= csrf_field() ?>
    <div class="input">
        <label>Nama Barang</label>
        <input type="text" name="nama" required />
    </div>
    <div class="input">
        <label>Kategori</label>
        <select name="kategori">
            <?php foreach (daftarKategori() as $k): ?>
            <option value="<?= e($k) ?>"><?= e($k) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="input">
        <label>Harga Jual</label>
        <input type="text" name="harga_jual" />
    </div>
    <div class="input">
        <label>Harga Beli</label>
        <input type="text" name="harga_beli" />
    </div>
    <div class="input">
        <label>Stok</label>
        <input type="text" name="stok" />
    </div>
    <div class="input">
        <label>File Gambar</label>
        <input type="file" name="file_gambar" />
    </div>
    <div class="submit">
        <input type="submit" name="submit" value="Simpan" />
    </div>
</form>
