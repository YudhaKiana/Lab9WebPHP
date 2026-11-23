<?php
// Penghapusan hanya lewat POST + token CSRF, bukan dengan membuka URL GET.
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    setFlash('gagal', 'Penghapusan hanya boleh melalui tombol Hapus (metode POST).');
    redirect('user/list');
}

if (!csrfValid()) {
    setFlash('gagal', 'Token keamanan tidak valid.');
    redirect('user/list');
}

$id = filter_var($_POST['id'] ?? null, FILTER_VALIDATE_INT);
if ($id === false || $id === null || $id < 1) {
    setFlash('gagal', 'ID pengguna tidak valid.');
    redirect('user/list');
}

$stmt = $pdo->prepare('DELETE FROM users WHERE id = ?');
$stmt->execute([$id]);

if ($stmt->rowCount() > 0) {
    setFlash('sukses', 'Pengguna berhasil dihapus.');
} else {
    setFlash('gagal', 'Pengguna tidak ditemukan.');
}
redirect('user/list');
