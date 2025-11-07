<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>📋 Lista Global de Reportes BPA</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            background: linear-gradient(135deg, #fff8f2 0%, #ffe7cc 100%);
            font-family: 'Inter', sans-serif;
        }

        h1 {
            background: linear-gradient(90deg, #ff7b00, #ffae42);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        table th {
            background: linear-gradient(90deg, #ff7b00, #ffae42);
        }

        .btn-orange {
            background: linear-gradient(90deg, #ff7b00, #ff9900);
        }

        .btn-orange:hover {
            background: linear-gradient(90deg, #ff6a00, #ff8800);
        }

        .shadow-orange {
            box-shadow: 0 4px 12px rgba(255, 122, 0, 0.2);
        }

        .shadow-orange:hover {
            box-shadow: 0 6px 18px rgba(255, 122, 0, 0.3);
        }

        input[type="date"] {
            background-color: #fff;
        }

        .rounded-lg {
            border-radius: 0.75rem;
        }

        .transition-all {
            transition: all 0.25s ease;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col items-center justify-start p-6">

    <h1 class="text-3xl font-bold mb-6 text-center">
        🧾 Lista Global de Reportes BPA
    </h1>

    <!-- 🔍 Selector de fecha -->
    <form action="index.php" method="get" class="flex flex-wrap justify-center items-center gap-3 mb-8 bg-white p-4 rounded-xl shadow-orange border border-orange-100">
        <input type="hidden" name="controller" value="Supervisor">
        <input type="hidden" name="action" value="listaGlobal">

        <label for="fecha" class="text-gray-800 font-semibold">Selecciona una fecha:</label>
        <input 
            type="date" 
            id="fecha" 
            name="fecha"
            value="<?= isset($_GET['fecha']) ? htmlspecialchars($_GET['fecha']) : '' ?>"
            class="border border-orange-200 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-orange-400"
        >
        <button 
            type="submit" 
            class="btn-orange hover:scale-[1.03] text-white px-5 py-2 rounded-lg font-semibold shadow transition-all">
            Buscar
        </button>
    </form>

    <div class="bg-white shadow-orange rounded-xl overflow-hidden w-full max-w-6xl border border-orange-100">
        <table class="min-w-full border border-gray-200">
            <thead class="text-white">
                <tr>
                    <th class="py-3 px-4 text-left">Tipo</th>
                    <th class="py-3 px-4 text-left">Fecha</th>
                    <th class="py-3 px-4 text-left">Sede</th>
                    <th class="py-3 px-4 text-left">Encargado</th>
                    <th class="py-3 px-4 text-center">Revisado</th>
                    <th class="py-3 px-4 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($reportes)): ?>
                    <?php foreach ($reportes as $r): ?>
                        <tr class="border-b hover:bg-orange-50 transition-all">
                            <td class="py-2 px-4 font-semibold text-gray-800"><?= htmlspecialchars($r['tipo']) ?></td>
                            <td class="py-2 px-4 text-gray-700"><?= htmlspecialchars($r['fecha']) ?></td>
                            <td class="py-2 px-4 text-gray-700"><?= htmlspecialchars($r['sede']) ?></td>
                            <td class="py-2 px-4 text-gray-700"><?= htmlspecialchars($r['encargado']) ?></td>
                            <td class="py-2 px-4 text-center text-lg">
                                <?= $r['revisado'] ? '✅' : '⏳' ?>
                            </td>
                            <td class="py-2 px-4 text-center">
                                <a href="<?= htmlspecialchars("index.php?controller=Supervisor&action=verDetallesBPA&tipo={$r['tipo']}&id={$r['id']}") ?>"
                                   class="inline-flex items-center px-3 py-1.5 btn-orange text-white rounded-lg text-sm font-medium shadow hover:scale-[1.03] transition-all">
                                   Ver Detalles
                                   <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                       <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                   </svg>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center py-6 text-gray-500 bg-orange-50">
                            No hay reportes registrados para la fecha seleccionada.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</body>
</html>
