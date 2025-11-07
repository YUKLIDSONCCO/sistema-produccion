<?php
// --- Simulación de datos ---
// En tu aplicación real, estos datos vendrían de tu base de datos (count($bpa1), etc.)
// Simplemente he añadido algunos valores para que veas cómo cambian los colores.
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
        'emoji' => '🧾',
        'titulo' => 'BPA-1',
        'descripcion' => 'Control de alimentos en almacén',
        'pendientes' => 3,
        'url' => 'index.php?controller=Supervisor&action=listarBPA1'
    ],
    [
        'id' => 'bpa2',
        'emoji' => '🥬',
        'titulo' => 'BPA-2',
        'descripcion' => 'Control de alimentos en proceso',
        'pendientes' => 0,
        'url' => 'index.php?controller=Supervisor&action=listarBPA2'
    ],
    [
        'id' => 'bpa3',
        'emoji' => '🥩',
        'titulo' => 'BPA-3',
        'descripcion' => 'Control de producto terminado',
        'pendientes' => 1,
        'url' => 'index.php?controller=Supervisor&action=listarBPA3'
    ],
    [
        'id' => 'bpa4',
        'emoji' => '🧃',
        'titulo' => 'BPA-4',
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
    <!-- Meta tag esencial para diseño responsivo (multiplataforma) -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Módulo de Inventario - BPA</title>
    
    <!-- Cargamos Tailwind CSS desde su CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Opcional: Usamos la fuente Inter para un look más moderno -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100">

    <div class="max-w-5xl mx-auto p-6 md:p-10">
        
        <!-- Encabezado -->
        <header class="text-center mb-10">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-2">
                📦 Módulo de Inventario
            </h1>
            <p class="text-lg text-gray-600">Formularios de Buenas Prácticas (BPA)</p>
        </header>

        <!-- Grid de Formularios Responsivo -->
        <!-- 1 columna en móvil (default), 2 columnas en pantallas medianas (md:) y más grandes -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            
            <!-- Iniciamos el bucle de PHP -->
            <?php foreach ($formularios as $form): ?>
                <?php
                    // Lógica para las clases del badge: rojo si hay pendientes, verde si no.
                    $badgeClass = $form['pendientes'] > 0
                        ? 'bg-red-100 text-red-800'
                        : 'bg-green-100 text-green-800';
                    $badgeTexto = $form['pendientes'] . ' ' . ($form['pendientes'] == 1 ? 'Pendiente' : 'Pendientes');
                ?>

                <!-- Card de Formulario -->
                <!-- La tarjeta usa flex-col para que el botón siempre quede abajo -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl flex flex-col">
                    
                    <!-- Contenido principal de la tarjeta -->
                    <div class="p-6 flex-grow">
                        
                        <!-- Encabezado de la Card (Título y Badge de Pendientes) -->
                        <div class="flex items-start justify-between mb-4">
                            <!-- Título con Emoji -->
                            <h2 class="text-2xl font-semibold text-gray-900 flex items-center">
                                <span class="text-3xl mr-3"><?= htmlspecialchars($form['emoji']) ?></span>
                                <?= htmlspecialchars($form['titulo']) ?>
                            </h2>
                            <!-- Badge de Pendientes (intuitivo) -->
                            <span class="text-sm font-bold px-3 py-1 rounded-full <?= $badgeClass ?> whitespace-nowrap">
                                <?= $badgeTexto ?>
                            </span>
                        </div>
                        
                        <!-- Descripción -->
                        <p class="text-gray-600">
                            <?= htmlspecialchars($form['descripcion']) ?>
                        </p>
                    </div>

                    <!-- Footer de la Card (Botón de Acción) -->
                    <div class="p-6 bg-gray-50">
                        <a href="<?= htmlspecialchars($form['url']) ?>" 
                           class="flex items-center justify-center w-full bg-blue-600 text-white text-center font-semibold py-3 px-4 rounded-lg transition-colors duration-200 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                            Ver Reportes
                            <!-- Icono de flecha para mayor claridad -->
                            <svg class="w-5 h-5 ml-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                            </svg>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
            <!-- Fin del bucle -->

        </div>
    </div>

</body>
</html>
