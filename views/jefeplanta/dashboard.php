<?php 
if (session_status() === PHP_SESSION_NONE) session_start(); 

// Seguridad: si no hay usuario logueado, redirigir al login
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'JefePlanta') {
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
            👋 Bienvenido Jefe de Planta: 
            <span class="text-primary"><?= htmlspecialchars($_SESSION['usuario']['nombre']); ?></span>
        </h1>
        <a href="index.php?controller=Auth&action=logout" class="btn btn-danger btn-sm">
            Cerrar sesión
        </a>
    </div>

    <!-- KPIs principales -->
    <div class="row g-4 mb-4">
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card bg-primary text-white shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title">Producción Diaria</h6>
                            <h3 class="mb-0">1,250 kg</h3>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-fish fa-2x opacity-50"></i>
                        </div>
                    </div>
                    <small>📈 +5.2% vs ayer</small>
                </div>
            </div>
        </div>
        
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card bg-success text-white shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title">Eficiencia</h6>
                            <h3 class="mb-0">94.5%</h3>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-chart-line fa-2x opacity-50"></i>
                        </div>
                    </div>
                    <small>✅ Meta: 95%</small>
                </div>
            </div>
        </div>
        
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card bg-warning text-dark shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title">Incidencias</h6>
                            <h3 class="mb-0">3</h3>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-exclamation-triangle fa-2x opacity-50"></i>
                        </div>
                    </div>
                    <small>⚠️ Por revisar</small>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card bg-info text-white shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title">Personal Activo</h6>
                            <h3 class="mb-0">24/28</h3>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-users fa-2x opacity-50"></i>
                        </div>
                    </div>
                    <small>👥 85.7% disponibilidad</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Tarjetas de acceso rápido -->
    <div class="row g-4">
        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card shadow-sm h-100 border-0">
                <div class="card-body">
                    <h5 class="card-title">📊 Dashboard de Producción</h5>
                    <p class="card-text">Indicadores clave y métricas de rendimiento en tiempo real.</p>
                    <a href="index.php?controller=Produccion&action=dashboard" class="btn btn-primary btn-sm w-100">
                        Ver dashboard
                    </a>
                </div>
            </div>
        </div>
        
        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card shadow-sm h-100 border-0">
                <div class="card-body">
                    <h5 class="card-title">📋 Reportes y Trazabilidad</h5>
                    <p class="card-text">Genera reportes detallados y sigue la trazabilidad de procesos.</p>
                    <a href="index.php?controller=Reportes&action=index" class="btn btn-success btn-sm w-100">
                        Generar reportes
                    </a>
                </div>
            </div>
        </div>
        
        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card shadow-sm h-100 border-0">
                <div class="card-body">
                    <h5 class="card-title">👥 Gestión de Personal</h5>
                    <p class="card-text">Asigna tareas y supervisa el desempeño del equipo.</p>
                    <a href="index.php?controller=Personal&action=index" class="btn btn-info btn-sm w-100">
                        Gestionar equipo
                    </a>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card shadow-sm h-100 border-0">
                <div class="card-body">
                    <h5 class="card-title">⚙️ Supervisión de Procesos</h5>
                    <p class="card-text">Monitorea y controla los procesos productivos en tiempo real.</p>
                    <a href="index.php?controller=Procesos&action=supervision" class="btn btn-warning btn-sm w-100">
                        Supervisar procesos
                    </a>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card shadow-sm h-100 border-0">
                <div class="card-body">
                    <h5 class="card-title">🔔 Alertas y Notificaciones</h5>
                    <p class="card-text">Revisa alertas críticas y notificaciones del sistema.</p>
                    <a href="index.php?controller=Alertas&action=index" class="btn btn-danger btn-sm w-100">
                        Ver alertas (5)
                    </a>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card shadow-sm h-100 border-0">
                <div class="card-body">
                    <h5 class="card-title">📈 Planificación</h5>
                    <p class="card-text">Planifica producción y establece metas para el equipo.</p>
                    <a href="index.php?controller=Planificacion&action=index" class="btn btn-secondary btn-sm w-100">
                        Planificar producción
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Sección de alertas críticas -->
    <div class="row mt-5">
        <div class="col-12 col-lg-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-warning text-dark">
                    <h5 class="card-title mb-0">🚨 Alertas Críticas</h5>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <small class="text-muted">Hace 2 horas</small>
                                <p class="mb-1">Bajo nivel de oxígeno en Tanque 7</p>
                            </div>
                            <span class="badge bg-danger">Crítico</span>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <small class="text-muted">Hace 4 horas</small>
                                <p class="mb-1">Temperatura fuera de rango - Sala 3</p>
                            </div>
                            <span class="badge bg-warning">Alto</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-info text-white">
                    <h5 class="card-title mb-0">📋 Actividades Recientes del Equipo</h5>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item">
                            <small class="text-muted">Hace 30 min</small>
                            <p class="mb-1">Juan Pérez completó formulario de producción</p>
                        </div>
                        <div class="list-group-item">
                            <small class="text-muted">Hace 1 hora</small>
                            <p class="mb-1">María García reportó incidencia en Tanque 5</p>
                        </div>
                        <div class="list-group-item">
                            <small class="text-muted">Hace 2 horas</small>
                            <p class="mb-1">Carlos López inició proceso de alimentación</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../templates/footer.php'; ?>
