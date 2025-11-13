<?php
// --- Simulación de datos ---
$formularios = [
    [
        'id' => 'global',
        'emoji' => '🌍',
        'titulo' => 'LISTA GLOBAL',
        'descripcion' => 'Ver todos los registros BPA (1, 2, 3 y 4) por día, semana o mes',
        'pendientes' => 0,
        'url' => 'index.php?controller=Supervisor&action=listaGlobal'
    ],
    [
        'id' => 'bpa1',
        'emoji' => '📦',
        'titulo' => 'MPA-1',
        'descripcion' => 'Control de alimentos en almacén',
        'pendientes' => 3,
        'url' => 'index.php?controller=Supervisor&action=listarBPA1'
    ],
    [
        'id' => 'bpa2',
        'emoji' => '🔄',
        'titulo' => 'MPA-2',
        'descripcion' => 'Control de alimentos en proceso',
        'pendientes' => 0,
        'url' => 'index.php?controller=Supervisor&action=listarBPA2'
    ],
    [
        'id' => 'bpa3',
        'emoji' => '✅',
        'titulo' => 'MPA-3',
        'descripcion' => 'Control de producto terminado',
        'pendientes' => 1,
        'url' => 'index.php?controller=Supervisor&action=listarBPA3'
    ],
    [
        'id' => 'bpa4',
        'emoji' => '🏷️',
        'titulo' => 'MPA-4',
        'descripcion' => 'Control de materiales de empaque',
        'pendientes' => 0,
        'url' => 'index.php?controller=Supervisor&action=listarBPA4'
    ],
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Módulo de Inventario - BPA</title>
    
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
            --shadow-hover: 0 12px 24px rgba(244, 147, 64, 0.25);
            --border-color: #dbe7e7;
            --border-hover: #f49340;
            --bg-image: url('https://www.coleccionantamina.com/static/media/book_3/page_2/Pag_152-153.jpg');
        }
        
        * { box-sizing: border-box; margin: 0; padding: 0; }
        
        body {

            font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background:    linear-gradient(135deg, rgba(255, 255, 255, 0.72), rgba(255, 252, 248, 0.72)),
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
            margin-bottom: 48px;
        }
        
        header h1 {
            font-size: 36px;
            font-weight: 800;
            color: var(--accent1);
            margin-bottom: 10px;
        }
        
        header p {
            color: var(--muted);
            font-size: 17px;
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
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 28px;
        }

        /* Tarjeta completa como enlace interactivo */
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
            border: 1px solid var(--border-color);
            transition: all 0.35s cubic-bezier(0.25, 0.8, 0.25, 1);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-hover);
            border-color: var(--border-hover);
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
        }

        .badge {
            padding: 6px 14px;
            border-radius: 30px;
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .badge-orange {
            background: var(--accent1-light);
            color: var(--accent1-dark);
            border: 1px solid var(--accent1);
        }

        .badge-white {
            background: #f8f9fa;
            color: var(--muted);
            border: 1px solid var(--border-color);
        }

        .card-desc {
            color: var(--muted);
            margin-bottom: 20px;
            line-height: 1.55;
            font-size: 15px;
        }

        .card-footer {
            padding-top: 18px;
            border-top: 1px solid var(--border-color);
            opacity: 0.9;
            transition: opacity 0.3s;
        }

        .card:hover .card-footer {
            opacity: 1;
        }

        /* Cursor interacción */
        .card-link:hover {
            cursor: pointer;
        }

        @media (max-width: 768px) {
            body {
                padding: 16px;
            }
            
            header h1 {
                font-size: 26px;
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
            <h1>📦 Módulo del Inventario</h1>
            <p>Formularios de Buenas Prácticas (BPA)</p>
            <div class="divider"></div>
        </header>

        <!-- Grid de Formularios -->
        <div class="grid">
            <?php foreach ($formularios as $form): ?>
                <?php
                    $badgeClass = $form['pendientes'] > 0 ? 'badge-orange' : 'badge-white';
                    $badgeTexto = $form['pendientes'] . ' ' . ($form['pendientes'] == 1 ? 'Pendiente' : 'Pendientes');
                ?>

                <!-- Tarjeta como enlace interactivo -->
                <a href="<?php echo htmlspecialchars($form['url']); ?>" class="card-link" title="Ir a <?php echo htmlspecialchars($form['titulo']); ?>">
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

                        <div class="card-footer">
                            <em>Ver reportes →</em>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Script para activar el acceso al pasar el mouse (opcional, pero mejora UX en algunos navegadores) -->
    <script>
        document.querySelectorAll('.card-link').forEach(card => {
            card.addEventListener('mouseenter', function() {
                // Opcional: puedes añadir sonido o feedback visual extra aquí
            });
        });
    </script>
</body>
</html>