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
  transform: scaleX(-1); /* Miran hacia la derecha */
  animation: swimRight linear infinite, floatUpDown ease-in-out infinite;
}

/* ====== ANIMACIÓN — de izquierda a derecha ====== */
@keyframes swimRight {
  0% {
    left: -120px;
    transform: translateX(0) scaleX(-1);
  }
  100% {
    left: 110%;
    transform: translateX(120vw) scaleX(-1);
  }
}

/* ====== ANIMACIÓN — leve movimiento vertical ====== */
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
  font-size: 2.8rem;   /* antes 2rem */
  margin-bottom: 20px;
  font-weight: bold;
  text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
}

.welcome p {
  max-width: 900px;
  margin: 0 auto 25px;
  line-height: 1.8;
  font-size: 1.3rem;   /* antes 1.1rem */
  text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.3);
}

/* ====== VARIACIÓN ENTRE PECES ====== */
.fish:nth-child(1) { top: 5%;  animation-duration: 18s, 3s; animation-delay: 0s, 1s; width: 70px; }
.fish:nth-child(2) { top: 12%; animation-duration: s, 3s; animation-delay: 0s, 1s; width: 70px; }
.fish:nth-child(3) { top: 20%; animation-duration: 22s, 5s; animation-delay: 5s, 3s; width: 50px; }
.fish:nth-child(4) { top: 28%; animation-duration: 20s, 3s; animation-delay: 2s, 2s; width: 80px; }
.fish:nth-child(5) { top: 35%; animation-duration: 35s, 4s; animation-delay: 7s, 1s; width: 65px; }
.fish:nth-child(6) { top: 42%; animation-duration: 25s, 5s; animation-delay: 4s, 3s; width: 55px; }
.fish:nth-child(7) { top: 48%; animation-duration: 27s, 3s; animation-delay: 6s, 2s; width: 70px; }
.fish:nth-child(8) { top: 55%; animation-duration: 30s, 6s; animation-delay: 8s, 1s; width: 60px; }
.fish:nth-child(9) { top: 62%; animation-duration: 21s, 4s; animation-delay: 1s, 3s; width: 50px; }
.fish:nth-child(10){ top: 69%; animation-duration: 33s, 3s; animation-delay: 9s, 2s; width: 75px; }
.fish:nth-child(11){ top: 76%; animation-duration: 29s, 5s; animation-delay: 10s, 3s; width: 65px; }
.fish:nth-child(12){ top: 83%; animation-duration: 26s, 4s; animation-delay: 12s, 1s; width: 55px; }
.fish:nth-child(13){ top: 10%; animation-duration: 24s, 3s; animation-delay: 14s, 2s; width: 80px; }
.fish:nth-child(14){ top: 50%; animation-duration: 28s, 5s; animation-delay: 11s, 1s; width: 60px; }
.fish:nth-child(15){ top: 75%; animation-duration: 32s, 4s; animation-delay: 16s, 2s; width: 75px; }
.fish:nth-child(16){ top: 30%; animation-duration: 20s, 5s; animation-delay: 6s, 1s; width: 65px; }
.fish:nth-child(17){ top: 60%; animation-duration: 27s, 4s; animation-delay: 13s, 3s; width: 55px; }
.fish:nth-child(18){ top: 40%; animation-duration: 31s, 3s; animation-delay: 17s, 2s; width: 70px; }
.fish:nth-child(19){ top: 15%; animation-duration: 30s, 5s; animation-delay: 19s, 1s; width: 60px; }
.fish:nth-child(20){ top: 90%; animation-duration: 34s, 6s; animation-delay: 15s, 3s; width: 85px; }

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
            <a href="index.php?controller=Colaborador&action=peces">
              <i class="fas fa-circle-arrow-left"></i> Volver al panel principal
            </a>
          </li>
        <li><a href="#" id="inicioBtn" class="active"><i class="fas fa-house-chimney"></i> Inicio</a></li>
        <li><a href="#" id="formatosBtn"><i class="fas fa-folder-open"></i> Formatos PECES</a></li>
        <li><a href="#" id="listadoBtn"><i class="fas fa-list-check"></i> Listado PECES</a></li>

        <li>
            <a href="index.php?controller=Auth&action=logout" onclick="return confirm('¿Seguro que deseas cerrar sesión?');">
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
        <p>
          Nuestro objetivo es brindarte una herramienta centralizada para 
          <b>optimizar la trazabilidad</b>, <b>mejorar la calidad</b> y 
          <b>facilitar la toma de decisiones</b> mediante información confiable y actualizada.
        </p>
      </div>

      <!-- 🐠 Peces animados con diferentes GIFs -->
      <img src="https://fondolunaria.org/informe2021/assets/GIFs/Personajes/pez-2.gif" class="fish fish1 small" alt="pez emoji">
      <img src="https://i.gifer.com/origin/b4/b4e3a0c856b18e134d175aa49f406bb1_w200.gif" class="fish fish2 medium" alt="pez azul">
      <img src="https://images.emojiterra.com/google/noto-emoji/animated-emoji/1f41f.gif" class="fish fish3 large" alt="pez naranja">
      <img src="https://fondolunaria.org/informe2021/assets/GIFs/Personajes/pez-2.gif" class="fish fish4 medium" alt="pez emoji">
      <img src="https://i.gifer.com/origin/b4/b4e3a0c856b18e134d175aa49f406bb1_w200.gif" class="fish fish5 small" alt="pez azul">
      <img src="https://images.emojiterra.com/google/noto-emoji/animated-emoji/1f41f.gif" class="fish fish6 large" alt="pez naranja">
    </section>

    <!-- FORMATOS PECES -->
<section class="dashboard" id="formatosSection" style="display:none;">
  <div class="section-header">
    <h2>FORMATOS DE CONTROL DE PECES</h2>
    <p>Registros para el control diario del cultivo, monitoreo y crecimiento de los peces.</p>
  </div>

  <div class="bpa-grid">
    <!-- BPA 01 - Mortalidad Diaria de Alevinos -->
    <div class="project-card" onclick="window.location.href='index.php?controller=Peces&action=bpa6'">
      <i class="fas fa-fish fa-3x" style="color:#0077b6;"></i>
      <h3>BPA 01 - Mortalidad Diaria de Alevinos</h3>
      <p>Registro detallado de alevines fallecidos para control sanitario.</p>
    </div>

    <!-- BPA 02 - Alimentación Diaria -->
    <div class="project-card" onclick="window.location.href='index.php?controller=Peces&action=bpa7'">
      <i class="fas fa-bowl-food fa-3x" style="color:#00b4d8;"></i>
      <h3>BPA 02 - Alimentación Diaria</h3>
      <p>Registro de la alimentación diaria de los peces.</p>
    </div>

    <!-- BPA 03 - Muestreo -->
    <div class="project-card" onclick="window.location.href='index.php?controller=Peces&action=bpa10'">
      <i class="fas fa-vial fa-3x" style="color:#48cae4;"></i>
      <h3>BPA 03 - Muestreo</h3>
      <p>Registro de muestreos realizados a los peces.</p>
    </div>

    <!-- BPA 04 - Control Diario de Parámetros -->
    <div class="project-card" onclick="window.location.href='index.php?controller=Peces&action=bpa12'">
      <i class="fas fa-temperature-high fa-3x" style="color:#ff6b6b;"></i>
      <h3>BPA 04 - Control Diario de Parámetros</h3>
      <p>Registros de parámetros de agua de peces.</p>
    </div>
  </div>
</section>
    <!-- LISTADO -->
<section class="dashboard" id="listadoSection" style="display:none;">
  <div class="section-header">
    <h2>LISTADO DE FORMATOS DE PECES</h2>
    <p>Consulta y administra los registros diarios de control y monitoreo de peces.</p>
  </div>

  <div class="bpa-grid">
    <!-- BPA 01 - Mortalidad Diaria de Alevinos -->
    <div class="project-card" onclick="window.location.href='index.php?controller=Peces&action=bpa06Listado'">
      <i class="fas fa-fish fa-3x" style="color:#0077b6;"></i>
      <h3>BPA 01 - Mortalidad Diaria de Alevinos</h3>
      <p>Visualiza el listado de los registros de alevines fallecidos.</p>
    </div>

    <!-- BPA 02 - Alimentación Diaria -->
    <div class="project-card" onclick="window.location.href='index.php?controller=Peces&action=bpa7Listado'">
      <i class="fas fa-bowl-food fa-3x" style="color:#00b4d8;"></i>
      <h3>BPA 02 - Alimentación Diaria</h3>
      <p>Listado general de la alimentación diaria de los peces.</p>
    </div>

    <!-- BPA 03 - Muestreo -->
    <div class="project-card" onclick="window.location.href='index.php?controller=Peces&action=bpa10Listado'">
      <i class="fas fa-vial fa-3x" style="color:#48cae4;"></i>
      <h3>BPA 03 - Muestreo</h3>
      <p>Listado del registro del muestreo diario de los peces.</p>
    </div>

    <!-- BPA 04 - Control Diario de Parámetros -->
    <div class="project-card" onclick="window.location.href='index.php?controller=Peces&action=bpa12Listado'">
      <i class="fas fa-temperature-high fa-3x" style="color:#ff6b6b;"></i>
      <h3>BPA 04 - Control Diario de Parámetros</h3>
      <p>Listado de los registros de parámetros de agua de peces.</p>
    </div>
  </div>
</section>



    <!-- REPORTES -->
    <section class="dashboard" id="reportesSection" style="display:none;">
  <div class="section-header">
    <h2>Reportes de Peces</h2>
    <p>Visualiza el estado actual del proceso reproductivo, mortalidad y parámetros de agua.</p>
  </div>

  <!-- Contenido cargado desde PHP -->
  <?php include 'reportes_peces.php'; ?>
</section>

  </main>

  <script src="/sistema-produccion/public/js/script_peces.js"></script>
</body>
</html>

