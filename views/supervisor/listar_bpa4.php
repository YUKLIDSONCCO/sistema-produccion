<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reportes BPA-4</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans text-gray-800">

  <div class="max-w-7xl mx-auto p-4 sm:p-6">
    <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mb-6">
      <h1 class="text-2xl sm:text-3xl font-bold text-blue-800 flex items-center gap-2 text-center sm:text-left">
        🍽️ Reportes BPA-4 — <span class="text-gray-700">Control de Alimentos</span>
      </h1>
      <a href="index.php?controller=Supervisor&action=inventarioGeneral"
        class="bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700 transition w-full sm:w-auto text-center">
        ← Volver al Inventario General
      </a>
    </div>

    <div class="bg-white shadow-lg rounded-lg overflow-hidden border border-gray-200">
      <div class="overflow-x-auto">
        <table class="min-w-full border-collapse text-sm" id="tablaBpa4">
          <thead class="bg-gradient-to-r from-blue-700 to-blue-800 text-white">
            <tr>
              <th class="px-4 py-3 text-left whitespace-nowrap">ID</th>
              <th class="px-4 py-3 text-left whitespace-nowrap">Fecha</th>
              <th class="px-4 py-3 text-left whitespace-nowrap">Sede</th>
              <th class="px-4 py-3 text-left whitespace-nowrap">Encargado</th>
              <th class="px-4 py-3 text-left whitespace-nowrap">Mes</th>
              <th class="px-4 py-3 text-left whitespace-nowrap">Nombre alimento</th>
              <th class="px-4 py-3 text-left whitespace-nowrap">Marca</th>
              <th class="px-4 py-3 text-left whitespace-nowrap">Calibre</th>
              <th class="px-4 py-3 text-left whitespace-nowrap">Cantidad</th>
              <th class="px-4 py-3 text-left whitespace-nowrap">Observaciones</th>
              <th class="px-4 py-3 text-left whitespace-nowrap">Estado</th>
              <th class="px-4 py-3 text-left whitespace-nowrap">Revisado</th>
              <th class="px-4 py-3 text-left whitespace-nowrap">Fecha revisión</th>
              <th class="px-4 py-3 text-left whitespace-nowrap">Fecha registro</th>
              <th class="px-4 py-3 text-center whitespace-nowrap">Acción</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-200">
            <?php if (!empty($reportes)): ?>
              <?php foreach ($reportes as $r): ?>
                <tr class="hover:bg-gray-50 transition">
                  <td class="px-4 py-2 font-medium text-gray-700 whitespace-nowrap"><?= htmlspecialchars($r['id']) ?></td>
                  <td class="px-4 py-2 whitespace-nowrap"><?= htmlspecialchars($r['fecha']) ?></td>
                  <td class="px-4 py-2 whitespace-nowrap"><?= htmlspecialchars($r['sede']) ?></td>
                  <td class="px-4 py-2 whitespace-nowrap"><?= htmlspecialchars($r['encargado']) ?></td>
                  <td class="px-4 py-2 whitespace-nowrap"><?= htmlspecialchars($r['mes']) ?></td>
                  <td class="px-4 py-2 whitespace-nowrap"><?= htmlspecialchars($r['nombre_alimento']) ?></td>
                  <td class="px-4 py-2 whitespace-nowrap"><?= htmlspecialchars($r['marca']) ?></td>
                  <td class="px-4 py-2 whitespace-nowrap"><?= htmlspecialchars($r['calibre']) ?></td>
                  <td class="px-4 py-2 text-right whitespace-nowrap"><?= htmlspecialchars($r['cantidad']) ?></td>
                  <td class="px-4 py-2 text-gray-600 whitespace-nowrap"><?= htmlspecialchars($r['observaciones']) ?></td>
                  <td
                    class="px-4 py-2 font-semibold whitespace-nowrap <?= $r['estado'] === 'pendiente' ? 'text-red-600' : 'text-green-600' ?>">
                    <?= htmlspecialchars($r['estado']) ?>
                  </td>
                  <td class="px-4 py-2 whitespace-nowrap"><?= $r['revisado'] ?? '-' ?></td>
                  <td class="px-4 py-2 whitespace-nowrap"><?= $r['fecha_revision'] ?? '-' ?></td>
                  <td class="px-4 py-2 text-gray-500 whitespace-nowrap"><?= htmlspecialchars($r['fecha_registro']) ?></td>
                  <td class="px-4 py-2 text-center whitespace-nowrap">
                    <a href="ver_bpa4.php?id=<?= $r['id'] ?>"
                      class="bg-blue-600 text-white px-3 py-1.5 rounded-md hover:bg-blue-700 transition text-sm font-medium shadow">
                      Ver Detalle
                    </a>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="15" class="px-4 py-6 text-center text-gray-500 italic">
                  No hay reportes BPA-4 registrados.
                </td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <script>
    // Guarda el último ID existente al cargar la página
    let ultimoId = <?= !empty($reportes) ? max(array_column($reportes, 'id')) : 0 ?>;

    // Función para actualizar la tabla automáticamente
    function actualizarTabla() {
      fetch(`index.php?controller=Supervisor&action=listarBpa4Ajax&ultimoId=${ultimoId}`)
        .then(res => res.json())
        .then(data => {
          if (data.nuevos && data.nuevos.length > 0) {
            const tbody = document.querySelector('#tablaBpa4 tbody');

            // Elimina el mensaje "No hay reportes" si existe
            const noDataRow = tbody.querySelector('td[colspan]');
            if (noDataRow) {
              noDataRow.parentElement.remove();
            }

            // Agrega las nuevas filas al inicio
            data.nuevos.forEach(r => {
              const fila = document.createElement('tr');
              fila.className = "hover:bg-gray-50 transition";

              fila.innerHTML = `
                <td class="px-4 py-2 font-medium text-gray-700 whitespace-nowrap">${r.id}</td>
                <td class="px-4 py-2 whitespace-nowrap">${r.fecha}</td>
                <td class="px-4 py-2 whitespace-nowrap">${r.sede}</td>
                <td class="px-4 py-2 whitespace-nowrap">${r.encargado}</td>
                <td class="px-4 py-2 whitespace-nowrap">${r.mes}</td>
                <td class="px-4 py-2 whitespace-nowrap">${r.nombre_alimento}</td>
                <td class="px-4 py-2 whitespace-nowrap">${r.marca}</td>
                <td class="px-4 py-2 whitespace-nowrap">${r.calibre}</td>
                <td class="px-4 py-2 text-right whitespace-nowrap">${r.cantidad}</td>
                <td class="px-4 py-2 text-gray-600 whitespace-nowrap">${r.observaciones}</td>
                <td class="px-4 py-2 font-semibold whitespace-nowrap ${r.estado === 'pendiente' ? 'text-red-600' : 'text-green-600'}">${r.estado}</td>
                <td class="px-4 py-2 whitespace-nowrap">${r.revisado ?? '-'}</td>
                <td class="px-4 py-2 whitespace-nowrap">${r.fecha_revision ?? '-'}</td>
                <td class="px-4 py-2 text-gray-500 whitespace-nowrap">${r.fecha_registro ?? '-'}</td>
                <td class="px-4 py-2 text-center whitespace-nowrap">
                  <a href="index.php?controller=Supervisor&action=bpa4&id=${r.id}"
                    class="bg-blue-600 text-white px-3 py-1.5 rounded-md hover:bg-blue-700 transition text-sm font-medium shadow">
                    Ver Detalle
                  </a>
                </td>
              `;

              // Inserta al inicio (últimos registros arriba)
              tbody.prepend(fila);
            });

            // Actualiza el último ID procesado
            ultimoId = Math.max(...data.nuevos.map(r => parseInt(r.id)));
          }
        })
        .catch(err => console.error('Error al actualizar tabla BPA-4:', err));
    }

    // Refrescar cada 2 segundos
    setInterval(actualizarTabla, 2000);
  </script>

</body>

</html>
