<?php 
if (session_status() === PHP_SESSION_NONE) session_start(); 

// Seguridad: si no hay usuario logueado, redirigir al login
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'Administrador') {
    header("Location: index.php?controller=Auth&action=login");
    exit;
}
?>

<?php include __DIR__ . '/../templates/header.php'; ?>
<?php include __DIR__ . '/../templates/sidebar.php'; ?>

<div class="container-fluid mt-4">
    <!-- Encabezado con nombre y botón de logout -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4">
        <h1 class="h3 mb-3 mb-md-0">
            👋 Bienvenido Administrador: 
            <span class="text-primary"><?= htmlspecialchars($_SESSION['usuario']['nombre']); ?></span>
        </h1>
        <a href="index.php?controller=Auth&action=logout" class="btn btn-danger btn-sm">
            Cerrar sesión
        </a>
    </div>

    <!-- Tarjetas de acceso rápido -->
    <div class="row g-4">
        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card shadow-sm h-100 border-0">
                <div class="card-body">
                    <h5 class="card-title">👥 Gestión de Usuarios</h5>
                    <p class="card-text">Crear, editar y asignar roles a los usuarios del sistema.</p>
                    <a href="index.php?controller=Usuarios&action=index" class="btn btn-primary btn-sm w-100">
                        Ir al módulo
                    </a>
                </div>
            </div>
        </div>
        
        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card shadow-sm h-100 border-0">
                <div class="card-body">
                    <h5 class="card-title">⚙️ Configuración</h5>
                    <p class="card-text">Parámetros globales, backups y seguridad del sistema.</p>
                    <a href="index.php?controller=Config&action=index" class="btn btn-primary btn-sm w-100">
                        Ir al módulo
                    </a>
                </div>
            </div>
        </div>
        
        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card shadow-sm h-100 border-0">
                <div class="card-body">
                    <h5 class="card-title">📊 Auditoría</h5>
                    <p class="card-text">Monitorea actividades de usuarios y genera reportes de seguridad.</p>
                    <a href="index.php?controller=Auditoria&action=index" class="btn btn-primary btn-sm w-100">
                        Ir al módulo
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../templates/footer.php'; ?>
