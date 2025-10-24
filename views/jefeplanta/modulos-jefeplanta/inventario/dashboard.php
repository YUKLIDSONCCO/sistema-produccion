<?php 

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>CORAQUA</title>

  <link rel="stylesheet" href="/sistema-produccion/public/css/style_inventario.css" />
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
        <li><a href="#"><i class="fas fa-th-large"></i> Inicio</a></li>
        <li><a href="#"><i class="far fa-calendar-alt"></i> Formatos BPA</a></li>
        <li class="active"><a href="#"><i class="far fa-file-alt"></i> Listado BPA</a></li>
        <li><a href="#"><i class="fas fa-users"></i> Listado BPA</a></li>
        <li><a href="#"><i class="fas fa-cogs"></i> Reportes BPA</a></li>
        <li><a href="#"><i class="fas fa-cog"></i> Configuración</a></li>
        <li><a href="index.php?controller=Login&action=cerrarSesion"><i class="fas fa-sign-out-alt"></i> Cerrar sesión</a></li>
      </ul>
    </nav>
  </aside>

  <!-- Main Content -->
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

    <section class="dashboard">
      <div class="section-header">
        <h2>Formatos BPA</h2>
        <p>Gestión de registros internos (Inventario, Alimentación, Medicamentos, etc.)</p>
      </div>

      <div class="filters">
        <button class="filter-btn active">Todos <span>5</span></button>
        <button class="filter-btn">Inventario <span>2</span></button>
        <button class="filter-btn">Alimentación <span>1</span></button>
        <button class="filter-btn">Medicamentos <span>2</span></button>
      </div>

      <!-- Grid BPA -->
      <div class="projects-grid bpa-grid">
        <?php
        $bpa_items = [
          ['num' => 'N°01', 'title' => 'ALIMENTACIÓN DIARIA', 'fa' => 'fa-utensils', 'action' => 'bpa1', 'time_range' => 'Registro Matutino'],
          ['num' => 'N°02', 'title' => 'CONTROL DE ALIMENTO EN ALMACÉN', 'fa' => 'fa-box', 'action' => 'bpa2', 'time_range' => 'Inventario Semanal'],
          ['num' => 'N°03', 'title' => 'CONTROL DE SAL EN ALMACÉN', 'fa' => 'fa-salt', 'action' => 'bpa3', 'time_range' => 'Inventario Diario'],
          ['num' => 'N°04', 'title' => 'CONTROL DE MEDICAMENTO', 'fa' => 'fa-prescription-bottle-medical', 'action' => 'bpa4', 'time_range' => 'Registro y Uso'],
          ['num' => 'N°05', 'title' => 'DOSIFICACIÓN DE SUPLEMENTOS Y MEDICAMENTOS', 'fa' => 'fa-flask', 'action' => 'bpa5', 'time_range' => 'Preparación'],
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
  </main>

  <script src="/sistema-produccion/public/js/script_inventario.js"></script>
</body>
</html>
