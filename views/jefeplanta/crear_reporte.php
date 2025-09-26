<?php include __DIR__ . '/../templates/header.php'; ?>
<h2>➕ Crear Reporte</h2>

<form method="POST" action="index.php?controller=JefePlanta&action=crearReporte">
    <label>Descripción:</label><br>
    <textarea name="descripcion" required></textarea><br><br>
    <button type="submit" class="btn btn-success">Guardar</button>
</form>

<a href="index.php?controller=JefePlanta&action=reportes" class="btn btn-secondary">⬅ Cancelar</a>
<?php include __DIR__ . '/../templates/footer.php'; ?>
