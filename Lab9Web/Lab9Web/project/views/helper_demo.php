<section>
    <h2>Demo Function Helper (Latihan 2)</h2>
    <?php
    $email1 = 'rina@example.com';
    $email2 = 'email-salah';
    $teks   = 'Modularisasi adalah teknik membagi aplikasi menjadi bagian-bagian yang lebih kecil berdasarkan tanggung jawabnya.';
    ?>
    <table>
        <tr><th>Function</th><th>Input</th><th>Hasil</th></tr>
        <tr><td>formatRupiah()</td><td>150000</td><td><?= e(formatRupiah(150000)) ?></td></tr>
        <tr><td>hitungDiskon()</td><td>200000, 15%</td><td><?= e(formatRupiah(hitungDiskon(200000, 15))) ?></td></tr>
        <tr><td>validasiEmail()</td><td><?= e($email1) ?></td><td><?= validasiEmail($email1) ? 'Valid' : 'Tidak valid' ?></td></tr>
        <tr><td>validasiEmail()</td><td><?= e($email2) ?></td><td><?= validasiEmail($email2) ? 'Valid' : 'Tidak valid' ?></td></tr>
        <tr><td>ringkasTeks()</td><td>batas 40 karakter</td><td><?= e(ringkasTeks($teks, 40)) ?></td></tr>
    </table>
</section>
