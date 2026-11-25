# Lab9Web - Praktikum 9: PHP Modular

|---|---|
| **Nama** | Raihan Nabil Mas'ud |
| **NIM** | 312510094 |
| **Kelas** | I.25.1A |
| **Mata Kuliah** | Pemrograman Web |
## Tujuan Project

Praktikum ini memecah aplikasi PHP menjadi file-file dengan tanggung jawab yang jelas, menggunakan template bersama, function, dan routing sederhana. Tujuannya:

1. Memahami pengertian, tujuan, dan manfaat modularisasi program.
2. Membedakan `include`, `require`, `include_once`, dan `require_once`.
3. Membuat template halaman (header dan footer) yang dipakai bersama.
4. Membuat dan memakai function PHP dengan parameter dan nilai kembalian.
5. Menyusun struktur direktori aplikasi PHP secara modular.
6. Menerapkan routing berdasarkan parameter URL dengan whitelist dan halaman 404.
7. Mengintegrasikan modularisasi dan routing ke aplikasi CRUD dari praktikum sebelumnya (Data Barang).

## Kebutuhan Perangkat

- Web server lokal: Apache dan MySQL (XAMPP atau Laragon)
- PHP
- Browser
- Visual Studio Code atau editor kode sejenis
- Github

## Cara Menjalankan Aplikasi

1. Salin folder project ke docroot web server (`C:\xampp\htdocs\` untuk XAMPP).
2. Jalankan **Apache** dan **MySQL** dari XAMPP Control Panel.
3. Siapkan database `latihan1` dengan tabel `data_barang` (sama seperti Praktikum 8). Struktur kolom yang dipakai: `id_barang`, `nama`, `kategori`, `harga_beli`, `harga_jual`, `stok`, `gambar`.
4. Sesuaikan koneksi database di `config/database.php` bila perlu (host, user, password, nama database).
5. Pastikan folder `gambar/` ada di root project untuk menyimpan gambar barang.
6. Buka `http://localhost/[nama-folder-project]/index.php` di browser.

## Struktur Direktori

Project dibagi dua bagian: latihan dasar (template dan function) dan aplikasi CRUD modular.

### Latihan dasar: `lab9_php_modular/`

```
lab9_php_modular/
├── pesan.php
├── uji-include.php
├── header.php
├── footer.php
├── home.php
├── about.php
├── kontak.php
├── helpers.php
├── fungsi1.php
├── fungsi2.php
└── style.css
```

### Aplikasi CRUD modular

```
crud_modular/
├── index.php              # titik masuk aplikasi dan router
├── config/
│   └── database.php       # koneksi database (mysqli)
├── views/
│   ├── header.php         # pembuka HTML dan navigasi
│   ├── footer.php         # penutup halaman
│   ├── dashboard.php      # halaman awal
│   └── 404.php            # halaman tidak ditemukan
├── helpers/
│   └── functions.php      # function umum
├── modules/
│   └── barang/
│       ├── list.php       # daftar barang
│       ├── add.php        # tambah barang
│       ├── edit.php       # ubah barang
│       └── delete.php     # hapus barang
├── assets/
│   └── css/style.css
└── gambar/                # gambar barang yang diunggah
```

| Direktori / file | Tanggung jawab |
|---|---|
| `index.php` | Titik masuk, memeriksa whitelist rute, memuat header, konten, dan footer |
| `config/` | Konfigurasi aplikasi dan koneksi database |
| `views/` | Komponen tampilan yang dipakai bersama |
| `helpers/` | Function umum: `e()`, `formatRupiah()`, `redirect()`, `daftarKategori()`, `selected()`, fungsi CSRF, `uploadGambar()` |
| `modules/barang/` | Fitur CRUD Data Barang |
| `assets/` | File statis (CSS) |

## Daftar Rute

Semua halaman diakses lewat `index.php?page=<rute>`. Hanya rute di daftar ini yang diizinkan.

| Rute | File | Keterangan |
|---|---|---|
| `dashboard` (default) | `views/dashboard.php` | Ringkasan jumlah barang dan total stok |
| `barang/list` | `modules/barang/list.php` | Menampilkan data barang |
| `barang/add` | `modules/barang/add.php` | Form dan proses tambah barang |
| `barang/edit` | `modules/barang/edit.php` | Form dan proses ubah barang (`&id=...`) |
| `barang/delete` | `modules/barang/delete.php` | Hapus barang, hanya lewat POST |
| rute lain | `views/404.php` | Status 404, halaman tidak ditemukan |

Contoh: `http://localhost/crud_modular/index.php?page=barang/list`

## Langkah Praktikum

Setiap langkah diikuti hasil uji dan screenshot-nya. Simpan semua gambar di folder `screenshot/` pada repository dan sesuaikan nama file bila perlu.

### 1. Uji include dan require

Membuat `pesan.php` dan `uji-include.php`, lalu membandingkan `include` (warning, eksekusi lanjut) dengan `require` (error fatal, eksekusi berhenti) saat file tidak ditemukan.

![Hasil include saat file tidak ada](screenshot/01-include.png)

![Hasil require saat file tidak ada](screenshot/02-require.png)

### 2. Template layout

Membuat `header.php`, `footer.php`, serta halaman Home, Tentang, dan Kontak yang memakai template yang sama lewat `require_once`.

![Struktur direktori template](screenshot/03-struktur-template.png)

![Halaman home.php](screenshot/04-home.png)

![Halaman about.php](screenshot/05-about.png)

### 3. Function dan helpers

Membuat function tanpa parameter, dengan parameter, dan dengan `return`. Function latihan (`formatRupiah`, `konversiCelciusKeFahrenheit`, `tentukanStatusNilai`, `hitungTotal`) dipindahkan ke `helpers.php` dan dipanggil dari dua halaman.

![Isi helpers.php](screenshot/06-helpers.png)

![Hasil pemanggilan function](screenshot/07-hasil-function.png)

### 4. Struktur direktori modular

Menyusun folder `config`, `views`, `helpers`, `modules`, dan `assets`.

![Struktur direktori project di VS Code](screenshot/08-struktur-direktori.png)

### 5. Router dengan whitelist

Membuat `index.php` yang membaca parameter `page`, mencocokkannya dengan daftar rute, dan menampilkan 404 untuk rute tidak dikenal. Input URL tidak pernah digabung langsung menjadi path file.

**Hasil pengujian routing:**

| URL | Yang diharapkan | Hasil |
|---|---|---|
| `index.php` | Dashboard tampil | [isi] |
| `index.php?page=barang/list` | Daftar barang tampil | [isi] |
| `index.php?page=barang/add` | Form tambah barang tampil | [isi] |
| `index.php?page=admin/rahasia` | Halaman 404 | [isi] |
| `index.php?page=` (kosong) | Halaman 404 | [isi] |
| `index.php?page[]=x` (bukan string) | Halaman 404 | [isi] |

![Dashboard lewat router](screenshot/09-dashboard.png)

![Halaman 404 untuk page tidak terdaftar](screenshot/10-404.png)

### 6. URL ringkas dengan .htaccess (opsional)

[isi: dikerjakan atau dilewati, dan hasilnya]

### 7. Integrasi CRUD

Menyalin project CRUD Praktikum 8, memindahkan koneksi ke `config/database.php`, template ke `views/`, function umum ke `helpers/functions.php`, halaman CRUD ke `modules/barang/`, dan mengubah semua tautan ke pola `index.php?page=...`.

**Perubahan pada integrasi CRUD:**

- Hapus data diproses lewat **POST** dengan konfirmasi, bukan tautan GET.
- Form tambah, ubah, dan hapus dilindungi **token CSRF**.
- Output ditampilkan dengan `e()` (escape HTML) dan harga dengan `formatRupiah()`.
- Upload gambar hanya menerima ekstensi jpg, jpeg, png, gif, dan webp.

**Hasil pengujian CRUD:**

| Fitur | Yang diharapkan | Hasil |
|---|---|---|
| Lihat data | Daftar barang tampil dengan gambar | [isi] |
| Tambah data | Data baru muncul di daftar | [isi] |
| Ubah data | Perubahan tersimpan dan tampil di daftar | [isi] |
| Hapus data | Data hilang setelah konfirmasi | [isi] |
| Buka `?page=barang/delete` lewat URL | Tidak ada data yang terhapus | [isi] |

![Daftar data](screenshot/11-list.png)

![Tambah data](screenshot/12-tambah.png)

![Ubah data](screenshot/13-ubah.png)

![Hapus data](screenshot/14-hapus.png)
