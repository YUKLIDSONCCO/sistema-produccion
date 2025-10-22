<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sistema Producción</title>
    <link rel="stylesheet" href="public/css/styles.css"> <!-- Tu CSS personalizado -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css  " rel="stylesheet">
</head>
<body>
    <header class="navbar navbar-dark bg-dark px-3">
        <a class="navbar-brand" href="index.php?controller=Panel&action=dashboard">Sistema Producción</a>
        <div class="d-flex">
            <?php if (isset($_SESSION['usuario'])): ?>
                <span class="text-light me-3">Hola, <?= $_SESSION['usuario']['nombre'] ?></span>
            <?php endif; ?>
        </div>
    </header>
    <div class="container-fluid">
        <div class="row">