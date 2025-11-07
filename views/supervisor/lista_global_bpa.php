<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>📋 Lista Global de Reportes BPA</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">

    <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">
        🧾 Lista Global de Reportes BPA
    </h1>

    <!-- 🔍 Selector de fecha -->
    <form action="index.php" method="get" class="flex justify-center items-center gap-3 mb-8">
        <input type="hidden" name="controller" value="Supervisor">
        <input type="hidden" name="action" value="listaGlobal">

        <label for="fecha" class="text-gray-700 font-semibold">Selecciona una fecha:</label>
        <input 
            type="date" 
            id="fecha" 
            name="fecha"
            value="<?= isset($_GET['fecha']) ? htmlspecialchars($_GET['fecha']) : '' ?>"
            class="border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
        >
        <button 
            type="submit" 
            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-semibold shadow">
            Buscar
        </button>
    </form>

    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <table class="min-w-full border border-gray-300">
            <thead class="bg-blue-600 text-white">
                <tr>
                    <th class="py-3 px-4 text-left">Tipo</th>
                    <th class="py-3 px-4 text-left">Fecha</th>
                    <th class="py-3 px-4 text-left">Sede</th>
                    <th class="py-3 px-4 text-left">Encargado</th>
                    <th class="py-3 px-4 text-center">Revisado</th>
                    <th class="py-3 px-4 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($reportes)): ?>
                    <?php foreach ($reportes as $r): ?>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-2 px-4 font-semibold"><?= htmlspecialchars($r['tipo']) ?></td>
                            <td class="py-2 px-4"><?= htmlspecialchars($r['fecha']) ?></td>
                            <td class="py-2 px-4"><?= htmlspecialchars($r['sede']) ?></td>
                            <td class="py-2 px-4"><?= htmlspecialchars($r['encargado']) ?></td>
                            <td class="py-2 px-4 text-center">
                                <?= $r['revisado'] ? '✅' : '⏳' ?>
                            </td>
                            <td class="py-2 px-4 text-center">
                                <a href="<?= htmlspecialchars("index.php?controller=Supervisor&action=verDetallesBPA&tipo={$r['tipo']}&id={$r['id']}") ?>"
                                   class="inline-flex items-center px-3 py-1.5 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors">
                                   Ver Detalles
                                   <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                       <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                   </svg>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center py-6 text-gray-500">
                            No hay reportes registrados para la fecha seleccionada.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</body>
</html>
