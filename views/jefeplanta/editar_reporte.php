<?php include __DIR__ . '/../templates/header.php'; ?>
<h2>✏ Editar Reporte</h2>

<form method="POST" action="index.php?controller=JefePlanta&action=editarReporte&id=<?php echo $reporte['id_reporte']; ?>">
    <label>Descripción:</label><br>
    <textarea name="descripcion" required><?php echo $reporte['descripcion']; ?></textarea><br><br>
    <button type="submit" class="btn btn-primary">Actualizar</button>
</form>

<a href="index.php?controller=JefePlanta&action=reportes" class="btn btn-secondary">⬅ Cancelar</a>
<?php include __DIR__ . '/../templates/footer.php'; ?>
