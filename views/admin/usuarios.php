<?php 
if (session_status() === PHP_SESSION_NONE) session_start();
// --- Lógica de Autenticación ---
// Descomenta la siguiente sección en tu entorno de producción
/*
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'Administrador') {
    header("Location: index.php?controller=Auth&action=login");
    exit;
}
*/

// --- Simulación de datos si $usuarios no está definido (para pruebas) ---
// Define la variable $usuarios aquí si no viene de tu controlador

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios - Multiplataforma</title>
    
    <!-- Importar la fuente Inter de Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Cargar Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        /* Estilo personalizado para la fuente Inter y el fondo */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fc; /* Un gris muy claro */
        }
        /* Estilos para los selects del modal */
        .modal-select {
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%239ca3af' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-position: right 0.75rem center;
            background-repeat: no-repeat;
            background-size: 1.25em 1.25em;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            padding-right: 2.5rem; 
        }
        /* Estilos para la paginación */
        .pagination-link {
            @apply inline-flex items-center justify-center w-8 h-8 text-sm font-medium text-gray-600 rounded-lg transition-colors;
        }
        .pagination-link.active {
            @apply bg-blue-50 text-blue-600 font-bold;
        }
        .pagination-link:not(.active):hover {
            @apply bg-gray-100;
        }
    </style>
</head>
<body class="min-h-screen p-4 md:p-6 lg:p-10"> <!-- Ajuste de padding responsivo -->

    <!-- Contenedor principal -->
    <main class="max-w-7xl mx-auto">

        <?php 
        // --- Mostrar Mensajes de Sesión con estilo Tailwind ---
        if (isset($_SESSION['success'])) {
            echo '<div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded-md shadow-sm" role="alert">';
            echo '<p class="font-bold">Éxito</p>';
            echo '<p>' . htmlspecialchars($_SESSION['success']) . '</p>';
            echo '</div>';
            unset($_SESSION['success']);
        }

        if (isset($_SESSION['error'])) {
            echo '<div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded-md shadow-sm" role="alert">';
            echo '<p class="font-bold">Error</p>';
            echo '<p>' . htmlspecialchars($_SESSION['error']) . '</p>';
            echo '</div>';
            unset($_SESSION['error']);
        }
        ?>

        <!-- 1. Cabecera con Título y Botones/Filtros -->
        <header class="flex flex-col md:flex-row justify-between items-center mb-6">
            <h1 class="text-xl lg:text-2xl font-semibold text-gray-800 mb-4 md:mb-0"> <!-- Tamaño de texto ajustado -->
                Gestión de Usuarios (<?= $totalUsuarios ?? 0 ?>)
            </h1>
            <div class="flex flex-col sm:flex-row w-full sm:w-auto space-y-2 sm:space-y-0 sm:space-x-3">
                 <a href="/sistema-produccion/public/index.php?controller=Admin&action=dashboard" class="w-full sm:w-auto text-center bg-white text-gray-700 px-4 py-2 rounded-full shadow-sm border border-gray-200 text-sm font-medium flex items-center justify-center hover:bg-gray-50 transition">
                     <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2">
                       <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                     </svg>
                    Volver al Panel
                </a>
                <button id="btnNuevoUsuario" class="w-full sm:w-auto text-center bg-blue-600 text-white px-5 py-2 rounded-full text-sm font-semibold shadow-md hover:bg-blue-700 transition flex items-center justify-center">
                     <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2">
                       <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                     </svg>
                    Nuevo Usuario
                </button>
            </div>
        </header>
        
         <!-- Filtro de Búsqueda -->
         <div class="mb-6">
             <input type="text" id="filter-search" placeholder="Buscar por nombre o correo..." class="w-full md:w-1/2 lg:w-1/3 border border-gray-300 rounded-full px-5 py-2 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm">
         </div>


        <!-- 2. Títulos de las Columnas (Solo para Escritorio LG+) -->
        <div class="hidden lg:grid lg:grid-cols-9 gap-4 px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">
            <span class="lg:col-span-2">Nombre</span> 
            <span>Correo</span>
            <span>Teléfono</span> 
            <span>Rol</span>
            <span>Estado</span>
            <span>Fecha Creación</span>
            <span class="lg:col-span-2 text-center">Operaciones</span> 
        </div>

        <!-- 3. Lista de Usuarios (Generada con PHP) -->
        <div id="user-list-tbody" class="space-y-4 mt-2">
             <?php if (!empty($usuarios)): ?>
                <?php foreach ($usuarios as $usuario): ?>
                    <!-- Tarjeta base para móvil y tablet, cambia a grid en LG -->
                    <div class="bg-white rounded-xl shadow-lg p-5 block lg:grid lg:grid-cols-9 lg:gap-4 lg:items-center user-card">
                        
                        <!-- Col 1: Foto & Nombre (Siempre visible, ocupa más espacio en LG) -->
                        <div class="lg:col-span-2 flex items-center space-x-3 mb-4 lg:mb-0">
                            <?php 
                            $fotoPath = !empty($usuario['foto']) && file_exists(__DIR__ . '/../../' . ltrim($usuario['foto'], '/')) 
                            ? '/' . ltrim($usuario['foto'], '/')
                            : "https://placehold.co/40x40/E0E7FF/3730A3?text=" . strtoupper(substr($usuario['nombre'], 0, 1));
                            ?>
                            <img class="w-10 h-10 rounded-full bg-gray-200 text-gray-600 flex items-center justify-center font-bold flex-shrink-0"
                            src="<?= htmlspecialchars($fotoPath) ?>" 
                            alt="<?= htmlspecialchars($usuario['nombre']) ?>">
                            <div class="flex-grow"> <!-- Permite que el texto se ajuste -->
                                <div class="font-semibold text-gray-800 user-name break-words"><?= htmlspecialchars($usuario['nombre']); ?></div>
                                <div class="text-xs text-gray-500">ID: <?= htmlspecialchars($usuario['id_usuario']); ?></div>
                            </div>
                        </div>

                        <!-- Contenedor para Móvil y Tablet (Oculto en LG+) -->
                        <div class="lg:hidden grid grid-cols-2 gap-x-4 gap-y-3 mb-4 border-t pt-4 mt-4 border-gray-100">
                             <div>
                                <div class="text-xs font-semibold text-gray-400 uppercase">Correo</div>
                                <div class="text-sm text-gray-800 user-email break-words"><?= htmlspecialchars($usuario['correo']); ?></div>
                            </div>
                            <div>
                                <div class="text-xs font-semibold text-gray-400 uppercase">Teléfono</div>
                                <div class="text-sm text-gray-800"><?= htmlspecialchars($usuario['telefono'] ?? 'N/A'); ?></div>
                            </div>
                             <div>
                                <div class="text-xs font-semibold text-gray-400 uppercase">Rol</div>
                                <div class="text-sm text-gray-800"><?= htmlspecialchars($usuario['rol']); ?></div>
                            </div>
                            <div>
                                <div class="text-xs font-semibold text-gray-400 uppercase">Estado</div>
                                <div class="text-sm">
                                    <?php if ($usuario['estado'] == 'activo'): ?>
                                        <span class="px-2 py-0.5 text-xs font-medium text-green-800 bg-green-100 rounded-full">Activo</span>
                                    <?php else: ?>
                                        <span class="px-2 py-0.5 text-xs font-medium text-red-800 bg-red-100 rounded-full">Suspendido</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-span-2"> 
                                <div class="text-xs font-semibold text-gray-400 uppercase">Fecha Creación</div>
                                <div class="text-sm text-gray-800"><?= htmlspecialchars($usuario['fecha_creacion']); ?></div>
                            </div>
                        </div>

                        <!-- Celdas solo para Escritorio (Ocultas debajo de LG) -->
                        <div class="hidden lg:block text-sm text-gray-800 user-email break-words"><?= htmlspecialchars($usuario['correo']); ?></div>
                        <div class="hidden lg:block text-sm text-gray-800"><?= htmlspecialchars($usuario['telefono'] ?? 'N/A'); ?></div>
                        <div class="hidden lg:block text-sm text-gray-800"><?= htmlspecialchars($usuario['rol']); ?></div>
                        <div class="hidden lg:block text-sm">
                             <?php if ($usuario['estado'] == 'activo'): ?>
                                <span class="px-2 py-0.5 text-xs font-medium text-green-800 bg-green-100 rounded-full">Activo</span>
                            <?php else: ?>
                                <span class="px-2 py-0.5 text-xs font-medium text-red-800 bg-red-100 rounded-full">Suspendido</span>
                            <?php endif; ?>
                        </div>
                        <div class="hidden lg:block text-sm text-gray-800"><?= htmlspecialchars($usuario['fecha_creacion']); ?></div>

                        <!-- Botones de Operar (Siempre visibles, layout cambia con SM y LG) -->
                         <div class="lg:col-span-2 flex flex-col sm:flex-row sm:justify-end space-y-2 sm:space-y-0 sm:space-x-2 mt-4 lg:mt-0">
                             <button class="w-full sm:w-auto bg-blue-600 text-white px-4 py-1.5 rounded-full text-xs font-semibold shadow-md hover:bg-blue-700 transition"
                                    onclick="editarUsuario(<?= htmlspecialchars(json_encode($usuario)) ?>)">
                                Editar
                            </button>
                            <?php if ($usuario['estado'] == 'suspendido'): ?>
                                <a href="index.php?controller=Admin&action=activarUsuario&id=<?= $usuario['id_usuario'] ?>" 
                                   class="w-full sm:w-auto text-center bg-green-500 text-white px-4 py-1.5 rounded-full text-xs font-semibold shadow-md hover:bg-green-600 transition" 
                                   onclick="return confirm('¿Estás seguro de activar este usuario?')">
                                    Activar
                                </a>
                            <?php else: ?>
                                <a href="index.php?controller=Admin&action=suspenderUsuario&id=<?= $usuario['id_usuario'] ?>" 
                                   class="w-full sm:w-auto text-center bg-yellow-400 text-black px-4 py-1.5 rounded-full text-xs font-semibold shadow-md hover:bg-yellow-500 transition" 
                                   onclick="return confirm('¿Estás seguro de suspender este usuario?')">
                                    Suspender
                                </a>
                            <?php endif; ?>
                            <a href="index.php?controller=Admin&action=eliminarUsuario&id=<?= $usuario['id_usuario'] ?>" 
                               class="w-full sm:w-auto text-center bg-red-600 text-white px-4 py-1.5 rounded-full text-xs font-semibold shadow-md hover:bg-red-700 transition" 
                               onclick="return confirm('¿Estás seguro de eliminar este usuario? Esta acción no se puede deshacer.')">
                                Eliminar
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                 <div class="bg-white rounded-xl shadow-lg p-10 text-center text-gray-500">
                     No hay usuarios registrados.
                 </div>
            <?php endif; ?>
        </div>

        <!-- Paginación (Marcador de posición - Necesita lógica PHP) -->
        <footer class="flex flex-col md:flex-row items-center justify-between p-5 mt-6 border-t border-gray-200 bg-white rounded-b-xl shadow-lg">
            <span id="pagination-info" class="text-sm text-gray-600 mb-4 md:mb-0">
                 Mostrando <?= isset($usuarios) ? count($usuarios) : 0; ?> de <?= $totalUsuarios ?? 0; ?> usuarios
            </span>
            <!-- La lógica de paginación PHP real debe implementarse aquí -->
            <nav id="pagination-nav" class="flex items-center space-x-1">
                <span class="pagination-link opacity-50 cursor-not-allowed">Previous</span>
                <span class="pagination-link active">1</span>
                <!-- <a href="#" class="pagination-link">2</a> ... -->
                <span class="pagination-link opacity-50 cursor-not-allowed">Next</span>
            </nav>
        </footer>

    </main>
    
    <!-- Modal para crear/editar usuario (Diseño adaptado estilo Tailwind) -->
    <div id="modalUsuario" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50" style="display: none;">
        <div class="bg-white rounded-lg shadow-xl p-6 max-w-lg w-full relative">
            <!-- Botón de cerrar -->
            <button class="close absolute top-4 right-5 text-gray-400 hover:text-gray-600" onclick="cerrarModal()">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <h2 id="modalTitulo" class="text-xl font-semibold text-gray-800 mb-6">Nuevo Usuario</h2>
            
            <form id="formUsuario" action="index.php?controller=Admin&action=guardarUsuario" method="POST">
                <input type="hidden" id="id_usuario" name="id_usuario" value="">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Columna Izquierda -->
                    <div>
                        <div class="mb-4">
                            <label for="nombre" class="block text-sm font-medium text-gray-700 mb-1">Nombre:</label>
                            <input type="text" id="nombre" name="nombre" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        
                        <div class="mb-4">
                            <label for="correo" class="block text-sm font-medium text-gray-700 mb-1">Correo:</label>
                            <input type="email" id="correo" name="correo" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        
                        <div class="mb-4">
                            <label for="telefono_modal" class="block text-sm font-medium text-gray-700 mb-1">Teléfono:</label>
                            <input type="tel" id="telefono_modal" name="telefono" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div class="mb-4">
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Contraseña:</label>
                            <input type="password" id="password" name="password" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Dejar en blanco para no cambiar">
                            <small class="text-xs text-gray-500 mt-1 block" id="passwordHelp">Introduce una nueva contraseña o deja en blanco.</small>
                        </div>
                    </div>
                    
                    <!-- Columna Derecha -->
                    <div>
                         <div class="mb-4">
                            <label for="identidad_modal" class="block text-sm font-medium text-gray-700 mb-1">Identidad:</label>
                            <input type="text" id="identidad_modal" name="identidad" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div class="mb-4">
                            <label for="rol" class="block text-sm font-medium text-gray-700 mb-1">Rol:</label>
                            <select id="rol" name="rol" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 modal-select">
                                <option value="">Seleccione un rol</option>
                                <option value="Administrador">Administrador</option>
                                <option value="Usuario">Usuario</option>
                                <option value="Supervisor">Supervisor</option>
                            </select>
                        </div>
                        
                        <div class="mb-4">
                            <label for="estado" class="block text-sm font-medium text-gray-700 mb-1">Estado:</label>
                            <select id="estado" name="estado" required class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 modal-select">
                                <option value="activo">Activo</option>
                                <option value="suspendido">Suspendido</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" class="px-5 py-2 text-sm font-semibold text-gray-700 bg-gray-100 rounded-full shadow-sm border border-gray-200 hover:bg-gray-200 transition" onclick="cerrarModal()">
                        Cancelar
                    </button>
                    <button type="submit" class="px-5 py-2 text-sm font-semibold text-white bg-blue-600 rounded-full shadow-md hover:bg-blue-700 transition">
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- JS Básico para manejar el modal y el filtro -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const modal = document.getElementById('modalUsuario');
            const btnNuevo = document.getElementById('btnNuevoUsuario');
            const modalTitulo = document.getElementById('modalTitulo');
            const form = document.getElementById('formUsuario');
            const inputId = document.getElementById('id_usuario');
            const passwordInput = document.getElementById('password');
            const passwordHelp = document.getElementById('passwordHelp');
            const userListTbody = document.getElementById('user-list-tbody'); // Contenedor de tarjetas

            // Función para cerrar el modal
            window.cerrarModal = function() {
                modal.style.display = 'none';
            }

            // Abrir modal para NUEVO usuario
            btnNuevo.addEventListener('click', () => {
                form.reset(); 
                inputId.value = ""; 
                modalTitulo.textContent = 'Nuevo Usuario';
                passwordInput.placeholder = 'Introduce una contraseña'; // Placeholder para nuevo
                passwordHelp.textContent = 'Introduce una nueva contraseña.';
                modal.style.display = 'flex';
                form.action = "index.php?controller=Admin&action=guardarUsuario"; 
            });

            // Función para abrir modal para EDITAR usuario
            window.editarUsuario = function(usuario) {
                form.reset();
                modalTitulo.textContent = 'Editar Usuario';
                
                // Rellenar el formulario
                document.getElementById('id_usuario').value = usuario.id_usuario;
                document.getElementById('nombre').value = usuario.nombre;
                document.getElementById('correo').value = usuario.correo;
                document.getElementById('telefono_modal').value = usuario.telefono ?? ''; // Asegurarse de manejar null
                document.getElementById('identidad_modal').value = usuario.identidad ?? '';
                document.getElementById('rol').value = usuario.rol;
                document.getElementById('estado').value = usuario.estado;
                
                // Password
                passwordInput.value = ""; // Siempre vacío al editar
                passwordInput.placeholder = "Dejar en blanco para no cambiar";
                passwordHelp.textContent = 'Dejar en blanco para mantener la contraseña actual.';

                form.action = "index.php?controller=Admin&action=guardarUsuario"; 
                
                modal.style.display = 'flex';
            }

            // Cerrar modal al hacer clic fuera (en el fondo oscuro)
            window.addEventListener('click', (event) => {
                if (event.target === modal) {
                    cerrarModal();
                }
            });

            // Actualizar hora (ejemplo - si la necesitas)
            /*
            const now = new Date();
            const lastUpdateSpan = document.getElementById('ultimaActualizacion');
            if (lastUpdateSpan) {
                lastUpdateSpan.textContent = now.toLocaleString('es-ES', { dateStyle: 'short', timeStyle: 'short' });
            }
            */
            
            // Lógica de filtro/búsqueda en el cliente
            const filterInput = document.getElementById('filter-search');
            if (filterInput && userListTbody) {
                filterInput.addEventListener('keyup', () => {
                    const searchTerm = filterInput.value.toLowerCase().trim();
                    userListTbody.querySelectorAll('.user-card').forEach(card => {
                        const nombre = card.querySelector('.user-name')?.textContent.toLowerCase() ?? '';
                        const correo = card.querySelector('.user-email')?.textContent.toLowerCase() ?? '';
                        
                        // Busca en el nombre visible Y en el correo visible
                        if (nombre.includes(searchTerm) || correo.includes(searchTerm)) {
                             // Usa 'grid' como display por defecto en JS, Tailwind lo ajustará a 'block' en pantallas < lg
                            card.style.display = 'grid'; 
                        } else {
                            card.style.display = 'none'; // Ocultar si no coincide
                        }
                    });
                });
            }
        });
    </script>
</body>
</html>

