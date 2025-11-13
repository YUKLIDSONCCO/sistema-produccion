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
    --bg: #ffffff;
    --muted: #6b7a7a;
    --card: #ffffff;
    --accent1: #f49340;       /* Naranja principal */
    --accent1-light: #fbdcaf;
    --accent1-dark: #d87e2c;
    --accent-contrast: #ffffff;
    --radius: 16px;
    --shadow: 0 8px 22px rgba(244, 147, 64, 0.15);
    --shadow-card: 0 4px 14px rgba(0, 0, 0, 0.06);
    --color-border: #dbe7e7;
    --bg-image: url('https://www.coleccionantamina.com/static/media/book_3/page_2/Pag_152-153.jpg');
  }
  * { box-sizing: border-box; margin: 0; padding: 0; }
  body {
    font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
    background:
      /* Degradado blanco translúcido más suave */
      linear-gradient(135deg, rgba(255, 255, 255, 0.72), rgba(255, 252, 248, 0.72)),
      /* Imagen de fondo */
      var(--bg-image);
    background-size: cover;
    background-attachment: fixed;
    background-position: center;
    color: #1e293b;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    min-height: 100vh;
    overflow-x: hidden;
  }

  .app {
    display: grid;
    grid-template-columns: 280px 1fr;
    gap: 28px;
    padding: 32px;
    min-height: 100vh;
  }

  /* ===== SIDEBAR ===== */
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
  .main { padding: 22px 18px; overflow: hidden; } /* Evitar overflow */
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

  /* Bienvenida */
  .welcome-section {
    background: linear-gradient(135deg, #f49340, #fbdcaf);
    border-radius: var(--radius);
    padding: 30px;
    margin-bottom: 28px;
    color: white;
    box-shadow: var(--shadow);
    text-align: center;
  }
  .welcome-section h1 {
    font-size: 28px;
    margin-bottom: 8px;
    font-weight: 800;
  }
  .welcome-section p {
    opacity: 0.9;
    font-size: 16px;
    max-width: 600px;
    margin: 0 auto;
  }

  /* Grid y Cards */
  .page-content { margin-top: 12px; position: relative; }
  .grid {
    display: grid;
    grid-template-columns: repeat(12, 1fr);
    gap: 22px;
    align-items: start;
  }
  .col-4 { grid-column: span 4; }

  /* Tarjetas de módulos */
  .module-card {
    background: white;
    border-radius: var(--radius);
    padding: 24px;
    box-shadow: var(--shadow-card);
    border: 1px solid var(--color-border);
    transition: all 0.3s ease;
    text-align: center;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 200px;
    position: relative;
    cursor: pointer;
  }
  .module-card:hover {
    transform: translateY(-6px) scale(1.03);
    box-shadow: 0 12px 30px rgba(244, 147, 64, 0.25);
    border-color: var(--accent1);
    background: linear-gradient(135deg, #fff, #fff7ef);
  }
  .module-icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: var(--accent1-light);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 16px;
    font-size: 28px;
    transition: all 0.25s ease;
  }
  .module-card:hover .module-icon {
    background: var(--accent1);
    color: white;
    transform: scale(1.15);
  }
  .module-title {
    font-size: 18px;
    font-weight: 700;
    margin-bottom: 8px;
    color: #1e293b;
  }
  .module-desc {
    color: var(--muted);
    font-size: 14px;
    line-height: 1.4;
  }

  /* Responsive */
  @media (max-width: 1000px) {
    .app { grid-template-columns: 1fr; padding: 18px; }
    .sidebar { display: none; }
    .col-4 { grid-column: span 12; }
    .module-card { height: auto; padding: 20px; }
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
            <a href="#" class="nav-item active" data-url="index.php?controller=Supervisor&action=dashboard">
              <div class="nav-icon">🛠️</div><span>Inicio</span>
            </a>
            <a href="#" class="nav-item" data-url="index.php?controller=Supervisor&action=inventarioGeneral">
              <div class="nav-icon">📦</div><span>Inventarios MPA</span>
            </a>
            <a href="#" class="nav-item" data-url="index.php?controller=Supervisor&action=ovas">
              <div class="nav-icon">🥚</div><span>OVAS MPA</span>
            </a>
            <a href="#" class="nav-item" data-url="index.php?controller=JefePlanta&action=peces">
              <div class="nav-icon">🐟</div><span>Peces MPA</span>
            </a>
          </div>
           <div style="margin-top:18px" class="nav-section tools">
            <a href="index.php?controller=Auth&action=settings" class="nav-item">
              <div class="nav-icon">⚙️</div><span class="label small">Configuración</span>
            </a>
            <a href="index.php?controller=Auth&action=logout" class="nav-item">
              <div class="nav-icon">🚪</div><span class="label small"> Cerrar Sesión</span>
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
      <div class="page-content">
        <!-- Sección de Bienvenida -->
        <section class="welcome-section">
          <h1>¡Bienvenido al Panel del Supervisor!</h1>
          <p>Gestiona eficientemente los recursos y procesos de producción desde este panel centralizado.</p>
        </section>

        <!-- Módulos Principales -->
        <section class="grid">
          <!-- Inventario -->
          <div class="col-4">
            <div class="module-card" data-url="index.php?controller=Supervisor&action=inventarioGeneral">
              <div class="module-icon">📦</div>
              <div class="module-title">Inventario MPA</div>
              <div class="module-desc">Gestiona y controla el inventario de materiales y productos</div>
            </div>
          </div>

          <!-- OVAS -->
          <div class="col-4">
            <div class="module-card" data-url="index.php?controller=Supervisor&action=ovas">
              <div class="module-icon">🥚</div>
              <div class="module-title">OVAS MPA</div>
              <div class="module-desc">Administra el proceso de ovas y su ciclo de producción</div>
            </div>
          </div>

          <!-- Peces -->
          <div class="col-4">
            <div class="module-card" data-url="index.php?controller=JefePlanta&action=peces">
              <div class="module-icon">🐟</div>
              <div class="module-title">Peces MPA</div>
              <div class="module-desc">Control y seguimiento de la producción piscícola</div>
            </div>
          </div>
        </section>
      </div>
    </main>
  </div>

  <script>
    // Script para manejar la navegación entre módulos sin cambiar de página
    document.addEventListener('DOMContentLoaded', function() {
      const pageContent = document.querySelector('.page-content');
      const originalContent = pageContent.innerHTML; // Guardar el contenido original
      
      // Función para cargar contenido de módulo
      function cargarModulo(url) {
        // Mostrar indicador de carga
        pageContent.innerHTML = '<div style="text-align: center; padding: 50px;"><div style="font-size: 18px; color: var(--accent1);">Cargando...</div></div>';
        
        fetch(url)
          .then(response => response.text())
          .then(html => {
            // Parsear el HTML
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            
            // Extraer y agregar estilos al head
            const styles = doc.querySelectorAll('style');
            styles.forEach(style => {
              style.setAttribute('data-dynamic', 'true');
              document.head.appendChild(style.cloneNode(true));
            });
            
            // Extraer enlaces a CSS externos
            const links = doc.querySelectorAll('link[rel="stylesheet"]');
            links.forEach(link => {
              const newLink = document.createElement('link');
              newLink.rel = 'stylesheet';
              newLink.href = link.href;
              newLink.setAttribute('data-dynamic', 'true');
              document.head.appendChild(newLink);
            });
            
            // Extraer el contenido principal
            const mainContent = doc.querySelector('.max-w-5xl') || doc.querySelector('body > div') || doc.body;
            if (mainContent) {
              // Reemplazar todo el contenido de .page-content con el contenido cargado
              pageContent.innerHTML = mainContent.innerHTML;
            } else {
              pageContent.innerHTML = '<p class="muted" style="text-align: center; padding: 50px;">Error al cargar el contenido. Verifica la URL.</p>';
            }
          })
          .catch(error => {
            console.error('Error cargando contenido:', error);
            pageContent.innerHTML = '<p class="muted" style="text-align: center; padding: 50px;">Error al cargar el contenido. Inténtalo de nuevo.</p>';
          });
      }
      
      // Función para volver al dashboard
      function volverDashboard() {
        // Remover estilos agregados dinámicamente
        const addedStyles = document.querySelectorAll('style[data-dynamic]');
        addedStyles.forEach(style => style.remove());
        const addedLinks = document.querySelectorAll('link[data-dynamic]');
        addedLinks.forEach(link => link.remove());
        
        // Restaurar contenido original exactamente
        pageContent.innerHTML = originalContent;
      }
      
      // Eventos para los botones del sidebar
      document.querySelectorAll('.sidebar .nav-item').forEach(item => {
        item.addEventListener('click', function(e) {
          e.preventDefault();
          const url = this.getAttribute('data-url');
          if (url.includes('dashboard')) {
            volverDashboard();
          } else if (url) {
            cargarModulo(url);
          }
        });
      });
      
      // Eventos para los botones de módulos
      document.querySelectorAll('.module-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
          e.preventDefault();
          const url = this.getAttribute('data-url');
          if (url) {
            cargarModulo(url);
          }
        });
      });
    });
  </script>
</body>
</html>
