<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>

    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="/sistema-produccion/public/css/style_admin.css">

    <!-- Íconos reemplazados con CSS puro -->
    <style>
    </style>
</head>
<body>
    <?php 
    if (session_status() === PHP_SESSION_NONE) session_start(); 
    if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'Administrador') {
        header("Location: index.php?controller=Auth&action=login");
        exit;
    }
    ?>

    <nav>
        <div class="logo-name">
            <div class="logo-image">
                <img src="/sistema-produccion/public/img/coraqua.png" alt="Logo del Sistema">
            </div>
            <span class="logo_name">Sistema Producción</span>
        </div>

        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="#"><i class="icon uil-estate"></i><span class="link-name">Dashboard</span></a></li>
                <li><a href="index.php?controller=Admin&action=index"><i class="icon uil-users-alt"></i><span class="link-name">Usuarios</span></a></li>
                <li><a href="index.php?controller=Config&action=index"><i class="icon uil-setting"></i><span class="link-name">Configuración</span></a></li>
                <li><a href="index.php?controller=Auditoria&action=index"><i class="icon uil-analytics"></i><span class="link-name">Auditoría</span></a></li>
            </ul>
            
            <ul class="logout-mode">
                <li><a href="index.php?controller=Auth&action=logout"><i class="icon uil-signout"></i><span class="link-name">Cerrar sesión</span></a></li>

                <li class="mode">
                    <a href="#"><i class="icon uil-moon"></i><span class="link-name">Modo Oscuro</span></a>
                    <div class="mode-toggle"><span class="switch"></span></div>
                </li>
            </ul>
        </div>
    </nav>

    <section class="dashboard">
        <div class="top">
            <i class="icon uil-bars sidebar-toggle"></i>

            <div class="search-box">
                <i class="icon uil-search"></i>
                <input type="text" placeholder="Buscar aquí...">
            </div>
            
            <div class="profile-info">
                <span class="user-name"><?= htmlspecialchars($_SESSION['usuario']['nombre']); ?></span>
                <img src="images/profile.jpg" alt="Perfil">
            </div>
        </div>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="icon uil-tachometer-fast-alt"></i>
                    <span class="text">Panel de Administración</span>
                </div>

                <div class="boxes">
                    <div class="box box1">
                        <i class="icon uil-users-alt"></i>
                        <span class="text">Gestión de Usuarios</span>
                        <span class="number">Administrar</span>
                        <a href="index.php?controller=Admin&action=index" class="box-link">Ir al módulo</a>

                    </div>
                    <div class="box box2">
                        <i class="icon uil-setting"></i>
                        <span class="text">Configuración</span>
                        <span class="number">Ajustes</span>
                        <a href="index.php?controller=Config&action=index" class="box-link">Ir al módulo</a>
                    </div>
                    <div class="box box3">
                        <i class="icon uil-analytics"></i>
                        <span class="text">Auditoría</span>
                        <span class="number">Reportes</span>
                        <a href="index.php?controller=Auditoria&action=index" class="box-link">Ir al módulo</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Script personalizado -->
    <script src="/sistema-produccion/public/js/script_admin.js"></script>
</body>
</html>
