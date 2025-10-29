<?php 
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>CORAQUA-PERÚ</title>

  <link rel="stylesheet" href="/sistema-produccion/public/css/style_inventarios.css" />
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
        <li><a href="#" id="formatosBtn"><i class="fas fa-folder-open"></i> Formatos MPA</a></li>
        <li><a href="#" id="listadoBtn"><i class="fas fa-list-check"></i> Listado MPA</a></li>
        <li><a href="#" id="laboratorioBtn"><i class="fas fa-flask-vial"></i> Laboratorio</a></li>
        <li><a href="#" id="salaBtn"><i class="fas fa-water"></i> Sala Empeques</a></li>
        <li><a href="#" id="reportesBtn"><i class="fas fa-chart-line"></i> Reportes MPA</a></li>
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

      <!-- 🐠 Pez animado -->
      <div class="fish"></div>
    </section>

    <!-- FORMATOS BPA -->
    <section class="dashboard" id="formatosSection" style="display:none;">
      <div class="section-header">
        <h2>FORMATOS DE MEJORAS PRÁCTICAS DE ACUICULTURA</h2>
        <p>Gestión de registros internos (Inventario, Alimentación, Medicamentos, etc.)</p>
      </div>

      <div class="bpa-grid">
        <div class="project-card" onclick="window.location.href='index.php?controller=Inventario&action=bpa1'">
          <i class="fas fa-box fa-3x"></i>
          <h3>CONTROL DE ALIMENTO EN ALMACÉN</h3>
          <p>Registro del ingreso, salida y control semanal de alimentos.</p>
        </div>

        <div class="project-card" onclick="window.location.href='index.php?controller=Inventario&action=bpa2'">
          <i class="fas fa-clipboard-list fa-3x"></i>
          <h3>CONTROL DE SAL EN ALMACÉN</h3>
          <p>Inventario diario y manejo del insumo de sal utilizada.</p>
        </div>

        <div class="project-card" onclick="window.location.href='index.php?controller=Inventario&action=bpa3'">
          <i class="fas fa-prescription-bottle-medical fa-3x"></i>
          <h3>CONTROL DE MEDICAMENTO</h3>
          <p>Gestión de stock, vencimiento y uso responsable de medicamentos.</p>
        </div>

        <div class="project-card" onclick="window.location.href='index.php?controller=Inventario&action=bpa4'">
          <i class="fas fa-flask fa-3x"></i>
          <h3>DOSIFICACIÓN DE SUPLEMENTOS Y MEDICAMENTOS</h3>
          <p>Preparación y aplicación controlada de suplementos.</p>
        </div>
      </div>
    </section>

    <!-- LISTADO BPA -->
    <section class="dashboard" id="listadoSection" style="display:none;">
      <div class="section-header">
        <h2>LISTADO DE MEJORAS PRÁCTICAS DE ACUICULTURA</h2>
        <p>Visualiza y accede a los formatos registrados en el sistema.</p>
      </div>

      <div class="bpa-grid">
        <div class="project-card" onclick="window.location.href='index.php?controller=Inventario&action=listarBPA1'">
          <i class="fas fa-box fa-3x"></i>
          <h3>CONTROL DE ALIMENTO EN ALMACÉN</h3>
          <p>Listado de registros de control semanal de alimentos.</p>
        </div>
          <div class="project-card" onclick="window.location.href='index.php?controller=Inventario&action=listarBPA2'">
          <i class="fas fa-clipboard-list fa-3x"></i>
          <h3>CONTROL DE SAL EN ALMACÉN</h3>
          <p>Listado de inventario diario de sal utilizada.</p>
        </div>
        <div class="project-card" onclick="window.location.href='index.php?controller=Inventario&action=listarBPA3'">
          <i class="fas fa-prescription-bottle-medical fa-3x"></i>
          <h3>CONTROL DE MEDICAMENTO</h3>
          <p>Listado general de medicamentos registrados.</p>
        </div>
          <div class="project-card" onclick="window.location.href='index.php?controller=Inventario&action=listarBPA4'">
          <i class="fas fa-flask fa-3x"></i>
          <h3>DOSIFICACIÓN DE SUPLEMENTOS Y MEDICAMENTOS</h3>
          <p>Listado de registros de dosificación y aplicación.</p>
        </div>
      </div>
    </section>

    <!-- LABORATORIO -->
    <section class="dashboard" id="laboratorioSection" style="display:none;">
      <div class="section-header">
        <h2>Laboratorio</h2>
        <p>Gestión de pruebas y análisis de agua, oxígeno y salud de peces.</p>
      </div>
      <div class="projects-grid">
        <div class="project-card">
          <i class="fas fa-vial-circle-check fa-3x"></i>
          <h3>Análisis de Calidad de Agua</h3>
          <p>Control de parámetros físicos y químicos del agua.</p>
        </div>
        <div class="project-card">
          <i class="fas fa-dna fa-3x"></i>
          <h3>Salud de Especies</h3>
          <p>Registros y estudios de condiciones sanitarias.</p>
        </div>
      </div>
    </section>

    <!-- SALA DE EMPEQUES -->
    <section class="dashboard" id="salaSection" style="display:none;">
      <div class="section-header">
        <h2>Sala de Empeques</h2>
        <p>Gestión del área de incubación y control de temperatura.</p>
      </div>
      <div class="projects-grid">
        <div class="project-card">
          <i class="fas fa-temperature-high fa-3x"></i>
          <h3>Control de Temperatura</h3>
          <p>Monitoreo en tiempo real del ambiente de las ovas.</p>
        </div>
        <div class="project-card">
          <i class="fas fa-egg fa-3x"></i>
          <h3>Incubación</h3>
          <p>Seguimiento del proceso de desarrollo embrionario.</p>
        </div>
      </div>
    </section>

    <!-- REPORTES -->
    <section class="dashboard" id="reportesSection" style="display:none;">
      <div class="section-header">
        <h2>Reportes MPA</h2>
        <p>Visualiza el estado actual del alimento, stock y producción.</p>
      </div>
      <div class="charts-grid">
        <canvas id="graficoAlimento" height="120"></canvas>
        <canvas id="graficoStock" height="120"></canvas>
      </div>
    </section>
  </main>


  <script src="/sistema-produccion/public/js/script_inventario.js"></script>
</body>
</html>
