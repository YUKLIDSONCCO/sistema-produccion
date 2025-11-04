<?php
// views/supervisor/dashboard.php
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Panel del Supervisor</title>
<style>
        /* (tu CSS original aquí — lo he preservado tal cual) */
        /* ----------------- Theme (del diseño original) ----------------- */
        :root {
            --color-primary: #4a6cfd;
            --color-primary-light: #eef2ff;
            --color-text: #2c3e50;
            --color-text-light: #778ca2;
            --color-bg: #f8f9fa;
            --color-white: #ffffff;
            --color-border: #e5e7eb;

            --tag-operations: #e0f2fe;
            --tag-operations-text: #0284c7;
            --tag-hr: #ede9fe;
            --tag-hr-text: #7c3aed;
            --tag-engineering: #dcfce7;
            --tag-engineering-text: #16a34a;
            --tag-marketing: #fee2e2;
            --tag-marketing-text: #dc2626;
            --tag-entrepreneurship: #fef3c7;
            --tag-entrepreneurship-text: #d97706;
            --tag-support: #e0e7ff;
            --tag-support-text: #4f46e5;

            --radius-lg: 12px;
            --shadow-soft: 0 10px 20px rgba(18, 38, 63, 0.06);
            --container-max: 1200px;
        }

        * { box-sizing: border-box; }
        html,body { height:100%; }
        body {
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial;
            background: var(--color-bg);
            color: var(--color-text);
            -webkit-font-smoothing:antialiased;
            -moz-osx-font-smoothing:grayscale;
            line-height: 1.4;
        }

        .page {
            max-width: var(--container-max);
            margin: 28px auto;
            padding: 0 20px 80px;
        }

        .main-header {
            background-color: var(--color-white);
            border: 1px solid var(--color-border);
            border-radius: 14px;
            padding: 14px 18px;
            display:flex;
            align-items:center;
            justify-content:space-between;
            gap: 16px;
            box-shadow: var(--shadow-soft);
        }
        .brand { display:flex; align-items:center; gap:12px; }
        .logo { width:44px; height:44px; border-radius:10px; display:flex; align-items:center; justify-content:center; font-weight:700; font-size:18px; border:2px solid var(--color-border); background: linear-gradient(180deg, #ffffff 0%, #f6f8ff 100%); }
        .title { font-size:18px; font-weight:700; color:var(--color-text); }
        .subtitle { font-size:13px; color:var(--color-text-light); }
        .header-actions { display:flex; align-items:center; gap:12px; }
        .profile-avatar img { width:40px; height:40px; border-radius:50%; object-fit:cover; border:2px solid var(--color-border); }

        .intro { margin-top:18px; display:flex; align-items:center; justify-content:space-between; gap:12px; }
        .welcome { display:flex; flex-direction:column; gap:4px; }
        .welcome h2 { margin:0; font-size:20px; }
        .lead { margin:0; color:var(--color-text-light); font-size:14px; }

        .filter-bar { display:flex; justify-content:space-between; align-items:center; gap:12px; margin:18px 0; flex-wrap:wrap; }
        .filter-group { display:flex; gap:10px; flex-wrap:wrap; }
        .filter-item { background: var(--color-white); border:1px solid var(--color-border); padding:8px 12px; border-radius:10px; font-weight:600; color:var(--color-text); cursor:pointer; display:flex; gap:8px; align-items:center; box-shadow: 0 1px 0 rgba(0,0,0,0.02); }
        .search-box { display:flex; align-items:center; gap:8px; background:var(--color-white); border:1px solid var(--color-border); padding:8px 12px; border-radius:10px; }
        .search-box input { border:0; outline:0; background:transparent; font-size:14px; color:var(--color-text); }
        .view-toggles { display:flex; gap:8px; }

        .grid { display:grid; grid-template-columns: repeat(12, 1fr); gap:20px; align-items:start; }

        .card { background:var(--color-white); border-radius:var(--radius-lg); border:1px solid var(--color-border); padding:16px; box-shadow: 0 6px 18px rgba(16,24,40,0.03); }
        .card.h-100 { display:flex; flex-direction:column; height:100%; }
        .card-title { font-weight:700; font-size:15px; margin:0 0 8px 0; }
        .muted { color:var(--color-text-light); font-size:13px; }

        .col-6 { grid-column: span 6; }
        .col-4 { grid-column: span 4; }
        .col-8 { grid-column: span 8; }
        .col-12 { grid-column: span 12; }

        .stat { display:flex; gap:14px; align-items:center; }
        .stat .num { font-size:20px; font-weight:800; color:var(--color-primary); }
        .stat .label { color:var(--color-text-light); font-weight:600; }

        .insumos-grid { display:grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap:12px; margin-top:8px; }
        .insumo-item { padding:12px; border-radius:10px; background:linear-gradient(180deg, #ffffff, #fbfdff); border:1px solid var(--color-border); }
        .insumo-item .name { font-weight:700; }
        .insumo-item .meta { color:var(--color-text-light); font-size:13px; }

        .employee-grid { display:grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap:18px; margin-top:12px; }
        .employee-card { background-color: var(--color-white); border-radius: 12px; border: 1px solid var(--color-border); box-shadow: 0 6px 18px rgba(16,24,40,0.03); overflow: hidden; display: flex; flex-direction: column; transition: transform .15s ease, box-shadow .15s ease; }
        .employee-card:hover { transform: translateY(-6px); }
        .card-header { display:flex; justify-content:space-between; align-items:center; padding:14px 16px; border-bottom:1px solid var(--color-border); }
        .department-tag { font-size:12px; padding:6px 10px; border-radius:999px; font-weight:700; }
        .tag-operations { background-color: var(--tag-operations); color: var(--tag-operations-text); }
        .tag-hr { background-color: var(--tag-hr); color: var(--tag-hr-text); }
        .tag-engineering { background-color: var(--tag-engineering); color: var(--tag-engineering-text); }
        .tag-marketing { background-color: var(--tag-marketing); color: var(--tag-marketing-text); }
        .tag-entrepreneurship { background-color: var(--tag-entrepreneurship); color: var(--tag-entrepreneurship-text); }
        .tag-support { background-color: var(--tag-support); color: var(--tag-support-text); }

        .card-profile { display:flex; flex-direction:column; align-items:center; padding:18px 16px 14px; text-align:center; }
        .profile-pic { width:72px; height:72px; border-radius:50%; object-fit:cover; border:3px solid var(--color-white); box-shadow:0 6px 20px rgba(16,24,40,0.06); margin-bottom:10px; }
        .profile-name { font-size:16px; font-weight:700; margin:0; }
        .profile-id { color:var(--color-text-light); font-size:13px; margin-bottom:8px; }

        .card-info { padding:0 16px 16px; color:var(--color-text-light); font-size:14px; }
        .card-info p { margin:6px 0; }
        .salary { color:#16a34a; font-weight:800; }

        .bpa-list { display:flex; flex-direction:column; gap:10px; margin-top:8px; }
        .bpa-item { display:flex; justify-content:space-between; gap:12px; align-items:center; padding:12px; border-radius:10px; background:linear-gradient(180deg,#fff,#fbfdff); border:1px solid var(--color-border); }
        .bpa-meta { display:flex; gap:12px; align-items:center; color:var(--color-text-light); font-size:14px; }

        .modules-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; margin-top: 20px; }
        .module-card { background: var(--color-white); border-radius: var(--radius-lg); border: 1px solid var(--color-border); padding: 20px; box-shadow: var(--shadow-soft); transition: all 0.3s ease; }
        .module-card:hover { transform: translateY(-5px); box-shadow: 0 15px 30px rgba(18, 38, 63, 0.1); }
        .module-header { display: flex; align-items: center; gap: 12px; margin-bottom: 16px; padding-bottom: 12px; border-bottom: 1px solid var(--color-border); }
        .module-icon { width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 20px; font-weight: bold; }
        .jefeplanta-icon { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; }
        .colaborador-icon { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white; }
        .module-title { font-size: 18px; font-weight: 700; margin: 0; }
        .module-subtitle { font-size: 13px; color: var(--color-text-light); margin: 0; }
        .submodules-grid { display: grid; gap: 10px; }
        .submodule-item { display: flex; align-items: center; gap: 12px; padding: 12px; border-radius: 8px; background: var(--color-bg); border: 1px solid var(--color-border); text-decoration: none; color: var(--color-text); transition: all 0.2s ease; }
        .submodule-item:hover { background: var(--color-primary-light); border-color: var(--color-primary); transform: translateX(5px); }
        .submodule-icon { width: 36px; height: 36px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-weight: bold; color: white; }
        .inventario-icon { background: #10b981; }
        .ovas-icon { background: #f59e0b; }
        .peces-icon { background: #3b82f6; }
        .submodule-info { flex: 1; }
        .submodule-name { font-weight: 600; margin: 0; }
        .submodule-desc { font-size: 12px; color: var(--color-text-light); margin: 0; }

        .text-end { text-align:right; margin-top:18px; }

        @media (max-width: 1000px) {
            .col-6 { grid-column: span 12; }
            .col-8 { grid-column: span 12; }
            .col-4 { grid-column: span 12; }
            .col-12 { grid-column: span 12; }
            .intro { flex-direction:column; align-items:flex-start; gap:8px; }
            .modules-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <div class="page">

        <!-- HEADER / NAV -->
        <header class="main-header">
            <div class="brand">
                <div class="logo">R</div>
                <div>
                    <div class="title">Panel del Supervisor</div>
                    <div class="subtitle">Control de producción y equipo</div>
                </div>
            </div>

            <div class="header-actions">
                <div class="muted">Usuario</div>
                <div class="profile-avatar">
                    <img src="<?php echo isset($usuario['avatar']) ? htmlspecialchars($usuario['avatar']) : 'https://i.pravatar.cc/40?img=11'; ?>" alt="Avatar">
                </div>
            </div>
        </header>

        <!-- INTRO + WELCOME -->
        <section class="intro" style="margin-top:14px;">
            <div class="welcome">
                <h2>🛠️ Panel del Supervisor</h2>
                <p class="lead">Bienvenido, <b><?php echo htmlspecialchars($usuario['nombre'] ?? 'Supervisor'); ?></b></p>
            </div>

            <div style="display:flex; gap:10px; align-items:center;">
                <div class="filter-bar" style="margin:0;">
                    <div class="filter-group">
                        <div class="filter-item">Últimos 4 años</div>
                        <div class="filter-item">Todos los departamentos</div>
                        <div class="filter-item">Antigüedad</div>
                        <div class="filter-item">10000-50000 $/a</div>
                    </div>
                    <div class="search-box" style="margin-left:12px;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"></path></svg>
                        <input type="text" placeholder="Buscar..." id="searchMain">
                    </div>
                </div>
            </div>
        </section>

        <!-- MÓDULOS JEFE DE PLANTA Y COLABORADOR -->
        <section class="col-12 card">
            <div class="card-title">🏗️ Módulos de Gestión</div>
            <p class="muted">Accede a los diferentes módulos del sistema</p>
            
            <div class="modules-grid">
                <!-- (módulos preservados) -->
                <div class="module-card">
                    <div class="module-header">
                        <div class="module-icon jefeplanta-icon">JP</div>
                        <div>
                            <h3 class="module-title">Jefe de Planta</h3>
                            <p class="module-subtitle">Gestión administrativa y operativa</p>
                        </div>
                    </div>
                    <div class="submodules-grid">
                        <a href="index.php?controller=Supervisor&action=inventarioGeneral" class="submodule-item">
                            <div class="submodule-icon inventario-icon">📦</div>
                            <div class="submodule-info">
                                <div class="submodule-name">Inventarios BPA</div>
                               
                            </div>
                            <span style="color:var(--color-text-light);">→</span>
                        </a>
                        <a href="index.php?controller=JefePlanta&action=ovas" class="submodule-item">
                            <div class="submodule-icon ovas-icon">🥚</div>
                            <div class="submodule-info">
                                <div class="submodule-name">OVAS</div>
                                <div class="submodule-desc">Control de producción de ovas</div>
                            </div>
                            <span style="color:var(--color-text-light);">→</span>
                        </a>
                        <a href="index.php?controller=JefePlanta&action=peces" class="submodule-item">
                            <div class="submodule-icon peces-icon">🐟</div>
                            <div class="submodule-info">
                                <div class="submodule-name">Peces</div>
                                <div class="submodule-desc">Seguimiento de población piscícola</div>
                            </div>
                            <span style="color:var(--color-text-light);">→</span>
                        </a>
                    </div>
                </div>

                <div class="module-card">
                    <div class="module-header">
                        <div class="module-icon colaborador-icon">CO</div>
                        <div>
                            <h3 class="module-title">Colaborador</h3>
                            <p class="module-subtitle">Operaciones y tareas diarias</p>
                        </div>
                    </div>
                    <div class="submodules-grid">
                        <a href="index.php?controller=Colaborador&action=inventario" class="submodule-item">
                            <div class="submodule-icon inventario-icon">📦</div>
                            <div class="submodule-info">
                                <div class="submodule-name">Inventario</div>
                                <div class="submodule-desc">Consulta y registro de materiales</div>
                            </div>
                            <span style="color:var(--color-text-light);">→</span>
                        </a>
                        <a href="index.php?controller=Colaborador&action=ovas" class="submodule-item">
                            <div class="submodule-icon ovas-icon">🥚</div>
                            <div class="submodule-info">
                                <div class="submodule-name">OVAS</div>
                                <div class="submodule-desc">Registro diario de producción</div>
                            </div>
                            <span style="color:var(--color-text-light);">→</span>
                        </a>
                        <a href="index.php?controller=Colaborador&action=peces" class="submodule-item">
                            <div class="submodule-icon peces-icon">🐟</div>
                            <div class="submodule-info">
                                <div class="submodule-name">Peces</div>
                                <div class="submodule-desc">Manejo y cuidado de peces</div>
                            </div>
                            <span style="color:var(--color-text-light);">→</span>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- GRID PRINCIPAL -->
        <section class="grid" style="margin-top:12px;">

            <!-- Producción (col-6 en desktop) -->
            <div class="col-6 card h-100">
                <div>
                    <div class="card-title">📈 Producción en Curso</div>
                    <p class="muted">Resumen rápido de producción</p>
                </div>

                <div style="margin-top:14px;">
                    <div class="stat">
                        <div>
                            <!-- IDs añadidos para actualización por JS -->
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
                <!-- 📊 Gráfico de barras -->
<div style="margin-top: 24px;">
    <h3 style="font-size:15px; font-weight:700; margin-bottom:8px;">Tendencia de producción</h3>
    <canvas id="produccionChart" height="140"></canvas>
</div>

            </div>

            <!-- Insumos (col-6 en desktop) -->
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

            <!-- Personal en Turno (full width) -->
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
                            $tagClass = 'tag-support';
                            if (strpos($roleLower, 'hr') !== false || strpos($roleLower, 'recursos') !== false) $tagClass = 'tag-hr';
                            else if (strpos($roleLower, 'oper') !== false || strpos($roleLower, 'operaciones') !== false) $tagClass = 'tag-operations';
                            else if (strpos($roleLower, 'ingenier') !== false) $tagClass = 'tag-engineering';
                            else if (strpos($roleLower, 'marketing') !== false) $tagClass = 'tag-marketing';
                        ?>
                            <div class="employee-card">
                                <div class="card-header">
                                    <span class="department-tag <?php echo $tagClass; ?>"><?php echo htmlspecialchars($p['rol']); ?></span>
                                    <span class="muted">Turno: <?php echo htmlspecialchars($p['turno'] ?? '---'); ?></span>
                                </div>
                                <div class="card-profile">
                                    <img class="profile-pic" src="<?php echo !empty($p['avatar']) ? htmlspecialchars($p['avatar']) : 'https://i.pravatar.cc/80?img=12'; ?>" alt="<?php echo htmlspecialchars($p['nombre']); ?>">
                                    <h3 class="profile-name"><?php echo htmlspecialchars($p['nombre']); ?></h3>
                                    <span class="profile-id"><?php echo htmlspecialchars($p['id_personal'] ?? ''); ?></span>
                                    <p class="profile-contact muted">
                                        <?php echo htmlspecialchars($p['email'] ?? ''); ?> <br>
                                        <?php echo htmlspecialchars($p['telefono'] ?? ''); ?>
                                    </p>
                                </div>
                                <div class="card-info">
                                    <p>Rol: <span><?php echo htmlspecialchars($p['rol']); ?></span> • Experiencia: <span><?php echo htmlspecialchars($p['experiencia'] ?? '-'); ?></span></p>
                                    <?php if (!empty($p['salario'])): ?>
                                        <p>Salario: <span class="salary"><?php echo htmlspecialchars($p['salario']); ?></span></p>
                                    <?php endif; ?>
                                </div>
                                <div style="padding:12px 16px; border-top:1px solid var(--color-border); display:flex; justify-content:space-between; align-items:center;">
                                    <small class="muted">ID: <?php echo htmlspecialchars($p['id_personal'] ?? '-'); ?></small>
                                    <a href="index.php?controller=Supervisor&action=perfil&pid=<?php echo urlencode($p['id_personal'] ?? ''); ?>" style="text-decoration:none; font-weight:700; color:var(--color-primary);">Ver perfil →</a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p class="muted" style="margin-top:12px;">No hay personal asignado en este turno.</p>
                <?php endif; ?>
            </div>

            <!-- Formularios BPA-1 Recibidos (col-8) -->
            <div class="col-8 card">
                <div>
                    <div class="card-title">📄 Formularios BPA-1 Recibidos</div>
                    <p class="muted">Revisar formularios pendientes</p>
                </div>

                <div id="bpaListContainer">
                    <?php if (!empty($bpa1_pendientes)): ?>
                        <div class="bpa-list">
                            <?php foreach ($bpa1_pendientes as $i => $b): ?>
                                <div class="bpa-item">
                                    <div style="display:flex; gap:12px; align-items:center;">
                                        <div style="min-width:36px; height:36px; border-radius:8px; display:flex; align-items:center; justify-content:center; font-weight:800; background:var(--color-primary-light); color:var(--color-primary);">
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
                        <p class="muted" style="margin-top:12px;">No hay formularios BPA-1 pendientes de revisión.</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Reportes y acciones (col-4) -->
            <div class="col-4 card">
                <div>
                    <div class="card-title">📑 Acciones y Reportes</div>
                    <p class="muted">Accesos rápidos</p>
                </div>

                <div style="margin-top:12px; display:flex; flex-direction:column; gap:10px;">
                    <a href="index.php?controller=Supervisor&action=reportes" style="display:inline-block; text-decoration:none; padding:10px 12px; border-radius:10px; background:var(--color-primary); color:#fff; font-weight:700; text-align:center;">Ver Reportes</a>

                    <a href="index.php?controller=Supervisor&action=crearIncidencia" style="display:inline-block; text-decoration:none; padding:10px 12px; border-radius:10px; background:linear-gradient(180deg,#fff,#fbfdff); border:1px solid var(--color-border); text-align:center; font-weight:700; color:var(--color-text);">✚ Nueva incidencia</a>

                    <a href="index.php?controller=Supervisor&action=insumos" style="display:inline-block; text-decoration:none; padding:10px 12px; border-radius:10px; background:linear-gradient(180deg,#fff,#fbfdff); border:1px solid var(--color-border); text-align:center; font-weight:700; color:var(--color-text);">📦 Gestionar Insumos</a>
                </div>

                <div style="margin-top:16px;">
                    <div class="muted">Última sincronización</div>
                    <div id="lastSync" style="font-weight:700; margin-top:6px;"><?php echo date('d M Y H:i'); ?></div>
                </div>

                <!-- AGREGADO: gráfico de barras Aprobados vs Pendientes -->
                <div style="margin-top:14px;">
                    <div class="muted">BPA-1: Aprobados vs Pendientes</div>
                    <canvas id="bpaStatusChart" style="width:100%;height:140px;margin-top:8px;"></canvas>
                </div>
            </div>

        </section>

        <!-- Footer action -->
        <div class="text-end">
            <a href="index.php?controller=Supervisor&action=reportes" style="display:inline-block; text-decoration:none; padding:10px 18px; border-radius:10px; background:var(--color-primary); color:#fff; font-weight:700;">📑 Ver Reportes</a>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
/* ================================
   INICIALIZACIÓN GRÁFICOS y AUTO-REFRESH
   ================================ */

/* Helper: safe parse JSON from PHP-inserted data */
function safeParsePhp(jsonLike, fallback) {
    try {
        return jsonLike ? jsonLike : fallback;
    } catch (e) {
        return fallback;
    }
}

/* Datos iniciales del servidor (si vienen) */
let initialGrafico = <?php echo json_encode($produccion['grafico'] ?? null); ?>;
let initialBpaResumen = <?php echo json_encode($bpaResumen ?? ['aprobado' => 0, 'pendiente' => 0]); ?>;

/* --- PRODUCCIÓN (Chart.js) --- */
const ctx = document.getElementById('produccionChart').getContext('2d');
let chartData = Array.isArray(initialGrafico) ? initialGrafico : [];
let produccionChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: chartData.map(d => d.label),
        datasets: [{
            label: 'Producción (unidades)',
            data: chartData.map(d => parseFloat(d.value) || 0),
            backgroundColor: 'rgba(74, 108, 253, 0.5)',
            borderColor: 'rgba(74, 108, 253, 1)',
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

/* Actualiza totales (hace suma simple del gráfico para total producido; total lotes = cantidad de puntos) */
function actualizarTotalesDesdeGrafico() {
    const valores = produccionChart.data.datasets[0].data.map(v => Number(v) || 0);
    const totalProducido = valores.reduce((s, x) => s + x, 0);
    const totalLotes = valores.length;
    const elTotalProducido = document.getElementById('totalProducido');
    const elTotalLotes = document.getElementById('totalLotes');
    if (elTotalProducido) elTotalProducido.textContent = totalProducido;
    if (elTotalLotes) elTotalLotes.textContent = totalLotes;
}

/* Si no hubo grafico inicial, traemos la primera vez */
async function cargarGraficoInicialSiHaceFalta() {
    if (!chartData || chartData.length === 0) {
        try {
            const resp = await fetch('index.php?controller=Supervisor&action=getProduccionJSON');
            if (!resp.ok) return;
            const data = await resp.json();
            if (Array.isArray(data)) {
                chartData = data.map(d=>({label: d.label, value: Number(d.value) || 0}));
                produccionChart.data.labels = chartData.map(d => d.label);
                produccionChart.data.datasets[0].data = chartData.map(d => d.value);
                produccionChart.update();
                actualizarTotalesDesdeGrafico();
            }
        } catch (e) {
            console.error('Error cargando grafico inicial:', e);
        }
    } else {
        actualizarTotalesDesdeGrafico();
    }
}

/* Refrescar gráfica desde endpoint (solo actualizar si difiere) */
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
            chartData = data.map(d=>({label: d.label, value: Number(d.value) || 0}));
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

/* --- BPA STATUS (Chart + lista) --- */
const ctxBpa = document.getElementById('bpaStatusChart').getContext('2d');
let bpaChart = new Chart(ctxBpa, {
    type: 'bar',
    data: {
        labels: ['Aprobados', 'Pendientes'],
        datasets: [{
            label: 'Formularios BPA-1',
            data: [ Number(initialBpaResumen.aprobado || initialBpaResumen.aprobados || 0), Number(initialBpaResumen.pendiente || initialBpaResumen.pendientes || 0) ],
            backgroundColor: ['rgba(34,197,94,0.7)', 'rgba(244,67,54,0.7)'],
            borderColor: ['rgba(34,197,94,1)', 'rgba(244,67,54,1)'],
            borderWidth: 1,
            borderRadius: 6
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: { y: { beginAtZero: true } }
    }
});

/* Refrescar resumen y lista de BPA usando tu endpoint listarBpaAjax */
let lastBpaListSnapshot = '';
async function refrescarBpa() {
    try {
        // pedimos sin ultimoId para obtener todos los registros nuevos (>0)
        const resp = await fetch('index.php?controller=Supervisor&action=listarBpaAjax&ultimoId=0');
        if (!resp.ok) return;
        const json = await resp.json();
        const nuevos = Array.isArray(json.nuevos) ? json.nuevos : [];
        // construir conteos por estado
        let aprobados = 0, pendientes = 0;
        nuevos.forEach(r => {
            const estado = (r.estado || r.estado_reporte || '').toString().toLowerCase();
            if (estado.includes('apro') ) aprobados++;
            else pendientes++;
        });

        // si tu endpoint devuelve todos (incluidos aprobados), si hay 0 registros nuevos el array puede estar vacío.
        // En ese caso, no tocar chart para evitar poner todo a 0. Solo actualizar si hay datos.
        if (nuevos.length > 0) {
            bpaChart.data.datasets[0].data = [aprobados, pendientes];
            bpaChart.update();
        } else {
            // si no hay elementos, podemos mantener el initialBpaResumen (o poner 0)
            // no hacemos nada
        }

        // Actualizar lista visual mínima: si cambió snapshot, re-dibujar
        const snapshot = JSON.stringify(nuevos.map(n => ({id:n.id,sede:n.sede,encargado:n.encargado,fecha:n.fecha,mes:n.mes})));
        if (snapshot !== lastBpaListSnapshot) {
            lastBpaListSnapshot = snapshot;
            const container = document.getElementById('bpaListContainer');
            if (container) {
                if (nuevos.length === 0) {
                    container.innerHTML = '<p class="muted" style="margin-top:12px;">No hay formularios BPA-1 pendientes de revisión.</p>';
                } else {
                    const html = nuevos.slice(0,8).map((b,i) => `
                        <div class="bpa-item">
                            <div style="display:flex; gap:12px; align-items:center;">
                                <div style="min-width:36px; height:36px; border-radius:8px; display:flex; align-items:center; justify-content:center; font-weight:800; background:var(--color-primary-light); color:var(--color-primary);">
                                    ${i+1}
                                </div>
                                <div>
                                    <div style="font-weight:700;">${escapeHtml(b.sede||'')} — ${escapeHtml(b.encargado||'')}</div>
                                    <div class="muted">${escapeHtml(b.fecha||'')} · Mes: ${escapeHtml(b.mes||'')}</div>
                                </div>
                            </div>
                            <div style="display:flex; gap:8px; align-items:center;">
                                <a href="index.php?controller=Supervisor&action=revisarBPA1&id=${encodeURIComponent(b.id)}" style="padding:8px 12px; border-radius:8px; border:1px solid #f6c84c; background:linear-gradient(180deg,#fff8e6,#fff9ed); text-decoration:none; color:#a47706; font-weight:700;">🔍 Revisar</a>
                            </div>
                        </div>
                    `).join('');
                    container.innerHTML = '<div class="bpa-list">' + html + '</div>';
                }
            }
        }

    } catch (e) {
        console.error('Error refrescando BPA:', e);
    }
}

/* Small helper to escape HTML when inserting via innerHTML */
function escapeHtml(str) {
    if (!str) return '';
    return String(str)
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#039;');
}

/* Inicializar todo al cargar */
document.addEventListener('DOMContentLoaded', async () => {
    await cargarGraficoInicialSiHaceFalta();
    // si initialBpaResumen vino, actualizar chart con esos valores
    actualizarTotalesDesdeGrafico();
    // refrescar BPA inicial (intenta obtener lista y actualizar chart/lista)
    refrescarBpa();

    // Polling: grafico cada 10s, bpa cada 10s (pueden coexistir)
    setInterval(refrescarGrafico, 10000);
    setInterval(refrescarBpa, 10000);

    // BÚSQUEDA SIMPLE (tu buscador de personal)
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
