# Lab9Web - Praktikum 9: PHP Modular

Aplikasi PHP modular yang mencakup template layout, function helper, struktur direktori terpisah,
router dengan whitelist, dan CRUD pengguna berbasis database MySQL (PDO).

## Kebutuhan
- PHP 8.0 atau lebih baru (memakai `str_starts_with`)
- MySQL/MariaDB (XAMPP atau Laragon)
- Apache (opsional `mod_rewrite` untuk URL ringkas)
- Browser dan editor kode

## Cara Menjalankan
1. Salin folder `Lab9Web` ke docroot (`htdocs` pada XAMPP).
2. Jalankan Apache dan MySQL.
3. Impor `project/database.sql` melalui phpMyAdmin.
4. Sesuaikan kredensial pada `project/config/database.php` bila perlu.
5. Buka:
   - Latihan template dan function: `http://localhost/Lab9Web/lab9_php_modular/home.php`
   - Aplikasi utama (router + CRUD): `http://localhost/Lab9Web/project/index.php`

## Struktur Direktori
```
Lab9Web/
├── lab9_php_modular/        # Latihan bagian C, D, E (include/require, template, function)
│   ├── header.php, footer.php
│   ├── home.php, about.php, profil.php, kontak.php
│   ├── helpers.php, contoh-function.php, contoh-panggil.php
│   ├── latihan-function.php, latihan-function-2.php
│   ├── pesan.php, uji-include.php, uji-require.php
│   └── style.css
└── project/                 # Aplikasi modular (bagian F - I)
    ├── index.php            # Router
    ├── .htaccess            # URL rewrite (opsional)
    ├── database.sql
    ├── config/database.php
    ├── views/               # header, footer, dashboard, about, helper_demo, 404
    ├── helpers/functions.php
    ├── modules/user/        # list, add, edit, delete
    └── assets/css, assets/js
```

## Daftar Rute
| Parameter `page` | File |
|---|---|
| `dashboard` (default) | views/dashboard.php |
| `about` | views/about.php |
| `helper/demo` | views/helper_demo.php |
| `user/list` | modules/user/list.php |
| `user/add` | modules/user/add.php |
| `user/edit` | modules/user/edit.php |
| `user/delete` | modules/user/delete.php |

Rute yang tidak terdaftar menampilkan `views/404.php` dengan status HTTP 404.

## Fitur Keamanan
- Router memakai whitelist, input `page` tidak pernah digabung menjadi path file.
- Query memakai prepared statement (PDO).
- Output di-escape dengan helper `e()`.
- Tambah, ubah, dan hapus diproses via POST dengan token CSRF.
- Detail error koneksi database dicatat ke log, tidak ditampilkan ke pengguna.

## Langkah Praktikum
1. Menguji `include` vs `require` (`uji-include.php`, `uji-require.php`).
2. Membuat template `header.php` dan `footer.php` serta halaman Home, About, Profil, Kontak.
3. Membuat function dan memindahkannya ke `helpers.php`.
4. Menata struktur direktori `project/`.
5. Membuat router whitelist dan halaman 404.
6. Mengintegrasikan CRUD pengguna dengan template, helper, dan router.
7. Menambahkan menu aktif dan flash message (tantangan mandiri).
8. Opsional: `.htaccess` untuk URL ringkas.

## Pengujian Routing
- `index.php` -> dashboard tampil
- `index.php?page=user/list` -> daftar pengguna
- `index.php?page=user/add` -> form tambah
- `index.php?page=admin/rahasia` -> 404
- `index.php?page=` atau `index.php?page[]=x` -> ditangani aman (dashboard / 404)

## Kendala dan Solusi
(Isi dengan kendala yang Anda temukan saat praktikum.)

## Catatan .htaccess
Aktifkan `mod_rewrite` dan set `AllowOverride All` pada konfigurasi Apache. Setelah rewrite aktif,
URL seperti `/Lab9Web/project/user/list` diteruskan ke `index.php?page=user/list`.
Tautan di aplikasi tetap memakai `index.php?page=...` agar berjalan tanpa rewrite.
