<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar BPA-1</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
<div class="max-w-3xl mx-auto mt-10 bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4 text-gray-700">✏️ Editar Reporte BPA-1</h1>
    <form action="index.php?controller=Supervisor&action=actualizarBpa1" method="POST" class="space-y-4">
        <input type="hidden" name="id" value="<?= htmlspecialchars($reporte['id']) ?>">

        <div>
            <label class="block font-semibold">Fecha:</label>
            <input type="date" name="fecha" value="<?= htmlspecialchars($reporte['fecha']) ?>" class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-semibold">Sede:</label>
            <input type="text" name="sede" value="<?= htmlspecialchars($reporte['sede']) ?>" class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-semibold">Encargado:</label>
            <input type="text" name="encargado" value="<?= htmlspecialchars($reporte['encargado']) ?>" class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-semibold">Cantidad (kg):</label>
            <input type="number" name="cantidad" value="<?= htmlspecialchars($reporte['cantidad']) ?>" class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-semibold">Estado:</label>
            <select name="estado" class="w-full border rounded px-3 py-2">
                <option value="pendiente" <?= $reporte['estado'] === 'pendiente' ? 'selected' : '' ?>>Pendiente</option>
                <option value="completado" <?= $reporte['estado'] === 'completado' ? 'selected' : '' ?>>Completado</option>
            </select>
        </div>

        <div class="flex justify-between mt-6">
            <a href="index.php?controller=Supervisor&action=listarBpa1"
               class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">← Volver</a>

            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">💾 Guardar Cambios</button>
        </div>
    </form>
</div>
</body>
</html>
