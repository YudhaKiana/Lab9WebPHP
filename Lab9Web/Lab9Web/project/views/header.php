<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aplikasi PHP Modular</title>
    <link rel="stylesheet" href="<?= e(baseUrl('assets/css/style.css')) ?>">
</head>
<body>
<div class="container">
    <header>
        <h1>Aplikasi PHP Modular</h1>
        <p>CRUD pengguna dengan template, helper, dan router</p>
    </header>
    <nav>
        <a class="<?= isActive('dashboard', $currentPage) ?>" href="<?= e(url('dashboard')) ?>">Dashboard</a>
        <a class="<?= isActive('user', $currentPage) ?>" href="<?= e(url('user/list')) ?>">Pengguna</a>
        <a class="<?= isActive('helper', $currentPage) ?>" href="<?= e(url('helper/demo')) ?>">Demo Helper</a>
        <a class="<?= isActive('about', $currentPage) ?>" href="<?= e(url('about')) ?>">Tentang</a>
    </nav>
    <main>
        <?php tampilkanFlash(); ?>
