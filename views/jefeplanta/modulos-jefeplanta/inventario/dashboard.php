<?php 
// Asume que header.php incluye las etiquetas <head> y <body> de inicio,
// y que footer.php incluye las etiquetas de cierre de </body> y </html>.
include __DIR__ . '/../../../templates/header.php'; 
?>

<link rel="stylesheet" href="/sistema-produccion/public/css/style_inventario.css"> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
<div class="dashboard-container">
    <aside class="sidebar">
        <div class="logo">corAqua</div>
        <nav class="main-nav">
            <ul>
                <li class="active"><i class="fas fa-box-open"></i> Inventario</li>
                <li><i class="fas fa-clipboard-list"></i> Registros Diarios</li>
                <li><i class="fas fa-file-alt"></i> Informes BPA</li>
                <li><i class="fas fa-warehouse"></i> Almacén</li>
                <li><i class="fas fa-users-cog"></i> Gestión Personal</li>
                <li><i class="fas fa-bell"></i> Alertas Críticas</li>
                <li><i class="fas fa-cog"></i> Configuración</li>
            </ul>
        </nav>
        <div class="sidebar-image">
            <i class="fas fa-seedling fa-5x" style="color: var(--color-bpa2); opacity: 0.5;"></i>
        </div>
    </aside>

    <main class="main-content">
        <header class="dashboard-header">
            <h1>Panel de Inventario</h1>
            <div class="header-info">
                <span><?php echo date('d F Y, l'); ?></span>
                <i class="fas fa-search"></i>
                <i class="fas fa-bell"></i>
                <div class="user-avatar-mobile">
                    <img src="data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='30' height='30'><circle cx='15' cy='15' r='15' fill='#005b96'/></svg>">
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

                <div class="schedule-list bpa-grid">
                    <?php
                    // Configuración de los BPA
                    $bpa_items = [
                        ['num' => 'N°07', 'title' => 'ALIMENTACIÓN DIARIA', 'icon' => '🧾', 'color' => '#6c72e3', 'room' => 'BPA-7', 'action' => 'bpa7', 'time_range' => 'Registro Matutino', 'css_var' => 'var(--color-bpa1)'],
                        ['num' => 'N°08', 'title' => 'CONTROL DE ALIMENTO EN ALMACÉN', 'icon' => '📦', 'color' => '#8ce1b2', 'room' => 'BPA-8', 'action' => 'bpa8', 'time_range' => 'Inventario Semanal', 'css_var' => 'var(--color-bpa2)'],
                        ['num' => 'N°13', 'title' => 'CONTROL DE SAL EN ALMACÉN', 'icon' => '🧂', 'color' => '#ff8e8e', 'room' => 'BPA-13', 'action' => 'bpa13', 'time_range' => 'Inventario Diario', 'css_var' => 'var(--color-bpa3)'],
                        ['num' => 'N°14', 'title' => 'CONTROL DE MEDICAMENTO', 'icon' => '💊', 'color' => '#ffe08a', 'room' => 'BPA-14', 'action' => 'bpa14', 'time_range' => 'Registro y Uso', 'css_var' => 'var(--color-bpa4)'],
                        ['num' => 'N°16', 'title' => 'DOSIFICACIÓN DE SUPLEMENTOS Y MEDICAMENTOS', 'icon' => '⚗️', 'color' => '#8edcff', 'room' => 'BPA-16', 'action' => 'bpa16', 'time_range' => 'Preparación', 'css_var' => 'var(--color-bpa5)'],
                    ];

                    foreach ($bpa_items as $item):
                    ?>
                        <a href="index.php?controller=Inventario&action=<?php echo $item['action']; ?>" class="schedule-item-link">
                            <div class="schedule-item">
                                <div class="time-slot"><?php echo $item['icon']; ?></div>
                                <div class="lesson" style="--lesson-color: <?php echo $item['css_var']; ?>;">
                                    <span><?php echo $item['title']; ?></span>
                                    <span><?php echo $item['time_range']; ?></span>
                                </div>
                                <span class="room bpa-room"><?php echo $item['room']; ?></span>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
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
                <img src="data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='60' height='60'><circle cx='30' cy='30' r='30' fill='#005b96'/></svg>" alt="Avatar de Usuario" class="student-avatar">
                <span class="student-name">Jefe de Planta</span>
                <span class="student-role">CORAQUA</span>
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

<script src="/sistema-produccion/public/js/script_inventario.js"></script>

<?php include __DIR__ . '/../../../templates/footer.php'; ?>