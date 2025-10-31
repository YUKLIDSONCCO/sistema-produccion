<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OVAs - Sistema de Producción</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        /* Mismo CSS base que el dashboard de inventario */
        :root {
            --font-family: 'Inter', sans-serif;
            --bg-body: #F7F8FC;
            --bg-container: #FFFFFF;
            --bg-card-dark: #2D2D2D;
            --bg-sidebar-right: #F9F9F9;
            
            --text-primary: #1F2937;
            --text-secondary: #6B7280;
            --text-placeholder: #9CA3AF;
            --text-on-dark: #FFFFFF;
            
            --accent-green: #22C55E;
            --accent-green-light: #D1FAE5;
            --accent-yellow: #FACC15;
            --accent-purple: #9333EA;
            --accent-blue: #3B82F6;
            --accent-orange: #F97316;

            --border-color: #E5E7EB;
            --shadow-light: 0 4px 12px rgba(0, 0, 0, 0.05);
            --radius-main: 1.5rem;
            --radius-card: 1rem;
            --radius-small: 0.5rem;
            
            --padding-main: 1.5rem;
            --padding-card: 1.25rem;
            --gap: 1.5rem;
        }
        
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html, body {
            width: 100%;
            height: 100%;
        }

        body {
            font-family: var(--font-family);
            background-color: var(--bg-body);
            color: var(--text-primary);
            padding: 1rem;
        }

        h1, h2, h3, h4, h5, h6 {
            font-weight: 600;
        }
        
        a {
            text-decoration: none;
            color: inherit;
        }

        /* Estructura principal (igual que inventario) */
        .dashboard-container {
            max-width: 1600px;
            margin: 0 auto;
            background: var(--bg-container);
            border-radius: var(--radius-main);
            box-shadow: var(--shadow-light);
            border: 1px solid var(--border-color);
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .dashboard-header {
            display: flex;
            flex-wrap: wrap; 
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            padding: var(--padding-card) var(--padding-main);
            border-bottom: 1px solid var(--border-color);
        }
        
        .header-left-section {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            flex-wrap: wrap;
        }
        
        .logo-icon {
            background-color: var(--bg-body);
            padding: 0.5rem;
            border-radius: var(--radius-small);
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--border-color);
        }

        .back-button {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background-color: var(--accent-purple);
            color: white;
            padding: 0.6rem 1rem;
            border-radius: var(--radius-small);
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            border: none;
            text-decoration: none;
        }

        .dashboard-content {
            display: flex;
            flex-direction: column;
            flex-grow: 1;
            padding: var(--padding-main);
            gap: var(--gap);
        }

        .content-main {
            display: flex;
            flex-direction: column;
            gap: var(--gap);
        }

        .page-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: var(--gap);
        }
        
        .tab-nav {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
            margin-bottom: 1rem;
            border-bottom: 2px solid var(--border-color);
        }
        .tab-nav-item {
            padding-bottom: 0.75rem;
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--text-secondary);
            border-bottom: 2px solid transparent;
            cursor: pointer;
            transition: all 0.2s ease;
            white-space: nowrap;
        }
        .tab-nav-item.active {
            color: var(--text-primary);
            border-bottom-color: var(--accent-green);
            font-weight: 600;
        }

        .main-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: var(--gap);
        }

        .grid-col-left, .grid-col-center, .grid-col-right {
            display: flex;
            flex-direction: column;
            gap: var(--gap);
        }

        /* Componentes específicos para OVAs */
        .card {
            background-color: var(--bg-container);
            border-radius: var(--radius-card);
            padding: var(--padding-card);
            box-shadow: var(--shadow-light);
            border: 1px solid var(--border-color);
        }
        
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }
        
        .card-header h2 {
            font-size: 1.125rem;
            color: inherit;
        }

        /* OVA Course Card */
        .ova-card {
            display: flex;
            gap: 1rem;
            align-items: center;
        }
        .ova-card .icon-wrapper {
            background-color: var(--bg-body);
            border-radius: var(--radius-small);
            padding: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .ova-card .course-info {
            flex-grow: 1;
        }
        .ova-card .course-info h3 {
            font-size: 1rem;
            margin-bottom: 0.25rem;
        }
        .ova-card .course-info p {
            font-size: 0.875rem;
            color: var(--text-secondary);
        }
        .ova-card .progress-info {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-top: 0.5rem;
        }
        .progress-bar {
            flex-grow: 1;
            height: 6px;
            background-color: var(--border-color);
            border-radius: 3px;
            overflow: hidden;
        }
        .progress-fill {
            height: 100%;
            background-color: var(--accent-green);
            border-radius: 3px;
        }
        .ova-card .progress-text {
            font-size: 0.75rem;
            font-weight: 500;
            color: var(--text-secondary);
            min-width: 40px;
        }
        .ova-card .actions {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            flex-shrink: 0;
        }
        .ova-card .button {
            padding: 0.5rem 0.75rem;
            border-radius: var(--radius-small);
            font-size: 0.875rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            border: none;
        }
        .ova-card .button.continue {
            background-color: var(--accent-green);
            color: white;
        }
        .ova-card .button.start {
            background-color: var(--accent-blue);
            color: white;
        }

        /* Stats Card */
        .stats-hero-card {
            background-color: var(--accent-purple);
            color: var(--text-on-dark);
            padding: var(--padding-card);
            border-radius: var(--radius-card);
            box-shadow: var(--shadow-light);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            gap: 0.5rem;
            min-height: 150px;
        }
        .stats-hero-card .icon {
            color: var(--text-on-dark);
            opacity: 0.7;
            margin-bottom: 0.5rem;
        }
        .stats-hero-card h3 {
            font-size: 1.5rem;
            font-weight: 700;
        }

        /* Sidebar (igual que inventario) */
        .sidebar-right {
            background-color: var(--bg-sidebar-right);
            padding: var(--padding-main);
            border-radius: var(--radius-card);
            display: flex;
            flex-direction: column;
            gap: var(--gap);
            flex-shrink: 0;
            width: 100%;
        }

        .profile-sidebar-card {
            background-color: var(--bg-container);
            border-radius: var(--radius-card);
            padding: var(--padding-card);
            text-align: center;
            box-shadow: var(--shadow-light);
            border: 1px solid var(--border-color);
        }
        .profile-sidebar-card .avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            margin: 0 auto 1rem auto;
            border: 2px solid var(--accent-green-light);
            padding: 3px;
        }

        .profile-stats-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }
        .stat-box {
            background-color: var(--bg-body);
            padding: 1rem;
            border-radius: var(--radius-card);
            text-align: center;
            border: 1px solid var(--border-color);
        }
        .stat-box h4 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
        }

        /* Media Queries */
        @media (min-width: 768px) {
            body { padding: 1.5rem; }
            .dashboard-content { flex-direction: row; }
            .content-main { flex-grow: 1; }
            .sidebar-right { width: 350px; }
            .main-grid { grid-template-columns: 1fr 1fr; }
            .grid-col-left { grid-column: 1 / 3; }
        }
        
        @media (min-width: 1024px) {
            .main-grid { grid-template-columns: 1.5fr 1fr; }
            .grid-col-left { grid-column: auto; }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <header class="dashboard-header">
            <div class="header-left-section">
                <div class="logo-icon">
                    <i data-lucide="monitor-play" class="icon" style="width:24px; height:24px;"></i>
                </div>
                <h1>OVAs</h1>
            </div>
            
            <div class="header-right-section">
                <a href="index.php?controller=Colaborador&action=dashboard" class="back-button">
                    <i data-lucide="arrow-left" style="width:16px; height:16px;"></i>
                    Volver al Dashboard
                </a>
            </div>
        </header>

        <div class="dashboard-content">
            <main class="content-main">
                <h1 class="page-title">Objetos Virtuales de Aprendizaje</h1>

                <nav class="tab-nav">
                    <span class="tab-nav-item active" data-tab="all">TODOS LOS CURSOS</span>
                    <span class="tab-nav-item" data-tab="progress">EN PROGRESO</span>
                    <span class="tab-nav-item" data-tab="completed">COMPLETADOS</span>
                    <span class="tab-nav-item" data-tab="new">NUEVOS</span>
                </nav>

                <div class="main-grid">
                    <div class="grid-col-left">
                        <!-- OVA Course 1 -->
                        <div class="card ova-card">
                            <div class="icon-wrapper">
                                <i data-lucide="graduation-cap" class="icon" style="width:32px; height:32px;"></i>
                            </div>
                            <div class="course-info">
                                <h3>Seguridad en el Trabajo</h3>
                                <p></p>
                                <div class="progress-info">
                                    <div class="progress-bar">
                                        <div class="progress-fill" style="width: 75%"></div>
                                    </div>
                                    <span class="progress-text"></span>
                                </div>
                            </div>
                            <div class="actions">
                                <button class="button continue">CONTINUAR</button>
                            </div>
                        </div>

                        <!-- OVA Course 2 -->
                        <div class="card ova-card">
                            <div class="icon-wrapper">
                                <i data-lucide="shield" class="icon" style="width:32px; height:32px;"></i>
                            </div>
                            <div class="course-info">
                                <h3>Protocolos de Calidad</h3>
                                <p></p>
                                <div class="progress-info">
                                    <div class="progress-bar">
                                        <div class="progress-fill" style="width: 100%"></div>
                                    </div>
                                    <span class="progress-text"></span>
                                </div>
                            </div>
                            <div class="actions">
                                <button class="button continue">CONTINUAR</button>
                            </div>
                        </div>

                        <!-- OVA Course 3 -->
                        <div class="card ova-card">
                            <div class="icon-wrapper">
                                <i data-lucide="settings" class="icon" style="width:32px; height:32px;"></i>
                            </div>
                            <div class="course-info">
                                <h3>Manejo de Equipos</h3>
                                <p></p>
                                <div class="progress-info">
                                    <div class="progress-bar">
                                        <div class="progress-fill" style="width: 25%"></div>
                                    </div>
                                    <span class="progress-text"></span>
                                </div>
                            </div>
                            <div class="actions">
                                <button class="button continue">CONTINUAR</button>
                            </div>
                        </div>
                    </div>

                    <div class="grid-col-center">
                        <!-- Stats Card -->
                        <div class="stats-hero-card">
                            <i data-lucide="award" class="icon" style="width:48px; height:48px;"></i>
                            <h3></h3>
                            <p>Promedio de completación</p>
                        </div>

                        <!-- New Course Card -->

                        <!-- Quick Stats -->
                        <div class="card">
                            <div class="card-header">
                                <h2>Mi Progreso</h2>
                            </div>
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                                <div style="text-align: center;">
                                    <h3 style="font-size: 1.5rem; color: var(--accent-green);">8</h3>
                                    <p style="font-size: 0.875rem; color: var(--text-secondary);">Completados</p>
                                </div>
                                <div style="text-align: center;">
                                    <h3 style="font-size: 1.5rem; color: var(--accent-blue);">5</h3>
                                    <p style="font-size: 0.875rem; color: var(--text-secondary);">En Progreso</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

            <aside class="sidebar-right">
                <div class="profile-sidebar-card">
                    <img src="https://placehold.co/80x80/B3E5FC/03A9F4?text=<?php echo substr($usuario['nombre'], 0, 1); ?>" class="avatar" alt="<?php echo $usuario['nombre']; ?>">
                    <h3><?php echo $usuario['nombre']; ?></h3>
                    <p>PERSONAL DE TRABAJO OVAS</p>
                </div>
            </aside>
        </div>
    </div>

    <script>
        lucide.createIcons();

        document.addEventListener('DOMContentLoaded', function() {
            const tabItems = document.querySelectorAll('.tab-nav-item');
            tabItems.forEach(item => {
                item.addEventListener('click', function() {
                    tabItems.forEach(i => i.classList.remove('active'));
                    this.classList.add('active');
                    console.log(`Pestaña activa: ${this.dataset.tab}`);
                });
            });

            console.log("Dashboard de OVAs inicializado.");
        });
    </script>
</body>
</html>