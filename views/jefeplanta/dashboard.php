<?php include __DIR__ . '/../templates/header.php'; ?>

<!-- dashboard completo estilo Taskify adaptado -->
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
                    <a href="index.php?controller=JefePlanta&action=moduloInventario" class="btn btn-ghost">
                        <i class="fa fa-box"></i> Abrir Inventario
                    </a>
                    <a href="index.php?controller=JefePlanta&action=moduloOvas" class="btn btn-ghost">
                        <i class="fa fa-egg"></i> Ovas
                    </a>
                    <a href="index.php?controller=JefePlanta&action=moduloPeces" class="btn btn-ghost">
                        <i class="fa fa-fish"></i> Peces
                    </a>
                </div>
            </div>

            <!-- GRID PRINCIPAL -->
            <div class="grid-dashboard">
                <!-- KPI Cards -->
                <div class="kpis">
                    <div class="kpi card kpi-ovas">
                        <div class="kpi-head">
                            <div class="kpi-title">🥚 Ovas</div>
                            <div class="kpi-value"><?php echo $produccion['ovas'] ?? 0; ?></div>
                        </div>
                        <div class="kpi-sub">En incubación</div>
                    </div>

                    <div class="kpi card kpi-peces">
                        <div class="kpi-head">
                            <div class="kpi-title">🐟 Peces</div>
                            <div class="kpi-value"><?php echo $produccion['peces'] ?? 0; ?></div>
                        </div>
                        <div class="kpi-sub">En producción</div>
                    </div>

                    <div class="kpi card kpi-inv">
                        <div class="kpi-head">
                            <div class="kpi-title">📦 Inventario</div>
                            <div class="kpi-value"><?php echo $produccion['insumos'] ?? 0; ?></div>
                        </div>
                        <div class="kpi-sub">Ítems disponibles</div>
                    </div>
                </div>

                <!-- Chart + Listas -->
                <div class="panel-big">
                    <div class="card chart-card">
                        <div class="card-header">
                            <h5>📊 Estado general</h5>
                            <small class="muted">Comparativa Ovas / Peces / Inventario</small>
                        </div>
                        <div class="card-body">
                            <canvas id="mainChart" height="120"></canvas>
                        </div>
                    </div>

                    <div class="card small-cards-row">
                        <div class="small-card">
                            <h6>Producción total</h6>
                            <div class="big-num"><?php echo $produccion['total_producido'] ?? 0; ?></div>
                            <small class="muted">Total unidades</small>
                        </div>
                        <div class="small-card">
                            <h6>Total de lotes</h6>
                            <div class="big-num"><?php echo $produccion['total_lotes'] ?? 0; ?></div>
                            <small class="muted">Lotes registrados</small>
                        </div>
                        <div class="small-card">
                            <h6>Eficiencia</h6>
                            <div class="big-num"><?php echo $produccion['eficiencia'] ?? '0%'; ?></div>
                            <small class="muted">Objetivo vs real</small>
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
                                            <span class="item-name"><?php echo $it['nombre']; ?></span>
                                            <span class="item-stock"><?php echo $it['stock']; ?> <?php echo $it['unidad_medida']; ?></span>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php else: ?>
                                <p class="muted">No hay insumos registrados.</p>
                            <?php endif; ?>
                        </div>
                        <div class="card-footer">
                            <a href="index.php?controller=JefePlanta&action=moduloInventario" class="link">Ver inventario completo</a>
                        </div>
                    </div>

                    <div class="card quick-forms">
                        <div class="card-header">
                            <h6>Formularios rápidos</h6>
                        </div>
                        <div class="card-body">
                            <a class="btn btn-block" href="views/jefeplanta/modulos/inventario/formato16.php">FORMATO N°16</a>
                            <a class="btn btn-block btn-outline" href="views/jefeplanta/modulos/inventario/formato07.php">FORMATO N°07</a>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h6>Atajos</h6>
                        </div>
                        <div class="card-body">
                            <a href="index.php?controller=JefePlanta&action=moduloOvas" class="link">Control de incubación</a><br>
                            <a href="index.php?controller=JefePlanta&action=moduloPeces" class="link">Control de peces</a>
                        </div>
                    </div>
                </aside>
            </div>
        </section>
    </main>
</div>

<!-- estilos específicos -->
<style>
/* reset pequeño */
.app-layout { display:flex; min-height:80vh; font-family: "Inter", system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial; color:#333; }
.sidebar { width:240px; background: linear-gradient(180deg,#ff7e00 0%, #ffb347 100%); color:#fff; padding:20px; position:fixed; height:100vh; box-shadow: 4px 0 20px rgba(0,0,0,0.06); border-right:1px solid rgba(255,255,255,0.06); }
.brand { display:flex; align-items:center; gap:12px; margin-bottom:18px; }
.logo-circle{ width:44px; height:44px; background:rgba(255,255,255,0.15); border-radius:10px; display:flex; align-items:center; justify-content:center; font-weight:700; font-size:18px; }
.brand-text h4 { margin:0; font-size:16px; font-weight:700; letter-spacing:0.2px; }
.brand-text small { opacity:0.9; display:block; margin-top:2px; font-size:12px; }

/* nav */
.nav-main { margin-top:8px; display:flex; flex-direction:column; gap:8px; }
.nav-item { display:flex; gap:10px; align-items:center; padding:10px 12px; border-radius:8px; color:rgba(255,255,255,0.95); text-decoration:none; font-weight:600; font-size:14px; }
.nav-item i { width:20px; text-align:center; }
.nav-item:hover { background: rgba(255,255,255,0.08); transform: translateX(4px); transition: .18s ease; }
.nav-item.active { background: rgba(255,255,255,0.14); box-shadow: inset 0 0 10px rgba(255,255,255,0.03); }

.sidebar-footer { position:absolute; bottom:20px; left:20px; right:20px; }
.user-mini { margin-top:6px; background:rgba(255,255,255,0.1); padding:6px 8px; border-radius:6px; font-weight:600; }

/* main content */
.main-content { margin-left:240px; flex:1; background: linear-gradient(180deg, #fffaf5 0%, #ffffff 100%); min-height:100vh; }
.topbar { display:flex; justify-content:space-between; align-items:center; padding:18px 28px; border-bottom:1px solid rgba(0,0,0,0.04); }
.search-area input[type="search"] { width:360px; padding:10px 12px; border-radius:8px; border:1px solid rgba(0,0,0,0.06); }
.user-card { display:flex; align-items:center; gap:10px; }
.user-avatar { width:40px; height:40px; border-radius:50%; object-fit:cover; }

/* main body */
.main-body { padding:22px 28px; }
.hero-row { display:flex; justify-content:space-between; align-items:center; gap:20px; margin-bottom:18px; }
.greeting h2 { margin:0; font-size:22px; }
.muted { color: #6b6b6b; }

/* grid */
.grid-dashboard { display:grid; grid-template-columns: 1fr 360px; gap:18px; align-items:start; }
.kpis { display:flex; gap:14px; margin-bottom:8px; }
.kpi { padding:18px; border-radius:12px; color:#fff; box-shadow:0 8px 24px rgba(0,0,0,0.06); min-width:0; flex:1; }
.kpi-head { display:flex; justify-content:space-between; align-items:center; }
.kpi-title { font-weight:700; font-size:14px; opacity:0.95; }
.kpi-value { font-size:24px; font-weight:800; }
.kpi-sub { margin-top:8px; font-size:13px; opacity:0.95; }

/* colores KPIs */
.kpi-ovas { background: linear-gradient(135deg,#ffcc33,#ffb347); color:#1a1200; }
.kpi-peces { background: linear-gradient(135deg,#ff9966,#ff5e62); color:#fff; }
.kpi-inv { background: linear-gradient(135deg,#ff7e5f,#feb47b); color:#fff; }

.panel-big { display:flex; flex-direction:column; gap:14px; }
.card { background:#fff; border-radius:12px; padding:12px; box-shadow:0 6px 18px rgba(0,0,0,0.04); }
.card-header h5 { margin:0; }
.chart-card .card-body { padding:6px 12px 14px 12px; }

.small-cards-row { display:flex; gap:12px; padding:12px; }
.small-card { flex:1; padding:10px; border-radius:8px; background: linear-gradient(180deg,#f8f9fb,#ffffff); text-align:center; }
.small-card .big-num { font-size:20px; font-weight:800; margin-top:6px; }

/* right panel */
.panel-right { display:flex; flex-direction:column; gap:12px; }
.card .small-list ul { list-style:none; padding:0; margin:0; display:flex; flex-direction:column; gap:8px; }
.small-list li { display:flex; justify-content:space-between; align-items:center; padding:8px; border-radius:8px; background: #fffaf2; }
.btn { display:inline-block; padding:8px 12px; border-radius:8px; text-decoration:none; font-weight:700; }
.btn-ghost { background:transparent; border:1px solid rgba(0,0,0,0.06); color:#333; margin-left:8px; }
.btn-block { display:block; width:100%; text-align:center; padding:10px; background:#ff7e00; color:#fff; border-radius:8px; text-decoration:none; margin-bottom:8px; }
.btn-outline { background:transparent; border:1px solid #ff7e00; color:#ff7e00; }

/* links */
.link { color:#4a90e2; text-decoration:none; font-weight:700; }
.card-footer { padding-top:8px; }

/* responsive */
@media (max-width: 1000px) {
    .grid-dashboard { grid-template-columns: 1fr; }
    .sidebar { position:relative; width:100%; height:auto; display:flex; flex-direction:row; align-items:center; padding:10px; gap:10px; }
    .main-content { margin-left:0; }
    .topbar { padding:10px; }
}
</style>

<!-- dependencias (FontAwesome y Chart.js) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- script gráfico -->
<script>
const ctx = document.getElementById('mainChart').getContext('2d');
const chart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Ovas', 'Peces', 'Inventario'],
        datasets: [{
            label: 'Unidades',
            data: [
                <?php echo (int)($produccion['ovas'] ?? 0); ?>,
                <?php echo (int)($produccion['peces'] ?? 0); ?>,
                <?php echo (int)($produccion['insumos'] ?? 0); ?>
            ],
            backgroundColor: ['#ffcc33','#ff9966','#ff7e5f'],
            borderRadius: 8
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { display:false },
            tooltip: { mode:'index', intersect:false }
        },
        scales: {
            y: { beginAtZero:true, ticks:{ precision:0 } }
        }
    }
});
</script>

<?php include __DIR__ . '/../templates/footer.php'; ?>
