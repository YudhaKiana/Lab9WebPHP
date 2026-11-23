<?php
require_once __DIR__ . '/helpers.php';
require_once __DIR__ . '/header.php';
?>
<section class="content">
    <h2>Latihan Function (Halaman 2)</h2>
    <p>Halaman ini memanggil <code>helpers.php</code> yang sama dengan halaman sebelumnya.</p>
    <ul>
        <li>0 &deg;C = <?= e((string) konversiCelciusKeFahrenheit(0)) ?> &deg;F</li>
        <li>Nilai 92 = <?= e(tentukanStatusNilai(92)) ?></li>
        <li>Total 10 x Rp 12.500 = <?= e(formatRupiah(hitungTotal(12500, 10))) ?></li>
    </ul>
</section>
<?php require_once __DIR__ . '/footer.php'; ?>
