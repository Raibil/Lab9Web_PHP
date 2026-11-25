<?php
// views/dashboard.php - ringkasan data barang
$res = mysqli_query($conn, "SELECT COUNT(*) AS total, COALESCE(SUM(stok), 0) AS total_stok FROM data_barang");
$ringkasan = $res ? mysqli_fetch_assoc($res) : ['total' => 0, 'total_stok' => 0];
?>
<p>Selamat datang di aplikasi Data Barang.</p>
<table>
    <tr>
        <th>Jumlah jenis barang</th>
        <td><?= (int) $ringkasan['total'] ?></td>
    </tr>
    <tr>
        <th>Total stok</th>
        <td><?= (int) $ringkasan['total_stok'] ?></td>
    </tr>
</table>
<p><a href="index.php?page=barang/list">Lihat data barang</a></p>
