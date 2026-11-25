<?php
// config/database.php - satu-satunya tempat koneksi database
$host = "localhost";
$user = "root";
$pass = "";
$db   = "latihan1";

$conn = mysqli_connect($host, $user, $pass, $db);

if ($conn === false) {
    // Detail error hanya dicatat di log, tidak ditampilkan ke pengguna
    error_log(mysqli_connect_error());
    http_response_code(500);
    exit("Koneksi ke server gagal.");
}

mysqli_set_charset($conn, 'utf8mb4');
