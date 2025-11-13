<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>📋 Reportes BPA-2</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background: linear-gradient(135deg, #fff8f2 0%, #ffe7cc 100%);
      min-height: 100vh;
    }

    .card {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 165, 0, 0.15);
      border-radius: 1rem;
      box-shadow: 0 8px 25px rgba(255, 140, 0, 0.15);
      animation: fadeIn 0.5s ease-in-out;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }

    table th {
      background: linear-gradient(90deg, #ff7b00, #ffae42);
      color: white;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    table tr:nth-child(even) {
      background-color: #fffdf9;
    }

    table tr:hover {
      background-color: #fff4e5;
      transition: 0.25s;
    }

    .badge {
      padding: 0.3rem 0.65rem;
      border-radius: 0.5rem;
      font-weight: 600;
      font-size: 0.85rem;
    }

    .badge-pendiente {
      background-color: #ffe0e0;
      color: #c0392b;
    }

    .badge-aprobado {
      background-color: #e3ffe7;
      color: #1e8449;
    }

    .btn-orange {
      background: linear-gradient(90deg, #ff7b00, #ff9900);
      color: white;
      border-radius: 0.5rem;
      font-weight: 600;
      padding: 0.5rem 1rem;
      transition: all 0.25s;
    }

    .btn-orange:hover {
      background: linear-gradient(90deg, #ff6a00, #ff8800);
      transform: translateY(-2px);
      box-shadow: 0 5px 14px rgba(255, 122, 0, 0.25);
    }

    .btn-gray {
      background-color: #6b7280;
      color: white;
    }

    .btn-gray:hover {
      background-color: #4b5563;
    }
  </style>
</head>
<body class="flex flex-col items-center justify-start p-8">

  <div class="max-w-7xl w-full">
    <!-- Encabezado -->
    <div class="mb-8 text-center">
      <h1 class="text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-orange-700 drop-shadow">
        🧾 Reportes BPA-2 — Control de Sal en Almacén
      </h1>
      <p class="text-gray-600 mt-2">Listado en tiempo real de registros BPA-2.</p>
    </div>

    <!-- Tabla -->
    <div class="overflow-x-auto card p-4">
      <table class="min-w-full text-sm text-gray-700">
        <thead>
          <tr>
            <th class="px-4 py-3 text-left">ID</th>
            <th class="px-4 py-3 text-left">Fecha</th>
            <th class="px-4 py-3 text-left">Sede</th>
            <th class="px-4 py-3 text-left">Encargado</th>
            <th class="px-4 py-3 text-left">Mes</th>
            <th class="px-4 py-3 text-left">Cantidad</th>
            <th class="px-4 py-3 text-left">Producto</th>
            <th class="px-4 py-3 text-left">Observaciones</th>
            <th class="px-4 py-3 text-left">Estado</th>
            <th class="px-4 py-3 text-center">Revisado</th>
            <th class="px-4 py-3 text-left">Fecha Revisión</th>
            <th class="px-4 py-3 text-left">Registro</th>
            <th class="px-4 py-3 text-center">Acción</th>
          </tr>
        </thead>
        <tbody id="tablaBpa2">
          <?php if (!empty($reportes)): ?>
            <?php foreach ($reportes as $r): ?>
              <tr class="border-b">
                <td class="px-4 py-2"><?= htmlspecialchars($r['id']) ?></td>
                <td class="px-4 py-2"><?= htmlspecialchars($r['fecha']) ?></td>
                <td class="px-4 py-2"><?= htmlspecialchars($r['sede']) ?></td>
                <td class="px-4 py-2"><?= htmlspecialchars($r['encargado']) ?></td>
                <td class="px-4 py-2"><?= htmlspecialchars($r['mes']) ?></td>
                <td class="px-4 py-2"><?= htmlspecialchars($r['cantidad']) ?></td>
                <td class="px-4 py-2"><?= htmlspecialchars($r['nombre_sal']) ?></td>
                <td class="px-4 py-2"><?= htmlspecialchars($r['observaciones']) ?></td>
                <td class="px-4 py-2">
                  <span class="badge <?= $r['estado'] === 'pendiente' ? 'badge-pendiente' : 'badge-aprobado' ?>">
                    <?= htmlspecialchars(ucfirst($r['estado'])) ?>
                  </span>
                </td>
                <td class="px-4 py-2 text-center text-lg"><?= $r['revisado'] ? '✅' : '⏳' ?></td>
                <td class="px-4 py-2"><?= htmlspecialchars($r['fecha_revision'] ?? '-') ?></td>
                <td class="px-4 py-2"><?= htmlspecialchars($r['created_at'] ?? '-') ?></td>
                <td class="px-4 py-2 text-center">
                  <a href="index.php?controller=Supervisor&action=bpa2&id=<?= urlencode($r['id']) ?>"
                     class="btn-orange inline-block text-sm">
                    Ver Detalle
                  </a>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="13" class="text-center py-6 text-gray-500 bg-orange-50 rounded-lg">
                No hay reportes BPA-2 registrados.
              </td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

    <!-- Botón inferior -->
    <div class="mt-8 text-center">
      <a href="index.php?controller=Supervisor&action=inventarioGeneral"
         class="btn-gray px-5 py-2 rounded-lg font-semibold transition">
        ← Volver al Inventario General
      </a>
    </div>
  </div>

  <!-- 🔁 Auto actualización cada 0.5 s -->
  <script>
    let ultimoId = <?= !empty($reportes) ? max(array_column($reportes, 'id')) : 0 ?>;

    function actualizarTabla() {
      fetch(`index.php?controller=Supervisor&action=listarBpa2Ajax&ultimoId=${ultimoId}`)
        .then(res => res.json())
        .then(data => {
          if (data.nuevos && data.nuevos.length > 0) {
            const tbody = document.querySelector('#tablaBpa2');
            data.nuevos.forEach(r => {
              const fila = document.createElement('tr');
              fila.className = "border-b animate-[fadeIn_0.3s_ease]";
              fila.innerHTML = `
                <td class='px-4 py-2'>${r.id}</td>
                <td class='px-4 py-2'>${r.fecha}</td>
                <td class='px-4 py-2'>${r.sede}</td>
                <td class='px-4 py-2'>${r.encargado}</td>
                <td class='px-4 py-2'>${r.mes}</td>
                <td class='px-4 py-2'>${r.cantidad}</td>
                <td class='px-4 py-2'>${r.nombre_sal}</td>
                <td class='px-4 py-2'>${r.observaciones}</td>
                <td class='px-4 py-2'><span class="badge ${r.estado === 'pendiente' ? 'badge-pendiente' : 'badge-aprobado'}">${r.estado}</span></td>
                <td class='px-4 py-2 text-center'>${r.revisado ? '✅' : '⏳'}</td>
                <td class='px-4 py-2'>${r.fecha_revision ?? '-'}</td>
                <td class='px-4 py-2'>${r.created_at ?? '-'}</td>
                <td class='px-4 py-2 text-center'>
                  <a href='index.php?controller=Supervisor&action=bpa2&id=${r.id}'
                     class='btn-orange text-sm'>Ver Detalle</a>
                </td>`;
              tbody.prepend(fila);
            });
            ultimoId = Math.max(...data.nuevos.map(r => parseInt(r.id)));
          }
        })
        .catch(err => console.error('Error al actualizar tabla BPA-2:', err));
    }

    setInterval(actualizarTabla, 500);
  </script>

</body>
</html>
