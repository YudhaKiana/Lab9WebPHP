<?php
// helpers/functions.php - function umum yang dipakai banyak modul

/** Escape output untuk HTML. */
function e(?string $nilai): string
{
    return htmlspecialchars((string) $nilai, ENT_QUOTES, 'UTF-8');
}

/** Format angka menjadi Rupiah. */
function formatRupiah(float $angka): string
{
    return 'Rp ' . number_format($angka, 0, ',', '.');
}

/** Hitung nilai diskon (bukan harga akhir). */
function hitungDiskon(float $harga, float $persen = 10): float
{
    return $harga * ($persen / 100);
}

/** Validasi format email. */
function validasiEmail(string $email): bool
{
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

/** Ringkas teks panjang dan tambahkan "..." bila terpotong. */
function ringkasTeks(string $teks, int $batas = 50): string
{
    if (mb_strlen($teks) <= $batas) {
        return $teks;
    }
    return rtrim(mb_substr($teks, 0, $batas)) . '...';
}

/** URL dasar aplikasi, dipakai agar path aset tetap benar. */
function baseUrl(string $path = ''): string
{
    $dir = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '')), '/');
    return $dir . '/' . ltrim($path, '/');
}

/** URL halaman berbasis router: index.php?page=... */
function url(string $page, array $params = []): string
{
    $query = http_build_query(array_merge(['page' => $page], $params));
    return baseUrl('index.php') . '?' . $query;
}

/** Redirect lalu hentikan eksekusi. */
function redirect(string $page, array $params = []): void
{
    header('Location: ' . url($page, $params));
    exit;
}

/** Menu aktif: kembalikan class "active" bila rute cocok. */
function isActive(string $route, string $current): string
{
    return ($route === $current || str_starts_with($current, $route . '/')) ? 'active' : '';
}

/* ---------- Flash message ---------- */
function setFlash(string $tipe, string $pesan): void
{
    $_SESSION['flash'] = ['tipe' => $tipe, 'pesan' => $pesan];
}

function tampilkanFlash(): void
{
    if (!empty($_SESSION['flash'])) {
        $f = $_SESSION['flash'];
        unset($_SESSION['flash']);
        $kelas = $f['tipe'] === 'sukses' ? 'alert-sukses' : 'alert-gagal';
        echo '<div class="alert ' . $kelas . '">' . e($f['pesan']) . '</div>';
    }
}

/* ---------- CSRF ---------- */
function csrfToken(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function csrfField(): string
{
    return '<input type="hidden" name="csrf_token" value="' . e(csrfToken()) . '">';
}

function csrfValid(): bool
{
    $kirim = $_POST['csrf_token'] ?? '';
    return is_string($kirim) && hash_equals(csrfToken(), $kirim);
}
