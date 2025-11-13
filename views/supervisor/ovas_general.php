<?php
// --- Aquí vendrían los datos reales de tu BD ---
$formularios = [
    [
        'id' => 'bpa1_ovas',
        'emoji' => '🧬',
        'titulo' => 'SELECCIÓN Y FERTILIZACIÓN DE OVAS NACIONALES',
        'descripcion' => 'Selección y fertilización de ovas nacionales.',
        'pendientes' => 4,
        'url' => 'index.php?controller=Supervisor&action=listarBPA1_OVAS'
    ],
    [
        'id' => 'bpa2_ovas',
        'emoji' => '💀',
        'titulo' => 'MORTALIDAD DIARIA - OVAS',
        'descripcion' => 'Control diario de mortalidad de ovas por batea.',
        'pendientes' => 0,
        'url' => 'index.php?controller=Supervisor&action=listarBPA2_OVAS'
    ],
    [
        'id' => 'bpa3_ovas',
        'emoji' => '🐟',
        'titulo' => 'MORTALIDAD DIARIA - LARVAS',
        'descripcion' => 'Control de larvas vivas y muertas en lotes de cultivo.',
        'pendientes' => 1,
        'url' => 'index.php?controller=Supervisor&action=listarBPA3_OVAS'
    ],
    [
        'id' => 'bpa4_ovas',
        'emoji' => '🌡️',
        'titulo' => 'CONTROL DIARIO DE PARÁMETROS',
        'descripcion' => 'Monitoreo de temperatura, oxígeno y pH por horario.',
        'pendientes' => 0,
        'url' => 'index.php?controller=Supervisor&action=listarBPA4_OVAS'
    ],
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OVAS - Formularios BPA</title>
    
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --bg: #ffffff;
            --muted: #6b7a7a;
            --card: #ffffff;
            --accent1: #f49340;       /* Naranja principal */
            --accent1-light: #fbdcaf;
            --accent1-dark: #d87e2c;
            --accent-contrast: #ffffff;
            --radius: 16px;
            --shadow-idle: 0 4px 12px rgba(0, 0, 0, 0.06);
            --shadow-hover: 0 12px 28px rgba(244, 147, 64, 0.35);
            --color-border: #dbe7e7;
            --bg-image: url('https://www.coleccionantamina.com/static/media/book_3/page_2/Pag_152-153.jpg');
        }
        
        * { box-sizing: border-box; margin: 0; padding: 0; }
        
        body {
            font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background:  linear-gradient(135deg, rgba(255, 255, 255, 0.72), rgba(255, 252, 248, 0.72)),
    /* Imagen de fondo */
    var(--bg-image);
            color: #1e293b;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            min-height: 100vh;
            padding: 32px;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        header {
            text-align: center;
            margin-bottom: 40px;
        }
        
        header h1 {
            font-size: 32px;
            font-weight: 800;
            color: var(--accent1);
            margin-bottom: 8px;
        }
        
        header p {
            color: var(--muted);
            font-size: 16px;
        }
        
        .divider {
            width: 60px;
            height: 4px;
            background: var(--accent1);
            margin: 16px auto;
            border-radius: 2px;
        }
        
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 28px;
        }

        /* Tarjeta como enlace interactivo */
        .card-link {
            text-decoration: none;
            color: inherit;
            display: block;
            height: 100%;
        }

        .card {
            background: var(--card);
            border-radius: var(--radius);
            padding: 26px;
            box-shadow: var(--shadow-idle);
            border: 1px solid var(--color-border);
            transition: all 0.35s cubic-bezier(0.25, 0.8, 0.25, 1);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-hover);
            border-color: var(--accent1);
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: var(--accent1-light);
            opacity: 0;
            z-index: -1;
            transition: opacity 0.3s ease;
        }

        .card:hover::before {
            opacity: 0.18;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 16px;
        }
        
        .card-title {
            font-size: 20px;
            font-weight: 700;
            color: #1e293b;
            display: flex;
            align-items: center;
            gap: 10px;
            line-height: 1.3;
        }
        
        .badge {
            padding: 6px 14px;
            border-radius: 30px;
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            white-space: nowrap;
        }
        
        .badge-pendiente {
            background: #fff4e5;
            color: #d97706;
            border: 1px solid #fbbf24;
        }
        
        .badge-completo {
            background: #ecfdf5;
            color: #047857;
            border: 1px solid #6ee7b7;
        }
        
        .card-desc {
            color: var(--muted);
            line-height: 1.55;
            font-size: 15px;
        }

        .card-link:hover {
            cursor: pointer;
        }

        @media (max-width: 768px) {
            body {
                padding: 16px;
            }
            header h1 {
                font-size: 24px;
            }
            .grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Encabezado -->
        <header>
            <h1>🥚 Módulo de Ovas</h1>
            <p>Control y seguimiento de procesos reproductivos</p>
            <div class="divider"></div>
        </header>

        <!-- Grid de Formularios -->
        <div class="grid">
            <?php foreach ($formularios as $form): ?>
                <?php
                    $badgeClass = $form['pendientes'] > 0 ? 'badge-pendiente' : 'badge-completo';
                    $badgeTexto = $form['pendientes'] . ' ' . ($form['pendientes'] == 1 ? 'Pendiente' : 'Pendientes');
                ?>

                <!-- Tarjeta interactiva completa -->
                <a href="<?php echo htmlspecialchars($form['url']); ?>" 
                   class="card-link" 
                   title="Ir a <?php echo htmlspecialchars($form['titulo']); ?>">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">
                                <span style="font-size: 26px;"><?php echo htmlspecialchars($form['emoji']); ?></span>
                                <?php echo htmlspecialchars($form['titulo']); ?>
                            </h2>
                            <span class="badge <?php echo $badgeClass; ?>">
                                <?php echo $badgeTexto; ?>
                            </span>
                        </div>
                        <p class="card-desc">
                            <?php echo htmlspecialchars($form['descripcion']); ?>
                        </p>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>