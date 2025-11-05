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
        🧪 Reportes BPA-4 — <span class="text-gray-700">Control de Dosificación</span>
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
              <th class="px-4 py-3">ID</th>
              <th class="px-4 py-3">Fecha</th>
              <th class="px-4 py-3">Medicamento/Suplemento</th>
              <th class="px-4 py-3">Dosis (gr)</th>
              <th class="px-4 py-3">Días</th>
              <th class="px-4 py-3">Lote Alevines</th>
              <th class="px-4 py-3">Sala</th>
              <th class="px-4 py-3">Responsable</th>
              <th class="px-4 py-3">Registro Diario</th>
              <th class="px-4 py-3">Observaciones</th>
              <th class="px-4 py-3">Fecha Registro</th>
              <th class="px-4 py-3 text-center">Acción</th>
            </tr>
          </thead>

          <tbody class="divide-y divide-gray-200">
            <?php if (!empty($reportes)): ?>
              <?php foreach ($reportes as $r): ?>
                <tr class="hover:bg-gray-50 transition">
                  <td class="px-4 py-2 font-medium text-gray-700"><?= htmlspecialchars($r['id']) ?></td>
                  <td class="px-4 py-2"><?= htmlspecialchars($r['fecha']) ?></td>
                  <td class="px-4 py-2"><?= htmlspecialchars($r['medicamento_suplemento']) ?></td>
                  <td class="px-4 py-2"><?= htmlspecialchars($r['dosis_gr']) ?></td>
                  <td class="px-4 py-2"><?= htmlspecialchars($r['dias_tratamiento']) ?></td>
                  <td class="px-4 py-2"><?= htmlspecialchars($r['lote_alevines']) ?></td>
                  <td class="px-4 py-2"><?= htmlspecialchars($r['sala']) ?></td>
                  <td class="px-4 py-2"><?= htmlspecialchars($r['responsable']) ?></td>
                  <td class="px-4 py-2"><?= htmlspecialchars($r['registro_diario']) ?></td>
                  <td class="px-4 py-2 text-gray-600"><?= htmlspecialchars($r['observaciones']) ?></td>
                  <td class="px-4 py-2 text-gray-500"><?= htmlspecialchars($r['fecha_registro']) ?></td>
                  <td class="px-4 py-2 text-center">
                    <a href="ver_bpa4.php?id=<?= $r['id'] ?>"
                      class="bg-blue-600 text-white px-3 py-1.5 rounded-md hover:bg-blue-700 transition text-sm shadow">
                      Ver Detalle
                    </a>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="12" class="px-4 py-6 text-center text-gray-500 italic">
                  No hay reportes registrados.
                </td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <script>
    let ultimoId = <?= !empty($reportes) ? max(array_column($reportes, 'id')) : 0 ?>;

    function actualizarTabla() {
      fetch(`index.php?controller=Supervisor&action=listarBpa4Ajax&ultimoId=${ultimoId}`)
        .then(res => res.json())
        .then(data => {
          if (data.nuevos && data.nuevos.length > 0) {
            const tbody = document.querySelector('#tablaBpa4 tbody');

            const noData = tbody.querySelector('td[colspan]');
            if (noData) noData.parentElement.remove();

            data.nuevos.forEach(r => {
              const fila = document.createElement('tr');
              fila.className = "hover:bg-gray-50 transition";
              fila.innerHTML = `
                <td class="px-4 py-2 font-medium text-gray-700">${r.id}</td>
                <td class="px-4 py-2">${r.fecha}</td>
                <td class="px-4 py-2">${r.medicamento_suplemento}</td>
                <td class="px-4 py-2">${r.dosis_gr}</td>
                <td class="px-4 py-2">${r.dias_tratamiento}</td>
                <td class="px-4 py-2">${r.lote_alevines}</td>
                <td class="px-4 py-2">${r.sala}</td>
                <td class="px-4 py-2">${r.responsable}</td>
                <td class="px-4 py-2">${r.registro_diario}</td>
                <td class="px-4 py-2 text-gray-600">${r.observaciones}</td>
                <td class="px-4 py-2 text-gray-500">${r.fecha_registro}</td>
                <td class="px-4 py-2 text-center">
                  <a href="ver_bpa4.php?id=${r.id}"
                    class="bg-blue-600 text-white px-3 py-1.5 rounded-md hover:bg-blue-700 transition text-sm shadow">
                    Ver Detalle
                  </a>
                </td>
              `;
              tbody.prepend(fila);
            });

            ultimoId = Math.max(...data.nuevos.map(r => parseInt(r.id)));
          }
        })
        .catch(err => console.error('Error BPA-4:', err));
    }

    setInterval(actualizarTabla, 2000);
  </script>

</body>

</html>
