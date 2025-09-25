<?php 
if (session_status() === PHP_SESSION_NONE) session_start(); 

// Seguridad: si no hay usuario logueado, redirigir al login
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'Colaborador') {
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
            👋 Bienvenido Colaborador: 
            <span class="text-primary"><?= htmlspecialchars($_SESSION['usuario']['nombre']); ?></span>
        </h1>
        <a href="index.php?controller=Auth&action=logout" class="btn btn-danger btn-sm">
            Cerrar sesión
        </a>
    </div>

    <!-- Alertas y notificaciones -->
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <strong>📢 Información:</strong> Tienes <span class="badge bg-primary">3</span> tareas pendientes y <span class="badge bg-success">2</span> formularios por completar.
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>

    <!-- Tarjetas de acceso rápido -->
    <div class="row g-4">
        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card shadow-sm h-100 border-0">
                <div class="card-body">
                    <h5 class="card-title">📝 Formulario de Producción</h5>
                    <p class="card-text">Registra los datos diarios de producción y actividades realizadas.</p>
                    <a href="index.php?controller=Produccion&action=formulario" class="btn btn-primary btn-sm w-100">
                        Completar formulario
                    </a>
                </div>
            </div>
        </div>
        
        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card shadow-sm h-100 border-0">
                <div class="card-body">
                    <h5 class="card-title">⚠️ Reporte de Incidencias</h5>
                    <p class="card-text">Reporta cualquier anomalía o problema detectado en el proceso.</p>
                    <a href="index.php?controller=Incidencias&action=reportar" class="btn btn-warning btn-sm w-100">
                        Reportar incidencia
                    </a>
                </div>
            </div>
        </div>
        
        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card shadow-sm h-100 border-0">
                <div class="card-body">
                    <h5 class="card-title">📦 Control de Insumos</h5>
                    <p class="card-text">Registra el uso de insumos y materiales en los procesos.</p>
                    <a href="index.php?controller=Insumos&action=registro" class="btn btn-info btn-sm w-100">
                        Registrar insumos
                    </a>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card shadow-sm h-100 border-0">
                <div class="card-body">
                    <h5 class="card-title">✅ Tareas Asignadas</h5>
                    <p class="card-text">Revisa y completa las tareas asignadas por tu supervisor.</p>
                    <a href="index.php?controller=Tareas&action=index" class="btn btn-success btn-sm w-100">
                        Ver tareas (3)
                    </a>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card shadow-sm h-100 border-0">
                <div class="card-body">
                    <h5 class="card-title">📋 Mis Registros</h5>
                    <p class="card-text">Consulta los formularios y registros que has enviado.</p>
                    <a href="index.php?controller=Colaborador&action=misRegistros" class="btn btn-secondary btn-sm w-100">
                        Ver mis registros
                    </a>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card shadow-sm h-100 border-0">
                <div class="card-body">
                    <h5 class="card-title">🔔 Notificaciones</h5>
                    <p class="card-text">Revisa las notificaciones y mensajes del sistema.</p>
                    <a href="index.php?controller=Notificaciones&action=index" class="btn btn-light btn-sm w-100">
                        Notificaciones (5)
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Sección de actividades recientes -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-light">
                    <h5 class="card-title mb-0">📊 Mis Actividades Recientes</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Actividad</th>
                                    <th>Estado</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>2024-01-15</td>
                                    <td>Formulario de producción matutino</td>
                                    <td><span class="badge bg-success">Completado</span></td>
                                    <td><a href="#" class="btn btn-sm btn-outline-primary">Ver</a></td>
                                </tr>
                                <tr>
                                    <td>2024-01-15</td>
                                    <td>Registro de insumos utilizados</td>
                                    <td><span class="badge bg-warning">Pendiente</span></td>
                                    <td><a href="#" class="btn btn-sm btn-outline-primary">Completar</a></td>
                                </tr>
                                <tr>
                                    <td>2024-01-14</td>
                                    <td>Reporte de incidencia - Tanque 5</td>
                                    <td><span class="badge bg-info">En revisión</span></td>
                                    <td><a href="#" class="btn btn-sm btn-outline-primary">Ver</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../templates/footer.php'; ?>
