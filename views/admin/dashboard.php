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

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
      :root{
        --cora-orange: #ff7b00;
        --cora-dark: #0f2b2b;
        --muted: #6b6b6b;
        --card-bg: rgba(255,255,255,0.98);
        --soft-shadow: 0 8px 30px rgba(15,43,43,0.06);
        --glass: rgba(255,255,255,0.6);
        --green-soft: #dff6ea;
      }

      /* Reset & base */
      *{box-sizing:border-box}
      body{
        margin:0;
        font-family: Inter, Poppins, system-ui, -apple-system, "Segoe UI", Roboto, Arial;
        background: linear-gradient(180deg,#f7fbfc 0%, #f0f4f6 100%);
        color:var(--cora-dark);
        -webkit-font-smoothing:antialiased;
      }

      /* Layout */
      .sidebar{
        position:fixed;
        left:0;
        top:0;
        bottom:0;
        width:260px;
        background: linear-gradient(180deg,#ec8304ff 0%, #ec8304ff 100%);
        color:#fff;
        padding:20px;
        display:flex;
        flex-direction:column;
        gap:12px;
        transition: width .22s ease;
        z-index:1100;
      }
      .sidebar.collapsed{ width:76px; }
      .sidebar .logo{
        display:flex;
        align-items:center;
        gap:12px;
        padding-bottom:8px;
        border-bottom:1px solid rgba(250, 144, 14, 0.94);
      }
      .sidebar .logo i{font-size:22px;color:var(--cora-orange)}
      .sidebar .logo span{font-weight:700; letter-spacing:.3px}

      .sidebar-nav{margin-top:12px; flex:1; overflow:auto}
      .sidebar-nav a{
        display:flex;
        align-items:center;
        gap:12px;
        color:rgba(255,255,255,0.92);
        padding:10px 8px;
        border-radius:10px;
        text-decoration:none;
        margin-bottom:6px;
        transition: background .15s;
      }
      .sidebar-nav a:hover, .sidebar-nav a.active{ background: rgba(255,255,255,0.06); }

      .sidebar-nav i{ width:30px; text-align:center; font-size:16px }

      main.main-content{
        margin-left:260px;
        padding:22px;
        transition: margin-left .22s ease;
      }
      .sidebar.collapsed + main.main-content{ margin-left:76px; }

      /* Header */
      .header{
        display:flex;
        align-items:center;
        justify-content:space-between;
        gap:12px;
        margin-bottom:16px;
      }
      .search-bar{
        display:flex;
        align-items:center;
        gap:10px;
        background:var(--card-bg);
        border-radius:12px;
        padding:8px 12px;
        box-shadow:var(--soft-shadow);
        border:1px solid rgba(15,43,43,0.03);
        min-width:260px;
      }
      .search-bar input{ border:0; outline:none; background:transparent; width:260px }
      .header-right{ display:flex; align-items:center; gap:12px }

      .notification{ position:relative; background:var(--card-bg); padding:8px 10px; border-radius:10px; box-shadow:var(--soft-shadow); border:1px solid rgba(15,43,43,0.03)}
      .notification .badge{ position:absolute; top:-6px; right:-6px; background:#e74c3c; color:#fff; font-size:11px; padding:4px 6px; border-radius:50% }

      .user-profile{ display:flex; align-items:center; gap:10px; background:var(--card-bg); padding:6px 10px; border-radius:12px; box-shadow:var(--soft-shadow); border:1px solid rgba(15,43,43,0.03)}
      .user-profile .user-info{ display:flex; flex-direction:column; line-height:1; }
      .user-profile small{ color:var(--muted); font-size:12px }

      /* Welcome card */
      .welcome{
        background: linear-gradient(180deg,#fff,#fffdf9);
        padding:18px;
        border-radius:14px;
        border:1px solid rgba(15,43,43,0.04);
        box-shadow:var(--soft-shadow);
        display:flex;
        justify-content:space-between;
        gap:12px;
        align-items:center;
      }
      .welcome h1{ margin:0; font-size:1.05rem }

      /* Grid & cards */
      .row-flex{ display:flex; gap:16px; flex-wrap:wrap; margin-top:18px }
      .card{ background:var(--card-bg); padding:18px; border-radius:14px; box-shadow:var(--soft-shadow); border:1px solid rgba(15,43,43,0.04); flex:1; min-width:220px }
      .card .title{ color:var(--muted); font-size:13px; margin-bottom:8px }
      .card .value{ font-size:1.6rem; font-weight:800 }

      /* Chart container smaller */
      .chart-small{ height:220px !important; }

      /* Recent activity */
      .recent-activity{ padding:12px; max-height:300px; overflow:auto }
      .activity-item{ padding:10px; border-radius:8px; margin-bottom:8px; background:linear-gradient(180deg, rgba(15,86,96,0.03), rgba(255,123,0,0.02)); border:1px solid rgba(15,43,43,0.04) }

      /* Quick actions */
      .quick-actions{ display:grid; grid-template-columns:repeat(auto-fit,minmax(160px,1fr)); gap:12px; margin-top:14px }
      .action-btn{ display:block; padding:16px; border-radius:12px; text-align:center; text-decoration:none; color:#fff; font-weight:700; box-shadow:0 8px 24px rgba(15,43,43,0.06) }
      .action-users{ background: linear-gradient(90deg,#1e88e5,#42a5f5) }
      .action-config{ background: linear-gradient(90deg,#0f5660,#2ca58d) }
      .action-audit{ background: linear-gradient(90deg,#ff9a4a,#ff7b00) }

      /* Footer */
      footer{ text-align:center; color:var(--muted); margin-top:18px }

      /* Responsive */
      @media(max-width:900px){
        .sidebar{ left:-9999px; position:fixed; transform:translateX(0) }
        .sidebar.collapsed{ left:0 }
        main.main-content{ margin-left:0; padding:12px }
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
    <aside class="sidebar" id="sidebar">
        <div class="logo">
            <i class="fas fa-water"></i>
            <span>CORAQUA</span>
        </div>

        <nav class="sidebar-nav" role="navigation">
            <a class="active" href="index.php?controller=Admin&action=dashboard"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a>
            <a href="index.php?controller=Admin&action=index"><i class="fas fa-users"></i><span>Gestión de Usuarios</span></a>
            <a href="index.php?controller=Admin&action=mostrarRegistro"><i class="fas fa-user-plus"></i><span>Registrar Usuario</span></a>
            <a href="index.php?controller=Auditoria&action=index"><i class="fas fa-chart-bar"></i><span>Ver Reportes</span></a>
            <a href="index.php?controller=Config&action=index"><i class="fas fa-cog"></i><span>Configuración</span></a>
            
            <a href="index.php?controller=Auth&action=logout" onclick="return confirm('¿Seguro que deseas cerrar sesión?');"><i class="fas fa-sign-out-alt"></i><span>Cerrar Sesión</span></a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <div class="header">
            <div style="display:flex; gap:12px; align-items:center;">
              <button id="toggleSidebar" title="Menu" style="background:transparent;border:0;font-size:18px;cursor:pointer;color:var(--cora-dark)">
                <i class="fas fa-bars"></i>
              </button>
              <div class="search-bar" role="search">
                <i class="fas fa-search" style="color:var(--muted)"></i>
                <input type="text" placeholder="Buscar formato..." aria-label="Buscar formato" />
              </div>
            </div>

                <div class="user-profile" title="<?= htmlspecialchars($_SESSION['usuario']['nombre']); ?>">
                    <div class="user-info">
                        <span><?= htmlspecialchars($_SESSION['usuario']['nombre']); ?></span>
                        <small>Administrador</small>
                    </div>
                    <i class="fas fa-chevron-down" style="color:var(--muted)"></i>
                </div>
            </div>
        </div>

        <div class="welcome" role="region" aria-label="Bienvenida">
          <div>
            <h1>👋 Hola, <?= htmlspecialchars($_SESSION['usuario']['nombre']); ?></h1>
            <p style="margin:6px 0 0 0; color:var(--muted)">Panel de administración — controla usuarios, configuración y auditoría.</p>
          </div>
          <div style="min-width:120px; text-align:right;">
            <small style="color:var(--muted)">Última actividad</small><br>
            <strong style="font-size:1.1rem">Hoy</strong>
          </div>
        </div>

        <!-- Stats row -->
        <div class="row-flex" style="margin-top:18px">
          <div class="card" style="max-width:320px">
            <div class="title">Total Usuarios</div>
            <div class="value" id="totalUsers"><?= $estadisticas['total_usuarios'] ?? 0 ?></div>
          </div>

          <div class="card" style="max-width:320px">
            <div class="title">Usuarios Activos</div>
            <div class="value" id="activeUsers"><?= $estadisticas['activos'] ?? 0 ?></div>
          </div>

          <div class="card" style="max-width:320px">
            <div class="title">Suspendidos</div>
            <div class="value" id="suspendedUsers"><?= $estadisticas['suspendidos'] ?? 0 ?></div>
          </div>
        </div>

        <!-- charts + activity -->
        <div class="row-flex" style="margin-top:18px; align-items:flex-start">
          <div class="card" style="flex:2; min-width:360px;">
            <div class="title">Distribución de Usuarios por Rol</div>
            <canvas id="usersChart" class="chart-small" aria-label="Grafico de roles" role="img"></canvas>
          </div>

          <div class="card" style="flex:1; min-width:260px;">
            <div class="title">Actividad Reciente</div>
            <div class="recent-activity">
              <?php if (!empty($actividadReciente)): ?>
                  <?php foreach ($actividadReciente as $actividad): ?>
                      <div class="activity-item">
                          <div style="display:flex; justify-content:space-between; align-items:center;">
                              <div style="font-weight:700; font-size:13px"><?= htmlspecialchars($actividad['accion']) ?></div>
                              <small style="color:var(--muted); font-size:12px"><?= $this->calcularTiempoTranscurrido($actividad['fecha']) ?></small>
                          </div>
                          <div style="color:var(--muted); font-size:13px; margin-top:6px">
                              <?= htmlspecialchars($actividad['usuario']) ?>
                          </div>
                      </div>
                  <?php endforeach; ?>
              <?php else: ?>
                  <div style="text-align:center; color:var(--muted); padding:18px">No hay actividad reciente</div>
              <?php endif; ?>
            </div>
          </div>
        </div>

        <!-- Quick actions -->
        <div style="margin-top:18px">
          <div class="card">
            <div class="title">Acciones Rápidas</div>
            <div class="quick-actions" style="margin-top:12px">
              <a class="action-btn action-users" href="index.php?controller=Admin&action=index"><i class="fas fa-users fa-lg"></i><div style="margin-top:8px">Gestionar Usuarios</div></a>
              <a class="action-btn action-config" href="index.php?controller=Config&action=index"><i class="fas fa-cog fa-lg"></i><div style="margin-top:8px">Configuración</div></a>
              <a class="action-btn action-audit" href="index.php?controller=Auditoria&action=index"><i class="fas fa-chart-bar fa-lg"></i><div style="margin-top:8px">Ver Auditoría</div></a>
            </div>
          </div>
        </div>

    </main>

    <script>
      // Toggle sidebar
      const toggleBtn = document.getElementById('toggleSidebar');
      const sidebar = document.getElementById('sidebar');
      toggleBtn.addEventListener('click', () => {
        sidebar.classList.toggle('collapsed');
      });

      // Chart.js init (small, kept logic same)
      document.addEventListener('DOMContentLoaded', function(){
        const distribucionRoles = <?= json_encode($distribucionRoles) ?> || [];
        const labels = distribucionRoles.map(item => item.rol);
        const data = distribucionRoles.map(item => parseInt(item.cantidad) || 0);
        const colores = ['#ff7b00','#2ecc71','#42a5f5','#f39c12','#9b59b6','#1abc9c'];

        const ctx = document.getElementById('usersChart').getContext('2d');
        new Chart(ctx, {
          type: 'doughnut',
          data: {
            labels,
            datasets: [{
              data,
              backgroundColor: colores.slice(0, labels.length),
              borderColor: '#fff',
              borderWidth: 2
            }]
          },
          options: {
            maintainAspectRatio: false,
            plugins: {
              legend: { position: 'bottom' },
            },
            layout: { padding: 8 }
          }
        });

        // refresh & print (keep behavior)
        const refreshBtn = document.getElementById('refreshBtn');
        if(refreshBtn){
          refreshBtn.addEventListener('click', function(){
            this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Actualizando...';
            setTimeout(()=>location.reload(), 900);
          });
        }
        const printBtn = document.getElementById('printBtn');
        if(printBtn){
          printBtn.addEventListener('click', ()=> window.print());
        }
      });
    </script>
</body>
</html>
