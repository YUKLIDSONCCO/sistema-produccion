<?php
// views/jefeplanta/modulos-jefeplanta/peces.php
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Panel de Peces - BPA</title>

  <!-- Estilos -->
  <link rel="stylesheet" href="/sistema-produccion/public/css/style_inventario.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

  <style>
    /* Ajustes visuales finos */
    .section-header h2 {
      color: #2d3748;
      font-size: 1.8rem;
      margin-bottom: 0.3rem;
    }

    .section-header p {
      color: #718096;
      margin-bottom: 1.5rem;
    }

    .projects-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
      gap: 1.5rem;
    }

    .project-card {
      background: #fff;
      border-radius: 16px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      padding: 1.5rem;
      text-align: center;
      transition: all 0.3s ease;
      position: relative;
    }

    .project-card:hover {
      transform: translateY(-6px);
      box-shadow: 0 8px 18px rgba(0,0,0,0.15);
    }

    .card-icon {
      width: 70px;
      height: 70px;
      border-radius: 50%;
      color: #fff;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.8rem;
      margin: 0 auto 1rem;
    }

    .project-card h3 {
      font-size: 1.1rem;
      color: #2d3748;
      margin-bottom: 0.8rem;
    }

    .team-info {
      font-size: 0.9rem;
      color: #718096;
      margin-bottom: 1rem;
    }

    .progress-bar {
      background: #edf2f7;
      border-radius: 10px;
      overflow: hidden;
      height: 10px;
      margin-bottom: 0.8rem;
      position: relative;
    }

    .progress-bar .fill {
      height: 100%;
      background: #4a90e2;
    }

    .progress-bar span {
      position: absolute;
      right: 10px;
      top: -22px;
      font-size: 0.8rem;
      color: #4a5568;
    }

    .btn-link {
      display: inline-block;
      background: #2b6cb0;
      color: #fff;
      padding: 0.5rem 1rem;
      border-radius: 8px;
      text-decoration: none;
      font-size: 0.9rem;
      transition: background 0.2s;
    }

    .btn-link:hover {
      background: #1a4e85;
    }

    /* Sidebar responsive */
    @media (max-width: 768px) {
      .sidebar {
        position: fixed;
        left: -100%;
        transition: left 0.3s ease;
      }
      .sidebar.active {
        left: 0;
      }
      #toggleSidebar {
        display: block;
      }
    }
  </style>
</head>

<body>
  <!-- Sidebar -->
  <aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
      <div class="logo">
        <i class="fas fa-fish"></i>
        <span>Panel Peces</span>
      </div>
      <button class="toggle-btn" id="toggleSidebar">
        <i class="fas fa-bars"></i>
      </button>
    </div>

    <nav class="sidebar-nav">
      <ul>
        <li><a href="index.php?controller=JefePlanta&action=dashboard"><i class="fas fa-th-large"></i> Dashboard</a></li>
        <li class="active"><a href="index.php?controller=JefePlanta&action=peces"><i class="fas fa-fish"></i> Panel Peces</a></li>
        <li><a href="#"><i class="fas fa-chart-line"></i> Producción</a></li>
        <li><a href="#"><i class="fas fa-cogs"></i> Configuración</a></li>
        <li><a href="#"><i class="fas fa-sign-out-alt"></i> Salir</a></li>
      </ul>
    </nav>
  </aside>

  <!-- Main Content -->
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

      <!-- BPA Cards -->
      <div class="projects-grid">

        <!-- BPA 7 -->
        <div class="project-card">
          <div class="card-icon" style="background: #4A90E2;">
            <i class="fas fa-water"></i>
          </div>
          <h3>BPA 07 - Control de Tanques</h3>
          <div class="team-info"><i class="fas fa-users"></i> Equipo: BPA</div>
          <div class="progress-bar"><div class="fill" style="width: 90%;"></div><span>90%</span></div>
          <a href="index.php?controller=JefePlanta&action=bpa7" class="btn-link">Ir al módulo</a>
        </div>

        <!-- BPA 10 -->
        <div class="project-card">
          <div class="card-icon" style="background: #FF9F1C;">
            <i class="fas fa-thermometer-half"></i>
          </div>
          <h3>BPA 10 - Control de Temperatura</h3>
          <div class="team-info"><i class="fas fa-users"></i> Equipo: BPA</div>
          <div class="progress-bar"><div class="fill" style="width: 85%; background:#FF9F1C;"></div><span>85%</span></div>
          <a href="index.php?controller=BPA&action=bpa10" class="btn-link">Ir al módulo</a>
        </div>

        <!-- BPA 11 -->
        <div class="project-card">
          <div class="card-icon" style="background: #2EC4B6;">
            <i class="fas fa-utensils"></i>
          </div>
          <h3>BPA 11 - Registro de Alimentación</h3>
          <div class="team-info"><i class="fas fa-users"></i> Equipo: BPA</div>
          <div class="progress-bar"><div class="fill" style="width: 78%; background:#2EC4B6;"></div><span>78%</span></div>
          <a href="index.php?controller=BPA&action=bpa11" class="btn-link">Ir al módulo</a>
        </div>

        <!-- BPA 12 -->
        <div class="project-card">
          <div class="card-icon" style="background: #FF6B9D;">
            <i class="fas fa-chart-line"></i>
          </div>
          <h3>BPA 12 - Control de Crecimiento</h3>
          <div class="team-info"><i class="fas fa-users"></i> Equipo: BPA</div>
          <div class="progress-bar"><div class="fill" style="width: 82%; background:#FF6B9D;"></div><span>82%</span></div>
          <a href="index.php?controller=BPA&action=bpa12" class="btn-link">Ir al módulo</a>
        </div>

        <!-- BPA 15 -->
        <div class="project-card">
          <div class="card-icon" style="background: #9B5DE5;">
            <i class="fas fa-map-marked-alt"></i>
          </div>
          <h3>BPA 15 - Registro de Áreas</h3>
          <div class="team-info"><i class="fas fa-users"></i> Equipo: BPA</div>
          <div class="progress-bar"><div class="fill" style="width: 65%; background:#9B5DE5;"></div><span>65%</span></div>
          <a href="index.php?controller=BPA&action=bpa15" class="btn-link">Ir al módulo</a>
        </div>

        <!-- Mortalidad -->
        <div class="project-card">
          <div class="card-icon" style="background: #E63946;">
            <i class="fas fa-skull-crossbones"></i>
          </div>
          <h3>Reporte de Mortalidad</h3>
          <div class="team-info"><i class="fas fa-users"></i> Equipo: BPA</div>
          <div class="progress-bar"><div class="fill" style="width: 70%; background:#E63946;"></div><span>70%</span></div>
          <a href="index.php?controller=BPA&action=mortproducc" class="btn-link">Ir al módulo</a>
        </div>

      </div>
    </section>
  </main>

  <script>
    const sidebar = document.getElementById('sidebar');
    const toggleBtn = document.getElementById('toggleSidebar');
    toggleBtn.addEventListener('click', () => {
      sidebar.classList.toggle('active');
    });
  </script>

  <script src="/sistema-produccion/public/js/script_inventario.js"></script>
</body>
</html>
