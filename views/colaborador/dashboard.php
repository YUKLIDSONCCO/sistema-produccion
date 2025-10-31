<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel del Colaborador - Sistema de Producción</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        /* --- 1. Variables Globales y Reseteo --- */
        :root {
            --font-family: 'Inter', sans-serif;
            --bg-body: #FDFBF8;
            --bg-container: #FFFFFF;
            --bg-sidebar: #F9F9F9;
            --bg-card: #FDFBF8;
            --bg-card-active: #FFFFFF;
            
            --text-primary: #1F2937;
            --text-secondary: #6B7280;
            
            --color-active: #7C3AED;
            --color-active-bg: #F3E8FF;
            --color-active-border: #A855F7;

            --color-positive: #16A34A;
            --color-negative: #DC2626;

            /* Colores de las tarjetas de estadísticas */
            --color-orange-bg: #FFF7ED;
            --color-orange-text: #9A3412;
            --color-blue-bg: #EFF6FF;
            --color-blue-text: #1E40AF;
            --color-purple-bg: #FAF5FF;
            --color-purple-text: #5B21B6;
            --color-red-bg: #FEF2F2;
            --color-red-text: #991B1B;
            --color-yellow-bg: #FEFCE8;
            --color-yellow-text: #854D0E;
            --color-pink-bg: #FDF2F8;
            --color-pink-text: #9D174D;
            --color-green-bg: #F0FDF4;
            --color-green-text: #166534;
            
            --border-color: #F3F4F6;
            --shadow-light: 0 4px 12px rgba(0, 0, 0, 0.05);
            --shadow-medium: 0 8px 16px rgba(0, 0, 0, 0.08);
            --radius-main: 1.5rem;
            --radius-card: 1rem;
            --radius-small: 0.5rem;
            
            --padding-main: 1.5rem;
            --padding-card: 1rem;
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

        /* --- 2. Contenedor Principal --- */
        .dashboard-container {
            max-width: 1600px;
            margin: 0 auto;
            background-color: var(--bg-container);
            border-radius: var(--radius-main);
            box-shadow: var(--shadow-light);
            border: 1px solid var(--border-color);
            overflow: hidden;
        }

        /* --- 3. Encabezado / Navegación --- */
        .dashboard-header {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            padding: var(--padding-card) var(--padding-main);
            border-bottom: 1px solid var(--border-color);
        }
        
        .header-left, .header-right {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }
        
        .header-left {
            flex-wrap: wrap;
        }
        
        .logo {
            font-size: 1.25rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .logo .icon {
            color: var(--color-active);
        }

        .main-nav {
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }
        
        .main-nav a {
            padding: 0.5rem 0.75rem;
            border-radius: var(--radius-small);
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--text-secondary);
            transition: all 0.2s ease;
        }
        
        .main-nav a:hover {
            background-color: var(--border-color);
            color: var(--text-primary);
        }
        
        .main-nav a.active {
            background-color: var(--color-active-bg);
            color: var(--color-active);
            font-weight: 600;
        }
        
        .header-icons {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .header-icons .icon {
            color: var(--text-secondary);
            cursor: pointer;
            transition: color 0.2s ease;
        }
        
        .header-icons .icon:hover {
            color: var(--text-primary);
        }
        
        .avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            object-fit: cover;
            border: 1px solid var(--border-color);
        }

        /* --- 4. Contenido Principal (Layout) --- */
        .dashboard-main {
            display: grid;
            grid-template-columns: 1fr;
            gap: var(--gap);
            padding: var(--padding-main);
        }

        .main-content {
            display: grid;
            grid-template-columns: 1fr;
            gap: var(--gap);
        }
        
        .content-bottom {
            display: grid;
            grid-template-columns: 1fr;
            gap: var(--gap);
        }

        .sidebar-content {
            background-color: var(--bg-sidebar);
            border-radius: var(--radius-card);
            padding: var(--padding-main);
            display: flex;
            flex-direction: column;
            gap: var(--gap);
        }

        /* --- 5. Componentes de Contenido --- */
        
        /* Encabezados de Sección */
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }
        
        .section-header h2 {
            font-size: 1.125rem;
            color: var(--text-primary);
        }
        
        .section-header .icon-group {
            display: flex;
            gap: 0.75rem;
            color: var(--text-secondary);
        }
        .section-header .icon {
            cursor: pointer;
        }

        /* Módulos del Sistema */
        .modules-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .module-card {
            background-color: var(--bg-card);
            border-radius: var(--radius-card);
            padding: var(--padding-card);
            border: 2px solid transparent;
            transition: all 0.3s ease;
            cursor: pointer;
            box-shadow: var(--shadow-light);
        }
        
        .module-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-medium);
            border-color: var(--color-active-border);
        }
        
        .module-card.active {
            background-color: var(--bg-card-active);
            border-color: var(--color-active-border);
        }
        
        .module-header {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 0.75rem;
        }
        
        .module-icon {
            width: 48px;
            height: 48px;
            border-radius: var(--radius-small);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }
        
        .module-info h3 {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 0.25rem;
        }
        
        .module-info p {
            font-size: 0.875rem;
            color: var(--text-secondary);
        }
        
        .module-stats {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid var(--border-color);
        }
        
        .stat {
            text-align: center;
        }
        
        .stat .value {
            font-size: 1.125rem;
            font-weight: 700;
            display: block;
        }
        
        .stat .label {
            font-size: 0.75rem;
            color: var(--text-secondary);
        }

        /* Tareas Asignadas */
        .tasks-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        .task-card {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: var(--padding-card);
            background-color: var(--bg-card);
            border-radius: var(--radius-card);
            border: 2px solid transparent;
            position: relative;
        }
        
        .task-card.active {
            background-color: var(--bg-container);
            border-color: var(--color-active-border);
            box-shadow: var(--shadow-light);
        }
        
        .task-card .avatar {
            width: 40px;
            height: 40px;
        }
        
        .task-card h3 {
            font-size: 0.875rem;
            font-weight: 600;
        }
        
        .task-card p {
            font-size: 0.75rem;
            color: var(--text-secondary);
        }
        
        .tag {
            position: absolute;
            top: -0.75rem;
            left: 50%;
            transform: translateX(-50%);
            font-size: 0.7rem;
            font-weight: 600;
            padding: 0.1rem 0.5rem;
            border-radius: 1rem;
            background-color: var(--color-active-bg);
            color: var(--color-active);
        }
        
        .tag.negative {
            background-color: #FFF1F2;
            color: #E11D48;
            left: auto;
            right: 0.5rem;
            transform: none;
        }
        
        .tag.pending {
            background-color: #FFEED9;
            color: #9A3412;
        }
        
        .tag.completed {
            background-color: #D1FAE5;
            color: #065F46;
        }

        /* Resumen de Producción */
        .production-summary-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1rem;
        }
        
        .stat-card {
            padding: var(--padding-card);
            border-radius: var(--radius-card);
        }
        .stat-card .icon {
            margin-bottom: 0.5rem;
            opacity: 0.8;
        }
        .stat-card p.label {
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 0.25rem;
        }
        .stat-card p.value {
            font-size: 1.5rem;
            font-weight: 700;
            line-height: 1.2;
        }
        .stat-card p.change {
            font-size: 0.75rem;
            font-weight: 500;
        }
        
        /* Colores de tarjetas de estadísticas */
        .stat-card.orange { background-color: var(--color-orange-bg); color: var(--color-orange-text); }
        .stat-card.blue { background-color: var(--color-blue-bg); color: var(--color-blue-text); }
        .stat-card.purple { background-color: var(--color-purple-bg); color: var(--color-purple-text); }
        .stat-card.red { background-color: var(--color-red-bg); color: var(--color-red-text); }
        .stat-card.yellow { background-color: var(--color-yellow-bg); color: var(--color-yellow-text); }
        .stat-card.pink { background-color: var(--color-pink-bg); color: var(--color-pink-text); }
        .stat-card.green { background-color: var(--color-green-bg); color: var(--color-green-text); }
        
        .stat-card p.change.positive { color: var(--color-positive); }
        .stat-card p.change.negative { color: var(--color-negative); }

        /* Tablas */
        .table-container {
            overflow-x: auto;
        }
        
        .data-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.875rem;
        }
        
        .data-table thead {
            background-color: #1F2937;
            color: white;
        }
        
        .data-table th, .data-table td {
            padding: 0.75rem;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
        }
        
        .data-table tbody tr:hover {
            background-color: #F9FAFB;
        }
        
        .data-table .status-badge {
            padding: 0.25rem 0.5rem;
            border-radius: 1rem;
            font-size: 0.75rem;
            font-weight: 600;
        }
        
        .status-badge.pending {
            background-color: #FFEED9;
            color: #9A3412;
        }
        
        .status-badge.in-progress {
            background-color: #DBEAFE;
            color: #1D4ED8;
        }
        
        .status-badge.completed {
            background-color: #D1FAE5;
            color: #065F46;
        }

        /* Insumos Disponibles */
        .supplies-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1rem;
        }
        
        .supply-card {
            padding: var(--padding-card);
            background-color: var(--bg-card);
            border-radius: var(--radius-card);
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .supply-icon {
            width: 48px;
            height: 48px;
            border-radius: var(--radius-small);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }
        
        .supply-info h4 {
            font-size: 0.875rem;
            font-weight: 600;
            margin-bottom: 0.25rem;
        }
        
        .supply-info p {
            font-size: 0.75rem;
            color: var(--text-secondary);
        }
        
        .supply-quantity {
            margin-left: auto;
            font-weight: 700;
            font-size: 1.125rem;
        }

        /* Progreso de Producción */
        .production-progress .card-content {
            padding: var(--padding-card);
            background-color: var(--bg-card);
            border-radius: var(--radius-card);
        }
        .progress-bar-container {
            margin-bottom: 1.5rem;
        }
        .progress-bar-header {
            display: flex;
            justify-content: space-between;
            font-size: 0.875rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        .progress-bar-track {
            width: 100%;
            height: 8px;
            background-color: #E5E7EB;
            border-radius: 4px;
        }
        .progress-bar-fill {
            height: 100%;
            border-radius: 4px;
            background-color: #2563EB;
        }
        
        .task-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }
        .task-item {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 0.5rem;
        }
        .task-info {
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
        }
        .task-info .icon { color: var(--text-secondary); }
        .task-info .icon.done { color: var(--color-positive); }
        .task-item h4 {
            font-size: 0.875rem;
            font-weight: 600;
        }
        .task-item.done h4 {
            text-decoration: line-through;
            color: var(--text-secondary);
        }
        .task-item p {
            font-size: 0.75rem;
            color: var(--text-secondary);
        }
        .task-tag {
            font-size: 0.7rem;
            font-weight: 600;
            padding: 0.1rem 0.5rem;
            border-radius: 1rem;
            white-space: nowrap;
        }
        .task-tag.inventory { background-color: #DBEAFE; color: #1D4ED8; }
        .task-tag.order { background-color: #FFEED9; color: #9A3412; }
        .task-tag.maintenance { background-color: #FEE2E2; color: #991B1B; }
        
        
        /* --- 6. Barra Lateral (Sidebar) --- */
        
        /* Profile Card */
        .profile-card {
            background-color: var(--bg-container);
            border-radius: var(--radius-card);
            padding: var(--padding-card);
            text-align: center;
            box-shadow: var(--shadow-light);
        }
        .profile-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            margin-bottom: 1rem;
            color: var(--text-secondary);
        }
        .profile-header .tag {
            position: static;
            transform: none;
            background-color: #D1FAE5;
            color: #065F46;
        }
        .profile-card .avatar {
            width: 80px;
            height: 80px;
            margin: 0 auto 1rem auto;
        }
        .profile-card h3 {
            font-size: 1.125rem;
            margin-bottom: 0.25rem;
        }
        .profile-card p {
            font-size: 0.875rem;
            color: var(--text-secondary);
            max-width: 250px;
            margin: 0 auto 1rem auto;
        }
        .profile-actions {
            display: flex;
            justify-content: center;
            gap: 0.75rem;
        }
        .profile-actions .action-button {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--bg-card);
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-secondary);
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .profile-actions .action-button:hover {
            background-color: #F3F4F6;
            color: var(--text-primary);
        }
        
        /* Detailed Info */
        .detailed-info {
            background-color: var(--bg-container);
            border-radius: var(--radius-card);
            padding: var(--padding-card);
            box-shadow: var(--shadow-light);
        }
        .info-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem 0;
            border-bottom: 1px solid var(--border-color);
        }
        .info-item:last-child {
            border-bottom: none;
        }
        .info-item p.label {
            font-size: 0.75rem;
            color: var(--text-secondary);
            margin-bottom: 0.1rem;
        }
        .info-item p.value {
            font-size: 0.875rem;
            font-weight: 600;
        }
        .info-item .icon {
            color: var(--text-secondary);
        }

        /* --- 7. Media Queries (Diseño Responsivo) --- */
        
        /* Tablet (por ejemplo, 768px y más) */
        @media (min-width: 768px) {
            body {
                padding: 1.5rem;
            }
            
            /* 2 columnas para módulos */
            .modules-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            /* 2 columnas para el resumen de producción */
            .production-summary-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            /* 2 columnas para tareas */
            .tasks-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            /* 2 columnas para insumos */
            .supplies-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .tag {
                top: -0.6rem;
                left: 1rem;
                transform: none;
            }
            .tag.negative {
                left: auto;
                right: 1rem;
            }
        }
        
        /* Escritorio (por ejemplo, 1024px y más) */
        @media (min-width: 1024px) {
            /* 3 columnas para módulos */
            .modules-grid {
                grid-template-columns: repeat(3, 1fr);
            }
            
            /* 3 columnas para el resumen de producción */
            .production-summary-grid {
                grid-template-columns: repeat(3, 1fr);
            }

            /* Layout principal: 2 columnas (contenido | sidebar) */
            .dashboard-main {
                grid-template-columns: 2fr 1fr;
            }
            
            /* El contenido de la barra lateral se renderiza por separado */
            .sidebar-content {
                padding: var(--padding-main);
            }

            /* 2 columnas para la parte inferior del contenido principal */
            .content-bottom {
                grid-template-columns: 1fr 1fr;
            }
            
            /* 3 columnas para tareas */
            .tasks-grid {
                grid-template-columns: repeat(3, 1fr);
            }
            
            /* 3 columnas para insumos */
            .supplies-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }
        
        /* Ocultar elementos en móvil y mostrarlos en escritorio */
        .hidden-mobile {
            display: none;
        }
        @media (min-width: 768px) {
            .hidden-mobile {
                display: flex;
            }
        }

    </style>
</head>
<body>

    <div class="dashboard-container">
        
        <header class="dashboard-header">
            <div class="header-left">
                <h1 class="logo">
                    <i data-lucide="factory" class="icon"></i>
                    Sistema Producción
                </h1>
                <nav class="main-nav hidden-mobile">
                    <a href="#" class="nav-link active">Dashboard</a>
                    <a href="#" class="nav-link">Tareas</a>
                    <a href="#" class="nav-link">Insumos</a>
                    <a href="#" class="nav-link">Reportes</a>
                    <a href="#" class="nav-link">Producción</a>
                    <a href="#" class="nav-link">Calendario</a>
                </nav>
            </div>
            
            <div class="header-right">
                <div class="header-icons">
                    <i data-lucide="search" class="icon"></i>
                    <i data-lucide="bell" class="icon"></i>
                    <i data-lucide="settings" class="icon"></i>
                    <a href="index.php?controller=Auth&action=logout" title="Cerrar Sesión">
                        <i data-lucide="log-out" class="icon"></i>
                    </a>
                    </div>
                <img src="https://placehold.co/32x32/E0E0E0/B0B0B0?text=<?php echo substr($usuario['nombre'], 0, 1); ?>" class="avatar" alt="User Avatar">
            </div>
        </header>

        <main class="dashboard-main">

            <div class="main-content">
                
                <section class="modules-section">
                    <div class="section-header">
                        <h2>🚀 Módulos del Sistema</h2>
                        <div class="icon-group">
                            <i data-lucide="grid" class="icon" style="width:16px; height:16px;"></i>
                        </div>
                    </div>
                    <div class="modules-grid">
                        <div class="module-card" data-module="inventario">
                            <div class="module-header">
                                <div class="module-icon" style="background-color: #EFF6FF; color: #1E40AF;">
                                    <i data-lucide="package"></i>
                                </div>
                                <div class="module-info">
                                    <h3>Inventario</h3>
                                    <p>Gestión de stock y materiales</p>
                                </div>
                            </div>
                            <div class="module-stats">
                                <div class="stat">
                                    <span class="value"></span>
                                    <span class="label">Items</span>
                                </div>
                                <div class="stat">
                                    <span class="value"></span>
                                    <span class="label">Categorías</span>
                                </div>
                                <div class="stat">
                                    <span class="value"></span>
                                    <span class="label">Disponible</span>
                                </div>
                            </div>
                        </div>

                        <div class="module-card" data-module="ovas">
                            <div class="module-header">
                                <div class="module-icon" style="background-color: #FEF3C7; color: #D97706;">
                                    <i data-lucide="monitor-play"></i>
                                </div>
                                <div class="module-info">
                                    <h3>OVAs</h3>
                                    <p>Objetos Virtuales de Aprendizaje</p>
                                </div>
                            </div>
                            <div class="module-stats">
                                <div class="stat">
                                    <span class="value"></span>
                                    <span class="label">Cursos</span>
                                </div>
                                <div class="stat">
                                    <span class="value"></span>
                                    <span class="label">Completados</span>
                                </div>
                                <div class="stat">
                                    <span class="value"></span>
                                    <span class="label">Progreso</span>
                                </div>
                            </div>
                        </div>

                        <div class="module-card" data-module="peces">
                            <div class="module-header">
                                <div class="module-icon" style="background-color: #D1FAE5; color: #065F46;">
                                    <i data-lucide="fish"></i>
                                </div>
                                <div class="module-info">
                                    <h3>Gestión de Peces</h3>
                                    <p>Control de especies acuáticas</p>
                                </div>
                            </div>
                            <div class="module-stats">
                                <div class="stat">
                                    <span class="value"></span>
                                    <span class="label">Ejemplares</span>
                                </div>
                                <div class="stat">
                                    <span class="value"></span>
                                    <span class="label">Especies</span>
                                </div>
                                <div class="stat">
                                    <span class="value"></span>
                                    <span class="label">Salud</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="tasks-info">
                    <div class="section-header">
                        <h2>📋 Tareas Asignadas</h2>
                    </div>
                    <?php if (!empty($tareas)): ?>
                        <div class="table-container">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Descripción</th>
                                        <th>Estado</th>
                                        <th>Fecha</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($tareas as $t): ?>
                                    <tr>
                                        <td><?php echo $t['id']; ?></td>
                                        <td><?php echo $t['descripcion']; ?></td>
                                        <td>
                                            <span class="status-badge <?php 
                                                if ($t['estado'] == 'Pendiente') echo 'pending';
                                                elseif ($t['estado'] == 'En Progreso') echo 'in-progress';
                                                else echo 'completed';
                                            ?>"><?php echo $t['estado']; ?></span>
                                        </td>
                                        <td><?php echo $t['fecha']; ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="task-card">
                            <i data-lucide="clipboard-x" class="icon"></i>
                            <div>
                                <h3>No tienes tareas asignadas</h3>
                                <p>Consulta con tu supervisor para obtener nuevas asignaciones</p>
                            </div>
                        </div>
                    <?php endif; ?>
                </section>

                <section class="production-summary">
                    <div class="section-header">
                        <h2>Resumen de Producción</h2>
                        <div class="icon-group">
                            <i data-lucide="refresh-cw" class="icon" style="width:16px; height:16px;"></i>
                            <i data-lucide="maximize" class="icon" style="width:16px; height:16px;"></i>
                        </div>
                    </div>
                    <div class="production-summary-grid">
                        <div class="stat-card orange">
                            <i data-lucide="clipboard-check" class="icon"></i>
                            <p class="label">Tareas Completadas</p>
                            <p class="value"></p>
                            <p class="change positive"></p>
                        </div>
                        <div class="stat-card blue">
                            <i data-lucide="clock" class="icon"></i>
                            <p class="label">Horas Trabajadas</p>
                            <p class="value"></p>
                            <p class="change"></p>
                        </div>
                        <div class="stat-card purple">
                            <i data-lucide="target" class="icon"></i>
                            <p class="label">Eficiencia</p>
                            <p class="value"></p>
                            <p class="change positive"></p>
                        </div>
                        <div class="stat-card red">
                            <i data-lucide="alert-triangle" class="icon"></i>
                            <p class="label">Tareas Pendientes</p>
                            <p class="value"></p>
                            <p class="change negative"></p>
                        </div>
                        <div class="stat-card yellow">
                            <i data-lucide="trending-up" class="icon"></i>
                            <p class="label">Productividad</p>
                            <p class="value"></p>
                            <p class="change positive"></p>
                        </div>
                        <div class="stat-card green">
                            <i data-lucide="award" class="icon"></i>
                            <p class="label">Calificación</p>
                            <p class="value"></p>
                            <p class="change positive"></p>
                        </div>
                    </div>
                </section>

                <section class="content-bottom">
                
                    <div class="supplies-available">
                        <div class="section-header">
                            <h2>📦 Insumos Disponibles</h2>
                            <i data-lucide="more-horizontal" class="icon" style="width:16px; height:16px;"></i>
                        </div>
                        <div class="supplies-grid">
                            <div class="supply-card">
                                <div class="supply-icon" style="background-color: #EFF6FF; color: #1E40AF;">
                                    <i data-lucide="package"></i>
                                </div>
                                <div class="supply-info">
                                    <h4>Material Base</h4>
                                    <p>Unidades disponibles</p>
                                </div>
                                <div class="supply-quantity"></div>
                            </div>
                            <div class="supply-card">
                                <div class="supply-icon" style="background-color: #FEF3C7; color: #D97706;">
                                    <i data-lucide="tool"></i>
                                </div>
                                <div class="supply-info">
                                    <h4>Herramientas</h4>
                                    <p>En buen estado</p>
                                </div>
                                <div class="supply-quantity"></div>
                            </div>
                            <div class="supply-card">
                                <div class="supply-icon" style="background-color: #D1FAE5; color: #065F46;">
                                    <i data-lucide="cpu"></i>
                                </div>
                                <div class="supply-info">
                                    <h4>Componentes</h4>
                                    <p>En inventario</p>
                                </div>
                                <div class="supply-quantity"></div>
                            </div>
                        </div>
                    </div>

                    <div class="production-progress">
                        <div class="section-header">
                            <h2>Progreso de Producción</h2>
                            <i data-lucide="more-horizontal" class="icon" style="width:16px; height:16px;"></i>
                        </div>
                        <div class="card-content">
                            <div class="progress-bar-container">
                                <div class="progress-bar-header">
                                    <p>Progreso Semanal</p>
                                    <p></p>
                                </div>
                                <div class="progress-bar-track">
                                    <div class="progress-bar-fill" style="width: 72%"></div>
                                </div>
                            </div>
                            <ul class="task-list">
                                <li class="task-item">
                                    <div class="task-info">
                                        <i data-lucide="clipboard-list" class="icon"></i>
                                        <div>
                                            <h4></h4>
                                            <p>Hoy - Prioridad Alta</p>
                                        </div>
                                    </div>
                                    <span class="task-tag inventory">En Progreso</span>
                                </li>
                                <li class="task-item done">
                                    <div class="task-info">
                                        <i data-lucide="clipboard-check" class="icon done"></i>
                                        <div>
                                            <h4></h4>
                                            <p>Completado ayer</p>
                                        </div>
                                    </div>
                                    <span class="task-tag order">Verificado</span>
                                </li>
                                <li class="task-item">
                                    <div class="task-info">
                                        <i data-lucide="clipboard-list" class="icon"></i>
                                        <div>
                                            <h4>Preparación Materia Prima</h4>
                                            <p>Mañana - Turno Matutino</p>
                                        </div>
                                    </div>
                                    <span class="task-tag maintenance">Pendiente</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </section>
            </div>

            <aside class="sidebar-content">
                
                <div class="profile-card">
                    <div class="profile-header">
                        <i data-lucide="more-horizontal" class="icon"></i>
                        <span class="tag">Activo</span>
                        <i data-lucide="maximize" class="icon"></i>
                    </div>
                    <img src="https://placehold.co/80x80/B3E5FC/03A9F4?text=<?php echo substr($usuario['nombre'], 0, 1); ?>" class="avatar" alt="<?php echo $usuario['nombre']; ?>">
                    <h3><?php echo $usuario['nombre']; ?></h3>
                    <p>Colaborador de Producción - Sistema de Manufactura</p>
                    <div class="profile-actions">
                        <button class="action-button"><i data-lucide="user" class="icon"></i></button>
                        <button class="action-button"><i data-lucide="message-square" class="icon"></i></button>
                        <button class="action-button"><i data-lucide="calendar" class="icon"></i></button>
                        <button class="action-button"><i data-lucide="more-vertical" class="icon"></i></button>
                    </div>
                </div>

                <div class="detailed-info">
                    <div class="section-header" style="margin-bottom: 0;">
                        <h2>Información del Turno</h2>
                        <i data-lucide="settings-2" class="icon"></i>
                    </div>
                    
                    <div class="info-item">
                        <div>
                            <p class="label">Turno Actual</p>
                            <p class="value"></p>
                        </div>
                        <i data-lucide="clock" class="icon"></i>
                    </div>
                    <div class="info-item">
                        <div>
                            <p class="label">Supervisor</p>
                            <p class="value"></p>
                        </div>
                        <i data-lucide="user-check" class="icon"></i>
                    </div>
                    <div class="info-item">
                        <div>
                            <p class="label">Área de Trabajo</p>
                            <p class="value"></p>
                        </div>
                        <i data-lucide="map-pin" class="icon"></i>
                    </div>
                    <div class="info-item">
                        <div>
                            <p class="label">Horas Extras</p>
                            <p class="value"></p>
                        </div>
                        <i data-lucide="watch" class="icon"></i>
                    </div>
                    <div class="info-item">
                        <div>
                            <p class="label">Próximo Descanso</p>
                            <p class="value"></p>
                        </div>
                        <i data-lucide="coffee" class="icon"></i>
                    </div>
                </div>
            </aside>
        </main>
    </div>

    <script>
        // 1. Activar los iconos de Lucide
        lucide.createIcons();

        // 2. Añadir interactividad al menú de navegación
        document.addEventListener('DOMContentLoaded', function() {
            
            // Selecciona todos los enlaces de navegación
            const navLinks = document.querySelectorAll('.nav-link');

            // Función para manejar el clic en un enlace
            function handleNavClick(event) {
                event.preventDefault(); 
                
                // Quita la clase 'active' de todos los enlaces
                navLinks.forEach(function(link) {
                    link.classList.remove('active');
                });
                
                // Añade la clase 'active' solo al enlace que fue clickeado
                event.currentTarget.classList.add('active');
            }

            // Añade un "event listener" a cada enlace
            navLinks.forEach(function(link) {
                link.addEventListener('click', handleNavClick);
            });

            // 3. Manejar clics en los módulos del sistema
            const moduleCards = document.querySelectorAll('.module-card');
            
            function handleModuleClick(event) {
                const module = this.getAttribute('data-module');
                let url = '';
                
                // Definir las URLs de redirección para cada módulo
                switch(module) {
                    case 'inventario':
                        url = 'index.php?controller=Colaborador&action=inventario';
                        break;
                    case 'ovas':
                        url = 'index.php?controller=Colaborador&action=ovas';
                        break;
                    case 'peces':
                        url = 'index.php?controller=Colaborador&action=peces';
                        break;
                    default:
                        console.log('Módulo no reconocido:', module);
                        return;
                }
                
                // Redirigir a la página correspondiente
                window.location.href = url;
            }

            // Añadir event listeners a las tarjetas de módulos
            moduleCards.forEach(function(card) {
                card.addEventListener('click', handleModuleClick);
            });
            
            console.log("Dashboard del Colaborador inicializado.");
        });
    </script>

</body>
</html>