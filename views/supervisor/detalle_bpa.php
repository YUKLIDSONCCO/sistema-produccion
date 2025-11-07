<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalles del <?= htmlspecialchars($tipo) ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-orange-50 via-white to-orange-100 min-h-screen p-8">

    <div class="max-w-5xl mx-auto bg-white/90 backdrop-blur-sm rounded-2xl shadow-xl border border-orange-200 p-8">
        <h1 class="text-3xl font-extrabold text-orange-700 mb-6 text-center drop-shadow-sm">
            📋 Detalles de <?= htmlspecialchars($tipo) ?>
        </h1>

        <?php if (!empty($detalle)): ?>
            <div class="overflow-x-auto">
                <table class="min-w-full border border-orange-200 rounded-lg divide-y divide-orange-100">
                    <tbody>
                        <?php foreach ($detalle as $campo => $valor): ?>
                            <tr class="hover:bg-orange-50 transition-colors">
                                <td class="py-3 px-4 font-semibold text-orange-800 capitalize border-b border-orange-100 bg-orange-50/60">
                                    <?= htmlspecialchars(str_replace('_', ' ', $campo)) ?>
                                </td>
                                <td class="py-3 px-4 text-gray-700 border-b border-orange-100">
                                    <?= $valor === null || $valor === '' ? '—' : htmlspecialchars($valor) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="text-center text-gray-500 py-6">No se encontraron datos para este registro.</p>
        <?php endif; ?>

        <div class="mt-8 flex justify-between">
            <a href="index.php?controller=Supervisor&action=listaGlobal"
               class="bg-orange-400 hover:bg-orange-500 text-white px-5 py-2 rounded-lg font-semibold shadow-md hover:shadow-lg transition">
               ⬅ Volver a Lista Global
            </a>

            <a href="index.php?controller=Supervisor&action=listaGlobal&filtro=dia"
               class="bg-orange-600 hover:bg-orange-700 text-white px-5 py-2 rounded-lg font-semibold shadow-md hover:shadow-lg transition">
               🔁 Ver Registros del Día
            </a>
        </div>

        <div class="mt-10 border-t border-orange-200 pt-6">
            <h2 class="text-xl font-bold text-orange-700 mb-4">Acción del Supervisor</h2>

            <div class="flex flex-wrap gap-4">
                <button 
                    onclick="actualizarEstado('Aprobado')" 
                    class="bg-green-500 hover:bg-green-600 text-white font-semibold px-5 py-2 rounded-lg shadow transition-transform hover:scale-105">
                    ✅ Aprobar
                </button>

                <button 
                    onclick="actualizarEstado('Pendiente')" 
                    class="bg-yellow-400 hover:bg-yellow-500 text-white font-semibold px-5 py-2 rounded-lg shadow transition-transform hover:scale-105">
                    ⏸ Pendiente
                </button>

                <button 
                    onclick="actualizarEstado('Desaprobado')" 
                    class="bg-red-500 hover:bg-red-600 text-white font-semibold px-5 py-2 rounded-lg shadow transition-transform hover:scale-105">
                    ❌ Desaprobar
                </button>
            </div>

            <p id="mensaje-estado" class="mt-4 text-gray-700 font-semibold"></p>
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
        if (data.success) {
            msg.textContent = `✅ Estado actualizado a "${estado}" correctamente.`;
            msg.className = "mt-4 text-green-600 font-semibold";
        } else {
            msg.textContent = "❌ Error al actualizar el estado.";
            msg.className = "mt-4 text-red-600 font-semibold";
        }
    })
    .catch(() => {
        document.getElementById('mensaje-estado').textContent = "❌ Error de conexión con el servidor.";
    });
}
</script>

</body>
</html>
