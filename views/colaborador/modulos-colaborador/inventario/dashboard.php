<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario - Sistema de Producción</title>
    
    <!-- Carga de la fuente Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Carga de la biblioteca de iconos Lucide -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        /* --- 1. Variables Globales y Reseteo --- */
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
        
        img {
            max-width: 100%;
            height: auto;
            display: block;
        }

        /* --- 2. Contenedor Principal del Dashboard --- */
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

        /* --- 3. Encabezado / Barra de Navegación Superior --- */
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
            background-color: var(--accent-blue);
            color: white;
            padding: 0.6rem 1rem;
            border-radius: var(--radius-small);
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            border: none;
            text-decoration: none;
        }

        .main-nav {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .main-nav a {
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--text-secondary);
            transition: color 0.2s ease;
        }
        
        .main-nav a:hover {
            color: var(--text-primary);
        }
        
        .header-right-section {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .header-icon-button {
            background: none;
            border: none;
            cursor: pointer;
            color: var(--text-secondary);
            position: relative;
        }

        /* --- 4. Contenido Principal --- */
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
        
        /* Navegación de Pestañas */
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

        /* Grid de Contenido */
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

        /* --- 5. Componentes de Contenido --- */
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

        /* Inventory Item Card */
        .inventory-card {
            display: flex;
            gap: 1rem;
            align-items: center;
        }
        .inventory-card .icon-wrapper {
            background-color: var(--bg-body);
            border-radius: var(--radius-small);
            padding: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .inventory-card .item-info {
            flex-grow: 1;
        }
        .inventory-card .item-info h3 {
            font-size: 1rem;
            margin-bottom: 0.25rem;
        }
        .inventory-card .item-info p {
            font-size: 0.875rem;
            color: var(--text-secondary);
        }
        .inventory-card .stock-info {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-top: 0.5rem;
        }
        .inventory-card .stock-level {
            font-size: 0.75rem;
            font-weight: 500;
            padding: 0.25rem 0.5rem;
            border-radius: 1rem;
        }
        .stock-level.high { background-color: var(--accent-green-light); color: var(--accent-green); }
        .stock-level.medium { background-color: #FEF3C7; color: #D97706; }
        .stock-level.low { background-color: #FEE2E2; color: #DC2626; }
        .inventory-card .actions {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            flex-shrink: 0;
        }
        .inventory-card .button {
            padding: 0.5rem 0.75rem;
            border-radius: var(--radius-small);
            font-size: 0.875rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            border: none;
        }
        .inventory-card .button.update {
            background-color: var(--accent-blue);
            color: white;
        }
        .inventory-card .button.request {
            background-color: var(--accent-green-light);
            color: var(--accent-green);
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

        /* Alert Card */
        .alert-card {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            background-color: #FEF3C7;
            color: #92400E;
        }
        .alert-card .icon-wrapper {
            background-color: rgba(245, 158, 11, 0.2);
            border-radius: var(--radius-small);
            padding: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .alert-card .info h4 {
            font-size: 1rem;
            margin-bottom: 0.25rem;
        }
        .alert-card .info p {
            font-size: 0.875rem;
            opacity: 0.9;
            margin-bottom: 0.75rem;
        }

        /* --- 6. Barra Lateral Derecha --- */
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

        /* Profile Card */
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
        .profile-sidebar-card h3 {
            font-size: 1.25rem;
            margin-bottom: 0.25rem;
        }

        /* Profile Stats Grid */
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
        .stat-box p {
            font-size: 0.875rem;
            color: var(--text-secondary);
        }

        /* Recent Activity */
        .activity-item {
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
            margin-bottom: 1rem;
        }
        .activity-item .avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            object-fit: cover;
            flex-shrink: 0;
        }
        .activity-item .activity-content {
            flex-grow: 1;
        }
        .activity-item .activity-header {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0.25rem;
        }
        .activity-item .activity-header h5 {
            font-size: 0.875rem;
            font-weight: 600;
        }
        .activity-item .activity-text {
            font-size: 0.875rem;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }
        .activity-item .activity-time {
            font-size: 0.75rem;
            color: var(--text-secondary);
        }

        /* --- 7. Media Queries --- */
        @media (min-width: 768px) {
            body {
                padding: 1.5rem;
            }
            
            .dashboard-content {
                flex-direction: row;
            }
            .content-main {
                flex-grow: 1;
            }
            .sidebar-right {
                width: 350px;
            }
            
            .main-grid {
                grid-template-columns: 1fr 1fr;
            }
            .grid-col-left {
                grid-column: 1 / 3;
            }
        }
        
        @media (min-width: 1024px) {
            .main-grid {
                grid-template-columns: 1.5fr 1fr;
            }
            .grid-col-left {
                grid-column: auto;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <header class="dashboard-header">
            <div class="header-left-section">
                <div class="logo-icon">
                    <i data-lucide="package" class="icon" style="width:24px; height:24px;"></i>
                </div>
                <h1>Inventario</h1>
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
                <h1 class="page-title">Gestión de Inventario</h1>

                <nav class="tab-nav">
                    <span class="tab-nav-item active" data-tab="all">TODOS LOS ITEMS</span>
                    <span class="tab-nav-item" data-tab="low">STOCK BAJO</span>
                    <span class="tab-nav-item" data-tab="categories">CATEGORÍAS</span>
                    <span class="tab-nav-item" data-tab="requests">SOLICITUDES</span>
                </nav>

                <div class="main-grid">
                    <div class="grid-col-left">
                        <!-- Inventory Item 1 -->
                        <div class="card inventory-card">
                            <div class="icon-wrapper">
                                <i data-lucide="package" class="icon" style="width:32px; height:32px;"></i>
                            </div>
                            <div class="item-info">
                                <h3>Material Base A</h3>
                                <p>Categoría: Materia Prima • Código: MAT-001</p>
                                <div class="stock-info">
                                    <span class="stock-level high">Stock Alto</span>
                                    <span style="font-size: 0.875rem; color: var(--text-secondary);">142 unidades</span>
                                </div>
                            </div>
                            <div class="actions">
                                <button class="button update">ACTUALIZAR</button>
                                <button class="button request">SOLICITAR</button>
                            </div>
                        </div>

                        <!-- Inventory Item 2 -->
                        <div class="card inventory-card">
                            <div class="icon-wrapper">
                                <i data-lucide="tool" class="icon" style="width:32px; height:32px;"></i>
                            </div>
                            <div class="item-info">
                                <h3>Herramientas Manuales</h3>
                                <p>Categoría: Equipamiento • Código: EQP-015</p>
                                <div class="stock-info">
                                    <span class="stock-level medium">Stock Medio</span>
                                    <span style="font-size: 0.875rem; color: var(--text-secondary);">28 unidades</span>
                                </div>
                            </div>
                            <div class="actions">
                                <button class="button update">ACTUALIZAR</button>
                                <button class="button request">SOLICITAR</button>
                            </div>
                        </div>

                        <!-- Inventory Item 3 -->
                        <div class="card inventory-card">
                            <div class="icon-wrapper">
                                <i data-lucide="cpu" class="icon" style="width:32px; height:32px;"></i>
                            </div>
                            <div class="item-info">
                                <h3>Componentes Electrónicos</h3>
                                <p>Categoría: Electrónica • Código: ELEC-023</p>
                                <div class="stock-info">
                                    <span class="stock-level low">Stock Bajo</span>
                                    <span style="font-size: 0.875claro; color: var(--text-secondary);">5 unidades</span>
                                </div>
                            </div>
                            <div class="actions">
                                <button class="button update">ACTUALIZAR</button>
                                <button class="button request">SOLICITAR</button>
                            </div>
                        </div>
                    </div>

                    <div class="grid-col-center">
                        <!-- Stats Card -->
                        <div class="stats-hero-card">
                            <i data-lucide="trending-up" class="icon" style="width:48px; height:48px;"></i>
                            <h3>85% Disponibilidad</h3>
                            <p>Total del inventario</p>
                        </div>

                        <!-- Alert Card -->
                        <div class="card alert-card">
                            <div class="icon-wrapper">
                                <i data-lucide="alert-triangle" class="icon" style="width:32px; height:32px;"></i>
                            </div>
                            <div class="info">
                                <h4>Stock Crítico</h4>
                                <p>3 items necesitan reabastecimiento urgente</p>
                            </div>
                        </div>

                        <!-- Quick Stats -->
                        <div class="card">
                            <div class="card-header">
                                <h2>Resumen Rápido</h2>
                            </div>
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                                <div style="text-align: center;">
                                    <h3 style="font-size: 1.5rem; color: var(--accent-green);">142</h3>
                                    <p style="font-size: 0.875rem; color: var(--text-secondary);">Items Totales</p>
                                </div>
                                <div style="text-align: center;">
                                    <h3 style="font-size: 1.5rem; color: var(--accent-orange);">8</h3>
                                    <p style="font-size: 0.875rem; color: var(--text-secondary);">Stock Bajo</p>
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
                    <p>GESTOR DE INVENTARIO</p>
                </div>

                <div class="profile-stats-grid">
                    <div class="stat-box">
                        <h4>142</h4>
                        <p>Items Totales</p>
                    </div>
                    <div class="stat-box">
                        <h4>28</h4>
                        <p>Categorías</p>
                    </div>
                    <div class="stat-box">
                        <h4>85%</h4>
                        <p>Disponibilidad</p>
                    </div>
                    <div class="stat-box">
                        <h4>12</h4>
                        <p>Proveedores</p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h2>Actividad Reciente</h2>
                    </div>
                    <div class="activity-list">
                        <div class="activity-item">
                            <div class="avatar" style="background: #E0F2FE; display: flex; align-items: center; justify-content: center;">
                                <i data-lucide="package" style="width:16px; height:16px; color: var(--accent-blue);"></i>
                            </div>
                            <div class="activity-content">
                                <div class="activity-header">
                                    <h5>Actualización de Stock</h5>
                                </div>
                                <p class="activity-text">Material Base A +20 unidades</p>
                                <span class="activity-time">Hace 2 horas</span>
                            </div>
                        </div>
                        <hr style="margin: 1rem 0;">
                        <div class="activity-item">
                            <div class="avatar" style="background: #FEF3C7; display: flex; align-items: center; justify-content: center;">
                                <i data-lucide="alert-triangle" style="width:16px; height:16px; color: #D97706;"></i>
                            </div>
                            <div class="activity-content">
                                <div class="activity-header">
                                    <h5>Alerta de Stock</h5>
                                </div>
                                <p class="activity-text">Componentes Bajo Mínimo</p>
                                <span class="activity-time">Hace 5 horas</span>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </div>

    <script>
        lucide.createIcons();

        document.addEventListener('DOMContentLoaded', function() {
            // Navegación por pestañas
            const tabItems = document.querySelectorAll('.tab-nav-item');
            tabItems.forEach(item => {
                item.addEventListener('click', function() {
                    tabItems.forEach(i => i.classList.remove('active'));
                    this.classList.add('active');
                    console.log(`Pestaña activa: ${this.dataset.tab}`);
                });
            });

            console.log("Dashboard de Inventario inicializado.");
        });
    </script>
</body>
</html>