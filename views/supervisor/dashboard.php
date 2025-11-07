<?php
// views/supervisor/dashboard.php
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Panel del Supervisor</title>
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">
<style>
  :root{
    --bg: #eaf4f4;
    --muted: #6b7a7a;
    --card: #ffffff;
    --accent1: #f49340;       /* Naranja vibrante: PRINCIPAL */
    --accent1-light: #fbdcaf;
    --accent1-dark: #d87e2c;
    --accent2: #3b82f6;       /* Azul complementario */
    --accent-contrast: #ffffff;
    --radius: 16px;
    --shadow: 0 8px 22px rgba(244, 147, 64, 0.15);
    --shadow-card: 0 4px 14px rgba(0, 0, 0, 0.06);
    --color-border: #dbe7e7;
  }
  * { box-sizing: border-box; margin: 0; padding: 0; }
  body {
    font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
    background: var(--bg);
    color: #1e293b;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    min-height: 100vh;
  }
  .app {
    display: grid;
    grid-template-columns: 280px 1fr;
    gap: 28px;
    padding: 32px;
  }

  /* ===== SIDEBAR: NO SE TOCA ===== */
  .sidebar {
    background: linear-gradient(180deg, #f49340, #fbdcaf);
    border-radius: 20px;
    padding: 22px;
    color: var(--accent-contrast);
    height: calc(100vh - 56px);
    position: sticky;
    top: 28px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
  }
  .brand { display: flex; gap: 12px; align-items: center; }
  .avatar {
    width: 52px; height: 52px; border-radius: 12px; overflow: hidden;
    border: 2px solid rgba(255,255,255,0.25);
    display: flex; align-items: center; justify-content: center;
    font-weight: 800; font-size: 24px;
    background: white;
    color: var(--accent1);
  }
  .user h4 { margin: 0; font-size: 15px; font-weight: 700; }
  .user p { margin: 0; font-size: 13px; opacity: 0.9; }
  nav.sidebar-nav { margin-top: 26px; }
  .nav-section { display: flex; flex-direction: column; gap: 8px; }
  .nav-item {
    display: flex; gap: 12px; align-items: center; padding: 10px;
    border-radius: 10px; cursor: pointer; color: rgba(255,255,255,0.92);
    font-weight: 600; text-decoration: none;
    transition: background 0.18s, transform 0.12s;
  }
  .nav-item:hover { transform: translateY(-2px); background: rgba(255,255,255,0.08); }
  .nav-item.active { background: rgba(255,255,255,0.12); }
  .nav-icon {
    width: 36px; height: 36px; border-radius: 8px;
    display: flex; align-items: center; justify-content: center;
    background: rgba(255,255,255,0.12);
  }

  /* Main */
  .main { padding: 22px 18px; }
  .topbar {
    display: flex; align-items: center; gap: 16px; margin-bottom: 18px;
  }
  .search {
    flex: 1; display: flex; align-items: center; gap: 12px;
    background: var(--card); padding: 12px; border-radius: 12px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    border: 1px solid var(--color-border);
  }
  .search input {
    border: 0; outline: 0; font-size: 15px; width: 100%;
    background: transparent;
    color: #222;
  }
  .top-actions { display: flex; gap: 10px; align-items: center; }
  .icon-btn {
    background: var(--card); border-radius: 10px; padding: 8px 10px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    cursor: pointer; text-decoration: none;
    color: inherit;
    display: flex; align-items: center; justify-content: center;
  }

  /* Grid y Cards */
  .page-content { margin-top: 12px; }
  .grid {
    display: grid;
    grid-template-columns: repeat(12, 1fr);
    gap: 22px;
    align-items: start;
  }
  .card {
    background: var(--card);
    border-radius: var(--radius);
    padding: 20px;
    box-shadow: var(--shadow-card);
    border: 1px solid var(--color-border);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
  }
  .card:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 16px rgba(0,0,0,0.08);
  }
  .card.h-100 { display: flex; flex-direction: column; height: 100%; }
  .card-title {
    font-weight: 700;
    font-size: 16px;
    margin: 0 0 12px 0;
    color: #1e293b;
    display: flex;
    align-items: center;
    gap: 8px;
  }
  .muted { color: var(--muted); font-size: 13px; }
  .col-6 { grid-column: span 6; }
  .col-4 { grid-column: span 4; }
  .col-8 { grid-column: span 8; }
  .col-12 { grid-column: span 12; }

  /* Estadísticas */
  .stat { display: flex; gap: 18px; align-items: center; }
  .stat .num { font-size: 22px; font-weight: 800; color: var(--accent1); }
  .stat .label { color: var(--muted); font-weight: 600; }

  /* Insumos */
  .insumos-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 14px;
    margin-top: 12px;
  }
  .insumo-item {
    padding: 14px;
    border-radius: 12px;
    background: linear-gradient(180deg, #ffffff, #fbfdff);
    border: 1px solid var(--color-border);
    box-shadow: 0 2px 6px rgba(0,0,0,0.02);
  }

  /* Personal */
  .employee-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 20px;
    margin-top: 16px;
  }
  .employee-card {
    background-color: var(--card);
    border-radius: 14px;
    border: 1px solid var(--color-border);
    box-shadow: var(--shadow-card);
    overflow: hidden;
    display: flex;
    flex-direction: column;
    transition: all 0.2s ease;
  }
  .employee-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
  }
  .card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 16px;
    border-bottom: 1px solid var(--color-border);
  }
  .department-tag {
    font-size: 12px;
    padding: 6px 12px;
    border-radius: 999px;
    font-weight: 700;
    background-color: #dbe7f5;
    color: var(--accent2);
  }
  .profile-pic {
    width: 76px; height: 76px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid white;
    margin-bottom: 12px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.12);
  }

  /* BPA */
  .bpa-list {
    display: flex;
    flex-direction: column;
    gap: 12px;
    margin-top: 12px;
  }
  .bpa-item {
    display: flex;
    justify-content: space-between;
    gap: 14px;
    align-items: center;
    padding: 14px;
    border-radius: 12px;
    background: var(--card);
    border: 1px solid var(--color-border);
    box-shadow: 0 2px 6px rgba(0,0,0,0.02);
  }

  /* Gráficos: asegurar altura mínima y centrado */
  canvas {
    width: 100% !important;
    height: 140px !important;
    max-height: 160px;
    margin-top: 10px;
  }

  /* Botones de acción */
  .text-end {
    text-align: right;
    margin-top: 20px;
  }
  .text-end a {
    display: inline-block;
    text-decoration: none;
    padding: 12px 20px;
    border-radius: 12px;
    background: var(--accent1);
    color: white;
    font-weight: 700;
    box-shadow: 0 4px 12px rgba(244, 147, 64, 0.3);
    transition: all 0.2s ease;
  }
  .text-end a:hover {
    background: var(--accent1-dark);
    transform: translateY(-2px);
  }

  /* Responsive */
  @media (max-width: 1000px) {
    .app { grid-template-columns: 1fr; padding: 18px; }
    .sidebar { display: none; }
    .col-6, .col-8, .col-4, .col-12 { grid-column: span 12; }
  }
</style>
</head>
<body>
  <div class="app">
    <!-- Sidebar -->
    <aside class="sidebar">
      <div>
        <div class="brand">
          <div class="avatar">R</div>
          <div class="user">
            <h4>Panel Supervisor</h4>
            <p>Producción y equipo</p>
          </div>
        </div>
        <nav class="sidebar-nav">
          <div class="nav-section">
            <a href="index.php?controller=Supervisor&action=dashboard" class="nav-item active">
              <div class="nav-icon">🛠️</div><span>Inicio</span>
            </a>
            <a href="index.php?controller=Supervisor&action=inventarioGeneral" class="nav-item">
              <div class="nav-icon">📦</div><span>Inventarios MPA</span>
            </a>
            <a href="index.php?controller=Supervisor&action=ovas" class="nav-item">
              <div class="nav-icon">🥚</div><span>OVAS MPA</span>
            </a>
            <a href="index.php?controller=JefePlanta&action=peces" class="nav-item">
              <div class="nav-icon">🐟</div><span>Peces MPA</span>
            </a>
          </div>
          <div class="nav-section" style="margin-top:18px;">
            <a href="index.php?controller=Supervisor&action=reportes" class="nav-item">
              <div class="nav-icon">📊</div><span>Reportes</span>
            </a>
          </div>
        </nav>
      </div>
      <div style="font-size:13px; opacity:0.95; margin-top:16px;">
        <div style="display:flex; align-items:center; gap:6px;">
          <span>👤</span>
          <strong><?php echo htmlspecialchars($usuario['nombre'] ?? 'Supervisor'); ?></strong>
        </div>
      </div>
    </aside>

    <!-- Main Content -->
    <main class="main">
      <header class="topbar">
        <div class="search">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"></path></svg>
          <input type="text" placeholder="Buscar..." id="searchMain">
        </div>
        <div class="top-actions">
          <div class="icon-btn" style="width:40px;height:40px; padding:0;">
            <img src="<?php echo isset($usuario['avatar']) ? htmlspecialchars($usuario['avatar']) : 'https://i.pravatar.cc/40?img=11'; ?>" alt="Avatar" style="width:100%;height:100%;border-radius:8px;object-fit:cover;">
          </div>
        </div>
      </header>

      <div class="page-content">
        <div style="margin-bottom:18px;">
          <h2 style="margin:0; font-size:22px;">🛠️ Panel del Supervisor</h2>
          <p class="muted">Bienvenido, <strong><?php echo htmlspecialchars($usuario['nombre'] ?? 'Supervisor'); ?></strong></p>
        </div>


        <!-- GRID PRINCIPAL -->
        <section class="grid">
          <!-- Producción -->
          <div class="col-6 card h-100">
            <div>
              <div class="card-title">📈 Producción en Curso</div>
              <p class="muted">Resumen rápido de producción</p>
            </div>
            <div style="margin-top:14px;">
              <div class="stat">
                <div>
                  <div id="totalLotes" class="num"><?php echo intval($produccion['total_lotes'] ?? 0); ?></div>
                  <div class="label">Total de Lotes</div>
                </div>
                <div style="margin-left:22px;">
                  <div id="totalProducido" class="num"><?php echo intval($produccion['total_producido'] ?? 0); ?></div>
                  <div class="label">Total Producido (unidades)</div>
                </div>
              </div>
              <?php if (!empty($produccion['detalles'])): ?>
                <div style="margin-top:14px;">
                  <?php foreach ($produccion['detalles'] as $d): ?>
                    <div style="display:flex; justify-content:space-between; padding:8px 0; border-top:1px dashed var(--color-border);">
                      <div style="font-weight:700;"><?php echo htmlspecialchars($d['label']); ?></div>
                      <div class="muted"><?php echo htmlspecialchars($d['value']); ?></div>
                    </div>
                  <?php endforeach; ?>
                </div>
              <?php else: ?>
                <p class="muted" style="margin-top:12px;">No hay detalles adicionales de producción.</p>
              <?php endif; ?>
            </div>
            <div style="margin-top:24px;">
              <h3 style="font-size:15px; font-weight:700; margin-bottom:8px;">Tendencia de producción</h3>
              <canvas id="produccionChart" height="140"></canvas>
            </div>
          </div>

          <!-- Insumos -->
          <div class="col-6 card">
            <div>
              <div class="card-title">📦 Insumos Asignados</div>
              <p class="muted">Stock actual y unidades</p>
            </div>
            <?php if (!empty($insumos)): ?>
              <div class="insumos-grid">
                <?php foreach ($insumos as $ins): ?>
                  <div class="insumo-item">
                    <div class="name"><?php echo htmlspecialchars($ins['nombre']); ?></div>
                    <div class="meta">Stock: <strong><?php echo htmlspecialchars($ins['stock']); ?></strong> &nbsp;|&nbsp; Unidad: <?php echo htmlspecialchars($ins['unidad_medida']); ?></div>
                    <?php if (!empty($ins['nota'])): ?>
                      <div class="muted" style="margin-top:6px;"><?php echo htmlspecialchars($ins['nota']); ?></div>
                    <?php endif; ?>
                  </div>
                <?php endforeach; ?>
              </div>
            <?php else: ?>
              <p class="muted" style="margin-top:12px;">No hay insumos registrados.</p>
            <?php endif; ?>
          </div>

          <!-- Personal -->
          <div class="col-12 card">
            <div style="display:flex; justify-content:space-between; align-items:center;">
              <div>
                <div class="card-title">👷‍♂️ Personal en Turno</div>
                <div class="muted">Lista de personal activo en este turno</div>
              </div>
              <div class="muted"><?php echo date('d M Y'); ?></div>
            </div>
            <?php if (!empty($personal)): ?>
              <div class="employee-grid" style="margin-top:16px;">
                <?php foreach ($personal as $p):
                  $roleLower = strtolower($p['rol'] ?? '');
                  $tagClass = 'department-tag';
                ?>
                  <div class="employee-card">
                    <div class="card-header">
                      <span class="<?php echo $tagClass; ?>"><?php echo htmlspecialchars($p['rol']); ?></span>
                      <span class="muted">Turno: <?php echo htmlspecialchars($p['turno'] ?? '---'); ?></span>
                    </div>
                    <div style="display:flex; flex-direction:column; align-items:center; padding:18px 16px 14px; text-align:center;">
                      <img class="profile-pic" src="<?php echo !empty($p['avatar']) ? htmlspecialchars($p['avatar']) : 'https://i.pravatar.cc/80?img=12'; ?>" alt="<?php echo htmlspecialchars($p['nombre']); ?>">
                      <h3 style="font-size:16px; font-weight:700; margin:0;"><?php echo htmlspecialchars($p['nombre']); ?></h3>
                      <span class="muted" style="font-size:13px; margin:6px 0;"><?php echo htmlspecialchars($p['id_personal'] ?? ''); ?></span>
                      <p class="muted" style="font-size:13px;">
                        <?php echo htmlspecialchars($p['email'] ?? ''); ?><br>
                        <?php echo htmlspecialchars($p['telefono'] ?? ''); ?>
                      </p>
                    </div>
                    <div style="padding:0 16px 16px; color:var(--muted); font-size:14px;">
                      <p>Rol: <?php echo htmlspecialchars($p['rol']); ?> • Experiencia: <?php echo htmlspecialchars($p['experiencia'] ?? '-'); ?></p>
                      <?php if (!empty($p['salario'])): ?>
                        <p>Salario: <span style="color:#16a34a; font-weight:800;"><?php echo htmlspecialchars($p['salario']); ?></span></p>
                      <?php endif; ?>
                    </div>
                    <div style="padding:12px 16px; border-top:1px solid var(--color-border); display:flex; justify-content:space-between; align-items:center;">
                      <small class="muted">ID: <?php echo htmlspecialchars($p['id_personal'] ?? '-'); ?></small>
                      <a href="index.php?controller=Supervisor&action=perfil&pid=<?php echo urlencode($p['id_personal'] ?? ''); ?>" style="text-decoration:none; font-weight:700; color:var(--accent1);">Ver perfil →</a>
                    </div>
                  </div>
                <?php endforeach; ?>
              </div>
            <?php else: ?>
              <p class="muted" style="margin-top:12px;">No hay personal asignado en este turno.</p>
            <?php endif; ?>
          </div>

          <!-- BPA-1 -->
          <div class="col-8 card">
            <div>
              <div class="card-title">📄 Formularios MPA-1 Recibidos</div>
              <p class="muted">Revisar formularios pendientes</p>
            </div>
            <div id="bpaListContainer">
              <?php if (!empty($bpa1_pendientes)): ?>
                <div class="bpa-list">
                  <?php foreach ($bpa1_pendientes as $i => $b): ?>
                    <div class="bpa-item">
                      <div style="display:flex; gap:12px; align-items:center;">
                        <div style="min-width:36px; height:36px; border-radius:8px; display:flex; align-items:center; justify-content:center; font-weight:800; background:#fbdcaf; color:#f49340;">
                          <?php echo $i+1; ?>
                        </div>
                        <div>
                          <div style="font-weight:700;"><?php echo htmlspecialchars($b['sede']); ?> — <?php echo htmlspecialchars($b['encargado']); ?></div>
                          <div class="muted"><?php echo htmlspecialchars($b['fecha']); ?> · Mes: <?php echo htmlspecialchars($b['mes']); ?></div>
                        </div>
                      </div>
                      <div style="display:flex; gap:8px; align-items:center;">
                        <a href="index.php?controller=Supervisor&action=revisarBPA1&id=<?php echo urlencode($b['id']); ?>" style="padding:8px 12px; border-radius:8px; border:1px solid #f6c84c; background:linear-gradient(180deg,#fff8e6,#fff9ed); text-decoration:none; color:#a47706; font-weight:700;">🔍 Revisar</a>
                      </div>
                    </div>
                  <?php endforeach; ?>
                </div>
              <?php else: ?>
                <p class="muted" style="margin-top:12px;">No hay formularios MPA-1 pendientes de revisión.</p>
              <?php endif; ?>
            </div>
          </div>

          <!-- Acciones -->
          <div class="col-4 card">
            <div>
              <div class="card-title">📑 Acciones y Reportes</div>
              <p class="muted">Accesos rápidos</p>
            </div>
            <div style="margin-top:12px; display:flex; flex-direction:column; gap:10px;">
              <a href="index.php?controller=Supervisor&action=reportes" style="display:inline-block; text-decoration:none; padding:10px 12px; border-radius:10px; background:var(--accent1); color:white; font-weight:700; text-align:center;">Ver Reportes</a>
              <a href="index.php?controller=Supervisor&action=crearIncidencia" style="display:inline-block; text-decoration:none; padding:10px 12px; border-radius:10px; background:var(--card); border:1px solid var(--color-border); text-align:center; font-weight:700; color:#222;">✚ Nueva incidencia</a>
              <a href="index.php?controller=Supervisor&action=insumos" style="display:inline-block; text-decoration:none; padding:10px 12px; border-radius:10px; background:var(--card); border:1px solid var(--color-border); text-align:center; font-weight:700; color:#222;">📦 Gestionar Insumos</a>
            </div>
            <div style="margin-top:16px;">
              <div class="muted">Última sincronización</div>
              <div id="lastSync" style="font-weight:700; margin-top:6px; color:#222;"><?php echo date('d M Y H:i'); ?></div>
            </div>
            <div style="margin-top:14px;">
              <div class="muted">BPA-1: Aprobados vs Pendientes</div>
              <canvas id="bpaStatusChart" style="width:100%;height:140px;margin-top:8px;"></canvas>
            </div>
          </div>
        </section>

        <div class="text-end">
          <a href="index.php?controller=Supervisor&action=reportes">📑 Ver Reportes</a>
        </div>
      </div>
    </main>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
/* ================================
   DASHBOARD SUPERVISOR - SCRIPT COMPLETO
   ================================ */
/* Helper: Safe parse desde PHP */
function safeParsePhp(jsonLike, fallback) {
    try {
        return jsonLike ? jsonLike : fallback;
    } catch {
        return fallback;
    }
}
/* Variables iniciales desde PHP */
let initialGrafico = <?php echo json_encode($produccion['grafico'] ?? null); ?>;
let initialBpaResumen = <?php echo json_encode($bpaResumen ?? ['aprobado' => 0, 'pendiente' => 0]); ?>;

/* --- GRÁFICO DE PRODUCCIÓN --- */
const ctxProd = document.getElementById('produccionChart').getContext('2d');
let chartData = Array.isArray(initialGrafico) ? initialGrafico : [];
let produccionChart = new Chart(ctxProd, {
    type: 'bar',
    data: {
        labels: chartData.map(d => d.label),
        datasets: [{
            label: 'Producción (unidades)',
            data: chartData.map(d => parseFloat(d.value) || 0),
            backgroundColor: 'rgba(244, 147, 64, 0.5)',
            borderColor: 'rgba(244, 147, 64, 1)',
            borderWidth: 1,
            borderRadius: 6
        }]
    },
    options: {
        responsive: true,
        scales: { y: { beginAtZero: true } },
        plugins: { legend: { display: false } }
    }
});

function actualizarTotalesDesdeGrafico() {
    const valores = produccionChart.data.datasets[0].data.map(v => Number(v) || 0);
    const totalProducido = valores.reduce((s, x) => s + x, 0);
    const totalLotes = valores.length;
    document.getElementById('totalProducido').textContent = totalProducido;
    document.getElementById('totalLotes').textContent = totalLotes;
}

async function cargarGraficoInicialSiHaceFalta() {
    if (!chartData || chartData.length === 0) {
        try {
            const resp = await fetch('index.php?controller=Supervisor&action=getProduccionJSON');
            if (!resp.ok) return;
            const data = await resp.json();
            if (Array.isArray(data)) {
                chartData = data.map(d => ({ label: d.label, value: Number(d.value) || 0 }));
                produccionChart.data.labels = chartData.map(d => d.label);
                produccionChart.data.datasets[0].data = chartData.map(d => d.value);
                produccionChart.update();
                actualizarTotalesDesdeGrafico();
            }
        } catch (err) {
            console.error('Error cargando gráfico inicial:', err);
        }
    } else actualizarTotalesDesdeGrafico();
}

let lastGraficoJson = JSON.stringify(chartData);
async function refrescarGrafico() {
    try {
        const resp = await fetch('index.php?controller=Supervisor&action=getProduccionJSON');
        if (!resp.ok) return;
        const data = await resp.json();
        if (!Array.isArray(data)) return;
        const asJson = JSON.stringify(data);
        if (asJson !== lastGraficoJson) {
            lastGraficoJson = asJson;
            chartData = data.map(d => ({ label: d.label, value: Number(d.value) || 0 }));
            produccionChart.data.labels = chartData.map(d => d.label);
            produccionChart.data.datasets[0].data = chartData.map(d => d.value);
            produccionChart.update();
            actualizarTotalesDesdeGrafico();
            document.getElementById('lastSync').textContent = new Date().toLocaleString();
        }
    } catch (err) {
        console.error('Error al actualizar gráfico:', err);
    }
}

/* --- GRÁFICO BPA STATUS --- */
const ctxBpa = document.getElementById('bpaStatusChart').getContext('2d');
let bpaChart = new Chart(ctxBpa, {
    type: 'doughnut',
    data: {
        labels: ['Aprobados', 'Pendientes'],
        datasets: [{
            data: [initialBpaResumen.aprobado || 0, initialBpaResumen.pendiente || 0],
            backgroundColor: ['#16a34a', '#f59e0b'],
            borderWidth: 0,
            hoverOffset: 6
        }]
    },
    options: {
        cutout: '70%',
        plugins: {
            legend: {
                display: true,
                position: 'bottom',
                labels: { color: '#4b5563', font: { size: 12 } }
            }
        }
    }
});

let lastBpaListSnapshot = '';
async function refrescarBpa() {
    try {
        const resp = await fetch('index.php?controller=Supervisor&action=listarBpaAjax&ultimoId=0');
        if (!resp.ok) return;
        const json = await resp.json();
        const nuevos = Array.isArray(json.nuevos) ? json.nuevos : [];
        let aprobados = 0, pendientes = 0;
        nuevos.forEach(r => {
            const estado = (r.estado || r.estado_reporte || '').toLowerCase();
            if (estado.includes('apro')) aprobados++; else pendientes++;
        });
        bpaChart.data.datasets[0].data = [aprobados, pendientes];
        bpaChart.update();
        const snapshot = JSON.stringify(nuevos.map(n => ({
            id: n.id, sede: n.sede, encargado: n.encargado, fecha: n.fecha, mes: n.mes
        })));
        if (snapshot !== lastBpaListSnapshot) {
            lastBpaListSnapshot = snapshot;
            const container = document.getElementById('bpaListContainer');
            if (!container) return;
            if (nuevos.length === 0) {
                container.innerHTML = '<p class="muted" style="margin-top:12px;">No hay formularios BPA-1 pendientes.</p>';
            } else {
                const html = nuevos.slice(0, 8).map((b, i) => `
                    <div class="bpa-item">
                        <div style="display:flex; gap:12px; align-items:center;">
                            <div style="min-width:36px; height:36px; border-radius:8px; display:flex; align-items:center; justify-content:center; font-weight:800; background:#fbdcaf; color:#f49340;">${i + 1}</div>
                            <div>
                                <div style="font-weight:700;">${escapeHtml(b.sede || '')} — ${escapeHtml(b.encargado || '')}</div>
                                <div class="muted">${escapeHtml(b.fecha || '')} · Mes: ${escapeHtml(b.mes || '')}</div>
                            </div>
                        </div>
                        <div style="display:flex; gap:8px; align-items:center;">
                            <a href="index.php?controller=Supervisor&action=revisarBPA1&id=${encodeURIComponent(b.id)}"
                               style="padding:8px 12px; border-radius:8px; border:1px solid #f6c84c;
                                      background:linear-gradient(180deg,#fff8e6,#fff9ed);
                                      text-decoration:none; color:#a47706; font-weight:700;">🔍 Revisar</a>
                        </div>
                    </div>
                `).join('');
                container.innerHTML = '<div class="bpa-list">' + html + '</div>';
            }
        }
    } catch (err) {
        console.error('Error refrescando BPA:', err);
    }
}

function escapeHtml(str) {
    if (!str) return '';
    return String(str)
        .replace(/&/g, '&amp;')
        .replace(/</g, '<')
        .replace(/>/g, '>')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#039;');
}

document.addEventListener('DOMContentLoaded', async () => {
    await cargarGraficoInicialSiHaceFalta();
    actualizarTotalesDesdeGrafico();
    refrescarBpa();
    setInterval(refrescarGrafico, 10000);
    setInterval(refrescarBpa, 10000);

    const searchInput = document.getElementById('searchMain');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const q = this.value.trim().toLowerCase();
            const cards = document.querySelectorAll('.employee-card');
            cards.forEach(c => {
                const text = c.innerText.toLowerCase();
                c.style.display = text.includes(q) ? '' : 'none';
            });
        });
    }
});
</script>
</body>
</html>