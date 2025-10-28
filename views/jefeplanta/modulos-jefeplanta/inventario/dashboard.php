<?php 

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>CORAQUA</title>

  <link rel="stylesheet" href="../css/style_inventario.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

</head>
<body>
  <!-- Sidebar -->
  <aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
      <div class="logo">
        <i class="fas fa-chart-line"></i>
        <span>CORAQUA</span>
      </div>
      <button class="toggle-btn" id="toggleSidebar">
        <i class="fas fa-bars"></i>
      </button>
    </div>

    <nav class="sidebar-nav">
      <ul>
        <li><a href="javascript:history.back()"><i class="fas fa-circle-arrow-left"></i> Volver atrás</a></li>
      <li><a href="#" id="inicioBtn"><i class="fas fa-house-chimney"></i> Inicio</a></li>
      <li><a href="#" id="formatosBtn"><i class="fas fa-folder-open"></i> Formatos MPA</a></li>
      <li><a href="#" id="listadoBtn"><i class="fas fa-list-check"></i> Listado MPA</a></li>
      <li><a href="#"><i class="fas fa-flask-vial"></i> Laboratorio</a></li>
      <li><a href="#"><i class="fas fa-water"></i> Sala Empeques</a></li>
      <li><a href="#"><i class="fas fa-chart-line"></i> Reportes MPA</a></li>
      <li><a href="index.php?controller=Login&action=cerrarSesion"><i class="fas fa-door-open"></i> Cerrar sesión</a></li>

      </ul>
    </nav>
  </aside>

  <!-- Contenido Principal -->
  <main class="main-content" id="mainContent">
    <header class="header">
      <div class="search-bar">
        <i class="fas fa-search"></i>
        <input type="text" placeholder="Buscar formato..." />
      </div>
      <div class="header-right">
        <div class="notification">
          <i class="far fa-bell"></i>
          <span class="badge">1</span>
        </div>
        <div class="user-profile">
          <img src="https://via.placeholder.com/40" alt="User" />
          <div class="user-info">
            <span>CORAQUA</span>
            <small>Jefe de Planta</small>
          </div>
          <i class="fas fa-chevron-down"></i>
        </div>
      </div>
    </header>

    <!-- INICIO -->
    <section class="dashboard" id="inicioSection">
      <div class="welcome">
        <h1>🐟 Bienvenido al Panel de Inventario</h1>
        <p>Aquí podrás acceder a todos los formatos BPA disponibles, registrar información y mantener actualizados los procesos de tu planta.</p>
      </div>
      <div class="fish"></div>
    </section>

    <!-- FORMATOS BPA -->
    <section class="dashboard" id="formatosSection" style="display:none;">
      <div class="section-header">
        <h2>Formatos BPA</h2>
        <p>Gestión de registros internos (Inventario, Alimentación, Medicamentos, etc.)</p>
      </div>

      <div class="filters">
        <button class="filter-btn active">Todos <span>5</span></button>
        <button class="filter-btn">Inventario <span>2</span></button>
        <button class="filter-btn">Medicamentos <span>2</span></button>
      </div>

      <div class="projects-grid bpa-grid">
        <?php
        $bpa_items = [
          ['num' => 'N°01', 'title' => 'CONTROL DE ALIMENTO EN ALMACÉN', 'fa' => 'fa-box', 'action' => 'bpa1', 'time_range' => 'Inventario Semanal'],
          ['num' => 'N°02', 'title' => 'CONTROL DE SAL EN ALMACÉN', 'fa' => 'fa-salt', 'action' => 'bpa2', 'time_range' => 'Inventario Diario'],
          ['num' => 'N°03', 'title' => 'CONTROL DE MEDICAMENTO', 'fa' => 'fa-prescription-bottle-medical', 'action' => 'bpa3', 'time_range' => 'Registro y Uso'],
          ['num' => 'N°04', 'title' => 'DOSIFICACIÓN DE SUPLEMENTOS Y MEDICAMENTOS', 'fa' => 'fa-flask', 'action' => 'bpa4', 'time_range' => 'Preparación'],
        ];

        foreach ($bpa_items as $item): ?>
          <a href="index.php?controller=Inventario&action=<?php echo $item['action']; ?>" class="schedule-item-link">
            <div class="project-card schedule-item">
              <div class="card-icon time-slot" aria-hidden="true">
                <i class="fas <?php echo $item['fa']; ?>"></i>
              </div>
              <h3 class="bpa-title"><?php echo $item['title']; ?></h3>
              <div class="team-info">
                <i class="fas fa-users"></i>
                <span class="bpa-sub"><?php echo $item['time_range']; ?></span>
              </div>
              <div class="time-left">
                <i class="far fa-clock"></i>
                <span class="bpa-num"><?php echo $item['num']; ?></span>
              </div>
              <div class="progress-info">
                <div class="avatars">
                  <img src="https://via.placeholder.com/28" alt="u" />
                </div>
                <div class="progress">
                  <span class="small muted">Abrir</span>
                </div>
                <div class="progress-bar">
                  <div class="fill" style="width: 65%; height:8px;"></div>
                </div>
              </div>
            </div>
          </a>
        <?php endforeach; ?>
      </div>
    </section>

    <!-- LISTADO BPA -->
    <section class="dashboard" id="listadoSection" style="display:none;">
      <div class="section-header">
        <h2>Listado de BPA</h2>
        <p>Consulta rápida de los formatos BPA registrados en el sistema.</p>
      </div>
      <table class="bpa-list">
        <tr><th>N°</th><th>Nombre del Formato</th><th>Tipo</th></tr>
        <tr><td>01</td><td>Control de alimento en almacén</td><td>Inventario</td></tr>
        <tr><td>02</td><td>Control de sal en almacén</td><td>Inventario</td></tr>
        <tr><td>03</td><td>Control de medicamento</td><td>Registro</td></tr>
        <tr><td>04</td><td>Dosificación de suplementos y medicamentos</td><td>Preparación</td></tr>
      </table>
    </section>
  </main>


  <script src="../public/js/script_inventario.js"></script>
</body>
</html>
