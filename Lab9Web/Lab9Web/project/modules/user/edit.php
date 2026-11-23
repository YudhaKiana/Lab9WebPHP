<?php
$id = filter_var($_GET['id'] ?? null, FILTER_VALIDATE_INT);
if ($id === false || $id === null || $id < 1) {
    setFlash('gagal', 'ID pengguna tidak valid.');
    redirect('user/list');
}

$stmt = $pdo->prepare('SELECT id, nama, email FROM users WHERE id = ?');
$stmt->execute([$id]);
$user = $stmt->fetch();
if (!$user) {
    setFlash('gagal', 'Pengguna tidak ditemukan.');
    redirect('user/list');
}

$errors = [];
$nama  = $user['nama'];
$email = $user['email'];

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
        $cek = $pdo->prepare('SELECT COUNT(*) FROM users WHERE email = ? AND id <> ?');
        $cek->execute([$email, $id]);
        if ((int) $cek->fetchColumn() > 0) {
            $errors[] = 'Email sudah dipakai pengguna lain.';
        }
    }

    if (!$errors) {
        $upd = $pdo->prepare('UPDATE users SET nama = ?, email = ? WHERE id = ?');
        $upd->execute([$nama, $email, $id]);
        setFlash('sukses', 'Data pengguna berhasil diperbarui.');
        redirect('user/list');
    }
}
?>
<section>
    <h2>Edit Pengguna</h2>

    <?php foreach ($errors as $err): ?>
        <div class="alert alert-gagal"><?= e($err) ?></div>
    <?php endforeach; ?>

    <form method="post" action="<?= e(url('user/edit', ['id' => $id])) ?>">
        <?= csrfField() ?>
        <label for="nama">Nama</label>
        <input type="text" id="nama" name="nama" value="<?= e($nama) ?>" required maxlength="100">

        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="<?= e($email) ?>" required>

        <button type="submit" class="btn">Perbarui</button>
        <a href="<?= e(url('user/list')) ?>">Batal</a>
    </form>
</section>
