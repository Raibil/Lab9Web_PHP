<?php
require_once __DIR__ . '/helpers.php';

echo "Harga: " . formatRupiah(150000) . "<br>";
echo "30 C = " . konversiCelciusKeFahrenheit(30) . " F<br>";
echo "Nilai 85 = " . tentukanStatusNilai(85) . "<br>";
echo "Total belanja: " . formatRupiah(hitungTotal(25000, 3)) . "<br>";
?>