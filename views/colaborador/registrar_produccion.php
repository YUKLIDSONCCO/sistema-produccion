<?php include __DIR__ . '/../templates/header.php'; ?>

<div class="container mt-4">
    <h2>➕ Registrar Producción</h2>
    <p class="lead">Colaborador: <b><?php echo $usuario['nombre']; ?></b></p>

    <form method="POST" action="index.php?controller=Colaborador&action=registrarProduccion" class="p-4 border rounded shadow-sm bg-light">
        <div class="mb-3">
            <label class="form-label">Lote</label>
            <input type="text" name="lote" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Cantidad Producida</label>
            <input type="number" name="cantidad" class="form-control" required min="1">
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="index.php?controller=Colaborador&action=dashboard" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?php include __DIR__ . '/../templates/footer.php'; ?>
