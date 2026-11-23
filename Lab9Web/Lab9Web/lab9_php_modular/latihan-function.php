<?php
require_once __DIR__ . '/helpers.php';
require_once __DIR__ . '/header.php';
?>
<section class="content">
    <h2>Latihan Function (Halaman 1)</h2>
    <table>
        <tr><th>Function</th><th>Contoh Pemanggilan</th><th>Hasil</th></tr>
        <tr>
            <td>konversiCelciusKeFahrenheit()</td>
            <td>37 &deg;C</td>
            <td><?= e((string) konversiCelciusKeFahrenheit(37)) ?> &deg;F</td>
        </tr>
        <tr>
            <td>tentukanStatusNilai()</td>
            <td>78</td>
            <td><?= e(tentukanStatusNilai(78)) ?></td>
        </tr>
        <tr>
            <td>hitungTotal()</td>
            <td>25000 x 3</td>
            <td><?= e(formatRupiah(hitungTotal(25000, 3))) ?></td>
        </tr>
    </table>
    <p><a href="latihan-function-2.php">Lihat halaman kedua yang juga memakai helpers.php</a></p>
</section>
<?php require_once __DIR__ . '/footer.php'; ?>
