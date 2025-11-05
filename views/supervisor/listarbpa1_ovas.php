<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes BPA-1 OVAS</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="max-w-7xl mx-auto p-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">🥚 Reportes BPA-1 - OVAS</h1>

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full table-auto" id="tablaOvasBpa1">
            <thead class="bg-blue-600 text-white">
            <tr>
                <th class="px-4 py-2 text-left">ID</th>
                <th class="px-4 py-2 text-left">Fecha Registro</th>
                <th class="px-4 py-2 text-left">Responsable</th>
                <th class="px-4 py-2 text-left">Hembras Aptas</th>
                <th class="px-4 py-2 text-left">Machos Aptos</th>
                <th class="px-4 py-2 text-left">Ovas Fértiles</th>
                <th class="px-4 py-2 text-left">Observaciones</th>
                <th class="px-4 py-2 text-left">Estado</th>
                <th class="px-4 py-2 text-center">Acción</th>
            </tr>
            </thead>

            <tbody>
            <?php if (!empty($reportes)): ?>
                <?php foreach ($reportes as $r): ?>
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2"><?= $r['id'] ?></td>
                        <td class="px-4 py-2"><?= $r['fecha_registro'] ?></td>
                        <td class="px-4 py-2"><?= $r['responsable'] ?></td>
                        <td class="px-4 py-2"><?= $r['cantidad_hembras_aptas'] ?></td>
                        <td class="px-4 py-2"><?= $r['cantidad_machos_aptos'] ?></td>
                        <td class="px-4 py-2"><?= $r['cantidad_ovas_fertiles'] ?></td>
                        <td class="px-4 py-2"><?= $r['observaciones'] ?></td>
                        <td class="px-4 py-2">
                            <span class="<?= $r['estado']==='pendiente'?'text-red-600 font-semibold':'text-green-600 font-semibold' ?>">
                                <?= ucfirst($r['estado']) ?>
                            </span>
                        </td>
                        <td class="px-4 py-2 text-center">
                            <a href="index.php?controller=Supervisor&action=bpa1Ovas&id=<?= $r['id'] ?>"
                               class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
                                Ver Detalle
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="9" class="text-center py-4 text-gray-500">No hay reportes BPA-1 de ovas.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        <a href="index.php?controller=Supervisor&action=ovasGeneral"
           class="inline-block bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 transition">
            ← Volver
        </a>
    </div>
</div>

</body>
</html>
