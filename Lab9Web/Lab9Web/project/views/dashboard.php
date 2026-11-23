<?php
$total = (int) $pdo->query('SELECT COUNT(*) FROM users')->fetchColumn();
$terbaru = $pdo->query('SELECT nama, email FROM users ORDER BY id DESC LIMIT 3')->fetchAll();
?>
<section>
    <h2>Dashboard</h2>
    <p>Total pengguna terdaftar: <strong><?= $total ?></strong></p>

    <h3>Pengguna terbaru</h3>
    <?php if ($terbaru): ?>
        <ul>
            <?php foreach ($terbaru as $u): ?>
                <li><?= e($u['nama']) ?> (<?= e($u['email']) ?>)</li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Belum ada data.</p>
    <?php endif; ?>

    <p><a class="btn" href="<?= e(url('user/list')) ?>">Kelola Pengguna</a></p>
</section>
