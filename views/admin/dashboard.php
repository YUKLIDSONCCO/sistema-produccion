<?php 
// Asegúrate de que estas variables estén disponibles
$estadisticas = $estadisticas ?? ['total_usuarios' => 0, 'activos' => 0, 'suspendidos' => 0, 'pendientes' => 0];
$distribucionRoles = $distribucionRoles ?? [];
$actividadReciente = $actividadReciente ?? [];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración - Sistema Producción</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #34495e;
            --accent-color: #3498db;
            --success-color: #27ae60;
            --warning-color: #f39c12;
            --danger-color: #e74c3c;
            --light-color: #ecf0f1;
            --dark-color: #2c3e50;
        }
        
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .sidebar {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            height: 100vh;
            position: fixed;
            width: 250px;
            transition: all 0.3s;
            z-index: 1000;
        }
        
        .sidebar .logo {
            padding: 20px 15px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        
        .sidebar .logo img {
            height: 40px;
        }
        
        .sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 12px 20px;
            margin: 5px 0;
            border-radius: 5px;
            transition: all 0.3s;
        }
        
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background-color: rgba(255,255,255,0.1);
            color: white;
        }
        
        .sidebar .nav-link i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }
        
        .main-content {
            margin-left: 250px;
            padding: 20px;
            transition: all 0.3s;
        }
        
        .navbar-custom {
            background-color: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .stat-card {
            border-radius: 10px;
            border: none;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: transform 0.3s;
            margin-bottom: 20px;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
        }
        
        .stat-card .card-body {
            padding: 25px;
        }
        
        .stat-icon {
            font-size: 2.5rem;
            opacity: 0.7;
        }
        
        .card-users {
            border-left: 4px solid var(--accent-color);
        }
        
        .card-active {
            border-left: 4px solid var(--success-color);
        }
        
        .card-pending {
            border-left: 4px solid var(--warning-color);
        }
        
        .card-suspended {
            border-left: 4px solid var(--danger-color);
        }
        
        .chart-container {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        
        .recent-activity {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        
        .activity-item {
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }
        
        .activity-item:last-child {
            border-bottom: none;
        }
        
        .activity-time {
            font-size: 0.8rem;
            color: #6c757d;
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }
        
        @media (max-width: 768px) {
            .sidebar {
                width: 70px;
                text-align: center;
            }
            
            .sidebar .logo span, .sidebar .nav-link span {
                display: none;
            }
            
            .sidebar .nav-link i {
                margin-right: 0;
                font-size: 1.2rem;
            }
            
            .main-content {
                margin-left: 70px;
            }
        }
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

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo d-flex align-items-center">
            <img src="/sistema-produccion/public/img/coraqua.png" alt="Logo Coraqua">
            <span class="ms-2 fw-bold">Sistema Producción</span>
        </div>
        
        <nav class="nav flex-column mt-3">
            <a class="nav-link active" href="index.php?controller=Admin&action=dashboard">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
            <a class="nav-link" href="index.php?controller=Admin&action=index">
                <i class="fas fa-users"></i>
                <span>Gestión de Usuarios</span>
            </a>
            <a class="nav-link" href="index.php?controller=Admin&action=mostrarRegistro">
                <i class="fas fa-user-plus"></i>
                <span>Registrar Usuario</span>
            </a>
            <a class="nav-link" href="index.php?controller=Config&action=index">
                <i class="fas fa-cog"></i>
                <span>Configuración</span>
            </a>
            <a class="nav-link" href="index.php?controller=Auditoria&action=index">
                <i class="fas fa-chart-bar"></i>
                <span>Auditoría</span>
            </a>
            <a class="nav-link" href="index.php?controller=Auth&action=logout">
                <i class="fas fa-sign-out-alt"></i>
                <span>Cerrar Sesión</span>
            </a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Bar -->
        <nav class="navbar navbar-expand-lg navbar-custom rounded mb-4">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse">
                    <i class="fas fa-bars"></i>
                </button>
                
                <div class="d-flex align-items-center ms-auto">
                    <div class="dropdown">
                        <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">
                            <img src="<?= $_SESSION['usuario']['foto'] ?? '/sistema-produccion/public/img/default-avatar.png' ?>" 
                                 alt="Perfil" class="user-avatar me-2">
                            <span class="d-none d-md-inline"><?= htmlspecialchars($_SESSION['usuario']['nombre']); ?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Mi Perfil</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Configuración</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="index.php?controller=Auth&action=logout"><i class="fas fa-sign-out-alt me-2"></i>Cerrar Sesión</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Title -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Panel de Administración</h1>
            <div class="btn-group">
                <button class="btn btn-outline-primary btn-sm" id="refreshBtn">
                    <i class="fas fa-sync-alt"></i> Actualizar
                </button>
                <button class="btn btn-outline-secondary btn-sm" id="printBtn">
                    <i class="fas fa-print"></i> Imprimir Reporte
                </button>
            </div>
        </div>

        <!-- Alert Messages -->
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= $_SESSION['success']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= $_SESSION['error']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
        <!-- Statistics Cards -->
<div class="row">
    <div class="col-xl-3 col-md-6">
        <div class="card stat-card card-users">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h5 class="card-title text-muted mb-0">Total Usuarios</h5>
                        <h2 class="mt-2 mb-0" id="totalUsers"><?= $estadisticas['total_usuarios'] ?? 0 ?></h2>
                    </div>
                    <div class="col-4 text-end">
                        <i class="fas fa-users stat-icon text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6">
        <div class="card stat-card card-active">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h5 class="card-title text-muted mb-0">Usuarios Activos</h5>
                        <h2 class="mt-2 mb-0" id="activeUsers"><?= $estadisticas['activos'] ?? 0 ?></h2>
                    </div>
                    <div class="col-4 text-end">
                        <i class="fas fa-user-check stat-icon text-success"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6">
        <div class="card stat-card card-suspended">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h5 class="card-title text-muted mb-0">Suspendidos</h5>
                        <h2 class="mt-2 mb-0" id="suspendedUsers"><?= $estadisticas['suspendidos'] ?? 0 ?></h2>
                    </div>
                    <div class="col-4 text-end">
                        <i class="fas fa-user-slash stat-icon text-danger"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        <!-- Charts and Activity -->
<div class="row mt-4">
    <div class="col-lg-8">
        <div class="chart-container">
            <h5 class="mb-3">Distribución de Usuarios por Rol</h5>
            <canvas id="usersChart" height="250"></canvas>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="recent-activity">
            <h5 class="mb-3">Actividad Reciente</h5>
            <div id="recentActivity">
                <?php if (!empty($actividadReciente)): ?>
                    <?php foreach ($actividadReciente as $actividad): ?>
                        <div class="activity-item">
                            <div class="d-flex justify-content-between">
                                <span class="fw-bold"><?= htmlspecialchars($actividad['accion']) ?></span>
                                <small class="activity-time">
                                    <?= $this->calcularTiempoTranscurrido($actividad['fecha']) ?>
                                </small>
                            </div>
                            <small class="text-muted">
                                <?= htmlspecialchars($actividad['usuario']) ?> 
                                <?= $actividad['accion'] === 'Nuevo usuario registrado' ? 'se registró en el sistema' : '' ?>
                            </small>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="text-muted text-center py-3">No hay actividad reciente</div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

        <!-- Quick Actions -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="chart-container">
                    <h5 class="mb-3">Acciones Rápidas</h5>
                    <div class="row text-center">
                        <div class="col-md-3 mb-3">
                            <a href="index.php?controller=Admin&action=index" class="btn btn-success btn-lg w-100 py-3">
                                <i class="fas fa-users fa-2x mb-2"></i><br>
                                Gestionar Usuarios
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="index.php?controller=Config&action=index" class="btn btn-info btn-lg w-100 py-3">
                                <i class="fas fa-cog fa-2x mb-2"></i><br>
                                Configuración
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="index.php?controller=Auditoria&action=index" class="btn btn-warning btn-lg w-100 py-3">
                                <i class="fas fa-chart-bar fa-2x mb-2"></i><br>
                Ver Auditoría
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Datos reales desde PHP
        const distribucionRoles = <?= json_encode($distribucionRoles) ?>;
        
        // Preparar datos para el gráfico
        const labels = distribucionRoles.map(item => item.rol);
        const data = distribucionRoles.map(item => parseInt(item.cantidad));
        const colores = ['#3498db', '#2ecc71', '#f39c12', '#e74c3c', '#9b59b6', '#1abc9c'];
        
        // Initialize chart with real data
        const ctx = document.getElementById('usersChart').getContext('2d');
        const usersChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    data: data,
                    backgroundColor: colores,
                    borderWidth: 2,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.raw || 0;
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = Math.round((value / total) * 100);
                                return `${label}: ${value} (${percentage}%)`;
                            }
                        }
                    }
                }
            }
        });

        // Refresh button functionality - ahora recarga la página
        document.getElementById('refreshBtn').addEventListener('click', function() {
            this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Actualizando...';
            setTimeout(() => {
                location.reload();
            }, 1000);
        });

        // Print button functionality
        document.getElementById('printBtn').addEventListener('click', function() {
            window.print();
        });

        // Responsive sidebar toggle for mobile
        const sidebarToggle = document.querySelector('.navbar-toggler');
        const sidebar = document.querySelector('.sidebar');
        const mainContent = document.querySelector('.main-content');

        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('collapsed');
                mainContent.classList.toggle('expanded');
            });
        }
    });
</script>
</body>
</html>