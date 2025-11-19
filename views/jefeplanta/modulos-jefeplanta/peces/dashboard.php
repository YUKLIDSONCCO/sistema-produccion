<?php 
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>CORAQUA-PERÚ</title>

  <link rel="stylesheet" href="/sistema-produccion/public/css/style_peces.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
/* 🌊 Fondo marino */
body {
  background: linear-gradient(to bottom, #b3ecff, #0066cc);
  overflow: hidden;
  margin: 0;
}

/* ====== PECES ====== */
.fish {
  position: absolute;
  width: 60px;
  height: auto;
  opacity: 0.9;
  transform: scaleX(-1);
  animation: swimRight linear infinite, floatUpDown ease-in-out infinite;
}

@keyframes swimRight {
  0% { left: -120px; transform: translateX(0) scaleX(-1); }
  100% { left: 110%; transform: translateX(120vw) scaleX(-1); }
}

@keyframes floatUpDown {
  0%, 100% { transform: translateY(0) scaleX(-1); }
  50% { transform: translateY(10px) scaleX(-1); }
}

.welcome {
  text-align: center;
  margin-top: 60px;
  color: white;
}

.welcome h1 {
  font-size: 2.8rem;
  margin-bottom: 20px;
  font-weight: bold;
  text-shadow: 2px 2px 5px rgba(0,0,0,0.3);
}

.welcome p {
  max-width: 900px;
  margin: 0 auto 25px;
  line-height: 1.8;
  font-size: 1.3rem;
  text-shadow: 1px 1px 4px rgba(0,0,0,0.3);
}
</style>
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
        <li>
          <a href="/sistema-produccion/public/index.php?controller=JefePlanta&action=dashboard">
            <i class="fas fa-circle-arrow-left"></i> Volver al panel principal
          </a>
        </li>

        <li><a href="#" id="inicioBtn" class="active"><i class="fas fa-house-chimney"></i> Inicio</a></li>
        <li><a href="#" id="formatosBtn"><i class="fas fa-folder-open"></i> Formatos PECES</a></li>
        <li><a href="#" id="listadoBtn"><i class="fas fa-list-check"></i> Listado PECES</a></li>

        <li>
          <a href="/sistema-produccion/public/index.php?controller=Auth&action=logout" onclick="return confirm('¿Seguro que deseas cerrar sesión?');">
            <i class="fas fa-door-open"></i> Cerrar Sesión
          </a>
        </li>
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
        <h1>🐟 Bienvenido al Panel de Control de PECES</h1>
        <p>
          Desde esta plataforma podrás <b>gestionar de manera eficiente</b> todos los formatos de control, 
          <b>registrar datos de producción</b>, <b>monitorear el crecimiento y la alimentación</b> de los peces,
          y <b>mantener actualizados los procesos de la planta acuícola</b>.
        </p>
      </div>

      <!-- Peces -->
      <img src="https://fondolunaria.org/informe2021/assets/GIFs/Personajes/pez-2.gif" class="fish fish1 small">
      <img src="https://i.gifer.com/origin/b4/b4e3a0c856b18e134d175aa49f406bb1_w200.gif" class="fish fish2 medium">
      <img src="https://images.emojiterra.com/google/noto-emoji/animated-emoji/1f41f.gif" class="fish fish3 large">
    </section>

<!-- FORMATOS -->
<section class="dashboard" id="formatosSection" style="display:none;">
  <div class="section-header">
    <h2>FORMATOS DE CONTROL DE PECES</h2>
  </div>

  <div class="bpa-grid">

    <div class="project-card" onclick="window.location.href='/sistema-produccion/public/index.php?controller=Peces&action=bpa6'">
      <i class="fas fa-fish fa-3x"></i>
      <h3>BPA 01 - Mortalidad Diaria de Alevinos</h3>
    </div>

    <div class="project-card" onclick="window.location.href='/sistema-produccion/public/index.php?controller=Peces&action=bpa7'">
      <i class="fas fa-bowl-food fa-3x"></i>
      <h3>BPA 02 - Alimentación Diaria</h3>
    </div>

    <div class="project-card" onclick="window.location.href='/sistema-produccion/public/index.php?controller=Peces&action=bpa10'">
      <i class="fas fa-vial fa-3x"></i>
      <h3>BPA 03 - Muestreo</h3>
    </div>

    <div class="project-card" onclick="window.location.href='/sistema-produccion/public/index.php?controller=Peces&action=bpa12'">
      <i class="fas fa-temperature-high fa-3x"></i>
      <h3>BPA 04 - Control Diario de Parámetros</h3>
    </div>

  </div>
</section>

<!-- LISTADO -->
<section class="dashboard" id="listadoSection" style="display:none;">
  <div class="section-header">
    <h2>LISTADO DE FORMATOS DE PECES</h2>
  </div>

  <div class="bpa-grid">

    <div class="project-card" onclick="window.location.href='/sistema-produccion/public/index.php?controller=Peces&action=bpa06Listado'">
      <i class="fas fa-fish fa-3x"></i>
      <h3>BPA 01 - Mortalidad Alevinos</h3>
    </div>

    <div class="project-card" onclick="window.location.href='/sistema-produccion/public/index.php?controller=Peces&action=bpa7Listado'">
      <i class="fas fa-bowl-food fa-3x"></i>
      <h3>BPA 02 - Alimentación</h3>
    </div>

    <div class="project-card" onclick="window.location.href='/sistema-produccion/public/index.php?controller=Peces&action=bpa10Listado'">
      <i class="fas fa-vial fa-3x"></i>
      <h3>BPA 03 - Muestreo</h3>
    </div>

    <div class="project-card" onclick="window.location.href='/sistema-produccion/public/index.php?controller=Peces&action=bpa12Listado'">
      <i class="fas fa-temperature-high fa-3x"></i>
      <h3>BPA 04 - Parámetros de Agua</h3>
    </div>

  </div>
</section>

<!-- REPORTES -->
<section class="dashboard" id="reportesSection" style="display:none;">
  <div class="section-header">
    <h2>Reportes de Peces</h2>
  </div>
  <?php include 'reportes_peces.php'; ?>
</section>

  </main>

  <script src="/sistema-produccion/public/js/script_peces.js"></script>
</body>
</html>
