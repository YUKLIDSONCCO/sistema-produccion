<?php
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Panel de Peces - BPA</title>

  <link rel="stylesheet" href="/sistema-produccion/public/css/style_peces.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>

<body>
  <header class="navbar">
    <div class="logo"><i class="fas fa-fish"></i> Panel Peces</div>
    <nav>
      <a href="index.php?controller=JefePlanta&action=dashboard"><i class="fas fa-th-large"></i> Dashboard</a>
      <a href="#" class="active"><i class="fas fa-fish"></i> Panel Peces</a>
      <a href="#"><i class="fas fa-chart-line"></i> Producción</a>
      <a href="#"><i class="fas fa-cogs"></i> Configuración</a>
      <a href="#"><i class="fas fa-sign-out-alt"></i> Salir</a>
    </nav>
  </header>

  <main class="content">
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
            <span>Jefe de Planta</span>
            <small>Administrador</small>
          </div>
          <i class="fas fa-chevron-down"></i>
        </div>
      </div>
    </header>

    <section class="dashboard">
      <div class="section-header">
        <h2>Panel de Peces (BPAs)</h2>
        <p>Selecciona un BPA para gestionar los controles de producción acuícola</p>
      </div>

    <section class="bpa-grid">
      <a href="index.php?controller=JefePlanta&action=bpa6" class="card color1">
        <i class="fas fa-skull-crossbones icon"></i>
        <h3>BPA 06 - Mortalidad Diaria</h3>
        <p>Registro de alevines fallecidos</p>
      </a>

      <a href="index.php?controller=JefePlanta&action=bpa7" class="card color2">
        <i class="fas fa-water icon"></i>
        <h3>BPA 07 - Control de Tanques</h3>
        <p>Supervisa los tanques de cultivo</p>
      </a>

      <a href="index.php?controller=JefePlanta&action=bpa10" class="card color3">
        <i class="fas fa-thermometer-half icon"></i>
        <h3>BPA 10 - Control de Temperatura</h3>
        <p>Monitoreo térmico diario</p>
      </a>

      <a href="index.php?controller=JefePlanta&action=bpa11" class="card color4">
        <i class="fas fa-utensils icon"></i>
        <h3>BPA 11 - Registro de Alimentación</h3>
        <p>Plan de alimentación y consumo</p>
      </a>

      <a href="index.php?controller=JefePlanta&action=bpa12" class="card color5">
        <i class="fas fa-chart-line icon"></i>
        <h3>BPA 12 - Control de Crecimiento</h3>
        <p>Peso y tamaño de peces</p>
      </a>

      <a href="index.php?controller=JefePlanta&action=bpa15" class="card color6">
        <i class="fas fa-map-marked-alt icon"></i>
        <h3>BPA 15 - Registro de Áreas</h3>
        <p>Zonas de producción y control</p>
      </a>

      <a href="index.php?controller=JefePlanta&action=mortproducc" class="card color7">
        <i class="fas fa-skull-crossbones icon"></i>
        <h3>Reporte de Mortalidad</h3>
        <p>Resumen de muertes por etapa</p>
      </a>
    </section>
  </main>
</body>
</html>
