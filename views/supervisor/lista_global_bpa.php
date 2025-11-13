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

        .btn-orange {
            background: linear-gradient(90deg, #ff7b00, #ff9900);
            box-shadow: 0 4px 12px rgba(255, 122, 0, 0.25);
            transition: all 0.25s ease;
        }

        .btn-orange:hover {
            background: linear-gradient(90deg, #ff6a00, #ff8800);
            transform: translateY(-2px) scale(1.04);
            box-shadow: 0 6px 18px rgba(255, 122, 0, 0.35);
        }

        th {
            background: linear-gradient(90deg, #ff7b00, #ffae42);
        }

        .table-container {
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(255, 122, 0, 0.15);
            border: 1px solid #ffe0b3;
        }

        tr:hover {
            background-color: #fff4e5;
        }

        td, th {
            transition: all 0.2s ease;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col items-center justify-start px-8 py-10">

    <!-- 🔸 Encabezado -->
    <header class="text-center mb-10">
        <h1 class="text-4xl font-extrabold tracking-tight mb-2">🧾 Lista Global de Reportes BPA</h1>
        <p class="text-gray-700 text-base">Consulta y gestiona los reportes registrados por fecha y tipo.</p>
    </header>

    <!-- 🔍 Selector de fecha -->
    <form action="index.php" method="get" 
          class="flex flex-wrap justify-center items-center gap-4 mb-10 bg-white px-6 py-5 rounded-2xl shadow-md border border-orange-100 w-full max-w-4xl">
        <input type="hidden" name="controller" value="Supervisor">
        <input type="hidden" name="action" value="listaGlobal">

        <label for="fecha" class="text-gray-800 font-semibold">Selecciona una fecha:</label>
        <input 
            type="date" 
            id="fecha" 
            name="fecha"
            value="<?= isset($_GET['fecha']) ? htmlspecialchars($_GET['fecha']) : '' ?>"
            class="border border-orange-300 rounded-lg px-3 py-2 w-52 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-orange-400 transition-all"
        >

        <button type="submit" 
            class="btn-orange text-white px-6 py-2.5 rounded-lg font-semibold shadow hover:scale-[1.03] transition-all">
            Buscar
        </button>
    </form>

    <!-- 📋 Tabla -->
    <div class="bg-white table-container w-full max-w-7xl">
        <table class="min-w-full text-sm text-gray-700">
            <thead class="text-white uppercase text-[15px]">
                <tr>
                    <th class="py-3.5 px-5 text-left font-semibold">Tipo</th>
                    <th class="py-3.5 px-5 text-left font-semibold">Fecha</th>
                    <th class="py-3.5 px-5 text-left font-semibold">Sede</th>
                    <th class="py-3.5 px-5 text-left font-semibold">Encargado</th>
                    <th class="py-3.5 px-5 text-center font-semibold">Revisado</th>
                    <th class="py-3.5 px-5 text-center font-semibold">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($reportes)): ?>
                    <?php foreach ($reportes as $r): ?>
                        <tr class="border-b border-orange-100 hover:bg-orange-50 transition-all">
                            <td class="py-3 px-5 font-semibold text-gray-800"><?= htmlspecialchars($r['tipo']) ?></td>
                            <td class="py-3 px-5 text-gray-700"><?= htmlspecialchars($r['fecha']) ?></td>
                            <td class="py-3 px-5 text-gray-700"><?= htmlspecialchars($r['sede']) ?></td>
                            <td class="py-3 px-5 text-gray-700"><?= htmlspecialchars($r['encargado']) ?></td>
                            <td class="py-3 px-5 text-center text-lg">
                                <?= $r['revisado'] ? '✅' : '⏳' ?>
                            </td>
                            <td class="py-3 px-5 text-center">
                                <a href="<?= htmlspecialchars("index.php?controller=Supervisor&action=verDetallesBPA&tipo={$r['tipo']}&id={$r['id']}") ?>"
                                   class="inline-flex items-center px-4 py-2 btn-orange text-white rounded-lg text-sm font-medium shadow hover:scale-[1.04] transition-all">
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
                        <td colspan="6" class="text-center py-8 text-gray-500 bg-orange-50">
                            No hay reportes registrados para la fecha seleccionada.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</body>
</html>
