<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>Revisión BPA-1 - Supervisor</title>
<style>
body { font-family: Arial, sans-serif; margin: 30px; background: #f5f6fa; }
h1 { color: #333; }
table { width: 100%; border-collapse: collapse; margin-top: 20px; background: #fff; }
th, td { border: 1px solid #ccc; padding: 8px; text-align: center; }
th { background: #ff7b00; color: #fff; }
.card { background: #fff; padding: 16px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
.btn { padding: 10px 16px; border: none; border-radius: 6px; cursor: pointer; font-weight: bold; }
.btn.aprobar { background: #28a745; color: #fff; }
.btn.rechazar { background: #dc3545; color: #fff; margin-left: 10px; }
.btn.volver { background: #ff7b00; color: #fff; margin-top: 20px; display: inline-block; text-decoration: none; }
</style>
</head>
<body>

<h1>📋 Revisión del Control de Alimento (BPA-1)</h1>

<div class="card">
  <p><strong>Fecha:</strong> <?= htmlspecialchars($data['fecha']) ?></p>
  <p><strong>Sede:</strong> <?= htmlspecialchars($data['sede']) ?></p>
  <p><strong>Encargado:</strong> <?= htmlspecialchars($data['encargado']) ?></p>
  <p><strong>Mes:</strong> <?= htmlspecialchars($data['mes']) ?></p>
</div>

<h2>Detalle de Alimentos</h2>
<table>
  <thead>
    <tr>
      <th>#</th>
      <th>Marca</th>
      <th>Calibre</th>
      <th>Cantidad</th>
      <th>Nombre</th>
      <th>Observaciones</th>
    </tr>
  </thead>
  <tbody>
    <?php if (!empty($data['alimentos'])): ?>
      <?php foreach ($data['alimentos'] as $i => $fila): ?>
        <tr>
          <td><?= $i + 1 ?></td>
          <td><?= htmlspecialchars($fila['marca']) ?></td>
          <td><?= htmlspecialchars($fila['calibre']) ?></td>
          <td><?= htmlspecialchars($fila['cantidad']) ?></td>
          <td><?= htmlspecialchars($fila['nombre']) ?></td>
          <td><?= htmlspecialchars($fila['observacion']) ?></td>
        </tr>
      <?php endforeach; ?>
    <?php else: ?>
      <tr><td colspan="6">No se recibieron alimentos.</td></tr>
    <?php endif; ?>
  </tbody>
</table>

<div style="margin-top:20px;">
  <button class="btn aprobar" onclick="alert('✅ Registro aprobado correctamente')">Aprobar</button>
  <button class="btn rechazar" onclick="alert('❌ Registro rechazado')">Rechazar</button>
</div>

<a href="index.php?controller=Supervisor&action=dashboard" class="btn volver">⬅️ Volver al Panel</a>

</body>
</html>
