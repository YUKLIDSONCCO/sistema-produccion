<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Boardto Dashboard</title>
  <link rel="stylesheet" href="/sistema-produccion/public/css/style_dashboard_ovas.css" />

  <!-- Íconos -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <style>
    /* Estilos adicionales si los necesitas */
  </style>
</head>
<body>
  <!-- Todo el contenido HTML se mantiene exactamente igual -->
  <div class="dashboard-container">
    <!-- Sidebar de Boardto con estructura de menú de CORAQUA -->
    <aside class="sidebar" id="sidebar">
      <div class="sidebar-header">
        <div class="logo">
          <i class="fas fa-chart-line"></i>
          <span>Boardto</span>
        </div>
        <button class="toggle-btn" id="toggleSidebar">
          <i class="fas fa-bars"></i>
        </button>
      </div>

      <nav class="sidebar-nav">
        <ul>
          <li><a href="#"><i class="fas fa-box-open"></i> Inventario</a></li>
          <li><a href="#"><i class="fas fa-clipboard-list"></i> Registros Diarios</a></li>
          <li class="active"><a href="#"><i class="far fa-file-alt"></i> Reporting</a></li>
          <li><a href="#"><i class="fas fa-file-alt"></i> Informes BPA</a></li>
          <li><a href="#"><i class="fas fa-warehouse"></i> Almacén</a></li>
          <li><a href="#"><i class="fas fa-users-cog"></i> Gestión Personal</a></li>
          <li><a href="#"><i class="fas fa-bell"></i> Alertas Críticas</a></li>
          <li><a href="#"><i class="fas fa-cog"></i> Setting</a></li>
          <li><a href="#"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
      </nav>
      
      <div class="sidebar-image" style="text-align: center; margin-top: 30px; opacity: 0.7;">
        <i class="fas fa-chart-line fa-4x" style="color: #4A90E2;"></i>
      </div>
    </aside>

    <!-- Main Content -->
    <main class="main-content" id="mainContent">
      <!-- Header -->
      <header class="dashboard-header">
        <h1>Panel de Reporting</h1>
        <div class="header-info">
          <span><?php echo date('d F Y, l'); ?></span>
          <i class="fas fa-search"></i>
          <i class="fas fa-bell"></i>
          <div class="user-avatar-mobile">
            <img src="https://via.placeholder.com/30" alt="User" />
          </div>
        </div>
      </header>

      <div class="main-layout-grid">
        <section class="timetable-section">
          <h2>Formatos de Registros BPA</h2>
          <div class="date-controls">
            <span>Inventario, Alimentación, Medicamentos y Suplementos</span>
            <a href="index.php?controller=JefePlanta&action=index" class="btn btn-outline-secondary">
              ⬅ Volver al Panel
            </a>
          </div>

          <!-- Sección original BPA -->
          <div class="schedule-list bpa-grid">
            <?php
            $bpa_items = [
              ['num' => 'N°07', 'title' => 'ALIMENTACIÓN DIARIA', 'icon' => '🧾', 'room' => 'BPA-1', 'action' => 'bpa1', 'time_range' => 'Registro Matutino'],
              ['num' => 'N°08', 'title' => 'CONTROL DE ALIMENTO EN ALMACÉN', 'icon' => '📦', 'room' => 'BPA-8', 'action' => 'bpa8', 'time_range' => 'Inventario Semanal'],
              ['num' => 'N°13', 'title' => 'CONTROL DE SAL EN ALMACÉN', 'icon' => '🧂', 'room' => 'BPA-13', 'action' => 'bpa13', 'time_range' => 'Inventario Diario'],
              ['num' => 'N°14', 'title' => 'CONTROL DE MEDICAMENTO', 'icon' => '💊', 'room' => 'BPA-14', 'action' => 'bpa14', 'time_range' => 'Registro y Uso'],
              ['num' => 'N°16', 'title' => 'DOSIFICACIÓN DE SUPLEMENTOS Y MEDICAMENTOS', 'icon' => '⚗', 'room' => 'BPA-16', 'action' => 'bpa16', 'time_range' => 'Preparación'],
            ];

            foreach ($bpa_items as $item):
            ?>
              <a href="index.php?controller=Inventario&action=<?php echo $item['action']; ?>" class="schedule-item-link">
                <div class="schedule-item">
                  <div class="time-slot"><?php echo $item['icon']; ?></div>
                  <div class="lesson">
                    <span><?php echo $item['title']; ?></span>
                    <span><?php echo $item['time_range']; ?></span>
                  </div>
                  <span class="room bpa-room"><?php echo $item['room']; ?></span>
                </div>
              </a>
            <?php endforeach; ?>
          </div>

          <!-- 🚀 NUEVA SECCIÓN AGREGADA: FORMATOS DE OVAS -->
          <h2 style="margin-top: 40px;">Formatos de Control de Ovas</h2>
          <div class="date-controls">
            <span>Control de Ovas Embrionadas, Incubación y Reincubación</span>
          </div>

          <div class="schedule-list bpa-grid">
            <a href="index.php?controller=Ovas&action=bpa4" class="schedule-item-link">
              <div class="schedule-item">
                <div class="time-slot">🥚</div>
                <div class="lesson">
                  <span>FORMATO N°04</span>
                  <span>Control de Ovas Embrionadas</span>
                </div>
                <span class="bpa-room">BPA-04</span>
              </div>
            </a>

            <a href="index.php?controller=Ovas&action=bpa5" class="schedule-item-link">
              <div class="schedule-item">
                <div class="time-slot">🧫</div>
                <div class="lesson">
                  <span>FORMATO N°05</span>
                  <span>Registro de Incubación</span>
                </div>
                <span class="bpa-room">BPA-05</span>
              </div>
            </a>

            <a href="index.php?controller=Ovas&action=bpa6" class="schedule-item-link">
              <div class="schedule-item">
                <div class="time-slot">♻️</div>
                <div class="lesson">
                  <span>FORMATO N°06</span>
                  <span>Control de Reincubación</span>
                </div>
                <span class="bpa-room">BPA-06</span>
              </div>
            </a>
          </div>
          <!-- FIN NUEVA SECCIÓN -->
        </section>

        <section class="info-widgets">
          <div class="latest-marks-card card">
            <h2>Últimos Movimientos</h2>
            <span class="date-context">30.09.2025 - 06.10.2025</span>
            <div class="marks-list">
              <i class="fas fa-chevron-left"></i>
              <div class="mark-item">1T</div>
              <div class="mark-item">+2T</div>
              <div class="mark-item main-mark">5T</div>
              <div class="mark-item">3T</div>
              <div class="mark-item">4T</div>
              <i class="fas fa-chevron-right"></i>
            </div>
            <div class="mark-details">
              <span class="subject">Alimento Consumido</span>
              <span class="test-type">Total en Toneladas (T)</span>
            </div>
          </div>

          <div class="homeworks-calendar-card card">
            <h2>Tareas Pendientes & Revisiones</h2>
            <div class="calendar-header">
              <span>Octubre 2025</span>
              <i class="fas fa-chevron-left"></i>
              <i class="fas fa-chevron-right"></i>
            </div>
            <div class="calendar-grid">
              <span class="day-name">Lun</span><span class="day-name">Mar</span><span class="day-name">Mié</span><span class="day-name">Jue</span><span class="day-name">Vie</span><span class="day-name">Sáb</span><span class="day-name">Dom</span>
              <span class="day inactive">29</span><span class="day inactive">30</span><span class="day today has-event">1</span><span class="day has-event">2</span><span class="day">3</span><span class="day">4</span><span class="day">5</span>
              <span class="day">6</span><span class="day today has-event">7</span><span class="day has-event">8</span><span class="day">9</span><span class="day">10</span><span class="day">11</span><span class="day">12</span>
              <span class="day">13</span><span class="day">14</span><span class="day exam">15</span><span class="day has-event">16</span><span class="day">17</span><span class="day test">18</span><span class="day active-select">19</span>
              <span class="day today">20</span><span class="day">21</span><span class="day">22</span><span class="day">23</span><span class="day">24</span><span class="day">25</span><span class="day">26</span>
              <span class="day">27</span><span class="day">28</span><span class="day test">29</span><span class="day">30</span><span class="day">31</span><span class="day inactive">1</span><span class="day inactive">2</span>
            </div>
            <div class="calendar-legend">
              <span><i class="dot homework"></i> Ingreso BPA</span>
              <span><i class="dot exam"></i> Auditoría</span>
              <span><i class="dot test"></i> Revisión Stock</span>
            </div>
          </div>
        </section>
      </div>
    </main>

    <aside class="right-panel">
      <div class="student-info-card">
        <div class="avatar-and-name">
          <img src="https://via.placeholder.com/80" alt="Avatar de Usuario" class="student-avatar">
          <span class="student-name">Augusta Ryan</span>
          <span class="student-role">Director</span>
        </div>

        <div class="detail-box lucky-number">
          <span>Lotes Activos</span>
          <span class="value">08</span>
          <i class="fas fa-fish"></i>
        </div>

        <div class="detail-box marks-average">
          <span>Stock Crítico</span>
          <span class="value">45%</span>
          <i class="fas fa-exclamation-triangle"></i>
        </div>

        <div class="detail-box place-in-class">
          <span>Registros Hoy</span>
          <span class="value">05</span>
          <i class="fas fa-clipboard-check"></i>
        </div>

        <div class="time-to-vacation-gauge">
          <span>Cumplimiento BPA</span>
          <div class="gauge-container">
            <span class="days-remaining">92%</span>
            <div class="gauge-placeholder"></div>
          </div>
        </div>

        <button class="log-out-btn"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</button>
      </div>
    </aside>
  </div>

  <script src="/sistema-produccion/public/js/app_dashboard_ovas.js"></script>
</body>
</html>
