<?php include __DIR__ . '/../templates/header.php'; ?>
<h2>📑 Reportes de Producción</h2>

<a href="index.php?controller=JefePlanta&action=crearReporte" class="btn btn-success">➕ Nuevo Reporte</a>
<br><br>

<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>ID</th>
            <th>Fecha</th>
            <th>Descripción</th>
            <th>Responsable</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($reportes as $r): ?>
        <tr>
            <td><?php echo $r['id_reporte']; ?></td>
            <td><?php echo $r['fecha']; ?></td>
            <td><?php echo $r['descripcion']; ?></td>
            <td><?php echo $r['responsable']; ?></td>
            <td>
                <a href="index.php?controller=JefePlanta&action=editarReporte&id=<?php echo $r['id_reporte']; ?>">✏ Editar</a> | 
                <a href="index.php?controller=JefePlanta&action=eliminarReporte&id=<?php echo $r['id_reporte']; ?>" onclick="return confirm('¿Seguro de eliminar?')">🗑 Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<a href="index.php?controller=JefePlanta&action=dashboard" class="btn btn-secondary">⬅ Volver</a>
<?php include __DIR__ . '/../templates/footer.php'; ?>
