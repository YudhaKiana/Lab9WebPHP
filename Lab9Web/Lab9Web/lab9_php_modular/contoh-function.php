<?php
// Function tanpa parameter
function tampilkanSalam() {
    echo "Selamat belajar PHP modular!<br>";
}

// Function dengan parameter
function sapaPengguna($nama) {
    echo "Halo, " . htmlspecialchars($nama, ENT_QUOTES, 'UTF-8') . "<br>";
}

// Function dengan return
function hitungLuasPersegiPanjang($panjang, $lebar) {
    return $panjang * $lebar;
}

// Type declaration dan nilai default
function hitungDiskon(float $harga, float $persen = 10): float {
    return $harga * ($persen / 100);
}

tampilkanSalam();
sapaPengguna("Rina");
$luas = hitungLuasPersegiPanjang(8, 5);
echo "Luas: " . $luas . "<br>";
echo "Diskon 10%: " . hitungDiskon(200000) . "<br>";
echo "Diskon 15%: " . hitungDiskon(200000, 15) . "<br>";
