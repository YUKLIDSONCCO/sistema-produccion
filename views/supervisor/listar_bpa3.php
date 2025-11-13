<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reportes BPA-3</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      background: linear-gradient(135deg, #fff7ed, #fff3e0);
      font-family: 'Inter', sans-serif;
      color: #4b5563;
    }

    h1 {
      background: linear-gradient(90deg, #f59e0b, #fbbf24);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    table th {
      background: linear-gradient(90deg, #f59e0b, #fbbf24);
      color: white;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.03em;
      font-size: 0.8rem;
    }

    table tr:hover {
      background-color: #fff8eb;
      transition: background 0.25s ease;
    }

    .tabla-contenedor {
      border-radius: 1rem;
      overflow: hidden;
      border: 1px solid #fde68a;
      box-shadow: 0 4px 18px rgba(249, 115, 22, 0.15);
      backdrop-filter: blur(5px);
    }

    .btn-volver {
      background: linear-gradient(90deg, #f59e0b, #fbbf24);
      color: white !important;
      font-weight: 600;
      border-radius: 0.5rem;
      transition: all 0.3s ease;
      box-shadow: 0 3px 8px rgba(249, 115, 22, 0.25);
    }

    .btn-volver:hover {
      background: linear-gradient(90deg, #fbbf24, #f59e0b);
      transform: translateY(-1px);
      box-shadow: 0 6px 15px rgba(249, 115, 22, 0.35);
    }

    .btn-ver {
      background: linear-gradient(90deg, #f59e0b, #fbbf24);
      color: white;
      font-weight: 600;
      transition: all 0.3s ease;
      border-radius: 0.375rem;
      box-shadow: 0 2px 6px rgba(249, 115, 22, 0.25);
    }

    .btn-ver:hover {
      background: linear-gradient(90deg, #fbbf24, #f59e0b);
      transform: translateY(-1px);
      box-shadow: 0 4px 10px rgba(249, 115, 22, 0.35);
    }
  </style>
</head>

<body>

  <div class="max-w-7xl mx-auto p-4 sm:p-6">
    <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mb-6">
      <h1 class="text-2xl sm:text-3xl font-extrabold flex items-center gap-2 text-center sm:text-left">
        🧾 Reportes BPA-3 — <span class="text-gray-700">Control de Medicamentos</span>
      </h1>
      <a href="index.php?controller=Supervisor&action=inventarioGeneral"
        class="btn-volver px-4 py-2 w-full sm:w-auto text-center">
        ← Volver al Inventario General
      </a>
    </div>

    <div class="tabla-contenedor bg-white overflow-hidden">
      <div class="overflow-x-auto">
        <table class="min-w-full border-collapse text-sm" id="tablaBpa3">
          <thead>
            <tr>
              <th class="px-4 py-3 text-left whitespace-nowrap">ID</th>
              <th class="px-4 py-3 text-left whitespace-nowrap">Fecha</th>
              <th class="px-4 py-3 text-left whitespace-nowrap">Sede</th>
              <th class="px-4 py-3 text-left whitespace-nowrap">Encargado</th>
              <th class="px-4 py-3 text-left whitespace-nowrap">Mes</th>
              <th class="px-4 py-3 text-left whitespace-nowrap">Medicamento / Suplemento</th>
              <th class="px-4 py-3 text-left whitespace-nowrap">Cantidad</th>
              <th class="px-4 py-3 text-left whitespace-nowrap">Empleado</th>
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
                <tr class="hover:bg-orange-50 transition">
                  <td class="px-4 py-2 font-medium text-gray-800 whitespace-nowrap"><?= htmlspecialchars($r['id']) ?></td>
                  <td class="px-4 py-2 whitespace-nowrap"><?= htmlspecialchars($r['fecha']) ?></td>
                  <td class="px-4 py-2 whitespace-nowrap"><?= htmlspecialchars($r['sede']) ?></td>
                  <td class="px-4 py-2 whitespace-nowrap"><?= htmlspecialchars($r['encargado']) ?></td>
                  <td class="px-4 py-2 whitespace-nowrap"><?= htmlspecialchars($r['mes']) ?></td>
                  <td class="px-4 py-2 whitespace-nowrap"><?= htmlspecialchars($r['medicamento_suplemento']) ?></td>
                  <td class="px-4 py-2 text-right whitespace-nowrap"><?= htmlspecialchars($r['cantidad']) ?></td>
                  <td class="px-4 py-2 whitespace-nowrap"><?= htmlspecialchars($r['nombre_empleado']) ?></td>
                  <td class="px-4 py-2 text-gray-600 whitespace-nowrap"><?= htmlspecialchars($r['observaciones']) ?></td>
                  <td
                    class="px-4 py-2 font-semibold whitespace-nowrap <?= $r['estado'] === 'pendiente' ? 'text-red-500' : 'text-green-600' ?>">
                    <?= htmlspecialchars($r['estado']) ?>
                  </td>
                  <td class="px-4 py-2 whitespace-nowrap"><?= $r['revisado'] ?? '-' ?></td>
                  <td class="px-4 py-2 whitespace-nowrap"><?= $r['fecha_revision'] ?? '-' ?></td>
                  <td class="px-4 py-2 text-gray-500 whitespace-nowrap"><?= htmlspecialchars($r['fecha_registro']) ?></td>
                  <td class="px-4 py-2 text-center whitespace-nowrap">
                    <a href="ver_bpa3.php?id=<?= $r['id'] ?>" class="btn-ver px-3 py-1.5 text-sm font-medium">
                      Ver Detalle
                    </a>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="14" class="px-4 py-6 text-center text-gray-500 italic">
                  No hay reportes BPA-3 registrados.
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
      fetch(`index.php?controller=Supervisor&action=listarBpa3Ajax&ultimoId=${ultimoId}`)
        .then(res => res.json())
        .then(data => {
          if (data.nuevos && data.nuevos.length > 0) {
            const tbody = document.querySelector('#tablaBpa3 tbody');
            const noDataRow = tbody.querySelector('td[colspan]');
            if (noDataRow) noDataRow.parentElement.remove();

            data.nuevos.forEach(r => {
              const fila = document.createElement('tr');
              fila.className = "hover:bg-orange-50 transition";
              fila.innerHTML = `
                <td class="px-4 py-2 font-medium text-gray-800 whitespace-nowrap">${r.id}</td>
                <td class="px-4 py-2 whitespace-nowrap">${r.fecha}</td>
                <td class="px-4 py-2 whitespace-nowrap">${r.sede}</td>
                <td class="px-4 py-2 whitespace-nowrap">${r.encargado}</td>
                <td class="px-4 py-2 whitespace-nowrap">${r.mes}</td>
                <td class="px-4 py-2 whitespace-nowrap">${r.medicamento_suplemento}</td>
                <td class="px-4 py-2 text-right whitespace-nowrap">${r.cantidad}</td>
                <td class="px-4 py-2 whitespace-nowrap">${r.nombre_empleado}</td>
                <td class="px-4 py-2 text-gray-600 whitespace-nowrap">${r.observaciones}</td>
                <td class="px-4 py-2 font-semibold whitespace-nowrap ${r.estado === 'pendiente' ? 'text-red-500' : 'text-green-600'}">${r.estado}</td>
                <td class="px-4 py-2 whitespace-nowrap">${r.revisado ?? '-'}</td>
                <td class="px-4 py-2 whitespace-nowrap">${r.fecha_revision ?? '-'}</td>
                <td class="px-4 py-2 text-gray-500 whitespace-nowrap">${r.fecha_registro ?? '-'}</td>
                <td class="px-4 py-2 text-center whitespace-nowrap">
                  <a href="index.php?controller=Supervisor&action=bpa3&id=${r.id}"
                    class="btn-ver px-3 py-1.5 text-sm font-medium">Ver Detalle</a>
                </td>`;
              tbody.prepend(fila);
            });

            ultimoId = Math.max(...data.nuevos.map(r => parseInt(r.id)));
          }
        })
        .catch(err => console.error('Error al actualizar tabla BPA-3:', err));
    }

    setInterval(actualizarTabla, 2000);
  </script>

</body>

</html>
