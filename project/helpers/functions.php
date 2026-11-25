<?php
// helpers/functions.php - function umum yang dipakai banyak modul

// Escape teks sebelum ditampilkan ke HTML
function e($nilai): string
{
    return htmlspecialchars((string) $nilai, ENT_QUOTES, 'UTF-8');
}

// Format angka menjadi Rupiah, contoh: 150000 -> Rp 150.000
function formatRupiah($angka): string
{
    return 'Rp ' . number_format((float) $angka, 0, ',', '.');
}

// Pindah ke halaman lain lewat router
function redirect(string $page): void
{
    if (ob_get_level() > 0) {
        ob_end_clean();
    }
    header('Location: index.php?page=' . $page);
    exit;
}

// Daftar kategori yang tersedia pada form
function daftarKategori(): array
{
    return ['Komputer', 'Elektronik', 'Hand Phone'];
}

// Menandai <option> yang terpilih
function selected($nilai, $pilihan): string
{
    return $nilai == $pilihan ? 'selected="selected"' : '';
}

// --- Perlindungan CSRF ---
function csrf_token(): string
{
    if (empty($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf'];
}

function csrf_field(): string
{
    return '<input type="hidden" name="csrf" value="' . e(csrf_token()) . '">';
}

function csrf_valid(): bool
{
    return isset($_POST['csrf'], $_SESSION['csrf'])
        && is_string($_POST['csrf'])
        && hash_equals($_SESSION['csrf'], $_POST['csrf']);
}

// Upload gambar ke folder gambar/. Mengembalikan nama file, atau null jika tidak ada/gagal.
function uploadGambar(array $file): ?string
{
    if (!isset($file['error']) || $file['error'] !== UPLOAD_ERR_OK) {
        return null;
    }

    $filename = str_replace(' ', '_', basename($file['name']));
    $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    if (!in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp'], true)) {
        return null;
    }

    $folder = dirname(__DIR__) . '/gambar/';
    if (!is_dir($folder)) {
        mkdir($folder, 0755, true);
    }

    if (move_uploaded_file($file['tmp_name'], $folder . $filename)) {
        return $filename;
    }
    return null;
}
