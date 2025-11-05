<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Reportes BPA-3 OVAS</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="max-w-7xl mx-auto p-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">🐟 Reportes BPA-3 — Mortalidad de Larvas</h1>

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full table-auto">
            <thead class="bg-blue-600 text-white">
                <tr>
                    <th class="px-4 py-2 text-left">ID</th>
                    <th class="px-4 py-2 text-left">Fecha</th>
                    <th class="px-4 py-2 text-left">Encargado</th>
                    <th class="px-4 py-2 text-left">Sede</th>
                    <th class="px-4 py-2 text-left">Lote</th>
                    <th class="px-4 py-2 text-left">Total Muertas</th>
                    <th class="px-4 py-2 text-left">Observación</th>
                    <th class="px-4 py-2 text-left">Acción</th>
                </tr>
            </thead>
            <tbody>

            <?php if (!empty($reportes)): ?>
                <?php foreach ($reportes as $r): ?>
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-4 py-2"><?= $r['id'] ?></td>
                    <td class="px-4 py-2"><?= $r['fecha_registro'] ?></td>
                    <td class="px-4 py-2"><?= $r['encargado'] ?></td>
                    <td class="px-4 py-2"><?= $r['sede'] ?></td>
                    <td class="px-4 py-2"><?= $r['lote'] ?></td>
                    <td class="px-4 py-2 font-semibold text-red-600"><?= $r['total'] ?></td>
                    <td class="px-4 py-2"><?= $r['observacion'] ?></td>
                    <td class="px-4 py-2 text-center">
                        <a href="index.php?controller=Supervisor&action=bpa3Ovas&id=<?= $r['id'] ?>"
                           class="bg-blue-600 text-white px-3 py-2 rounded-md hover:bg-blue-700 transition">
                           Ver Detalle
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="8" class="text-center py-4 text-gray-500">No hay reportes.</td></tr>
            <?php endif; ?>

            </tbody>
        </table>
    </div>

    <div class="mt-6">
        <a href="index.php?controller=Supervisor&action=ovas_general"
           class="bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700 transition">
            ← Volver
        </a>
    </div>
</div>

</body>
</html>
