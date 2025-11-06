<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes BPA-1</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">

    <div class="w-full p-4 sm:p-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">🧾 Reportes BPA-1</h1>

        <!-- 🔍 FILTROS DE BÚSQUEDA Y VISUALIZACIÓN -->
        <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
            <div class="flex items-center gap-2">
                <label for="busquedaTipo" class="text-gray-700 text-sm font-medium">Buscar por:</label>
                <select id="busquedaTipo" class="border border-gray-300 rounded-md px-3 py-1 text-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="mes">Mes</option>
                    <option value="semana">Semana</option>
                </select>
                <input type="text" id="busquedaInput" placeholder="Escribe el mes o semana..." 
                       class="border border-gray-300 rounded-md px-3 py-1 text-sm focus:ring-blue-500 focus:border-blue-500 w-48">
            </div>

            <div class="flex items-center gap-2">
                <label for="mostrarCantidad" class="text-gray-700 text-sm font-medium">Ver:</label>
                <select id="mostrarCantidad" class="border border-gray-300 rounded-md px-3 py-1 text-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="10">10</option>
                    <option value="15">15</option>
                    <option value="todos">Todos</option>
                </select>
            </div>
        </div>

        <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
            <table class="min-w-full table-auto" id="tablaBpa">
                <thead class="bg-blue-600 text-white text-xs uppercase tracking-wider">
                    <tr>
                        <th class="px-6 py-3 text-left">ID</th>
                        <th class="px-6 py-3 text-left">Fecha</th>
                        <th class="px-6 py-3 text-left">Sede</th>
                        <th class="px-6 py-3 text-left">Encargado</th>
                        <th class="px-6 py-3 text-left">Mes</th>
                        <th class="px-6 py-3 text-left">Marca</th>
                        <th class="px-6 py-3 text-left">Calibre</th>
                        <th class="px-6 py-3 text-left">Cantidad (kg)</th>
                        <th class="px-6 py-3 text-left">Nombre del alimento</th>
                        <th class="px-6 py-3 text-left">Observaciones</th>
                        <th class="px-6 py-3 text-left">Estado</th>
                        <th class="px-6 py-3 text-left">Fecha registro</th>
                        <th class="px-6 py-3 text-center">Revisado</th>
                        <th class="px-6 py-3 text-center">Acción</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php if (!empty($reportes)): ?>
                        <?php foreach ($reportes as $r): ?>
                            <tr id="fila-<?= htmlspecialchars($r['id']) ?>" class="hover:bg-gray-50 align-top">
                                <td class="px-6 py-3 text-sm text-gray-700"><?= htmlspecialchars($r['id']) ?></td>
                                <td class="px-6 py-3 text-sm text-gray-700"><?= htmlspecialchars($r['fecha']) ?></td>
                                <td class="px-6 py-3 text-sm text-gray-700"><?= htmlspecialchars($r['sede']) ?></td>
                                <td class="px-6 py-3 text-sm text-gray-700"><?= htmlspecialchars($r['encargado']) ?></td>
                                <td class="px-6 py-3 text-sm text-gray-700"><?= htmlspecialchars($r['mes']) ?></td>
                                <td class="px-6 py-3 text-sm text-gray-700"><?= htmlspecialchars($r['marca']) ?></td>
                                <td class="px-6 py-3 text-sm text-gray-700"><?= htmlspecialchars($r['calibre']) ?></td>
                                <td class="px-6 py-3 text-sm text-gray-700"><?= htmlspecialchars($r['cantidad']) ?></td>
                                <td class="px-6 py-3 text-sm text-gray-700"><?= htmlspecialchars($r['nombre_alimento']) ?></td>
                                <td class="px-6 py-3 text-sm text-gray-700 whitespace-pre-wrap min-w-[200px]"><?= htmlspecialchars($r['observaciones']) ?></td>
                                <td class="px-6 py-3 text-sm">
                                    <span class="<?= $r['estado'] === 'pendiente' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' ?> text-xs font-semibold px-2.5 py-0.5 rounded-full">
                                        <?= htmlspecialchars(ucfirst($r['estado'])) ?>
                                    </span>
                                </td>
                                <td class="px-6 py-3 text-sm text-gray-700"><?= htmlspecialchars($r['fecha_registro']) ?></td>
                                <td class="px-6 py-3 text-sm text-gray-700 text-center text-lg"><?= $r['revisado'] ? '✅' : '⏳' ?></td>
                                <td class="px-6 py-3 text-center text-sm font-medium">
                                    <div class="flex justify-center space-x-2">
                                        <a href="index.php?controller=Supervisor&action=bpa1&id=<?= urlencode($r['id']) ?>" class="bg-blue-500 text-white px-3 py-1 rounded-md hover:bg-blue-600 transition">Ver</a>
                                        <a href="index.php?controller=Supervisor&action=editarBpa1&id=<?= urlencode($r['id']) ?>" class="bg-yellow-500 text-white px-3 py-1 rounded-md hover:bg-yellow-600 transition">Editar</a>
                                        <button onclick="eliminarBpa(<?= htmlspecialchars($r['id']) ?>)" class="bg-red-600 text-white px-3 py-1 rounded-md hover:bg-red-700 transition">Eliminar</button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="14" class="text-center py-6 text-gray-500">No hay reportes BPA-1 registrados.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="mt-8">
            <a href="index.php?controller=Supervisor&action=inventarioGeneral"
               class="inline-block bg-gray-500 text-white px-5 py-2 rounded-lg hover:bg-gray-600 transition font-medium">
                ← Volver al Inventario General
            </a>
        </div>
    </div>

    <!-- 🔁 Auto actualización -->
    <script>
        let ultimoId = <?= !empty($reportes) ? max(array_column($reportes, 'id')) : 0 ?>;

        function actualizarTabla() {
            fetch(`index.php?controller=Supervisor&action=listarBpaAjax&ultimoId=${ultimoId}`)
                .then(res => res.json())
                .then(data => {
                    if (data.nuevos && data.nuevos.length > 0) {
                        const tbody = document.querySelector('#tablaBpa tbody');
                        const filaNoDatos = tbody.querySelector('td[colspan="14"]');
                        if (filaNoDatos) filaNoDatos.parentElement.remove();

                        data.nuevos.forEach(r => {
                            const fila = document.createElement('tr');
                            fila.id = `fila-${r.id}`;
                            fila.className = "hover:bg-gray-50 align-top";
                            const estadoClass = r.estado === 'pendiente' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800';
                            const estadoTexto = r.estado.charAt(0).toUpperCase() + r.estado.slice(1);
                            const revisadoIcon = r.revisado ? '✅' : '⏳';
                            fila.innerHTML = `
                                <td class="px-6 py-3 text-sm text-gray-700">${r.id}</td>
                                <td class="px-6 py-3 text-sm text-gray-700">${r.fecha}</td>
                                <td class="px-6 py-3 text-sm text-gray-700">${r.sede}</td>
                                <td class="px-6 py-3 text-sm text-gray-700">${r.encargado}</td>
                                <td class="px-6 py-3 text-sm text-gray-700">${r.mes}</td>
                                <td class="px-6 py-3 text-sm text-gray-700">${r.marca}</td>
                                <td class="px-6 py-3 text-sm text-gray-700">${r.calibre}</td>
                                <td class="px-6 py-3 text-sm text-gray-700">${r.cantidad}</td>
                                <td class="px-6 py-3 text-sm text-gray-700">${r.nombre_alimento}</td>
                                <td class="px-6 py-3 text-sm text-gray-700 whitespace-pre-wrap min-w-[200px]">${r.observaciones}</td>
                                <td class="px-6 py-3 text-sm"><span class="${estadoClass} text-xs font-semibold px-2.5 py-0.5 rounded-full">${estadoTexto}</span></td>
                                <td class="px-6 py-3 text-sm text-gray-700">${r.fecha_registro}</td>
                                <td class="px-6 py-3 text-sm text-gray-700 text-center text-lg">${revisadoIcon}</td>
                                <td class="px-6 py-3 text-center text-sm font-medium">
                                    <div class="flex justify-center space-x-2">
                                        <a href="index.php?controller=Supervisor&action=bpa1&id=${r.id}" class="bg-blue-500 text-white px-3 py-1 rounded-md hover:bg-blue-600 transition">Ver</a>
                                        <a href="index.php?controller=Supervisor&action=editarBpa1&id=${r.id}" class="bg-yellow-500 text-white px-3 py-1 rounded-md hover:bg-yellow-600 transition">Editar</a>
                                        <button onclick="eliminarBpa(${r.id})" class="bg-red-600 text-white px-3 py-1 rounded-md hover:bg-red-700 transition">Eliminar</button>
                                    </div>
                                </td>`;
                            tbody.prepend(fila);
                        });
                        ultimoId = Math.max(...data.nuevos.map(r => parseInt(r.id)));
                    }
                })
                .catch(err => console.error('Error al actualizar tabla BPA:', err));
        }
        setInterval(actualizarTabla, 500);
    </script>

    <!-- 🧠 FILTROS Y VISUALIZACIÓN -->
    <script>
        const busquedaInput = document.getElementById('busquedaInput');
        const busquedaTipo = document.getElementById('busquedaTipo');
        const mostrarCantidad = document.getElementById('mostrarCantidad');
        const tabla = document.querySelector('#tablaBpa tbody');

        function aplicarFiltros() {
            const tipo = busquedaTipo.value;
            const texto = busquedaInput.value.toLowerCase();
            const filas = tabla.querySelectorAll('tr');
            let visibles = 0;
            filas.forEach(fila => {
                const mes = fila.children[4]?.textContent.toLowerCase() || '';
                const fecha = fila.children[1]?.textContent.toLowerCase() || '';
                const coincide = tipo === 'mes' ? mes.includes(texto) : fecha.includes(texto);
                if (coincide || texto === '') {
                    fila.style.display = '';
                    visibles++;
                } else {
                    fila.style.display = 'none';
                }
            });

            // Aplicar límite de cantidad visible
            const limite = mostrarCantidad.value === 'todos' ? visibles : parseInt(mostrarCantidad.value);
            let contador = 0;
            filas.forEach(fila => {
                if (fila.style.display !== 'none') {
                    contador++;
                    fila.style.display = contador <= limite ? '' : 'none';
                }
            });
        }

        busquedaInput.addEventListener('input', aplicarFiltros);
        busquedaTipo.addEventListener('change', aplicarFiltros);
        mostrarCantidad.addEventListener('change', aplicarFiltros);
    </script>

    <script>
        function eliminarBpa(id) {
            if (confirm('¿Seguro que deseas eliminar este registro BPA-1?')) {
                fetch(`index.php?controller=Supervisor&action=eliminarBpa1`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: `id=${id}`
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        alert('Registro eliminado correctamente');
                        document.querySelector(`#fila-${id}`)?.remove();
                        const tbody = document.querySelector('#tablaBpa tbody');
                        if (tbody.rows.length === 0) {
                            tbody.innerHTML = '<tr><td colspan="14" class="text-center py-6 text-gray-500">No hay reportes BPA-1 registrados.</td></tr>';
                        }
                    } else {
                        alert('Error al eliminar el registro: ' + (data.message || 'Error desconocido'));
                    }
                })
                .catch(err => console.error('Error al eliminar BPA:', err));
            }
        }
    </script>

</body>
</html>
