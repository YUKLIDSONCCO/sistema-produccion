<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>BPA-4 OVAS</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="max-w-7xl mx-auto p-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">🌡️ Reportes BPA-4 — OVAS</h1>

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full table-auto" id="tablaBpa">
            <thead class="bg-blue-600 text-white">
                <tr>
                    <th class="px-3 py-2 text-left">ID</th>
                    <th class="px-3 py-2 text-left">Fecha registro</th>
                    <th class="px-3 py-2 text-left">Mes</th>
                    <th class="px-3 py-2 text-left">Sede</th>
                    <th class="px-3 py-2 text-left">Día</th>
                    <th class="px-3 py-2 text-left">T° 06:30</th>
                    <th class="px-3 py-2 text-left">O₂ 06:30</th>
                    <th class="px-3 py-2 text-left">Sat 06:30</th>
                    <th class="px-3 py-2 text-left">pH 06:30</th>
                    <th class="px-3 py-2 text-left">T° 12:00</th>
                    <th class="px-3 py-2 text-left">O₂ 12:00</th>
                    <th class="px-3 py-2 text-left">Sat 12:00</th>
                    <th class="px-3 py-2 text-left">pH 12:00</th>
                    <th class="px-3 py-2 text-left">Responsable</th>
                    <th class="px-3 py-2 text-left">Observación</th>
                    <th class="px-3 py-2 text-center">Acción</th>
                </tr>
            </thead>
            <tbody>
            <?php if (!empty($reportes)): ?>
                <?php foreach ($reportes as $r): ?>
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-3 py-2"><?= $r['id'] ?></td>
                        <td class="px-3 py-2"><?= $r['fecha_registro'] ?></td>
                        <td class="px-3 py-2"><?= $r['mes'] ?></td>
                        <td class="px-3 py-2"><?= $r['sede'] ?></td>
                        <td class="px-3 py-2"><?= $r['dia'] ?></td>

                        <td class="px-3 py-2"><?= $r['t_0630'] ?></td>
                        <td class="px-3 py-2"><?= $r['o2_0630'] ?></td>
                        <td class="px-3 py-2"><?= $r['sat_0630'] ?></td>
                        <td class="px-3 py-2"><?= $r['ph_0630'] ?></td>

                        <td class="px-3 py-2"><?= $r['t_1200'] ?></td>
                        <td class="px-3 py-2"><?= $r['o2_1200'] ?></td>
                        <td class="px-3 py-2"><?= $r['sat_1200'] ?></td>
                        <td class="px-3 py-2"><?= $r['ph_1200'] ?></td>

                        <td class="px-3 py-2"><?= $r['responsable'] ?></td>
                        <td class="px-3 py-2"><?= $r['observacion'] ?></td>

                        <td class="px-3 py-2 text-center">
                            <a href="index.php?controller=Supervisor&action=bpa4Ovas&id=<?= $r['id'] ?>"
                               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                               Ver detalle
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="16" class="text-center py-4 text-gray-500">Sin registros BPA-4 OVAS.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

    <a href="index.php?controller=Supervisor&action=ovasGeneral"
       class="mt-6 inline-block bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
        ← Volver
    </a>
</div>

</body>
</html>
