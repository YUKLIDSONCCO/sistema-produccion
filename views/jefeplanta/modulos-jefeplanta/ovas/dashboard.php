<?php
// dashboard.php
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard CORAQUA</title>

  <!-- Estilos -->
  <link rel="stylesheet" href="/sistema-produccion/public/css/style_dashboard_ovas.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body>
  <!-- Sidebar -->
  <aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
      <div class="logo">
        <i class="fas fa-fish"></i>
        <span>CORAQUA</span>
      </div>
      <button class="toggle-btn" id="toggleSidebar">
        <i class="fas fa-bars"></i>
      </button>
    </div>

    <nav class="sidebar-nav">
      <ul>
        <li><a href="index.php?controller=Inventario&action=index"><i class="fas fa-box-open"></i> Inventario</a></li>
        <li><a href="index.php?controller=Registros&action=index"><i class="fas fa-clipboard-list"></i> Registros Diarios</a></li>
        <li class="active"><a href="#"><i class="far fa-file-alt"></i> Reporting</a></li>
        <li><a href="index.php?controller=Informes&action=bpa"><i class="fas fa-file-alt"></i> Informes BPA</a></li>
        <li><a href="index.php?controller=Almacen&action=index"><i class="fas fa-warehouse"></i> Almacén</a></li>
        <li><a href="index.php?controller=Personal&action=index"><i class="fas fa-users-cog"></i> Gestión Personal</a></li>
        <li><a href="index.php?controller=Alertas&action=index"><i class="fas fa-bell"></i> Alertas Críticas</a></li>
        <li><a href="index.php?controller=Configuracion&action=index"><i class="fas fa-cog"></i> Configuración</a></li>
        <li><a href="index.php?controller=Login&action=logout"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
      </ul>
    </nav>
  </aside>

  <!-- Main Content -->
  <main class="main-content" id="mainContent">
    <!-- Header -->
    <header class="header">
      <div class="search-bar">
        <i class="fas fa-search"></i>
        <input type="text" placeholder="Buscar..." />
      </div>
      <div class="header-right">
        <div class="notification">
          <i class="far fa-bell"></i>
          <span class="badge">1</span>
        </div>
        <div class="user-profile">
          <img src="https://via.placeholder.com/40" alt="User" />
          <div class="user-info">
            <span>Augusta Ryan</span>
            <small>Director</small>
          </div>
          <i class="fas fa-chevron-down"></i>
        </div>
      </div>
    </header>

    <!-- Dashboard Content -->
    <section class="dashboard">
      <div class="section-header">
        <h2>Panel de Reporting</h2>
        <p>Formatos de Control BPA y Ovas</p>
      </div>

      <!-- Filtros -->
      <div class="filters">
        <button class="filter-btn active">Todos</button>
        <button class="filter-btn">BPA</button>
        <button class="filter-btn">Ovas</button>
      </div>

      <!-- Tarjetas de reportes -->
      <div class="projects-grid">

        <!-- BPA -->
        <div class="project-card">
          <div class="card-icon" style="background: #4A90E2;">
            <i class="fas fa-clipboard-list"></i>
          </div>
          <h3>Registros BPA</h3>
          <div class="team-info"><i class="fas fa-file-alt"></i> Alimentación, Inventario y Medicamentos</div>
          <div class="time-left"><i class="far fa-clock"></i> Última actualización: <?php echo date('d/m/Y'); ?></div>
          <a href="index.php?controller=JefePlanta&action=index" class="btn-add"><i class="fas fa-eye"></i></a>
        </div>

        <!-- Ovas -->
        <div class="project-card">
          <div class="card-icon" style="background: #9B5DE5;">
            <i class="fas fa-egg"></i>
          </div>
          <h3>Control de Ovas</h3>
          <div class="team-info"><i class="fas fa-fish"></i> Embrionadas, Incubación y Reincubación</div>
          <div class="time-left"><i class="far fa-clock"></i> Último registro: <?php echo date('d/m/Y'); ?></div>
          <a href="index.php?controller=Ovas&action=bpa4" class="btn-add"><i class="fas fa-eye"></i></a>
        </div>

        <!-- BPA 9 -->
        <div class="project-card">
          <div class="card-icon" style="background: #00BFA5;">
            <i class="fas fa-balance-scale"></i>
          </div>
          <h3>BPA N°9 - Selección, Pesaje y Traslado</h3>
          <div class="team-info"><i class="fas fa-water"></i> Clasificación, peso y movimiento de alevinos</div>
          <div class="time-left"><i class="far fa-clock"></i> Actualizado: <?php echo date('d/m/Y'); ?></div>
          <a href="index.php?controller=Ovas&action=bpa9" class="btn-add"><i class="fas fa-eye"></i></a>
        </div>

        <!-- Informes BPA -->
        <div class="project-card">
          <div class="card-icon" style="background: #FF6B9D;">
            <i class="fas fa-chart-pie"></i>
          </div>
          <h3>Informes BPA</h3>
          <div class="team-info"><i class="fas fa-users"></i> Área de Producción</div>
          <div class="time-left"><i class="far fa-clock"></i> Último Informe: Sept 2025</div>
          <a href="index.php?controller=Informes&action=bpa" class="btn-add"><i class="fas fa-eye"></i></a>
        </div>

        <!-- Gestión de Almacén -->
        <div class="project-card">
          <div class="card-icon" style="background: #FF9F1C;">
            <i class="fas fa-warehouse"></i>
          </div>
          <h3>Almacén y Stock</h3>
          <div class="team-info"><i class="fas fa-boxes"></i> Control de insumos y materiales</div>
          <div class="time-left"><i class="far fa-clock"></i> Actualizado cada semana</div>
          <a href="index.php?controller=Almacen&action=index" class="btn-add"><i class="fas fa-eye"></i></a>
        </div>

      </div>
    </section>
  </main>

  <script src="/sistema-produccion/public/js/app_dashboard_ovas.js"></script>
</body>
</html>
