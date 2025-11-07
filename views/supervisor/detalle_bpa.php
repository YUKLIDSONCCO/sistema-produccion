<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalles del <?= htmlspecialchars($tipo) ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">

    <div class="max-w-5xl mx-auto bg-white rounded-xl shadow-lg p-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">
            📋 Detalles de <?= htmlspecialchars($tipo) ?>
        </h1>

        <?php if (!empty($detalle)): ?>
            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-300 rounded-lg divide-y divide-gray-200">
                    <tbody>
                        <?php foreach ($detalle as $campo => $valor): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="py-3 px-4 font-semibold text-gray-700 capitalize border-b border-gray-200">
                                    <?= htmlspecialchars(str_replace('_', ' ', $campo)) ?>
                                </td>
                                <td class="py-3 px-4 text-gray-600 border-b border-gray-200">
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
               class="bg-gray-500 text-white px-5 py-2 rounded-lg hover:bg-gray-600 transition">
               ⬅ Volver a Lista Global
            </a>

            <a href="index.php?controller=Supervisor&action=listaGlobal&filtro=dia"
               class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition">
               🔁 Ver Registros del Día
            </a>
        </div>
        <div class="mt-10 border-t pt-6">
    <h2 class="text-xl font-bold text-gray-800 mb-4">Acción del Supervisor</h2>

    <div class="flex flex-wrap gap-4">
        <button 
            onclick="actualizarEstado('Aprobado')" 
            class="bg-green-600 hover:bg-green-700 text-white font-semibold px-5 py-2 rounded-lg shadow">
            ✅ Aprobar
        </button>

        <button 
            onclick="actualizarEstado('Pendiente')" 
            class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold px-5 py-2 rounded-lg shadow">
            ⏸ Pendiente
        </button>

        <button 
            onclick="actualizarEstado('Desaprobado')" 
            class="bg-red-600 hover:bg-red-700 text-white font-semibold px-5 py-2 rounded-lg shadow">
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
