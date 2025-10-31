<?php include __DIR__ . '/../templates/header.php'; ?>

<div class="container mt-4">
    <h2 class="mb-3">🛠️ Panel del Supervisor</h2>
    <p class="lead">Bienvenido, <b><?php echo $usuario['nombre']; ?></b></p>

    <!-- Producción -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card shadow-sm border-0 rounded-lg">
                <div class="card-body">
                    <h5 class="card-title text-primary">📈 Producción en Curso</h5>
                    <p><b>Total de Lotes:</b> <?php echo $produccion['total_lotes'] ?? 0; ?></p>
                    <p><b>Total Producido:</b> <?php echo $produccion['total_producido'] ?? 0; ?> unidades</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Insumos -->
    <div class="card shadow-sm border-0 rounded-lg mb-4">
        <div class="card-body">
            <h5 class="card-title text-success">📦 Insumos Asignados</h5>
            <?php if (!empty($insumos)): ?>
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr><th>Nombre</th><th>Stock</th><th>Unidad</th></tr>
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
            <?php else: ?>
                <p class="text-muted">No hay insumos registrados.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Personal -->
    <div class="card shadow-sm border-0 rounded-lg mb-4">
        <div class="card-body">
            <h5 class="card-title text-info">👷‍♂️ Personal en Turno</h5>
            <?php if (!empty($personal)): ?>
                <table class="table table-bordered">
                    <thead class="table-secondary">
                        <tr><th>Nombre</th><th>Rol</th><th>Turno</th></tr>
                    </thead>
                    <tbody>
                        <?php foreach ($personal as $p): ?>
                        <tr>
                            <td><?php echo $p['nombre']; ?></td>
                            <td><?php echo $p['rol']; ?></td>
                            <td><?php echo $p['turno']; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="text-muted">No hay personal asignado en este turno.</p>
            <?php endif; ?>
        </div>
    </div>
        <!-- Formularios BPA-1 recibidos -->
    <div class="card shadow-sm border-0 rounded-lg mb-4">
        <div class="card-body">
            <h5 class="card-title text-warning">📄 Formularios BPA-1 Recibidos</h5>

            <?php if (!empty($bpa1_pendientes)): ?>
                <table class="table table-hover align-middle">
                    <thead class="table-warning">
                        <tr>
                            <th>#</th>
                            <th>Fecha</th>
                            <th>Sede</th>
                            <th>Encargado</th>
                            <th>Mes</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($bpa1_pendientes as $i => $b): ?>
                            <tr>
                                <td><?php echo $i + 1; ?></td>
                                <td><?php echo htmlspecialchars($b['fecha']); ?></td>
                                <td><?php echo htmlspecialchars($b['sede']); ?></td>
                                <td><?php echo htmlspecialchars($b['encargado']); ?></td>
                                <td><?php echo htmlspecialchars($b['mes']); ?></td>
                                <td>
                                    <a href="index.php?controller=Supervisor&action=revisarBPA1&id=<?php echo $b['id']; ?>" class="btn btn-outline-warning btn-sm">
                                        🔍 Revisar
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="text-muted">No hay formularios BPA-1 pendientes de revisión.</p>
            <?php endif; ?>
        </div>
    </div>


    <!-- Reportes -->
    <div class="text-end">
        <a href="index.php?controller=Supervisor&action=reportes" class="btn btn-primary btn-lg shadow-sm">
            📑 Ver Reportes
        </a>
    </div>
</div>

<?php include __DIR__ . '/../templates/footer.php'; ?>
