# Laporan Praktikum 9 - PHP Modular

**Mata Kuliah:** Pemrograman Web
**Nama:** YUDHA EKA P
**NIM:** 312210362
**Kelas:** I251C
**Repository:** Lab9Web

---

## 1. Tujuan Praktikum
1. Menjelaskan pengertian, tujuan, dan manfaat modularisasi program.
2. Membedakan `include`, `require`, `include_once`, dan `require_once`.
3. Membuat template halaman yang dipakai bersama oleh beberapa halaman.
4. Membuat dan memakai function PHP dengan parameter dan nilai kembalian.
5. Menyusun struktur direktori aplikasi PHP secara modular.
6. Menerapkan routing berdasarkan parameter URL dengan validasi halaman.
7. Mengintegrasikan modularisasi dan routing ke aplikasi database.

## 2. Kebutuhan Perangkat
- PHP 8.0 atau lebih baru
- MySQL/MariaDB dan Apache (XAMPP/Laragon)
- Visual Studio Code dan browser
- Git

## 3. Cara Menjalankan
1. Salin folder `Lab9Web` ke `htdocs` (XAMPP) atau `www` (Laragon).
2. Jalankan Apache dan MySQL.
3. Impor `project/database.sql` melalui phpMyAdmin.
4. Sesuaikan kredensial di `project/config/database.php` bila perlu.
5. Buka di browser:
   - Latihan template dan function: `http://localhost/Lab9Web/lab9_php_modular/home.php`
   - Aplikasi utama: `http://localhost/Lab9Web/project/index.php`

## 4. Struktur Direktori
```
Lab9Web/
├── README.md
├── docs/screenshots/            # screenshot untuk laporan
├── lab9_php_modular/            # latihan bagian C, D, E
│   ├── header.php, footer.php
│   ├── home.php, about.php, profil.php, kontak.php
│   ├── helpers.php, contoh-function.php, contoh-panggil.php
│   ├── latihan-function.php, latihan-function-2.php
│   ├── pesan.php, uji-include.php, uji-require.php
│   └── style.css
└── project/                     # aplikasi modular bagian F - I
    ├── index.php                # router
    ├── .htaccess                # URL rewrite (opsional)
    ├── database.sql
    ├── config/database.php
    ├── views/                   # header, footer, dashboard, about, helper_demo, 404
    ├── helpers/functions.php
    ├── modules/user/            # list, add, edit, delete
    └── assets/css, assets/js
```

| Direktori | Tanggung jawab |
|---|---|
| `index.php` | Titik masuk dan router |
| `config/` | Konfigurasi dan koneksi database |
| `views/` | Komponen tampilan bersama |
| `helpers/` | Function umum |
| `modules/` | Fitur aplikasi per domain |
| `assets/` | File statis (CSS, JS) |

## 5. Daftar Rute
| Parameter `page` | File | Keterangan |
|---|---|---|
| `dashboard` (default) | `views/dashboard.php` | Ringkasan data |
| `about` | `views/about.php` | Tentang aplikasi |
| `helper/demo` | `views/helper_demo.php` | Demo function helper |
| `user/list` | `modules/user/list.php` | Daftar pengguna |
| `user/add` | `modules/user/add.php` | Tambah pengguna |
| `user/edit` | `modules/user/edit.php` | Ubah pengguna |
| `user/delete` | `modules/user/delete.php` | Hapus pengguna (POST) |

Rute yang tidak terdaftar menampilkan `views/404.php` dengan status HTTP 404.

---

## 6. Langkah Praktikum dan Hasil

### 6.1 Uji `include` vs `require`
Folder `lab9_php_modular` berisi `pesan.php`, `uji-include.php`, dan `uji-require.php`. Nama `pesan.php` diubah sementara untuk mengamati perilaku kedua perintah.

| Perintah | File tidak ditemukan | Baris setelahnya |
|---|---|---|
| `include` | Warning | Tetap dijalankan |
| `require` | Fatal error | Tidak dijalankan |


### 6.2 Template Layout
`header.php` berisi awal dokumen HTML, judul, dan navigasi. `footer.php` berisi penutup halaman. Halaman `home.php`, `about.php`, `profil.php`, dan `kontak.php` hanya berisi konten khusus dan memanggil keduanya dengan `require_once __DIR__ . '/header.php'`.

**Analisis hasil**
- *Bagian yang dipakai bersama:* header (judul dan navigasi) serta footer.
- *Jika teks navigasi diubah di `header.php`:* semua halaman yang memanggilnya ikut berubah.
- *Mengapa konten tidak seluruhnya di `header.php`:* header hanya untuk bagian yang sama di semua halaman. Konten tiap halaman berbeda, sehingga tetap ditulis di file masing-masing.
- *Manfaat `require_once` dibanding menyalin kode:* tidak ada duplikasi, perubahan cukup di satu file, dan file tidak dimuat ganda.

### 6.3 Function
Function dikerjakan di `contoh-function.php` (tanpa parameter, dengan parameter, dengan `return`, type declaration, dan nilai default) lalu dipindahkan ke `helpers.php`.

| Function | Keterangan |
|---|---|
| `konversiCelciusKeFahrenheit($c)` | Konversi suhu |
| `tentukanStatusNilai($nilai)` | Predikat A sampai E |
| `hitungTotal($harga, $jumlah)` | Total belanja |
| `formatRupiah()` dan `e()` | Format uang dan escaping HTML |

Function dipanggil dari dua halaman: `latihan-function.php` dan `latihan-function-2.php`.

### 6.4 Struktur Direktori Modular
Aplikasi pada folder `project/` disusun mengikuti struktur bagian F modul.

### 6.5 Routing dengan Whitelist
`index.php` menjadi router. Parameter `page` dicocokkan dengan array `$routes`. Input URL tidak pernah digabung langsung menjadi path file.

Hasil pengujian:

| Pengujian | Hasil yang diharapkan |
|---|---|
| `index.php` | Dashboard tampil |
| `index.php?page=user/list` | Daftar pengguna tampil |
| `index.php?page=user/add` | Form tambah tampil |
| `index.php?page=admin/rahasia` | Halaman 404 |
| `index.php?page=` | Dashboard (nilai kosong ditangani aman) |
| `index.php?page[]=x` | Halaman 404 (tipe tidak sesuai) |

### 6.6 Integrasi CRUD
Koneksi database dipusatkan di `config/database.php` (PDO), function umum di `helpers/functions.php`, dan halaman CRUD di `modules/user/`. Semua halaman memakai template yang sama dan tautan antarhalaman memakai pola `index.php?page=...`.

| Operasi | Modul | Keterangan |
|---|---|---|
| Create | `user/add` | Validasi nama dan email, cek email ganda |
| Read | `user/list` | Tabel pengguna |
| Update | `user/edit` | Validasi dan cek email ganda |
| Delete | `user/delete` | Hanya metode POST dengan token CSRF |

### 6.7 Fitur Tambahan
- Menu aktif berdasarkan rute (`isActive()`).
- Pesan sukses/gagal setelah operasi CRUD (`setFlash()`, `tampilkanFlash()`).
- URL ringkas dengan `.htaccess` (opsional).
- Halaman `helper/demo` untuk Latihan 2: `formatRupiah()`, `hitungDiskon()`, `validasiEmail()`, `ringkasTeks()`.

## 7. Aspek Keamanan
- Whitelist rute, input `page` tidak dipakai langsung sebagai path (mencegah path traversal).
- Prepared statement PDO (mencegah SQL injection).
- Escaping output dengan `e()` (mencegah XSS).
- Operasi ubah data lewat POST dengan token CSRF.
- Detail error koneksi database hanya dicatat ke log.

## 8. Jawaban Pertanyaan Pemahaman
1. **Modularisasi** adalah teknik membagi aplikasi menjadi bagian kecil berdasarkan tanggung jawabnya. Manfaat: kode tidak berulang, perawatan lebih mudah, dan bagian yang sama dapat dipakai ulang. Kerja tim juga lebih mudah dibagi.
2. Jika file tidak ditemukan, `include` hanya memberi peringatan dan eksekusi berlanjut, sedangkan `require` menghasilkan error fatal dan menghentikan eksekusi.
3. Konfigurasi database wajib ada dan tidak boleh dimuat ganda, sehingga `require_once` sesuai: berhenti jika file hilang dan mencegah pemuatan berulang.
4. **Parameter** adalah variabel pada deklarasi function. **Argumen** adalah nilai yang dikirim saat function dipanggil. **Return** adalah nilai yang dikembalikan ke pemanggil dan dapat disimpan atau diproses lagi.
5. Header dan footer sama di semua halaman, sehingga cukup ditulis sekali agar mudah dirawat, sedangkan konten tiap halaman berbeda.
6. `index.php` adalah titik masuk dan router yang membaca parameter `page`, memeriksa whitelist, lalu memuat file yang sesuai bersama template.
7. Whitelist hanya mengizinkan halaman yang ditentukan aplikasi, sehingga file lain tidak bisa dipanggil lewat URL.
8. Menggabungkan input langsung menjadi path `require` membuka peluang path traversal dan pemanggilan file yang tidak dimaksudkan.
9. `RewriteCond` menentukan syarat aturan berlaku (di sini: bukan file dan bukan direktori fisik). `RewriteRule` mengubah URL, yaitu mengarahkan permintaan ke `index.php?page=...`.
10. - `config`: koneksi database.
    - `views`: header, footer, dashboard, 404.
    - `helpers`: function umum (validasi, format tampilan).
    - `modules`: halaman CRUD pengguna (list, add, edit, delete).

## 9. Kendala dan Solusi
| Kendala | Penyebab | Solusi |
|---|---|---|
| | | |

Contoh yang mungkin muncul: *Failed opening required* (path salah, solusi `__DIR__`), *Function already declared* (solusi `require_once`), CSS tidak tampil setelah rewrite (solusi `baseUrl()`).

## 10. Kesimpulan
Modularisasi membuat aplikasi lebih rapi, mudah dirawat, dan mudah dikembangkan. Template bersama menghilangkan duplikasi tampilan, function dan helper memusatkan logika umum, dan router dengan whitelist menjaga navigasi tetap terkendali dan aman. Aplikasi CRUD dari praktikum sebelumnya berhasil dipindahkan ke struktur modular tanpa kehilangan fungsinya.

## 11. Pengumpulan
```bash
git init
git add .
git commit -m "Praktikum 9: PHP Modular"
git branch -M main
git remote add origin https://github.com/<username>/Lab9Web.git
git push -u origin main
```
Kirim URL repository melalui e-learning sesuai instruksi dosen.
