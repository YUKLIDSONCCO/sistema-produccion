<?php
// --- Aquí vendrían los datos reales de tu BD ---
// Ejemplos de valores simulados:
$formularios = [
    [
        'id' => 'bpa1_ovas',
        'emoji' => '🧬',
        'titulo' => 'FORMATO N°02',
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

<script src="https://cdn.tailwindcss.com"></script>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');
    body { font-family: 'Inter', sans-serif; }
</style>
</head>
<body class="bg-gray-100">

<div class="max-w-5xl mx-auto p-6 md:p-10">

    <!-- Encabezado -->
    <header class="text-center mb-10">
        <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-2">
            🥚 Módulo de Ovas
        </h1>
        <p class="text-lg text-gray-600">Control y seguimiento de procesos reproductivos</p>
    </header>

    <!-- Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <?php foreach ($formularios as $form): ?>
            <?php
                $badgeClass = $form['pendientes'] > 0
                    ? 'bg-red-100 text-red-800'
                    : 'bg-green-100 text-green-800';

                $badgeTexto = $form['pendientes'] . ' ' . ($form['pendientes'] == 1 ? 'Pendiente' : 'Pendientes');
            ?>

            <div class="bg-white rounded-lg shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl flex flex-col">
                
                <div class="p-6 flex-grow">
                    <div class="flex items-start justify-between mb-4">
                        <h2 class="text-2xl font-semibold text-gray-900 flex items-center">
                            <span class="text-3xl mr-3"><?= $form['emoji'] ?></span>
                            <?= $form['titulo'] ?>
                        </h2>
                        <span class="text-sm font-bold px-3 py-1 rounded-full <?= $badgeClass ?>">
                            <?= $badgeTexto ?>
                        </span>
                    </div>

                    <p class="text-gray-600">
                        <?= $form['descripcion'] ?>
                    </p>
                </div>

                <div class="p-6 bg-gray-50">
                    <a href="<?= $form['url'] ?>"
                    class="flex items-center justify-center w-full bg-blue-600 text-white font-semibold py-3 px-4 rounded-lg hover:bg-blue-700 transition">
                        Administrar
                        <svg class="w-5 h-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/>
                        </svg>
                    </a>
                </div>

            </div>
        <?php endforeach; ?>

    </div>
</div>

</body>
</html>
