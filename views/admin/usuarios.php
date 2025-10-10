<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios</title>
    <link rel="stylesheet" href="/sistema-produccion/public/css/style_admin.css">
    <style>
        /* Estilos adicionales para el CRUD */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
        }
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border-radius: 8px;
            width: 50%;
            max-width: 600px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }
        .close:hover {
            color: black;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-group input, .form-group select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .btn {
            padding: 8px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-right: 5px;
        }
        .btn-primary {
            background-color: #007bff;
            color: white;
        }
        .btn-success {
            background-color: #28a745;
            color: white;
        }
        .btn-danger {
            background-color: #dc3545;
            color: white;
        }
        .btn-warning {
            background-color: #ffc107;
            color: black;
        }
        .btn-info {
            background-color: #17a2b8;
            color: white;
        }
        .btn:hover {
            opacity: 0.9;
        }
        .acciones {
            display: flex;
            gap: 5px;
        }
        .acciones a {
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 14px;
        }
        .btn-volver {
    display: inline-block;
    padding: 10px 15px;
    background-color: #6c757d;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    font-weight: bold;
    transition: background-color 0.3s ease;
    margin-left: 10px;
}

.btn-volver:hover {
    background-color: #5a6268;
    color: white;
    text-decoration: none;
}
    </style>
</head>
<body>

<?php 
if (session_status() === PHP_SESSION_NONE) session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'Administrador') {
    header("Location: index.php?controller=Auth&action=login");
    exit;
}

// Mostrar mensajes
if (isset($_SESSION['success'])) {
    echo '<div style="background: #d4edda; color: #155724; padding: 10px; margin: 10px; border-radius: 5px; text-align: center;">' . $_SESSION['success'] . '</div>';
    unset($_SESSION['success']);
}

if (isset($_SESSION['error'])) {
    echo '<div style="background: #f8d7da; color: #721c24; padding: 10px; margin: 10px; border-radius: 5px; text-align: center;">' . $_SESSION['error'] . '</div>';
    unset($_SESSION['error']);
}
?>

<section class="dashboard">
    <div class="top">
        <h1>Gestión de Usuarios</h1>
        <a href="/sistema-produccion/public/index.php?controller=Admin&action=dashboard" class="btn-volver">← Volver al Panel</a>
    </div>

    <div class="dash-content">
        <div class="overview">
            <div class="title">
                <span class="text">Lista de Usuarios Registrados</span>
                <button id="btnNuevoUsuario" class="btn btn-primary" style="margin-left: 10px;">Nuevo Usuario</button>
                <span id="ultimaActualizacion" style="font-size: 12px; color: #666; margin-left: 10px;"></span>
            </div>

            <div id="tablaUsuariosContainer">
                <table border="1" cellspacing="0" cellpadding="8" width="100%">
                    <thead style="background:#9D4BFF;color:white;">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Rol</th>
                            <th>Estado</th>
                            <th>Fecha de creación</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="tbodyUsuarios">
                        <?php if (!empty($usuarios)): ?>
                            <?php foreach ($usuarios as $usuario): ?>
                                <tr>
                                    <td><?= htmlspecialchars($usuario['id_usuario']); ?></td>
                                    <td><?= htmlspecialchars($usuario['nombre']); ?></td>
                                    <td><?= htmlspecialchars($usuario['correo']); ?></td>
                                    <td><?= htmlspecialchars($usuario['rol']); ?></td>
                                    <td>
                                        <?php if ($usuario['estado'] == 'activo'): ?>
                                            <span style="color:green;font-weight:bold;">Activo</span>
                                        <?php else: ?>
                                            <span style="color:red;font-weight:bold;">Suspendido</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= htmlspecialchars($usuario['fecha_creacion']); ?></td>
                                    <td>
                                        <div class="acciones">
                                            <a href="#" class="btn btn-info" onclick="editarUsuario(<?= $usuario['id_usuario'] ?>)">Editar</a>
                                            <?php if ($usuario['estado'] == 'suspendido'): ?>
                                                <a href="index.php?controller=Admin&action=activarUsuario&id=<?= $usuario['id_usuario'] ?>" 
                                                   class="btn btn-success" 
                                                   onclick="return confirm('¿Estás seguro de activar este usuario?')">
                                                    Activar
                                                </a>
                                            <?php else: ?>
                                                <a href="index.php?controller=Admin&action=suspenderUsuario&id=<?= $usuario['id_usuario'] ?>" 
                                                   class="btn btn-warning" 
                                                   onclick="return confirm('¿Estás seguro de suspender este usuario?')">
                                                    Suspender
                                                </a>
                                            <?php endif; ?>
                                            <a href="index.php?controller=Admin&action=eliminarUsuario&id=<?= $usuario['id_usuario'] ?>" 
                                               class="btn btn-danger" 
                                               onclick="return confirm('¿Estás seguro de eliminar este usuario? Esta acción no se puede deshacer.')">
                                                Eliminar
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" style="text-align:center;">No hay usuarios registrados</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<!-- Modal para crear/editar usuario -->
<div id="modalUsuario" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2 id="modalTitulo">Nuevo Usuario</h2>
        <form id="formUsuario" action="index.php?controller=Admin&action=guardarUsuario" method="POST">
            <input type="hidden" id="id_usuario" name="id_usuario" value="">
            
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>
            
            <div class="form-group">
                <label for="correo">Correo:</label>
                <input type="email" id="correo" name="correo" required>
            </div>
            
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password">
                <small>Dejar en blanco para mantener la contraseña actual (solo en edición)</small>
            </div>
            
            <div class="form-group">
                <label for="rol">Rol:</label>
                <select id="rol" name="rol" required>
                    <option value="">Seleccione un rol</option>
                    <option value="Administrador">Administrador</option>
                    <option value="Usuario">Usuario</option>
                    <option value="Supervisor">Supervisor</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="estado">Estado:</label>
                <select id="estado" name="estado" required>
                    <option value="activo">Activo</option>
                    <option value="suspendido">Suspendido</option>
                </select>
            </div>
            
            <div style="text-align: right; margin-top: 20px;">
                <button type="button" class="btn btn-danger" onclick="cerrarModal()">Cancelar</button>
                <button type="submit" class="btn btn-success">Guardar</button>
            </div>
        </form>
    </div>
</div>
    <script src="/sistema-produccion/public/js/usuarios_admin.js"></script>

</body>
</html>