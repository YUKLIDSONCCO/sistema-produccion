<?php 
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>CORAQUA-PERÚ | Panel de Peces</title>

  <!-- Estilos -->
  <link rel="stylesheet" href="/sistema-produccion/public/css/style_inventarios.css" />
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
        <li><a href="javascript:history.back()"><i class="fas fa-circle-arrow-left"></i> Volver atrás</a></li>
        <li><a href="index.php?controller=JefePlanta&action=dashboard"><i class="fas fa-th-large"></i> Dashboard</a></li>
        <li><a href="#" id="inicioBtn" class="active"><i class="fas fa-fish"></i> Panel Peces</a></li>
        <li><a href="#" id="produccionBtn"><i class="fas fa-chart-line"></i> Producción</a></li>
        <li><a href="#" id="configBtn"><i class="fas fa-cogs"></i> Configuración</a></li>
        <li><a href="index.php?controller=Login&action=cerrarSesion"><i class="fas fa-door-open"></i> Cerrar sesión</a></li>
      </ul>
    </nav>
  </aside>

  <!-- Contenido Principal -->
  <main class="main-content" id="mainContent">
    <header class="header">
      <div class="search-bar">
        <i class="fas fa-search"></i>
        <input type="text" placeholder="Buscar BPA..." />
      </div>
      <div class="header-right">
        <div class="notification">
          <i class="far fa-bell"></i>
          <span class="badge">3</span>
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

    <!-- PANEL DE PECES -->
    <section class="dashboard" id="inicioSection">
      <div class="section-header">
        <h2>Panel de Peces (BPAs)</h2>
        <p>Selecciona un BPA para gestionar los controles de producción acuícola</p>
      </div>

      <div class="bpa-grid">
        <div class="project-card color1" onclick="window.location.href='index.php?controller=JefePlanta&action=bpa6'">
          <i class="fas fa-skull-crossbones fa-3x"></i>
          <h3>BPA 06 - Mortalidad Diaria</h3>
          <p>Registro de alevines fallecidos</p>
        </div>

        <div class="project-card color2" onclick="window.location.href='index.php?controller=JefePlanta&action=bpa7'">
          <i class="fas fa-water fa-3x"></i>
          <h3>BPA 07 - Control de Tanques</h3>
          <p>Supervisa los tanques de cultivo</p>
        </div>

        <div class="project-card color3" onclick="window.location.href='index.php?controller=JefePlanta&action=bpa10'">
          <i class="fas fa-thermometer-half fa-3x"></i>
          <h3>BPA 10 - Control de Temperatura</h3>
          <p>Monitoreo térmico diario</p>
        </div>

        <div class="project-card color5" onclick="window.location.href='index.php?controller=JefePlanta&action=bpa12'">
          <i class="fas fa-chart-line fa-3x"></i>
          <h3>BPA 12 - Control de Crecimiento</h3>
          <p>Peso y tamaño de peces</p>
        </div>

        <div class="project-card color6" onclick="window.location.href='index.php?controller=JefePlanta&action=bpa15'">
          <i class="fas fa-map-marked-alt fa-3x"></i>
          <h3>BPA 15 - Registro de Áreas</h3>
          <p>Zonas de producción y control</p>
        </div>

        <div class="project-card color7" onclick="window.location.href='index.php?controller=JefePlanta&action=mortproducc'">
          <i class="fas fa-skull-crossbones fa-3x"></i>
          <h3>Reporte de Mortalidad</h3>
          <p>Resumen de muertes por etapa</p>
        </div>
      </div>
    </section>
  </main>

  <!-- Script general -->
  <script>
    // Toggle Sidebar
    document.getElementById("toggleSidebar").addEventListener("click", () => {
      document.getElementById("sidebar").classList.toggle("collapsed");
    });
  </script>
</body>
</html>
