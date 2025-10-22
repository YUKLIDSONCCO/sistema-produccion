<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Panel de Acuicultura</title>

  <link rel="stylesheet" href="/sistema-produccion/public/css/style_peces.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

  <style>
    /* ======== ESTILOS ADICIONALES ======== */
    .dashboard-container {
      display: flex;
      min-height: 100vh;
    }

    .main-layout-grid {
      display: grid;
      grid-template-columns: 2fr 1fr;
      gap: 20px;
      margin-top: 20px;
    }

    .timetable-section,
    .card {
      background: white;
      border-radius: 12px;
      padding: 20px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }

    .date-controls {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }

    .bpa-grid {
      display: grid;
      gap: 15px;
    }

    .schedule-item-link {
      text-decoration: none;
      color: inherit;
    }

    .schedule-item {
      display: flex;
      align-items: center;
      padding: 15px;
      border-radius: 8px;
      background: #f8f9fa;
      transition: all 0.3s ease;
    }

    .schedule-item:hover {
      background: #e9ecef;
      transform: translateY(-2px);
    }

    .time-slot {
      font-size: 24px;
      margin-right: 15px;
    }

    .lesson {
      flex: 1;
    }

    .lesson span:first-child {
      display: block;
      font-weight: 600;
      margin-bottom: 5px;
    }

    .lesson span:last-child {
      font-size: 14px;
      color: #6c757d;
    }

    .bpa-room {
      background: #005b96;
      color: white;
      padding: 5px 10px;
      border-radius: 20px;
      font-size: 12px;
      font-weight: 600;
    }

    .info-widgets {
      display: flex;
      flex-direction: column;
      gap: 20px;
    }

    .marks-list {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      margin: 15px 0;
    }

    .mark-item {
      width: 40px;
      height: 40px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 8px;
      background: #f8f9fa;
      font-weight: 600;
    }

    .main-mark {
      background: #005b96;
      color: white;
    }

    .calendar-grid {
      display: grid;
      grid-template-columns: repeat(7, 1fr);
      gap: 8px;
      margin: 15px 0;
    }

    .day-name, .day {
      text-align: center;
      padding: 8px;
      border-radius: 8px;
    }

    .day {
      cursor: pointer;
    }

    .day:hover {
      background: #f8f9fa;
    }

    .today {
      background: #005b96;
      color: white;
    }

    .has-event::after,
    .exam::after,
    .test::after {
      content: '';
      display: block;
      width: 4px;
      height: 4px;
      background: #005b96;
      border-radius: 50%;
      margin: 2px auto 0;
    }

    .exam::after { background: #dc3545; }
    .test::after { background: #ffc107; }
    .inactive { color: #adb5bd; }

    .calendar-legend {
      display: flex;
      flex-wrap: wrap;
      gap: 15px;
      font-size: 12px;
    }

    .dot {
      display: inline-block;
      width: 8px;
      height: 8px;
      border-radius: 50%;
      margin-right: 5px;
    }

    .homework { background: #005b96; }
    .exam { background: #dc3545; }
    .test { background: #ffc107; }

    .right-panel {
      width: 300px;
      background: white;
      padding: 20px;
      box-shadow: -2px 0 10px rgba(0,0,0,0.05);
    }

    .student-info-card {
      display: flex;
      flex-direction: column;
      gap: 20px;
    }

    .avatar-and-name {
      text-align: center;
    }

    .student-avatar {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      margin-bottom: 10px;
    }

    .student-name {
      display: block;
      font-weight: 600;
    }

    .student-role {
      font-size: 14px;
      color: #6c757d;
    }

    .detail-box {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px;
      border-radius: 8px;
      background: #f8f9fa;
      position: relative;
    }

    .detail-box i {
      position: absolute;
      right: 15px;
      color: #005b96;
    }

    .value {
      font-weight: 600;
      font-size: 18px;
    }

    .time-to-vacation-gauge {
      padding: 15px;
      border-radius: 8px;
      background: #f8f9fa;
    }

    .gauge-container {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-top: 10px;
    }

    .days-remaining {
      font-weight: 600;
      font-size: 18px;
    }

    .gauge-placeholder {
      flex: 1;
      height: 8px;
      background: #e9ecef;
      border-radius: 4px;
      overflow: hidden;
    }

    .gauge-placeholder::after {
      content: '';
      display: block;
      width: 92%;
      height: 100%;
      background: #005b96;
      border-radius: 4px;
    }

    .log-out-btn {
      background: #005b96;
      color: white;
      border: none;
      padding: 12px;
      border-radius: 8px;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      font-weight: 600;
      transition: background 0.3s;
    }

    .log-out-btn:hover {
      background: #004578;
    }

    .btn {
      padding: 8px 16px;
      border-radius: 6px;
      border: none;
      cursor: pointer;
      font-weight: 600;
      transition: all 0.3s;
    }

    .btn-outline-secondary {
      background: transparent;
      border: 1px solid #6c757d;
      color: #6c757d;
    }

    .btn-outline-secondary:hover {
      background: #6c757d;
      color: white;
    }

    .sidebar {
      width: 250px;
    }

    .main-content {
      flex: 1;
      padding: 20px;
    }

    .dashboard-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }

    .header-info {
      display: flex;
      align-items: center;
      gap: 15px;
    }

    .header-info i {
      font-size: 18px;
      color: #6c757d;
      cursor: pointer;
    }

    .user-avatar-mobile img {
      width: 30px;
      height: 30px;
      border-radius: 50%;
    }
  </style>
</head>

<body>
  <div class="dashboard-container">

    <!-- ======== SIDEBAR ======== -->
    <aside class="sidebar" id="sidebar">
      <div class="sidebar-header">
        <div class="logo">
          <i class="fas fa-water"></i>
          <span>AquaDash</span>
        </div>
        <button class="toggle-btn" id="toggleSidebar">
          <i class="fas fa-bars"></i>
        </button>
      </div>

      <nav class="sidebar-nav">
        <ul>
          <li><a href="#"><i class="fas fa-box-open"></i> Inventario Alimento</a></li>
          <li><a href="#"><i class="fas fa-clipboard-list"></i> Registros Diarios</a></li>
          <li class="active"><a href="#"><i class="fas fa-chart-bar"></i> Reporting Biomasa</a></li>
          <li><a href="#"><i class="fas fa-shield-alt"></i> Bioseguridad</a></li>
          <li><a href="#"><i class="fas fa-temperature-low"></i> Monitoreo Calidad</a></li>
          <li><a href="#"><i class="fas fa-user-friends"></i> Gestión Personal</a></li>
          <li><a href="#"><i class="fas fa-bell"></i> Alertas Críticas</a></li>
          <li><a href="#"><i class="fas fa-cog"></i> Setting</a></li>
          <li><a href="#"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
      </nav>

      <div class="sidebar-image" style="text-align: center; margin-top: 30px; opacity: 0.7;">
        <i class="fas fa-fish fa-4x" style="color: #005b96;"></i>
      </div>
    </aside>

    <!-- ======== CONTENIDO PRINCIPAL ======== -->
    <main class="main-content" id="mainContent">
      <header class="dashboard-header">
        <h1>Panel de Acuicultura</h1>
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
        <!-- ======== REGISTROS DIARIOS ======== -->
        <section class="timetable-section">
          <h2>Registros Diarios y Procesos</h2>
          <div class="date-controls">
            <span>Alimento, Calidad de Agua, Sanidad y Crecimiento</span>
            <a href="index.php?controller=JefePlanta&action=index" class="btn btn-outline-secondary">⬅ Volver al Panel</a>
          </div>

          <div class="schedule-list bpa-grid">
            <?php
            $aquaculture_items = [
              ['icon' => '🍚', 'title' => 'DOSIFICACIÓN DE ALIMENTO', 'room' => 'Estanque-A', 'action' => 'registro_alimento', 'time_range' => 'Registro Matutino y Vespertino'],
              ['icon' => '🧪', 'title' => 'MONITOREO DE OXÍGENO Y pH', 'room' => 'Estanque-B', 'action' => 'monitoreo_agua', 'time_range' => 'Mediciones Periódicas'],
              ['icon' => '🚨', 'title' => 'CONTROL DE MORTALIDAD', 'room' => 'Sanidad', 'action' => 'registro_mortalidad', 'time_range' => 'Recolección y Disposición'],
              ['icon' => '📏', 'title' => 'SEGUIMIENTO BIOMÉTRICO Y MUESTREO', 'room' => 'Biomasa', 'action' => 'seguimiento_biometrico', 'time_range' => 'Peso, Talla y Salud'],
              ['icon' => '⚙️', 'title' => 'MANTENIMIENTO DE FILTROS Y AIREACIÓN', 'room' => 'Sistemas', 'action' => 'mantenimiento_sistemas', 'time_range' => 'Revisión Diaria/Semanal'],
            ];

            foreach ($aquaculture_items as $item): ?>
              <a href="index.php?controller=Acuicultura&action=<?php echo $item['action']; ?>" class="schedule-item-link">
                <div class="schedule-item">
                  <div class="time-slot"><?php echo $item['icon']; ?></div>
                  <div class="lesson">
                    <span><?php echo $item['title']; ?></span>
                    <span><?php echo $item['time_range']; ?></span>
                  </div>
                  <span class="bpa-room"><?php echo $item['room']; ?></span>
                </div>
              </a>
            <?php endforeach; ?>
          </div>
        </section>

        <!-- ======== INFORMACIÓN DERECHA ======== -->
        <section class="info-widgets">
          <div class="latest-marks-card card">
            <h2>Últimos Movimientos</h2>
            <span class="date-context">Semana 40 - Biomasa Cosechada</span>
            <div class="marks-list">
              <i class="fas fa-chevron-left"></i>
              <div class="mark-item">150K</div>
              <div class="mark-item">200K</div>
              <div class="mark-item main-mark">220K</div>
              <div class="mark-item">180K</div>
              <div class="mark-item">250K</div>
              <i class="fas fa-chevron-right"></i>
            </div>
            <div class="mark-details">
              <span class="subject">Biomasa Cosechada</span>
              <span class="test-type">Total en Kilogramos (K)</span>
            </div>
          </div>

          <div class="homeworks-calendar-card card">
            <h2>Planificación & Eventos Críticos</h2>
            <div class="calendar-header">
              <span>Octubre 2025</span>
              <i class="fas fa-chevron-left"></i>
              <i class="fas fa-chevron-right"></i>
            </div>

            <div class="calendar-grid">
              <span class="day-name">Lun</span><span class="day-name">Mar</span><span class="day-name">Mié</span><span class="day-name">Jue</span><span class="day-name">Vie</span><span class="day-name">Sáb</span><span class="day-name">Dom</span>
              <span class="day inactive">29</span><span class="day inactive">30</span><span class="day today has-event">1</span><span class="day has-event">2</span><span class="day">3</span><span class="day">4</span><span class="day">5</span>
              <span class="day">6</span><span class="day today has-event">7</span><span class="day has-event">8</span><span class="day">9</span><span class="day">10</span><span class="day">11</span><span class="day">12</span>
              <span class="day">13</span><span class="day exam">14</span><span class="day exam">15</span><span class="day has-event">16</span><span class="day">17</span><span class="day test">18</span><span class="day active-select">19</span>
              <span class="day today">20</span><span class="day">21</span><span class="day">22</span><span class="day">23</span><span class="day">24</span><span class="day">25</span><span class="day">26</span>
              <span class="day">27</span><span class="day">28</span><span class="day test">29</span><span class="day">30</span><span class="day">31</span><span class="day inactive">1</span><span class="day inactive">2</span>
            </div>

            <div class="calendar-legend">
              <span><i class="dot homework"></i> Tratamiento Sanitario</span>
              <span><i class="dot exam"></i> Cosecha Planificada</span>
              <span><i class="dot test"></i> Mantenimiento Mayor</span>
            </div>
          </div>
        </section>
      </div>
    </main>

    <!-- ======== PANEL DERECHO ======== -->
    <aside class="right-panel">
      <div class="student-info-card">
        <div class="avatar-and-name">
          <img src="https://via.placeholder.com/80" alt="Avatar de Usuario" class="student-avatar">
          <span class="student-name">Augusta Ryan</span>
          <span class="student-role">Jefe de Producción</span>
        </div>

        <div class="detail-box">
          <span>Lotes Activos</span>
          <span class="value">08</span>
          <i class="fas fa-fish"></i>
        </div>

        <div class="detail-box">
          <span>Temperatura Media</span>
          <span class="value">28.5°C</span>
          <i class="fas fa-thermometer-half"></i>
        </div>

        <div class="detail-box">
          <span>Mortalidad Diaria</span>
          <span class="value">0.05%</span>
          <i class="fas fa-skull-crossbones"></i>
        </div>

        <div class
