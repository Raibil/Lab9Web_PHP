<?php
// modules/barang/list.php - menampilkan data barang
$result = mysqli_query($conn, 'SELECT * FROM data_barang');
?>
<p><a href="index.php?page=barang/add">Tambah Barang</a></p>
<table>
    <tr>
        <th>Gambar</th>
        <th>Nama Barang</th>
        <th>Kategori</th>
        <th>Harga Beli</th>
        <th>Harga Jual</th>
        <th>Stok</th>
        <th>Aksi</th>
    </tr>
    <?php if ($result && mysqli_num_rows($result) > 0): ?>
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
    <tr>
        <td>
            <?php if (!empty($row['gambar'])): ?>
            <img src="gambar/<?= e($row['gambar']) ?>" alt="<?= e($row['nama']) ?>" width="80">
            <?php endif; ?>
        </td>
        <td><?= e($row['nama']) ?></td>
        <td><?= e($row['kategori']) ?></td>
        <td><?= formatRupiah($row['harga_beli']) ?></td>
        <td><?= formatRupiah($row['harga_jual']) ?></td>
        <td><?= (int) $row['stok'] ?></td>
        <td>
            <a href="index.php?page=barang/edit&amp;id=<?= (int) $row['id_barang'] ?>">Ubah</a>
            <form method="post" action="index.php?page=barang/delete" class="inline"
                  onsubmit="return confirm('Yakin hapus data ini?')">
                <?= csrf_field() ?>
                <input type="hidden" name="id" value="<?= (int) $row['id_barang'] ?>">
                <button type="submit" class="link-button">Hapus</button>
            </form>
        </td>
    </tr>
    <?php endwhile; ?>
    <?php else: ?>
    <tr>
        <td colspan="7">Belum ada data</td>
    </tr>
    <?php endif; ?>
</table>
