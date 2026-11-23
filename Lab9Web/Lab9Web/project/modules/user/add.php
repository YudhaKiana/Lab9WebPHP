<?php
$errors = [];
$nama = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama  = trim((string) ($_POST['nama'] ?? ''));
    $email = trim((string) ($_POST['email'] ?? ''));

    if (!csrfValid()) {
        $errors[] = 'Token keamanan tidak valid. Muat ulang halaman.';
    }
    if ($nama === '') {
        $errors[] = 'Nama wajib diisi.';
    } elseif (mb_strlen($nama) > 100) {
        $errors[] = 'Nama maksimal 100 karakter.';
    }
    if (!validasiEmail($email)) {
        $errors[] = 'Format email tidak valid.';
    }

    if (!$errors) {
        $cek = $pdo->prepare('SELECT COUNT(*) FROM users WHERE email = ?');
        $cek->execute([$email]);
        if ((int) $cek->fetchColumn() > 0) {
            $errors[] = 'Email sudah terdaftar.';
        }
    }

    if (!$errors) {
        $stmt = $pdo->prepare('INSERT INTO users (nama, email) VALUES (?, ?)');
        $stmt->execute([$nama, $email]);
        setFlash('sukses', 'Pengguna berhasil ditambahkan.');
        redirect('user/list');
    }
}
?>
<section>
    <h2>Tambah Pengguna</h2>

    <?php foreach ($errors as $err): ?>
        <div class="alert alert-gagal"><?= e($err) ?></div>
    <?php endforeach; ?>

    <form method="post" action="<?= e(url('user/add')) ?>">
        <?= csrfField() ?>
        <label for="nama">Nama</label>
        <input type="text" id="nama" name="nama" value="<?= e($nama) ?>" required maxlength="100">

        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="<?= e($email) ?>" required>

        <button type="submit" class="btn">Simpan</button>
        <a href="<?= e(url('user/list')) ?>">Batal</a>
    </form>
</section>
