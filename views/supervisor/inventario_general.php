<?php
// --- Simulación de datos ---
$formularios = [
    [
        'id' => 'global',
        'emoji' => '',
        'titulo' => 'LISTA GLOBAL',
        'descripcion' => 'Ver todos los registros BPA (1, 2, 3 y 4) por día, semana o mes',
        'pendientes' => 0,
        'url' => 'index.php?controller=Supervisor&action=listaGlobal'
    ],
    [
        'id' => 'bpa1',
        'emoji' => '',
        'titulo' => 'MPA-1',
        'descripcion' => 'Control de alimentos en almacén',
        'pendientes' => 3,
        'url' => 'index.php?controller=Supervisor&action=listarBPA1'
    ],
    [
        'id' => 'bpa2',
        'emoji' => '',
        'titulo' => 'MPA-2',
        'descripcion' => 'Control de alimentos en proceso',
        'pendientes' => 0,
        'url' => 'index.php?controller=Supervisor&action=listarBPA2'
    ],
    [
        'id' => 'bpa3',
        'emoji' => '',
        'titulo' => 'MPA-3',
        'descripcion' => 'Control de producto terminado',
        'pendientes' => 1,
        'url' => 'index.php?controller=Supervisor&action=listarBPA3'
    ],
    [
        'id' => 'bpa4',
        'emoji' => '',
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
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #fff8f2 0%, #ffe8d1 100%);
        }

        header h1 {
            background: linear-gradient(90deg, #ff7b00, #ffae42);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .card-shadow {
            box-shadow: 0 6px 16px rgba(255, 122, 0, 0.15);
        }

        .card-shadow:hover {
            box-shadow: 0 10px 25px rgba(255, 122, 0, 0.25);
            transform: translateY(-4px);
        }

        .orange-btn {
            background: linear-gradient(90deg, #ff7b00, #ff9900);
        }

        .orange-btn:hover {
            background: linear-gradient(90deg, #ff6a00, #ff8800);
        }

        .orange-badge {
            background: #fff4e5;
            color: #d97706;
            border: 1px solid #fbbf24;
        }

        .green-badge {
            background: #ecfdf5;
            color: #047857;
            border: 1px solid #6ee7b7;
        }

        /* Transiciones suaves */
        .transition-all {
            transition: all 0.3s ease;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col items-center justify-center p-4">

    <div class="max-w-5xl w-full mx-auto p-6 md:p-10">

        <!-- Encabezado -->
        <header class="text-center mb-10">
            <h1 class="text-3xl md:text-4xl font-bold mb-2">
                📦MÓDULO DEL INVENTARIO
            </h1>
            <p class="text-lg text-gray-700">Formularios de Buenas Prácticas (BPA)</p>
            <div class="w-24 h-1 bg-gradient-to-r from-orange-500 to-orange-400 mx-auto mt-3 rounded-full"></div>
        </header>

        <!-- Grid de Formularios -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <?php foreach ($formularios as $form): ?>
                <?php
                    $badgeClass = $form['pendientes'] > 0
                        ? 'orange-badge'
                        : 'green-badge';
                    $badgeTexto = $form['pendientes'] . ' ' . ($form['pendientes'] == 1 ? 'Pendiente' : 'Pendientes');
                ?>

                <!-- Card -->
                <div class="bg-white rounded-xl card-shadow overflow-hidden transition-all duration-300 flex flex-col border border-orange-100">

                    <div class="p-6 flex-grow">
                        <div class="flex items-start justify-between mb-4">
                            <h2 class="text-2xl font-semibold text-gray-900 flex items-center">
                                <span class="text-3xl mr-3"><?= htmlspecialchars($form['emoji']) ?></span>
                                <?= htmlspecialchars($form['titulo']) ?>
                            </h2>
                            <span class="text-sm font-bold px-3 py-1 rounded-full <?= $badgeClass ?> whitespace-nowrap">
                                <?= $badgeTexto ?>
                            </span>
                        </div>

                        <p class="text-gray-600">
                            <?= htmlspecialchars($form['descripcion']) ?>
                        </p>
                    </div>

                    <div class="p-6 bg-orange-50">
                        <a href="<?= htmlspecialchars($form['url']) ?>" 
                           class="orange-btn flex items-center justify-center w-full text-white text-center font-semibold py-3 px-4 rounded-lg transition-all duration-200 hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-opacity-50">
                            Ver Reportes
                            <svg class="w-5 h-5 ml-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                            </svg>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

</body>
</html>
