<?php include __DIR__ . '/../templates/header.php'; ?>

<div class="container mt-4">
    <h2>📑 Reportes del Supervisor</h2>
    <p class="lead">Bienvenido, <b><?php echo $usuario['nombre']; ?></b></p>

    <?php if (!empty($reportes)): ?>
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Fecha</th>
                    <th>Descripción</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reportes as $r): ?>
                <tr>
                    <td><?php echo $r['id']; ?></td>
                    <td><?php echo $r['titulo']; ?></td>
                    <td><?php echo $r['fecha']; ?></td>
                    <td><?php echo $r['descripcion']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="text-muted">No hay reportes registrados.</p>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/../templates/footer.php'; ?>
