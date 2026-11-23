<?php
// Uji require: jika pesan.php tidak ada, baris "Sesudah pemanggilan" TIDAK tampil.
echo "Sebelum pemanggilan<br>";
require __DIR__ . '/pesan.php';
echo "Sesudah pemanggilan<br>";
