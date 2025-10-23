<?php 
// dashboard.php — versión final con diseño moderno + enlaces funcionales BPA
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Boardto Dashboard - CORAQUA</title>
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
        <li><a href="#"><i class="fas fa-th-large"></i> Panel</a></li>
        <li><a href="#"><i class="far fa-calendar-alt"></i> Programación</a></li>
        <li class="active"><a href="#"><i class="far fa-file-alt"></i> Formatos BPA</a></li>
        <li><a href="#"><i class="fas fa-users"></i> Personal</a></li>
        <li><a href="#"><i class="fas fa-cogs"></i> Herramientas</a></li>
        <li><a href="#"><i class="fas fa-cog"></i> Configuración</a></li>
        <li><a href="index.php?controller=Login&action=cerrarSesion"><i class="fas fa-sign-out-alt"></i> Cerrar sesión</a></li>
      </ul>
    </nav>
  </aside>

  <!-- Main Content -->
  <main class="main-content" id="mainContent">
    <!-- Header -->
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
            <span>Usuario CORAQUA</span>
            <small>Administrador</small>
          </div>
          <i class="fas fa-chevron-down"></i>
        </div>
      </div>
    </header>

    <!-- Dashboard Content -->
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

      <div class="actions">
        <button class="btn-add"><i class="fas fa-plus"></i></button>
        <div class="view-options">
          <button><i class="fas fa-list"></i></button>
          <button><i class="fas fa-th-large"></i></button>
          <button><i class="fas fa-ellipsis-v"></i></button>
        </div>
      </div>

      <!-- Grid de BPA -->
      <div class="projects-grid bpa-grid">
        <?php
        $bpa_items = [
            ['num' => 'N°07', 'title' => 'ALIMENTACIÓN DIARIA', 'icon' => '🧾', 'room' => 'BPA-1', 'action' => 'bpa1', 'time_range' => 'Registro Matutino'],
            ['num' => 'N°08', 'title' => 'CONTROL DE ALIMENTO EN ALMACÉN', 'icon' => '📦', 'room' => 'BPA-8', 'action' => 'bpa8', 'time_range' => 'Inventario Semanal'],
            ['num' => 'N°13', 'title' => 'CONTROL DE SAL EN ALMACÉN', 'icon' => '🧂', 'room' => 'BPA-13', 'action' => 'bpa13', 'time_range' => 'Inventario Diario'],
            ['num' => 'N°14', 'title' => 'CONTROL DE MEDICAMENTO', 'icon' => '💊', 'room' => 'BPA-14', 'action' => 'bpa14', 'time_range' => 'Registro y Uso'],
            ['num' => 'N°16', 'title' => 'DOSIFICACIÓN DE SUPLEMENTOS Y MEDICAMENTOS', 'icon' => '⚗️', 'room' => 'BPA-16', 'action' => 'bpa16', 'time_range' => 'Preparación'],
        ];

        foreach ($bpa_items as $item): ?>
          <a href="index.php?controller=Inventario&action=<?php echo $item['action']; ?>" class="schedule-item-link">
            <div class="project-card schedule-item">
              <div class="card-icon time-slot" style="background: transparent;">
                <span class="bpa-emoji"><?php echo $item['icon']; ?></span>
              </div>

              <h3 class="bpa-title"><?php echo $item['title']; ?></h3>

              <div class="team-info">
                <i class="fas fa-users"></i>
                <span class="bpa-sub"><?php echo $item['time_range']; ?></span>
              </div>

              <div class="time-left">
                <i class="far fa-clock"></i>
                <span class="bpa-room"><?php echo $item['room']; ?></span>
                <span class="bpa-num"><?php echo $item['num']; ?></span>
              </div>

              <div class="progress-info">
                <div class="avatars">
                  <img src="https://via.placeholder.com/24" alt="u" />
                </div>
                <div class="progress">
                  <span class="small muted">Abrir</span>
                </div>
                <div class="progress-bar" style="width:70px; max-width:100%;">
                  <div class="fill" style="width: 0%; height:6px;"></div>
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
