<?php include __DIR__ . '/../templates/header.php'; ?>

<!-- dashboard completo estilo moderno -->
<div class="app-layout">
    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="brand">
            <div class="logo-circle">C</div>
            <div class="brand-text">
                <h4>CORAQUA</h4>
                <small>Producción</small>
            </div>
        </div>

        <nav class="nav-main">
            <a href="index.php?controller=JefePlanta&action=dashboard" class="nav-item active">
                <i class="fa fa-tachometer-alt"></i> <span>Dashboard</span>
            </a>
            <a href="index.php?controller=JefePlanta&action=moduloInventario" class="nav-item">
                <i class="fa fa-boxes"></i> <span>Inventario</span>
            </a>
            <a href="index.php?controller=JefePlanta&action=moduloPeces" class="nav-item">
                <i class="fa fa-fish"></i> <span>Peces</span>
            </a>
            <a href="index.php?controller=JefePlanta&action=moduloOvas" class="nav-item">
                <i class="fa fa-egg"></i> <span>Ovas</span>
            </a>
            <a href="index.php?controller=JefePlanta&action=reportes" class="nav-item">
                <i class="fa fa-file-alt"></i> <span>Reportes</span>
            </a>
            <a href="index.php?controller=Auth&action=settings" class="nav-item">
                <i class="fa fa-cog"></i> <span>Configuración</span>
            </a>
        </nav>

        <div class="sidebar-footer">
            <small>Usuario:</small>
            <div class="user-mini"><?php echo htmlspecialchars($usuario['nombre']); ?></div>
        </div>
    </aside>

    <!-- MAIN -->
    <main class="main-content">
        <header class="topbar">
            <div class="search-area">
                <input type="search" placeholder="Buscar...">
            </div>

            <div class="top-actions">
                <div class="user-card">
                    <span class="user-name"><?php echo htmlspecialchars($usuario['nombre']); ?></span>
                    <img src="/public/img/user-default.png" alt="user" class="user-avatar">
                </div>
            </div>
        </header>

        <section class="main-body container-fluid">
            <!-- HERO / Greeting -->
            <div class="hero-row">
                <div class="greeting">
                    <h2>Hola, <strong><?php echo htmlspecialchars($usuario['nombre']); ?></strong></h2>
                    <p class="muted">Revisa el estado de producción, inventario y los formularios.</p>
                </div>

                <div class="quick-actions">
                    <a href="index.php?controller=JefePlanta&action=moduloInventario" class="btn btn-primary">
                        <i class="fa fa-box"></i> Abrir Inventario
                    </a>
                    <a href="index.php?controller=JefePlanta&action=moduloOvas" class="btn btn-primary">
                        <i class="fa fa-egg"></i> Ovas
                    </a>
                    <a href="index.php?controller=JefePlanta&action=moduloPeces" class="btn btn-primary">
                        <i class="fa fa-fish"></i> Peces
                    </a>
                </div>
            </div>

            <!-- GRID PRINCIPAL -->
            <div class="grid-dashboard">
                <!-- KPI Cards -->
                <div class="kpis">
                    <div class="kpi card kpi-ovas">
                        <div class="kpi-icon">
                            <i class="fa fa-egg"></i>
                        </div>
                        <div class="kpi-content">
                            <div class="kpi-title">Ovas en incubación</div>
                            <div class="kpi-value"><?php echo $produccion['ovas'] ?? 0; ?></div>
                            <div class="kpi-trend">
                                <i class="fa fa-arrow-up"></i>
                                <span>12% vs mes anterior</span>
                            </div>
                        </div>
                    </div>

                    <div class="kpi card kpi-peces">
                        <div class="kpi-icon">
                            <i class="fa fa-fish"></i>
                        </div>
                        <div class="kpi-content">
                            <div class="kpi-title">Peces en producción</div>
                            <div class="kpi-value"><?php echo $produccion['peces'] ?? 0; ?></div>
                            <div class="kpi-trend">
                                <i class="fa fa-arrow-up"></i>
                                <span>8% vs mes anterior</span>
                            </div>
                        </div>
                    </div>

                    <div class="kpi card kpi-inv">
                        <div class="kpi-icon">
                            <i class="fa fa-boxes"></i>
                        </div>
                        <div class="kpi-content">
                            <div class="kpi-title">Ítems en inventario</div>
                            <div class="kpi-value"><?php echo $produccion['insumos'] ?? 0; ?></div>
                            <div class="kpi-trend">
                                <i class="fa fa-arrow-down"></i>
                                <span>5% vs mes anterior</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Charts -->
                <div class="chart-row">
                    <div class="chart-container card">
                        <div class="card-header">
                            <h5>📊 Resumen de Producción</h5>
                            <div class="chart-actions">
                                <button class="btn-chart active">Semanal</button>
                                <button class="btn-chart">Mensual</button>
                                <button class="btn-chart">Anual</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="productionChart" height="250"></canvas>
                        </div>
                    </div>
                    
                    <div class="small-charts">
                        <div class="card">
                            <div class="card-header">
                                <h6>📈 Eficiencia de Producción</h6>
                            </div>
                            <div class="card-body">
                                <canvas id="efficiencyChart" height="120"></canvas>
                            </div>
                        </div>
                        
                        <div class="card">
                            <div class="card-header">
                                <h6>📦 Estado de Inventario</h6>
                            </div>
                            <div class="card-body">
                                <canvas id="inventoryChart" height="120"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Stats & Quick Actions -->
                <div class="stats-actions-row">
                    <div class="stats-container card">
                        <div class="card-header">
                            <h5>📈 Resumen de Producción</h5>
                        </div>
                        <div class="card-body">
                            <div class="stats-grid">
                                <div class="stat-item">
                                    <div class="stat-label">Total de Lotes</div>
                                    <div class="stat-value"><?php echo $produccion['total_lotes'] ?? 0; ?></div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-label">Total Producido</div>
                                    <div class="stat-value"><?php echo $produccion['total_producido'] ?? 0; ?> unidades</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-label">Eficiencia</div>
                                    <div class="stat-value"><?php echo $produccion['eficiencia'] ?? '0%'; ?></div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-label">Tasa de Supervivencia</div>
                                    <div class="stat-value">94%</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>

                <!-- Right column: Inventario rápido + Accesos -->
                <aside class="panel-right">
                    <div class="card">
                        <div class="card-header">
                            <h6>📦 Últimos insumos</h6>
                        </div>
                        <div class="card-body small-list">
                            <?php if (!empty($insumos)): ?>
                                <ul>
                                    <?php foreach (array_slice($insumos,0,6) as $it): ?>
                                        <li>
                                            <div class="item-info">
                                                <span class="item-name"><?php echo $it['nombre']; ?></span>
                                                <span class="item-category"><?php echo $it['categoria'] ?? 'General'; ?></span>
                                            </div>
                                            <span class="item-stock"><?php echo $it['stock']; ?> <?php echo $it['unidad_medida']; ?></span>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php else: ?>
                                <div class="empty-state">
                                    <i class="fa fa-box-open"></i>
                                    <p>No hay insumos registrados</p>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="card-footer">
                            <a href="index.php?controller=JefePlanta&action=moduloInventario" class="link">Ver inventario completo</a>
                        </div>
                    </div>

                    <div class="card quick-links">
                        <div class="card-header">
                            <h6>🔗 Accesos Rápidos</h6>
                        </div>
                        <div class="card-body">
                            <a href="index.php?controller=JefePlanta&action=moduloOvas" class="quick-link">
                                <i class="fa fa-egg"></i>
                                <span>Control de incubación</span>
                                <i class="fa fa-chevron-right"></i>
                            </a>
                            <a href="index.php?controller=JefePlanta&action=moduloPeces" class="quick-link">
                                <i class="fa fa-fish"></i>
                                <span>Control de peces</span>
                                <i class="fa fa-chevron-right"></i>
                            </a>
                            <a href="index.php?controller=JefePlanta&action=reportes" class="quick-link">
                                <i class="fa fa-chart-bar"></i>
                                <span>Reportes de producción</span>
                                <i class="fa fa-chevron-right"></i>
                            </a>
                        </div>
                    </div>
                </aside>
            </div>
        </section>
    </main>
</div>

<!-- estilos específicos -->
<style>
/* Variables de colores */
:root {
    --primary: #FF7E00;
    --primary-dark: #E67100;
    --primary-light: #FF9A3D;
    --secondary: #4A90E2;
    --secondary-dark: #3A7BC8;
    --secondary-light: #6BA8FF;
    --accent: #FFCC33;
    --text: #333333;
    --text-light: #6B6B6B;
    --text-lighter: #9E9E9E;
    --bg-light: #FFF9F2;
    --bg-white: #FFFFFF;
    --border: rgba(0,0,0,0.06);
    --shadow: 0 6px 18px rgba(0,0,0,0.06);
    --shadow-hover: 0 10px 25px rgba(0,0,0,0.1);
}

/* reset pequeño */
.app-layout { 
    display:flex; 
    min-height:80vh; 
    font-family: "Inter", system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial; 
    color: var(--text); 
    background-color: #f8f9fa;
}

.sidebar { 
    width:240px; 
    background: linear-gradient(180deg, var(--primary) 0%, var(--primary-dark) 100%); 
    color: var(--bg-white); 
    padding:20px; 
    position:fixed; 
    height:100vh; 
    box-shadow: var(--shadow); 
    border-right:1px solid rgba(255,255,255,0.06); 
    z-index: 100;
}

.brand { 
    display:flex; 
    align-items:center; 
    gap:12px; 
    margin-bottom:18px; 
}

.logo-circle{ 
    width:44px; 
    height:44px; 
    background:rgba(255,255,255,0.15); 
    border-radius:10px; 
    display:flex; 
    align-items:center; 
    justify-content:center; 
    font-weight:700; 
    font-size:18px; 
}

.brand-text h4 { 
    margin:0; 
    font-size:16px; 
    font-weight:700; 
    letter-spacing:0.2px; 
}

.brand-text small { 
    opacity:0.9; 
    display:block; 
    margin-top:2px; 
    font-size:12px; 
}

/* nav */
.nav-main { 
    margin-top:8px; 
    display:flex; 
    flex-direction:column; 
    gap:8px; 
}

.nav-item { 
    display:flex; 
    gap:10px; 
    align-items:center; 
    padding:10px 12px; 
    border-radius:8px; 
    color:rgba(255,255,255,0.95); 
    text-decoration:none; 
    font-weight:600; 
    font-size:14px; 
    transition: all 0.2s ease;
}

.nav-item i { 
    width:20px; 
    text-align:center; 
}

.nav-item:hover { 
    background: rgba(255,255,255,0.08); 
    transform: translateX(4px); 
}

.nav-item.active { 
    background: rgba(255,255,255,0.14); 
    box-shadow: inset 0 0 10px rgba(255,255,255,0.03); 
}

.sidebar-footer { 
    position:absolute; 
    bottom:20px; 
    left:20px; 
    right:20px; 
}

.user-mini { 
    margin-top:6px; 
    background:rgba(255,255,255,0.1); 
    padding:6px 8px; 
    border-radius:6px; 
    font-weight:600; 
}

/* main content */
.main-content { 
    margin-left:240px; 
    flex:1; 
    background: linear-gradient(180deg, var(--bg-light) 0%, var(--bg-white) 100%); 
    min-height:100vh; 
}

.topbar { 
    display:flex; 
    justify-content:space-between; 
    align-items:center; 
    padding:18px 28px; 
    border-bottom:1px solid var(--border); 
    background: var(--bg-white);
    position: sticky;
    top: 0;
    z-index: 99;
}

.search-area input[type="search"] { 
    width:360px; 
    padding:10px 12px; 
    border-radius:8px; 
    border:1px solid var(--border); 
    background: var(--bg-light);
}

.user-card { 
    display:flex; 
    align-items:center; 
    gap:10px; 
}

.user-avatar { 
    width:40px; 
    height:40px; 
    border-radius:50%; 
    object-fit:cover; 
}

/* main body */
.main-body { 
    padding:22px 28px; 
}

.hero-row { 
    display:flex; 
    justify-content:space-between; 
    align-items:center; 
    gap:20px; 
    margin-bottom:28px; 
}

.greeting h2 { 
    margin:0; 
    font-size:24px; 
    font-weight: 700;
}

.muted { 
    color: var(--text-light); 
}

/* grid */
.grid-dashboard { 
    display:grid; 
    grid-template-columns: 1fr 320px; 
    gap:22px; 
    align-items:start; 
}

.kpis { 
    display:grid; 
    grid-template-columns: repeat(3, 1fr);
    gap:18px; 
    margin-bottom:18px; 
    grid-column: 1 / -1;
}

.kpi { 
    padding:20px; 
    border-radius:12px; 
    color: var(--text); 
    box-shadow: var(--shadow);
    display: flex;
    align-items: center;
    gap: 16px;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.kpi:hover {
    transform: translateY(-3px);
    box-shadow: var(--shadow-hover);
}

.kpi-icon {
    width: 50px;
    height: 50px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
}

.kpi-content {
    flex: 1;
}

.kpi-title { 
    font-weight:600; 
    font-size:14px; 
    margin-bottom: 4px;
    color: var(--text-light);
}

.kpi-value { 
    font-size:28px; 
    font-weight:800; 
    margin-bottom: 4px;
}

.kpi-trend {
    display: flex;
    align-items: center;
    gap: 4px;
    font-size: 12px;
    color: var(--text-lighter);
}

/* colores KPIs */
.kpi-ovas { 
    background: linear-gradient(135deg, #FFF9F2, #FFEBD6); 
    border-left: 4px solid var(--accent);
}

.kpi-ovas .kpi-icon {
    background: var(--accent);
    color: #1a1200;
}

.kpi-peces { 
    background: linear-gradient(135deg, #F0F7FF, #E1EFFF); 
    border-left: 4px solid var(--secondary);
}

.kpi-peces .kpi-icon {
    background: var(--secondary);
    color: white;
}

.kpi-inv { 
    background: linear-gradient(135deg, #FFF5F0, #FFE8DE); 
    border-left: 4px solid var(--primary);
}

.kpi-inv .kpi-icon {
    background: var(--primary);
    color: white;
}

/* Chart Row */
.chart-row {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 18px;
    margin-bottom: 18px;
}

.chart-container {
    grid-column: 1;
}

.small-charts {
    display: flex;
    flex-direction: column;
    gap: 18px;
}

.card { 
    background: var(--bg-white); 
    border-radius:12px; 
    padding:18px; 
    box-shadow: var(--shadow);
    border: 1px solid var(--border);
}

.card-header { 
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 16px;
}

.card-header h5, .card-header h6 { 
    margin:0; 
    font-size: 16px;
}

.chart-actions {
    display: flex;
    gap: 8px;
}

.btn-chart {
    padding: 6px 12px;
    border-radius: 6px;
    background: transparent;
    border: 1px solid var(--border);
    font-size: 12px;
    cursor: pointer;
    transition: all 0.2s ease;
}

.btn-chart.active {
    background: var(--primary);
    color: white;
    border-color: var(--primary);
}

/* Stats & Actions Row */
.stats-actions-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 18px;
    margin-bottom: 18px;
}

.stats-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
}

.stat-item {
    padding: 12px;
    border-radius: 8px;
    background: var(--bg-light);
}

.stat-label {
    font-size: 12px;
    color: var(--text-light);
    margin-bottom: 4px;
}

.stat-value {
    font-size: 18px;
    font-weight: 700;
}

.form-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 12px;
}

.form-btn {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px;
    border-radius: 8px;
    background: var(--bg-light);
    text-decoration: none;
    color: var(--text);
    transition: all 0.2s ease;
}

.form-btn:hover {
    background: #f0f0f0;
    transform: translateY(-2px);
}

.form-icon {
    width: 40px;
    height: 40px;
    border-radius: 8px;
    background: var(--primary);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
}

.form-info {
    flex: 1;
}

.form-title {
    font-weight: 700;
    font-size: 14px;
}

.form-desc {
    font-size: 12px;
    color: var(--text-light);
}

/* right panel */
.panel-right { 
    display:flex; 
    flex-direction:column; 
    gap:18px; 
    grid-column: 2;
    grid-row: 2 / span 2;
}

.card .small-list ul { 
    list-style:none; 
    padding:0; 
    margin:0; 
    display:flex; 
    flex-direction:column; 
    gap:8px; 
}

.small-list li { 
    display:flex; 
    justify-content:space-between; 
    align-items:center; 
    padding:10px; 
    border-radius:8px; 
    background: var(--bg-light);
    transition: all 0.2s ease;
}

.small-list li:hover {
    background: #f5f5f5;
}

.item-info {
    display: flex;
    flex-direction: column;
}

.item-name {
    font-weight: 600;
    font-size: 14px;
}

.item-category {
    font-size: 11px;
    color: var(--text-lighter);
}

.item-stock {
    font-weight: 700;
    font-size: 14px;
}

.empty-state {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 20px;
    color: var(--text-lighter);
}

.empty-state i {
    font-size: 32px;
    margin-bottom: 8px;
}

.empty-state p {
    margin: 0;
    font-size: 14px;
}

.quick-links .card-body {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.quick-link {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 10px;
    border-radius: 8px;
    text-decoration: none;
    color: var(--text);
    transition: all 0.2s ease;
}

.quick-link:hover {
    background: var(--bg-light);
}

.quick-link i:first-child {
    width: 20px;
    text-align: center;
}

.quick-link span {
    flex: 1;
    font-size: 14px;
}

.quick-link i:last-child {
    color: var(--text-lighter);
}

/* buttons */
.btn { 
    display:inline-block; 
    padding:10px 16px; 
    border-radius:8px; 
    text-decoration:none; 
    font-weight:700; 
    font-size: 14px;
    transition: all 0.2s ease;
}

.btn-primary { 
    background: var(--primary); 
    color: white;
    border: 1px solid var(--primary);
}

.btn-primary:hover {
    background: var(--primary-dark);
    transform: translateY(-2px);
}

/* links */
.link { 
    color: var(--secondary); 
    text-decoration:none; 
    font-weight:700; 
    font-size: 14px;
}

.card-footer { 
    padding-top:12px; 
    border-top: 1px solid var(--border);
    margin-top: 8px;
}

/* responsive */
@media (max-width: 1200px) {
    .grid-dashboard { 
        grid-template-columns: 1fr; 
    }
    
    .panel-right {
        grid-column: 1;
        grid-row: auto;
    }
    
    .chart-row {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 1000px) {
    .sidebar { 
        position:relative; 
        width:100%; 
        height:auto; 
        display:flex; 
        flex-direction:row; 
        align-items:center; 
        padding:10px; 
        gap:10px; 
    }
    
    .main-content { 
        margin-left:0; 
    }
    
    .topbar { 
        padding:10px; 
    }
    
    .kpis {
        grid-template-columns: 1fr;
    }
    
    .stats-actions-row {
        grid-template-columns: 1fr;
    }
}
</style>

<!-- dependencias (FontAwesome y Chart.js) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- script gráfico -->
<script>
// Gráfico principal de producción
const productionCtx = document.getElementById('productionChart').getContext('2d');
const productionChart = new Chart(productionCtx, {
    type: 'line',
    data: {
        labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
        datasets: [
            {
                label: 'Ovas',
                data: [120, 150, 180, 200, 240, 220, 260, 280, 300, 320, 350, 380],
                borderColor: '#FFCC33',
                backgroundColor: 'rgba(255, 204, 51, 0.1)',
                tension: 0.3,
                fill: true
            },
            {
                label: 'Peces',
                data: [800, 850, 900, 950, 1000, 1050, 1100, 1150, 1200, 1250, 1300, 1350],
                borderColor: '#4A90E2',
                backgroundColor: 'rgba(74, 144, 226, 0.1)',
                tension: 0.3,
                fill: true
            }
        ]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { 
                position: 'top',
                labels: {
                    usePointStyle: true,
                    padding: 15
                }
            }
        },
        scales: {
            y: { 
                beginAtZero: true,
                grid: {
                    color: 'rgba(0,0,0,0.05)'
                }
            },
            x: {
                grid: {
                    display: false
                }
            }
        }
    }
});

// Gráfico de eficiencia
const efficiencyCtx = document.getElementById('efficiencyChart').getContext('2d');
const efficiencyChart = new Chart(efficiencyCtx, {
    type: 'doughnut',
    data: {
        labels: ['Eficiencia', 'Pérdidas'],
        datasets: [{
            data: [85, 15],
            backgroundColor: ['#FF7E00', '#E0E0E0'],
            borderWidth: 0
        }]
    },
    options: {
        responsive: true,
        cutout: '70%',
        plugins: {
            legend: {
                display: false
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        return context.label + ': ' + context.raw + '%';
                    }
                }
            }
        }
    }
});

// Gráfico de inventario
const inventoryCtx = document.getElementById('inventoryChart').getContext('2d');
const inventoryChart = new Chart(inventoryCtx, {
    type: 'bar',
    data: {
        labels: ['Alimento', 'Medicamentos', 'Equipos', 'Materiales'],
        datasets: [{
            label: 'Stock',
            data: [75, 40, 60, 85],
            backgroundColor: '#4A90E2',
            borderRadius: 6
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                max: 100,
                ticks: {
                    callback: function(value) {
                        return value + '%';
                    }
                }
            },
            x: {
                grid: {
                    display: false
                }
            }
        }
    }
});
</script>

<?php include __DIR__ . '/../templates/footer.php'; ?>