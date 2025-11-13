<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reportes BPA-4</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-orange-100 via-white to-orange-50 font-sans text-gray-800 min-h-screen">

  <div class="max-w-7xl mx-auto p-6 sm:p-10">
    <!-- ENCABEZADO -->
    <div
      class="flex flex-col sm:flex-row items-center justify-between gap-4 mb-8 bg-white/90 backdrop-blur-sm shadow-md rounded-2xl border border-orange-100 p-4 sm:p-6">
      <h1 class="text-2xl sm:text-3xl font-extrabold text-orange-500 flex items-center gap-2 text-center sm:text-left">
        🧪 Reportes BPA-4 <span class="text-gray-600 font-semibold text-lg">— Control de Dosificación</span>
      </h1>

      <a href="index.php?controller=Supervisor&action=inventarioGeneral"
        class="bg-gradient-to-r from-orange-300 to-orange-400 text-white px-5 py-2 rounded-lg font-semibold shadow-md hover:from-orange-400 hover:to-orange-500 transition-all w-full sm:w-auto text-center">
        ← Volver al Inventario General
      </a>
    </div>

    <!-- TABLA -->
    <div class="bg-white/90 backdrop-blur-sm shadow-lg rounded-2xl overflow-hidden border border-orange-100">
      <div class="overflow-x-auto">
        <table class="min-w-full border-collapse text-sm" id="tablaBpa4">
          <thead
            class="bg-gradient-to-r from-orange-300 to-orange-400 text-white text-xs uppercase tracking-wider sticky top-0 z-10">
            <tr>
              <th class="px-4 py-3 text-left">ID</th>
              <th class="px-4 py-3 text-left">Fecha</th>
              <th class="px-4 py-3 text-left">Medicamento/Suplemento</th>
              <th class="px-4 py-3 text-left">Dosis (gr)</th>
              <th class="px-4 py-3 text-left">Días</th>
              <th class="px-4 py-3 text-left">Lote Alevines</th>
              <th class="px-4 py-3 text-left">Sala</th>
              <th class="px-4 py-3 text-left">Responsable</th>
              <th class="px-4 py-3 text-left">Registro Diario</th>
              <th class="px-4 py-3 text-left">Observaciones</th>
              <th class="px-4 py-3 text-left">Fecha Registro</th>
            </tr>
          </thead>

          <tbody class="divide-y divide-orange-100">
            <?php if (!empty($reportes)): ?>
              <?php foreach ($reportes as $r): ?>
                <tr
                  class="hover:bg-orange-50 transition-all duration-200 ease-in-out even:bg-orange-50/60 odd:bg-white cursor-pointer">
                  <td class="px-4 py-3 font-semibold text-gray-700"><?= htmlspecialchars($r['id']) ?></td>
                  <td class="px-4 py-3"><?= htmlspecialchars($r['fecha']) ?></td>
                  <td class="px-4 py-3"><?= htmlspecialchars($r['medicamento_suplemento']) ?></td>
                  <td class="px-4 py-3"><?= htmlspecialchars($r['dosis_gr']) ?></td>
                  <td class="px-4 py-3"><?= htmlspecialchars($r['dias_tratamiento']) ?></td>
                  <td class="px-4 py-3"><?= htmlspecialchars($r['lote_alevines']) ?></td>
                  <td class="px-4 py-3"><?= htmlspecialchars($r['sala']) ?></td>
                  <td class="px-4 py-3"><?= htmlspecialchars($r['responsable']) ?></td>
                  <td class="px-4 py-3"><?= htmlspecialchars($r['registro_diario']) ?></td>
                  <td class="px-4 py-3 text-gray-600"><?= htmlspecialchars($r['observaciones']) ?></td>
                  <td class="px-4 py-3 text-gray-500"><?= htmlspecialchars($r['fecha_registro']) ?></td>
                  <td class="px-4 py-3 text-center">

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

  <!-- SCRIPT -->
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
              fila.className = "hover:bg-orange-50 transition-all even:bg-orange-50/60 odd:bg-white cursor-pointer";
              fila.innerHTML = `
                <td class="px-4 py-3 font-semibold text-gray-700">${r.id}</td>
                <td class="px-4 py-3">${r.fecha}</td>
                <td class="px-4 py-3">${r.medicamento_suplemento}</td>
                <td class="px-4 py-3">${r.dosis_gr}</td>
                <td class="px-4 py-3">${r.dias_tratamiento}</td>
                <td class="px-4 py-3">${r.lote_alevines}</td>
                <td class="px-4 py-3">${r.sala}</td>
                <td class="px-4 py-3">${r.responsable}</td>
                <td class="px-4 py-3">${r.registro_diario}</td>
                <td class="px-4 py-3 text-gray-600">${r.observaciones}</td>
                <td class="px-4 py-3 text-gray-500">${r.fecha_registro}</td>
                <td class="px-4 py-3 text-center">
                  <a href="ver_bpa4.php?id=${r.id}"
                    class="bg-gradient-to-r from-orange-300 to-orange-400 text-white px-4 py-1.5 rounded-md font-medium hover:from-orange-400 hover:to-orange-500 transition-all shadow-md hover:shadow-lg text-sm">
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
