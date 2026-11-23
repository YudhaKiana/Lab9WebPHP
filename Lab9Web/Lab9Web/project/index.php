<?php
// index.php - titik masuk aplikasi (router)
session_start();
ob_start(); // agar redirect pada modul tetap bisa dilakukan setelah header dimuat

require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/helpers/functions.php';

// Whitelist rute: hanya halaman di daftar ini yang boleh dimuat
$routes = [
    'dashboard'   => __DIR__ . '/views/dashboard.php',
    'about'       => __DIR__ . '/views/about.php',
    'helper/demo' => __DIR__ . '/views/helper_demo.php',
    'user/list'   => __DIR__ . '/modules/user/list.php',
    'user/add'    => __DIR__ . '/modules/user/add.php',
    'user/edit'   => __DIR__ . '/modules/user/edit.php',
    'user/delete' => __DIR__ . '/modules/user/delete.php',
];

$page = $_GET['page'] ?? 'dashboard';
if (is_string($page)) {
    $page = trim($page, '/');
    if ($page === '') {
        $page = 'dashboard';
    }
}

if (!is_string($page) || !array_key_exists($page, $routes)) {
    http_response_code(404);
    $currentPage = '404';
    $contentFile = __DIR__ . '/views/404.php';
} else {
    $currentPage = $page;
    $contentFile = $routes[$page];
}

require_once __DIR__ . '/views/header.php';
require $contentFile;
require_once __DIR__ . '/views/footer.php';
ob_end_flush();
