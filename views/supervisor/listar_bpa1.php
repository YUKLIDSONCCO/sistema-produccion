<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes BPA-1</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #fff7ed 0%, #ffedd5 100%);
            min-height: 100vh;
        }

        h1 {
            background: linear-gradient(90deg, #f97316, #fb923c);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .tabla-container {
            background: rgba(255, 255, 255, 0.96);
            backdrop-filter: blur(10px);
            border-radius: 1rem;
            border: 1px solid rgba(249, 115, 22, 0.15);
            box-shadow: 0 6px 18px rgba(249, 115, 22, 0.15);
            overflow: hidden;
            transition: 0.3s ease;
        }

        .tabla-container:hover {
            box-shadow: 0 10px 25px rgba(249, 115, 22, 0.25);
        }

        table th {
            background: linear-gradient(90deg, #fb923c, #f97316);
            color: white;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
        }

        table tr:nth-child(even) {
            background-color: #fff7ed;
        }

        table tr:hover {
            background-color: #ffedd5;
            transition: background 0.25s ease;
        }

        select, input {
            transition: all 0.25s ease;
        }

        select:focus, input:focus {
            border-color: #f97316;
            box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.25);
        }

        .btn {
            font-weight: 600;
            transition: all 0.25s ease;
            border-radius: 0.5rem;
        }

        .btn-orange {
            background: linear-gradient(90deg, #fb923c, #f97316);
            color: white;
        }
        .btn-orange:hover {
            background: linear-gradient(90deg, #f97316, #ea580c);
            box-shadow: 0 4px 12px rgba(249, 115, 22, 0.3);
            transform: translateY(-1px);
        }

        .btn-yellow {
            background: linear-gradient(90deg, #facc15, #eab308);
            color: #fff;
        }
        .btn-yellow:hover {
            background: linear-gradient(90deg, #eab308, #ca8a04);
            box-shadow: 0 4px 12px rgba(234, 179, 8, 0.3);
            transform: translateY(-1px);
        }

        .btn-red {
            background: linear-gradient(90deg, #ef4444, #dc2626);
            color: white;
        }
        .btn-red:hover {
            background: linear-gradient(90deg, #dc2626, #b91c1c);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
            transform: translateY(-1px);
        }

        .btn-gray {
            background: #fb923c;
            color: white;
        }
        .btn-gray:hover {
            background: #f97316;
            box-shadow: 0 4px 10px rgba(249, 115, 22, 0.3);
        }

        .badge {
            font-weight: 600;
            border-radius: 9999px;
            padding: 0.25rem 0.75rem;
            font-size: 0.75rem;
        }

        .badge-pendiente {
            background-color: #fff7ed;
            color: #c2410c;
            border: 1px solid #fdba74;
        }

        .badge-aprobado {
            background-color: #fef3c7;
            color: #92400e;
            border: 1px solid #fdba74;
        }
    </style>
</head>
<body>

    <div class="w-full p-4 sm:p-8">
        <h1 class="text-3xl font-extrabold mb-8 text-center">🧾 Reportes BPA-1</h1>

        <!-- 🔍 FILTROS -->
        <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4 bg-white shadow-sm p-4 rounded-lg border border-orange-200">
            <div class="flex items-center gap-2">
                <label for="busquedaTipo" class="text-gray-700 text-sm font-medium">Buscar por:</label>
                <select id="busquedaTipo" class="border border-orange-300 rounded-md px-3 py-1 text-sm">
                    <option value="mes">Mes</option>
                    <option value="semana">Semana</option>
                </select>
                <input type="text" id="busquedaInput" placeholder="Escribe el mes o semana..." 
                       class="border border-orange-300 rounded-md px-3 py-1 text-sm w-48">
            </div>

            <div class="flex items-center gap-2">
                <label for="mostrarCantidad" class="text-gray-700 text-sm font-medium">Ver:</label>
                <select id="mostrarCantidad" class="border border-orange-300 rounded-md px-3 py-1 text-sm">
                    <option value="10">10</option>
                    <option value="15">15</option>
                    <option value="todos">Todos</option>
                </select>
            </div>
        </div>

        <!-- 📋 TABLA -->
        <div class="overflow-x-auto tabla-container">
            <table class="min-w-full table-auto" id="tablaBpa">
                <thead class="text-white text-xs uppercase tracking-wider">
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
                    </tr>
                </thead>
                <tbody class="divide-y divide-orange-100">
                    <?php if (!empty($reportes)): ?>
                        <?php foreach ($reportes as $r): ?>
                            <tr id="fila-<?= htmlspecialchars($r['id']) ?>" class="hover:bg-orange-50 align-top transition">
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
                                    <span class="badge <?= $r['estado'] === 'pendiente' ? 'badge-pendiente' : 'badge-aprobado' ?>">
                                        <?= htmlspecialchars(ucfirst($r['estado'])) ?>
                                    </span>
                                </td>
                                <td class="px-6 py-3 text-sm text-gray-700"><?= htmlspecialchars($r['fecha_registro']) ?></td>
                                <td class="px-6 py-3 text-center text-lg"><?= $r['revisado'] ? '✅' : '⏳' ?></td>
                                <td class="px-6 py-3 text-center text-sm font-medium">
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="14" class="text-center py-6 text-gray-500">No hay reportes BPA-1 registrados.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="mt-8 text-center">
            <a href="index.php?controller=Supervisor&action=inventarioGeneral"
               class="btn btn-gray px-5 py-2 text-sm">← Volver al Inventario General</a>
        </div>
    </div>

    <!-- 🔁 Tus scripts originales permanecen igual -->
</body>
</html>
