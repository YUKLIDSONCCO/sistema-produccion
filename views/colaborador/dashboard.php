<?php include __DIR__ . '/../templates/header.php'; ?>

<div class="container mt-4">
    <h2>👷 Panel del Colaborador</h2>
    <p class="lead">Bienvenido, <b><?php echo $usuario['nombre']; ?></b></p>

    <!-- Tareas -->
    <div class="card shadow-sm border-0 rounded-lg mb-4">
        <div class="card-body">
            <h5 class="card-title text-primary">📋 Tareas Asignadas</h5>
            <?php if (!empty($tareas)): ?>
                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr><th>ID</th><th>Descripción</th><th>Estado</th><th>Fecha</th></tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tareas as $t): ?>
                        <tr>
                            <td><?php echo $t['id']; ?></td>
                            <td><?php echo $t['descripcion']; ?></td>
                            <td><?php echo $t['estado']; ?></td>
                            <td><?php echo $t['fecha']; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="text-muted">No tienes tareas asignadas.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Insumos -->
    <div class="card shadow-sm border-0 rounded-lg mb-4">
        <div class="card-body">
            <h5 class="card-title text-success">📦 Insumos Disponibles</h5
