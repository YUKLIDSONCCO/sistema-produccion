<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes BPA-1</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <div class="max-w-7xl mx-auto p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">🧾 Reportes BPA-1</h1>

        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="min-w-full table-auto" id="tablaBpa">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th class="px-4 py-2 text-left">ID</th>
                        <th class="px-4 py-2 text-left">Fecha</th>
                        <th class="px-4 py-2 text-left">Sede</th>
                        <th class="px-4 py-2 text-left">Encargado</th>
                        <th class="px-4 py-2 text-left">Mes</th>
                        <th class="px-4 py-2 text-left">Marca</th>
                        <th class="px-4 py-2 text-left">Calibre</th>
                        <th class="px-4 py-2 text-left">Cantidad (kg)</th>
                        <th class="px-4 py-2 text-left">Nombre del alimento</th>
                        <th class="px-4 py-2 text-left">Observaciones</th>
                        <th class="px-4 py-2 text-left">Estado</th>
                        <th class="px-4 py-2 text-left">Fecha registro</th>
                        <th class="px-4 py-2 text-left">Revisado</th>
                        <th class="px-4 py-2 text-center">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($reportes)): ?>
                        <?php foreach ($reportes as $r): ?>
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-4 py-2"><?= htmlspecialchars($r['id']) ?></td>
                                <td class="px-4 py-2"><?= htmlspecialchars($r['fecha']) ?></td>
                                <td class="px-4 py-2"><?= htmlspecialchars($r['sede']) ?></td>
                                <td class="px-4 py-2"><?= htmlspecialchars($r['encargado']) ?></td>
                                <td class="px-4 py-2"><?= htmlspecialchars($r['mes']) ?></td>
                                <td class="px-4 py-2"><?= htmlspecialchars($r['marca']) ?></td>
                                <td class="px-4 py-2"><?= htmlspecialchars($r['calibre']) ?></td>
                                <td class="px-4 py-2"><?= htmlspecialchars($r['cantidad']) ?></td>
                                <td class="px-4 py-2"><?= htmlspecialchars($r['nombre_alimento']) ?></td>
                                <td class="px-4 py-2"><?= htmlspecialchars($r['observaciones']) ?></td>
                                <td class="px-4 py-2">
                                    <span class="<?= $r['estado'] === 'pendiente' ? 'text-red-600 font-semibold' : 'text-green-600 font-semibold' ?>">
                                        <?= htmlspecialchars(ucfirst($r['estado'])) ?>
                                    </span>
                                </td>
                                <td class="px-4 py-2"><?= htmlspecialchars($r['fecha_registro']) ?></td>
                                <td class="px-4 py-2 text-center">
                                    <?= $r['revisado'] ? '✅' : '⏳' ?>
                                </td>
                                <td class="px-4 py-2 text-center">
                                    <a href="index.php?controller=Supervisor&action=bpa1&id=<?= urlencode($r['id']) ?>"
                                       class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
                                        Ver Detalle
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="14" class="text-center py-4 text-gray-500">No hay reportes BPA-1 registrados.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            <a href="index.php?controller=Supervisor&action=inventarioGeneral"
               class="inline-block bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 transition">
                ← Volver al Inventario General
            </a>
        </div>
    </div>

    <!-- 🔁 Auto actualización cada 0.5 s -->
    <script>
        let ultimoId = <?= !empty($reportes) ? max(array_column($reportes, 'id')) : 0 ?>;

function actualizarTabla() {
    fetch(`index.php?controller=Supervisor&action=listarBpaAjax&ultimoId=${ultimoId}`)
        .then(res => res.json())
        .then(data => {
            if (data.nuevos && data.nuevos.length > 0) {
                const tbody = document.querySelector('#tablaBpa tbody');
                data.nuevos.forEach(r => {
                    const fila = document.createElement('tr');
                    fila.className = "border-b hover:bg-gray-50";
                    fila.innerHTML = `
                        <td class="px-4 py-2">${r.id}</td>
                        <td class="px-4 py-2">${r.fecha}</td>
                        <td class="px-4 py-2">${r.sede}</td>
                        <td class="px-4 py-2">${r.encargado}</td>
                        <td class="px-4 py-2">${r.mes}</td>
                        <td class="px-4 py-2">${r.marca}</td>
                        <td class="px-4 py-2">${r.calibre}</td>
                        <td class="px-4 py-2">${r.cantidad}</td>
                        <td class="px-4 py-2">${r.nombre_alimento}</td>
                        <td class="px-4 py-2">${r.observaciones}</td>
                        <td class="px-4 py-2"><span class="${r.estado === 'pendiente' ? 'text-red-600 font-semibold' : 'text-green-600 font-semibold'}">${r.estado}</span></td>
                        <td class="px-4 py-2">${r.fecha_registro}</td>
                        <td class="px-4 py-2 text-center">${r.revisado ? '✅' : '⏳'}</td>
                        <td class="px-4 py-2 text-center">
                            <a href="index.php?controller=Supervisor&action=bpa1&id=${r.id}"
                               class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
                               Ver Detalle
                            </a>
                        </td>
                    `;
                    tbody.prepend(fila);
                });

                // Actualiza el último ID conocido
                ultimoId = Math.max(...data.nuevos.map(r => parseInt(r.id)));
            }
        })
        .catch(err => console.error('Error al actualizar tabla BPA:', err));
}

setInterval(actualizarTabla, 500);

    </script>

</body>
</html>
