<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalles del <?= htmlspecialchars($tipo) ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #fff8f2 0%, #ffe7cc 100%);
        }

        .btn {
            transition: all 0.25s ease;
        }

        .btn:hover {
            transform: translateY(-2px) scale(1.03);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
        }

        table td:first-child {
            background: #fff3e0;
            font-weight: 600;
            color: #c05621;
        }

        table tr:nth-child(even) {
            background: #fffdf9;
        }
    </style>
</head>
<body class="min-h-screen p-10 flex items-center justify-center">

    <div class="w-full max-w-5xl bg-white/90 backdrop-blur-md border border-orange-200 rounded-3xl shadow-2xl p-10">

        <!-- 🧾 Título -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-orange-700 drop-shadow">
                📋 Detalles de <?= htmlspecialchars($tipo) ?>
            </h1>
            <p class="text-gray-600 mt-2 text-base">Consulta y gestiona la información completa del registro seleccionado.</p>
        </div>

        <!-- 📑 Tabla de Detalles -->
        <?php if (!empty($detalle)): ?>
            <div class="overflow-hidden border border-orange-200 rounded-2xl shadow-inner">
                <table class="min-w-full text-gray-800">
                    <tbody>
                        <?php foreach ($detalle as $campo => $valor): ?>
                            <tr class="hover:bg-orange-50 transition-colors">
                                <td class="py-3 px-5 capitalize border-b border-orange-100">
                                    <?= htmlspecialchars(str_replace('_', ' ', $campo)) ?>
                                </td>
                                <td class="py-3 px-5 border-b border-orange-100 text-gray-700">
                                    <?= $valor === null || $valor === '' ? '—' : htmlspecialchars($valor) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="text-center text-gray-500 py-6 text-lg">No se encontraron datos para este registro.</p>
        <?php endif; ?>

        <!-- 🔙 Botones de navegación -->
        <div class="mt-10 flex flex-wrap justify-between gap-3">
            <a href="index.php?controller=Supervisor&action=listaGlobal"
               class="btn bg-gradient-to-r from-orange-400 to-orange-500 text-white px-6 py-2.5 rounded-lg font-semibold shadow">
               ⬅ Volver a Lista Global
            </a>

            <a href="index.php?controller=Supervisor&action=listaGlobal&filtro=dia"
               class="btn bg-gradient-to-r from-orange-600 to-orange-700 text-white px-6 py-2.5 rounded-lg font-semibold shadow">
               🔁 Ver Registros del Día
            </a>
        </div>

        <!-- ⚙️ Acción del Supervisor -->
        <div class="mt-12 border-t border-orange-200 pt-8">
            <h2 class="text-2xl font-bold text-orange-700 mb-6 text-center">Acción del Supervisor</h2>

            <div class="flex flex-wrap justify-center gap-6">
                <button 
                    onclick="actualizarEstado('Aprobado')" 
                    class="btn bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white font-semibold px-6 py-2.5 rounded-lg shadow">
                    ✅ Aprobar
                </button>

                <button 
                    onclick="actualizarEstado('Pendiente')" 
                    class="btn bg-gradient-to-r from-yellow-400 to-yellow-500 hover:from-yellow-500 hover:to-yellow-600 text-white font-semibold px-6 py-2.5 rounded-lg shadow">
                    ⏸ Pendiente
                </button>

                <button 
                    onclick="actualizarEstado('Desaprobado')" 
                    class="btn bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-semibold px-6 py-2.5 rounded-lg shadow">
                    ❌ Desaprobar
                </button>
            </div>

            <div id="mensaje-estado" class="mt-6 text-center text-lg font-semibold transition-all"></div>
        </div>
    </div>

    <script>
    function actualizarEstado(estado) {
        if (!confirm(`¿Seguro que deseas marcar como "${estado}" este registro?`)) return;

        fetch('index.php?controller=Supervisor&action=actualizarEstadoBPA', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams({
                tipo: '<?= htmlspecialchars($tipo) ?>',
                id: '<?= htmlspecialchars($detalle['id']) ?>',
                estado: estado
            })
        })
        .then(res => res.json())
        .then(data => {
            const msg = document.getElementById('mensaje-estado');
            msg.style.opacity = '1';
            if (data.success) {
                msg.textContent = `✅ Estado actualizado a "${estado}" correctamente.`;
                msg.className = "mt-6 text-green-600 font-semibold text-center text-lg";
            } else {
                msg.textContent = "❌ Error al actualizar el estado.";
                msg.className = "mt-6 text-red-600 font-semibold text-center text-lg";
            }
        })
        .catch(() => {
            const msg = document.getElementById('mensaje-estado');
            msg.textContent = "⚠️ Error de conexión con el servidor.";
            msg.className = "mt-6 text-yellow-600 font-semibold text-center text-lg";
        });
    }
    </script>

</body>
</html>
