<?php 
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>CORAQUA-PERÚ</title>

  <link rel="stylesheet" href="/sistema-produccion/public/css/style_ovas.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
        <li><a href="#" id="inicioBtn" class="active"><i class="fas fa-house-chimney"></i> Inicio</a></li>
        <li><a href="#" id="formatosBtn"><i class="fas fa-folder-open"></i> Formatos OVAS</a></li>
        <li><a href="#" id="listadoBtn"><i class="fas fa-list-check"></i> Listado OVAS</a></li>
        <li><a href="#" id="reportesBtn"><i class="fas fa-chart-line"></i> Reportes OVAS</a></li>
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
        <h1>🐟 Bienvenido al Panel de Control de OVAS</h1>
        <p>Aquí podrás acceder a todos los formatos de control de ovas, registrar información y mantener actualizados los procesos de la planta.</p>
      </div>

      <!-- 🐠 Pez animado -->
      <div class="fish"></div>
    </section>

    <!-- FORMATOS OVAS -->
    <section class="dashboard" id="formatosSection" style="display:none;">
      <div class="section-header">
        <h2>FORMATOS DE CONTROL DE OVAS</h2>
        <p>Gestión de registros internos relacionados con los procesos de ovación y fertilización.</p>
      </div>

      <div class="bpa-grid">
        <div class="project-card" onclick="window.location.href='index.php?controller=Ovas&action=bpa_1'">
          <i class="fas fa-egg fa-3x"></i>
          <h3>FORMATO N°02 - SELECCIÓN Y FERTILIZACIÓN DE OVAS NACIONALES</h3>
          <p>Registro detallado de reproductores, fertilización y estimación de ovas fértiles.</p>
        </div>

        <div class="project-card" onclick="window.location.href='index.php?controller=Ovas&action=bpa_2'">
          <i class="fas fa-skull-crossbones fa-3x"></i>
          <h3>FORMATO N°04 - MORTALIDAD DIARIA - OVAS</h3>
          <p>Control diario de la mortalidad de ovas en cada batea y observaciones correspondientes.</p>
        </div>

        <div class="project-card" onclick="window.location.href='index.php?controller=Ovas&action=bpa_3'">
          <i class="fas fa-fish fa-3x"></i>
          <h3>FORMATO N°05 - MORTALIDAD DIARIA - LARVAS</h3>
          <p>Registro y control del número de larvas vivas y muertas en los lotes de cultivo.</p>
        </div>

        <div class="project-card" onclick="window.location.href='index.php?controller=Ovas&action=bpa_4'">
          <i class="fas fa-temperature-high fa-3x"></i>
          <h3>FORMATO N°12 - CONTROL DIARIO DE PARÁMETROS</h3>
          <p>Monitoreo de temperatura, oxígeno y pH en diferentes horarios de control diario.</p>
        </div>
      </div>
    </section>

    <!-- LISTADO OVAS -->
    <section class="dashboard" id="listadoSection" style="display:none;">
      <div class="section-header">
        <h2>LISTADO DE FORMATOS DE OVAS</h2>
        <p>Visualiza y accede a los registros de control y seguimiento de ovación y parámetros.</p>
      </div>

      <div class="bpa-grid">
        <div class="project-card" onclick="window.location.href='index.php?controller=Ovas&action=listarBPA2'">
          <i class="fas fa-egg fa-3x"></i>
          <h3>LISTADO - SELECCIÓN Y FERTILIZACIÓN DE OVAS NACIONALES</h3>
          <p>Visualiza los registros de fertilización y cantidad de ovas fértiles por lote.</p>
        </div>

        <div class="project-card" onclick="window.location.href='index.php?controller=Ovas&action=listarBPA4'">
          <i class="fas fa-skull-crossbones fa-3x"></i>
          <h3>LISTADO - MORTALIDAD DIARIA - OVAS</h3>
          <p>Listado general de mortalidad registrada en las distintas bateas de incubación.</p>
        </div>

        <div class="project-card" onclick="window.location.href='index.php?controller=Ovas&action=listarBPA5'">
          <i class="fas fa-fish fa-3x"></i>
          <h3>LISTADO - MORTALIDAD DIARIA - LARVAS</h3>
          <p>Listado de registros diarios de larvas con detalle de muertes y observaciones.</p>
        </div>

        <div class="project-card" onclick="window.location.href='index.php?controller=Ovas&action=listarBPA12'">
          <i class="fas fa-temperature-high fa-3x"></i>
          <h3>LISTADO - CONTROL DIARIO DE PARÁMETROS</h3>
          <p>Visualización de los registros de temperatura, oxígeno y pH registrados diariamente.</p>
        </div>
      </div>
    </section>

    <!-- REPORTES -->
    <section class="dashboard" id="reportesSection" style="display:none;">
      <div class="section-header">
        <h2>Reportes OVAS</h2>
        <p>Visualiza el estado actual del proceso reproductivo, mortalidad y parámetros de agua.</p>
      </div>
      <div class="charts-grid">
        <canvas id="graficoAlimento" height="120"></canvas>
        <canvas id="graficoStock" height="120"></canvas>
      </div>
    </section>
  </main>

  <script src="/sistema-produccion/public/js/script_ovas.js"></script>
</body>
</html>
