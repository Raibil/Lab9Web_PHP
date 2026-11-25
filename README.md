# Lab9Web - Praktikum 9: PHP Modular

| | |
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

<img width="975" height="94" alt="image" src="https://github.com/user-attachments/assets/49fd526d-0b00-465b-a02f-d67820907efa" />

<img width="975" height="78" alt="image" src="https://github.com/user-attachments/assets/c64e32ec-5392-43d9-96e0-eaccb7c609aa" />

### 2. Template layout

Membuat `header.php`, `footer.php`, serta halaman Home, Tentang, dan Kontak yang memakai template yang sama lewat `require_once`.

<img width="325" height="422" alt="image" src="https://github.com/user-attachments/assets/0293e532-ec91-4e13-9427-319559fe051f" />

<img width="646" height="350" alt="image" src="https://github.com/user-attachments/assets/04fc63fe-5ef0-467f-afed-67bf5281575e" />

<img width="640" height="356" alt="image" src="https://github.com/user-attachments/assets/be00928d-caf7-4fa6-b9fb-3f65fd221594" />

### 3. Function dan helpers

Membuat function tanpa parameter, dengan parameter, dan dengan `return`. Function latihan (`formatRupiah`, `konversiCelciusKeFahrenheit`, `tentukanStatusNilai`, `hitungTotal`) dipindahkan ke `helpers.php` dan dipanggil dari dua halaman.

<img width="583" height="496" alt="image" src="https://github.com/user-attachments/assets/475273cf-f232-4656-890e-8180f0eda1ff" />

<img width="528" height="179" alt="image" src="https://github.com/user-attachments/assets/0fdbf88c-91f0-42ac-9f91-ca6613d542f3" />

<img width="574" height="153" alt="image" src="https://github.com/user-attachments/assets/e8532657-e2ca-4168-a0e3-dd7cb57b372d" />

### 4. Struktur direktori modular

Menyusun folder `config`, `views`, `helpers`, `modules`, dan `assets`.

<img width="194" height="550" alt="image" src="https://github.com/user-attachments/assets/c5f3d77e-1ad2-482f-bdcd-215a7f47490c" />

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

<img width="975" height="315" alt="image" src="https://github.com/user-attachments/assets/b02d63d9-e460-451b-874a-1e7c9cafef86" />

<img width="975" height="246" alt="image" src="https://github.com/user-attachments/assets/1878cc8e-2d6c-4749-b09d-e6a0a809fae2" />

### 6. Integrasi CRUD

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

<img width="975" height="315" alt="image" src="https://github.com/user-attachments/assets/393a59e1-1ba6-45dc-95ad-f0c090b72cc5" />

<img width="462" height="429" alt="image" src="https://github.com/user-attachments/assets/8e040630-e5ad-40d9-a65b-9ca4383b24e8" />

<img width="823" height="336" alt="image" src="https://github.com/user-attachments/assets/06280e55-e0ac-40c3-95f7-e67efb967733" />

<img width="447" height="401" alt="image" src="https://github.com/user-attachments/assets/d50329c6-53c1-4868-ad7e-c6fae1bfd555" />

<img width="875" height="350" alt="image" src="https://github.com/user-attachments/assets/285fc74e-a71d-41b6-b02b-8a2c93f54638" />

<img width="851" height="352" alt="image" src="https://github.com/user-attachments/assets/d02e7e2a-18ff-4269-9b82-40be7c26bdb1" />

<img width="876" height="342" alt="image" src="https://github.com/user-attachments/assets/2bb89154-a0c7-40f6-9c08-4fd4aa841481" />
