<?php include __DIR__ . '/../templates/header.php'; ?>

<div class="container mt-4">
    <h2 class="mb-3">📊 Panel del Jefe de Planta</h2>
    <p class="lead">Bienvenido, <b><?php echo $usuario['nombre']; ?></b></p>

    <!-- Resumen de Producción -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card shadow-sm border-0 rounded-lg">
                <div class="card-body">
                    <h5 class="card-title text-primary">📈 Resumen de Producción</h5>
                    <p class="card-text mb-1">
                        <span class="fw-bold">Total de Lotes:</span> 
                        <?php echo $produccion['total_lotes'] ?? 0; ?>
                    </p>
                    <p class="card-text">
                        <span class="fw-bold">Total Producido:</span> 
                        <?php echo $produccion['total_producido'] ?? 0; ?> unidades
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Estado de Insumos -->
    <div class="card shadow-sm border-0 rounded-lg mb-4">
        <div class="card-body">
            <h5 class="card-title text-success">📦 Estado de Insumos</h5>
            <?php if (!empty($insumos)): ?>
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>Nombre</th>
                                <th>Stock</th>
                                <th>Unidad</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($insumos as $i): ?>
                            <tr>
                                <td><?php echo $i['nombre']; ?></td>
                                <td><?php echo $i['stock']; ?></td>
                                <td><?php echo $i['unidad_medida']; ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <p class="text-muted">No hay insumos registrados.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Botón Reportes -->
    <div class="text-end">
        <a href="index.php?controller=JefePlanta&action=reportes" class="btn btn-primary btn-lg shadow-sm">
            📑 Gestionar Reportes
        </a>
    </div>
</div>

<?php include __DIR__ . '/../templates/footer.php'; ?>
