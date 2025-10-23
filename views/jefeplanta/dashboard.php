<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>Dashboard - CORAQUA / Producción</title>
<link rel="preconnect" href="https://fonts.gstatic.com  " crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">
<style>
  :root{
    --bg: #eaf4f4; /* Fondo general azul pastel */
    --muted: #7a8f8f; /* Ajustado al tono del azul pastel */
    --card: #ffffff;
    --accent1: #f49340; /* Naranja principal */
    --accent2: #fbdcaf; /* Naranja claro para degradado */
    --accent-contrast: #ffffff;
    --sidebar-bg: linear-gradient(180deg, #f49340, #fbdcaf); /* Degradado naranja */
    --radius: 14px;
    --glass: rgba(255,255,255,0.6);
    --shadow: 0 6px 18px rgba(150, 120, 100, 0.12); /* Sombra más cálida */
  }

  *{box-sizing:border-box}
  body{
    margin:0;
    font-family:Inter, system-ui, Arial, sans-serif;
    background:var(--bg);
    color:#222;
    -webkit-font-smoothing:antialiased;
    -moz-osx-font-smoothing:grayscale;
    min-height:100vh;
  }

  /* Layout */
  .app{
    display:grid;
    grid-template-columns: 280px 1fr;
    gap:24px;
    padding:28px;
  }

  /* Sidebar */
  .sidebar{
    background:var(--sidebar-bg);
    border-radius:20px;
    padding:22px;
    color:var(--accent-contrast);
    height:calc(100vh - 56px);
    position:sticky;
    top:28px;
    display:flex;
    flex-direction:column;
    justify-content:space-between;
    transition:all .3s ease;
  }

  .sidebar.collapsed{
    width:88px;
    padding:16px;
  }

  .brand{
    display:flex;
    gap:12px;
    align-items:center;
  }
  .avatar{
    width:52px;height:52px;border-radius:12px;overflow:hidden;border:2px solid rgba(255,255,255,0.25);
    flex:0 0 52px;
  }
  .avatar img{width:100%;height:100%;object-fit:cover;display:block}
  .user{
    line-height:1;
  }
  .user h4{margin:0;font-size:15px;font-weight:700}
  .user p{margin:0;font-size:13px;opacity:.9}

  /* --- Estilo de item de navegación --- */
  nav.sidebar-nav{margin-top:26px}
  .nav-section{display:flex;flex-direction:column;gap:8px}
  .nav-item{
    display:flex;gap:12px;align-items:center;padding:10px;border-radius:10px;
    cursor:pointer;color:rgba(255,255,255,0.92);font-weight:600;
    transition:background .18s, transform .12s;
    text-decoration:none;
  }
  .nav-item:hover{transform:translateY(-2px);background:rgba(255,255,255,0.08);}
  .nav-item.active{
    background:rgba(255,255,255,0.12);
    box-shadow:inset 0 -2px 0 rgba(255,255,255,0.06);
  }
  .nav-icon{
    width:36px;height:36px;border-radius:8px;display:flex;align-items:center;justify-content:center;
    background:rgba(255,255,255,0.12);
    flex:0 0 36px;
  }

  .tools{margin-top:20px;opacity:.95}
  .tools .small{font-size:13px;opacity:.95}

  /* Main content */
  .main{
    padding:22px 18px;
  }
  header.topbar{
    display:flex;align-items:center;gap:16px;margin-bottom:18px;
  }
  .search{
    flex:1;display:flex;align-items:center;gap:12px;
    background:var(--card);padding:12px;border-radius:12px;box-shadow:var(--shadow);
  }
  .search input{
    border:0;outline:0;font-size:15px;width:100%;
    background:transparent;
  }
  .top-actions{display:flex;gap:10px;align-items:center}
  .icon-btn{
    background:var(--card);border-radius:10px;padding:8px 10px;box-shadow:var(--shadow);cursor:pointer;
    display:inline-flex;align-items:center;justify-content:center;
    text-decoration:none;
    color:inherit;
  }
  .toggle-sidebar{
    display:none;
  }

  /* Grid content */
  .grid{
    display:grid;
    grid-template-columns: repeat(3, 1fr);
    gap:18px;
    margin-top:16px;
  }

  .card{
    background:var(--card);
    border-radius:16px;
    padding:16px;
    box-shadow:var(--shadow);
  }

  /* Project card gradient (para KPIs) */
  .project-card{
    background: linear-gradient(180deg, var(--accent1), var(--accent2));
    color:white;
    padding:20px;border-radius:16px;display:flex;flex-direction:column;gap:10px;
  }
  .project-card .meta{display:flex;justify-content:space-between;align-items:center;font-size:13px;opacity:.95}
  .progress{height:8px;background:rgba(255,255,255,0.2);border-radius:6px;overflow:hidden}
  .progress > i{display:block;height:100%;background:white;border-radius:6px}

  /* small white project (para KPIs) */
  .project-card.light{
    background:var(--card);color:var(--accent1);border:1px solid rgba(244, 147, 64, 0.12)
  }

  /* Chart card */
  .chart{
    padding:18px;border-radius:16px;height:200px;display:flex;align-items:center;justify-content:center;
  }

  /* Calendar & list */
  .calendar{
    display:flex;gap:16px;align-items:flex-start;
  }
  .mini-calendar{width:220px;padding:12px;border-radius:12px;background:var(--card);box-shadow:var(--shadow)}
  .mini-calendar .month{display:flex;justify-content:space-between;align-items:center;margin-bottom:8px;font-weight:700}
  .days{display:grid;grid-template-columns:repeat(7,1fr);gap:6px;text-align:center;color:var(--muted);font-size:13px}
  .day-num{padding:8px;border-radius:8px}
  .day-num.today{background:linear-gradient(180deg,#fff4f0,#fffaf8);color:#f49340;font-weight:700}

  /* Messages */
  .messages{display:flex;flex-direction:column;gap:10px}
  .msg{display:flex;gap:12px;align-items:center;padding:10px;border-radius:10px}
  .msg .m-avatar{width:44px;height:44px;border-radius:8px;overflow:hidden}
  .msg .m-avatar img{width:100%;height:100%;object-fit:cover}
  .msg .m-body{flex:1}
  .msg .m-body .name{font-weight:700}
  .msg .m-time{font-size:12px;color:var(--muted)}

  /* Responsive */
  @media (max-width: 1000px){
    .app{grid-template-columns: 84px 1fr; padding:18px}
    .sidebar{height:auto;position:relative;top:0}
    .sidebar.collapsed{width:84px;padding:14px}
    .brand .user{display:none}
    .nav-item span.label{display:none}
    .toggle-sidebar{display:inline-flex}
  }

  @media (max-width: 760px){
    .app{grid-template-columns:1fr;padding:12px}
    .sidebar{
      position:fixed;left:0;top:0;bottom:0;z-index:50;transform:translateX(-110%);
      width:260px;height:100vh;padding:18px;box-shadow:0 20px 60px rgba(0,0,0,0.18);
    }
    .sidebar.open{transform:translateX(0)}
    .sidebar.collapsed{transform:translateX(-110%)}
    .sidebar .user{display:flex}
    .overlay{display:block}
    .grid{grid-template-columns:1fr; margin-top:12px}
  }

  /* small helpers */
  .muted{color:var(--muted)}
  .flex{display:flex;align-items:center;gap:10px}
  .space-between{display:flex;justify-content:space-between;align-items:center}
</style>
</head>
<body>
  <div class="app" id="app">
    <aside class="sidebar" id="sidebar" role="navigation" aria-label="Sidebar">
      <div>
        <div class="brand">
          <div class="avatar" style="background:#fff;color:var(--accent1);display:flex;align-items:center;justify-content:center;font-size:24px;font-weight:800;">
            C
          </div>
          <div class="user">
            <h4>CORAQUA</h4>
            <p style="opacity:.9">Producción</p>
          </div>
        </div>

        <nav class="sidebar-nav" aria-label="Main navigation">
          <div class="nav-section">
            <a href="index.php?controller=JefePlanta&action=dashboard" class="nav-item active">
              <div class="nav-icon">🏠</div><span class="label">Dashboard</span>
            </a>
            <a href="index.php?controller=JefePlanta&action=moduloInventario" class="nav-item">
              <div class="nav-icon">📦</div><span class="label">Inventario</span>
            </a>
            <a href="index.php?controller=JefePlanta&action=moduloPeces" class="nav-item">
              <div class="nav-icon">🐟</div><span class="label">Peces</span>
            </a>
            <a href="index.php?controller=JefePlanta&action=moduloOvas" class="nav-item">
              <div class="nav-icon">🥚</div><span class="label">Ovas</span>
            </a>
            <a href="index.php?controller=JefePlanta&action=reportes" class="nav-item">
              <div class="nav-icon">📊</div><span class="label">Reportes</span>
            </a>
          </div>

          <div style="margin-top:18px" class="nav-section tools">
            <a href="index.php?controller=Auth&action=settings" class="nav-item">
              <div class="nav-icon">⚙️</div><span class="label small">Configuración</span>
            </a>
            <a href="index.php?controller=Auth&action=logout" class="nav-item">
              <div class="nav-icon">🚪</div><span class="label small">Log Out</span>
            </a>
          </div>
        </nav>
      </div>

      <div style="margin-top:16px;font-size:13px;opacity:.95">
        <div style="display:flex;align-items:center;justify-content:space-between">
          <div style="display:flex;gap:8px;align-items:center">
             <span>Usuario:</span>
             <strong style="font-weight:700"><?php echo htmlspecialchars($usuario['nombre']); ?></strong>
          </div>
        </div>
      </div>
    </aside>

    <main class="main">
      <header class="topbar">
        <button class="icon-btn toggle-sidebar" id="btnToggle" title="Toggle sidebar">☰</button>
        <div class="search" role="search">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden><path d="M21 21l-4.35-4.35" stroke="#7a8f8f" stroke-width="1.6" stroke-linecap="round"/></svg>
          <input id="searchInput" placeholder="Buscar..." />
        </div>
        <div class="top-actions">
          <div class="icon-btn" title="New">＋</div>
          <div class="icon-btn" title="Notifications">🔔</div>
          <div class="icon-btn" title="Profile" style="display:flex;gap:8px;align-items:center;padding:6px 10px">
            <img src="/public/img/user-default.png" alt="me" style="width:34px;height:34px;border-radius:8px;object-fit:cover">
          </div>
        </div>
      </header>
      
      <section class="hero-row" style="display:flex;justify-content:space-between;align-items:center;gap:12px;margin-bottom:18px;flex-wrap:wrap;">
        <div class="greeting">
          <h2 style="margin:0">Hola, <strong><?php echo htmlspecialchars($usuario['nombre']); ?></strong></h2>
          <p class="muted" style="margin:4px 0 0 0">Revisa el estado de producción, inventario y los formularios.</p>
        </div>
        
        <div class="quick-actions" style="display:flex;gap:10px;flex-wrap:wrap;">
          <a href="index.php?controller=JefePlanta&action=moduloInventario" class="icon-btn" style="padding:10px 14px;font-weight:600;gap:8px;background:#C3A77F;color:white;">
            📦 <span>Abrir Inventario</span>
          </a>
          <a href="index.php?controller=JefePlanta&action=moduloOvas" class="icon-btn" style="padding:10px 14px;font-weight:600;gap:8px;background:#f49340;color:white;">
            🥚 <span>Ovas</span>
          </a>
          <a href="index.php?controller=JefePlanta&action=moduloPeces" class="icon-btn" style="padding:10px 14px;font-weight:600;gap:8px;background:#96b9b9;color:white;">
            🐟 <span>Peces</span>
          </a>
        </div>
      </section>

      <section class="grid" aria-live="polite">
        
        <div style="display:flex;flex-direction:column;gap:18px">
          <h3 style="margin:0 0 0 4px">Métricas Clave</h3>

          <div class="project-card card">
            <div class="space-between">
              <h4 style="margin:0;font-size:16px;font-weight:600;">Ovas en incubación</h4>
              <div style="font-size:20px;background:rgba(255,255,255,0.12);width:36px;height:36px;border-radius:10px;display:flex;align-items:center;justify-content:center;">🥚</div>
            </div>
            <div style="font-size:36px;font-weight:800;margin:10px 0;">
              <?php echo $produccion['ovas'] ?? 0; ?>
            </div>
            <div class="meta" style="font-size:13px;opacity:1;">
              <span>⬆️ 12% vs mes anterior</span>
            </div>
          </div>

          <div class="project-card light card" style="padding:20px;">
            <div class="space-between">
              <h4 style="margin:0;font-size:16px;font-weight:600;">Peces en producción</h4>
              <div style="font-size:20px;background:rgba(244, 147, 64, 0.12);width:36px;height:36px;border-radius:10px;display:flex;align-items:center;justify-content:center;">🐟</div>
            </div>
            <div style="font-size:36px;font-weight:800;margin:10px 0;">
              <?php echo $produccion['peces'] ?? 0; ?>
            </div>
            <div class="meta" style="font-size:13px;opacity:1;color:#f49340;">
              <span>⬆️ 8% vs mes anterior</span>
            </div>
          </div>

          <div class="card" style="color:#333; padding:20px;">
            <div class="space-between">
              <h4 style="margin:0;font-size:16px;font-weight:600;">Ítems en inventario</h4>
              <div style="font-size:20px;background:rgba(0,0,0,0.05);width:36px;height:36px;border-radius:10px;display:flex;align-items:center;justify-content:center;color:#555">📦</div>
            </div>
            <div style="font-size:36px;font-weight:800;margin:10px 0;">
              <?php echo $produccion['insumos'] ?? 0; ?>
            </div>
            <div class="meta" style="font-size:13px;opacity:1;color:#666;">
              <span>⬇️ 5% vs mes anterior</span>
            </div>
          </div>
        </div>

        <div>
          <h3 style="margin:0 0 6px 4px">Actividad</h3>
          
          <div class="card" style="padding:18px;height:auto;display:block;">
             <div class="card-header" style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px;">
                <h5 style="margin:0;font-size:15px;font-weight:700;">📊 Resumen de Producción</h5>
                <div class="chart-actions" style="display:flex;gap:6px;">
                    <button class="icon-btn" style="padding:6px 10px;font-size:12px;background:#f49340;color:white;border:0;">Semanal</button>
                    <button class="icon-btn" style="padding:6px 10px;font-size:12px;border:0;">Mensual</button>
                    <button class="icon-btn" style="padding:6px 10px;font-size:12px;border:0;">Anual</button>
                </div>
            </div>
            <div class="card-body" style="height:250px;">
                <canvas id="productionChart" style="width:100%;height:100%;"></canvas>
            </div>
          </div>

          <div style="margin-top:18px" class="card">
            <h4 style="margin:0 0 10px 0">New Messages</h4>
            <div style="display:flex;gap:10px;margin-bottom:12px">
              <button class="icon-btn" style="background:#fff;border-radius:12px;border:0;">All</button>
              <button class="icon-btn" style="background:linear-gradient(90deg,#f49340,#fbdcaf);color:#fff;border-radius:12px;border:0;">Teammate</button>
              <button class="icon-btn" style="border:0;">Customer</button>
            </div>
            <div class="messages">
              <div class="msg">
                <div class="m-avatar"><img src="  https://images.unsplash.com/photo-1607746882042-944635dfe10e?q=80&w=200&auto=format&fit=crop" alt=""></div>
                <div class="m-body">
                  <div class="name">Barak <span class="muted" style="font-weight:400">• Hew How Are You</span></div>
                </div>
                <div class="m-time">12:30</div>
              </div>
              <div class="msg">
                <div class="m-avatar"><img src="  https://images.unsplash.com/photo-1542204165-6e5a7f6a13b6?q=80&w=200&auto=format&fit=crop" alt=""></div>
                <div class="m-body">
                  <div class="name">Nikole <span class="muted" style="font-weight:400">• Hew How Are You</span></div>
                </div>
                <div class="m-time">12:36</div>
              </div>
            </div>
          </div>
        </div>

        <div>
          <h3 style="margin:0 0 6px 4px">Eficiencia</h3>

          <div class="card" style="margin-bottom:18px">
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px;">
              <div style="font-weight:700">📈 Eficiencia de Producción</div>
            </div>
            <div class="card-body">
                 <div style="height:120px;border-radius:12px;background:linear-gradient(180deg,#eaf4f4,#d0e8e8);display:flex;align-items:center;justify-content:center;color:var(--muted)">
                   (Gráfica eficiencia)
                 </div>
            </div>
          </div>

          <div class="card">
            <h4 style="margin:0 0 8px 0">Tasks</h4>
            <div style="display:flex;flex-direction:column;gap:8px">
              <div style="display:flex;justify-content:space-between;align-items:center">
                <div class="muted">Design review</div><div style="font-weight:700">4/8</div>
              </div>
              <div style="display:flex;justify-content:space-between;align-items:center">
                <div class="muted">Client call</div><div style="font-weight:700">1/1</div>
              </div>
            </div>
          </div>
          
          <div class="card" style="margin-top:18px; padding:12px;">
             <div class="mini-calendar" aria-hidden style="width:100%; box-shadow:none; padding:0;">
                <div class="month">
                  <strong>May 2021</strong>
                  <div style="display:flex;gap:8px">
                    <button class="icon-btn" style="padding:6px;border:0;">◀</button>
                    <button class="icon-btn" style="padding:6px;border:0;">▶</button>
                  </div>
                </div>
                <div class="days muted" style="margin-top:8px">
                  <div>M</div><div>T</div><div>W</div><div>T</div><div>F</div><div>S</div><div>S</div>
                </div>
                <div class="days" style="margin-top:8px;">
                  <div class="day-num">27</div><div class="day-num">28</div><div class="day-num">29</div><div class="day-num">30</div><div class="day-num">1</div><div class="day-num">2</div><div class="day-num">3</div>
                  <div class="day-num">4</div><div class="day-num">5</div><div class="day-num">6</div><div class="day-num">7</div><div class="day-num">8</div><div class="day-num">9</div><div class="day-num">10</div>
                  <div class="day-num">11</div><div class="day-num">12</div><div class="day-num">13</div><div class="day-num">14</div><div class="day-num">15</div><div class="day-num">16</div><div class="day-num today">17</div>
                  <div class="day-num">18</div><div class="day-num">19</div><div class="day-num">20</div><div class="day-num">21</div><div class="day-num">22</div><div class="day-num">23</div><div class="day-num">24</div>
                </div>
              </div>
          </div>

        </div>

      </section>
    </main>

    <div class="overlay" id="overlay" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.35);z-index:40"></div>
  </div>

<script>
  (function(){
    const sidebar = document.getElementById('sidebar');
    const btn = document.getElementById('btnToggle');
    const overlay = document.getElementById('overlay');
    const app = document.getElementById('app');

    function isMobile() {
      return window.matchMedia('(max-width:760px)').matches;
    }

    function isNarrow(){
      return window.matchMedia('(max-width:1000px)').matches;
    }

    function applyInitialState() {
      if (isMobile()) {
        sidebar.classList.remove('collapsed');
        sidebar.classList.remove('open');
      } else if (isNarrow()) {
        sidebar.classList.add('collapsed');
        sidebar.classList.remove('open');
      } else {
        sidebar.classList.remove('collapsed');
        sidebar.classList.remove('open');
      }
    }

    applyInitialState();
    window.addEventListener('resize', applyInitialState);

    btn.addEventListener('click', function(){
      if (isMobile()) {
        const open = sidebar.classList.toggle('open');
        overlay.style.display = open ? 'block' : 'none';
      } else {
        sidebar.classList.toggle('collapsed');
      }
    });

    overlay.addEventListener('click', function(){
      sidebar.classList.remove('open');
      overlay.style.display = 'none';
    });

    document.addEventListener('keydown', function(e){
      if (e.key === 'Escape') {
        sidebar.classList.remove('open');
        overlay.style.display = 'none';
      }
    });

    document.addEventListener('click', function(e){
      if (!isMobile() && isNarrow()) {
        const path = e.composedPath ? e.composedPath() : (e.path || []);
        if (!path.includes(sidebar) && !path.includes(btn)) {
          sidebar.classList.add('collapsed');
        }
      }
    });

    const search = document.getElementById('searchInput');
    search.addEventListener('input', function(){
      // console.log('Buscar:', search.value)
    });
  })();
</script>
</body>
</html>