<?php 
if (session_status() === PHP_SESSION_NONE) session_start(); 

// Seguridad: si no hay usuario logueado, redirigir al login
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'Supervisor') {
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
            👋 Bienvenido Supervisor: 
            <span class="text-primary"><?= htmlspecialchars($_SESSION['usuario']['nombre']); ?></span>
        </h1>
        <a href="index.php?controller=Auth&action=logout" class="btn btn-danger btn-sm">
            Cerrar sesión
        </a>
    </div>

    <!-- Estadísticas rápidas -->
    <div class="row g-4 mb-4">
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card bg-primary text-white shadow-sm border-0">
                <div class="card-body text-center">
                    <h3 class="mb-1">12</h3>
                    <small>Formularios por validar</small>
                </div>
            </div>
        </div>
        
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card bg-success text-white shadow-sm border-0">
                <div class="card-body text-center">
                    <h3 class="mb-1">8</h3>
                    <small>Incidencias resueltas</small>
                </div>
            </div>
        </div>
        
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card bg-warning text-dark shadow-sm border-0">
                <div class="card-body text-center">
                    <h3 class="mb-1">5</h3>
                    <small>Alertas activas</small>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card bg-info text-white shadow-sm border-0">
                <div class="card-body text-center">
                    <h3 class="mb-1">15/18</h3>
                    <small>Tareas completadas</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Tarjetas de acceso rápido -->
    <div class="row g-4">
        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card shadow-sm h-100 border-0">
                <div class="card-body">
                    <h5 class="card-title">✅ Validación de Registros</h5>
                    <p class="card-text">Revisa y valida los formularios enviados por colaboradores.</p>
                    <a href="index.php?controller=Validacion&action=index" class="btn btn-primary btn-sm w-100">
                        Validar registros (12)
                    </a>
                </div>
            </div>
        </div>
        
        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card shadow-sm h-100 border-0">
                <div class="card-body">
                    <h5 class="card-title">📦 Control de Insumos</h5>
                    <p class="card-text">Gestiona inventario y controla el uso de insumos.</p>
                    <a href="index.php?controller=Insumos&action=control" class="btn btn-success btn-sm w-100">
                        Controlar insumos
                    </a>
                </div>
            </div>
        </div>
        
        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card shadow-sm h-100 border-0">
                <div class="card-body">
                    <h5 class="card-title">📊 Seguimiento Producción</h5>
                    <p class="card-text">Monitorea el progreso diario de la producción.</p>
                    <a href="index.php?controller=Seguimiento&action=index" class="btn btn-info btn-sm w-100">
                        Ver seguimiento
                    </a>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card shadow-sm h-100 border-0">
                <div class="card-body">
                    <h5 class="card-title">👥 Comunicación Jefe Planta</h5>
                    <p class="card-text">Coordinación directa con el jefe de planta.</p>
                    <a href="index.php?controller=Comunicacion&action=index" class="btn btn-warning btn-sm w-100">
                        Comunicarse
                    </a>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card shadow-sm h-100 border-0">
                <div class="card-body">
                    <h5 class="card-title">🐟 Gestión de Alimentos</h5>
                    <p class="card-text">Controla y programa la alimentación de los peces.</p>
                    <a href="index.php?controller=Alimentos&action=index" class="btn btn-secondary btn-sm w-100">
                        Gestionar alimentos
                    </a>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card shadow-sm h-100 border-0">
                <div class="card-body">
                    <h5 class="card-title">📋 Reportes Diarios</h5>
                    <p class="card-text">Genera reportes de supervisión para el jefe de planta.</p>
                    <a href="index.php?controller=Reportes&action=diarios" class="btn btn-light btn-sm w-100">
                        Crear reporte
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Sección de actividades pendientes -->
    <div class="row mt-5">
        <div class="col-12 col-lg-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">📝 Formularios Pendientes de Validación</h5>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1">Producción Matutina</h6>
                                <small class="text-muted">Enviado por: Juan Pérez • Hace 2 horas</small>
                            </div>
                            <a href="#" class="btn btn-sm btn-outline-primary">Validar</a>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1">Control de Calidad</h6>
                                <small class="text-muted">Enviado por: María García • Hace 1 hora</small>
                            </div>
                            <a href="#" class="btn btn-sm btn-outline-primary">Validar</a>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1">Registro de Insumos</h6>
                                <small class="text-muted">Enviado por: Carlos López • Hace 45 min</small>
                            </div>
                            <a href="#" class="btn btn-sm btn-outline-primary">Validar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-warning text-dark">
                    <h5 class="card-title mb-0">⚠️ Incidencias por Atender</h5>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h6 class="mb-1">Fuga de agua - Tanque 3</h6>
                                    <small class="text-muted">Reportado por: Ana Rodríguez • Prioridad: Alta</small>
                                </div>
                                <span class="badge bg-danger">Urgente</span>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h6 class="mb-1">Equipo medición defectuoso</h6>
                                    <small class="text-muted">Reportado por: Luis Martínez • Prioridad: Media</small>
                                </div>
                                <span class="badge bg-warning">Pendiente</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Alertas del sistema -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>🔔 Alerta:</strong> Stock de alimento crítico. Nivel actual: 15%. 
                <a href="index.php?controller=Alimentos&action=index" class="alert-link">Solicitar más alimento</a>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../templates/footer.php'; ?>
