<?php
if (session_status() === PHP_SESSION_NONE) session_start();

require_once __DIR__ . '/../models/AdminModel.php';

class AdminController {
    private $adminModel;

    public function __construct() {
        $this->adminModel = new AdminModel();
    }

    // Mostrar listado de usuarios
    public function index() {
        if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'Administrador') {
            header("Location: index.php?controller=Auth&action=login");
            exit;
        }

        $usuarios = $this->adminModel->obtenerUsuarios();
        require __DIR__ . '/../views/admin/usuarios.php';
    }
    // Agregar este método en AdminController.php
    // En AdminController.php - método dashboard actualizado
public function dashboard() {
    if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'Administrador') {
        header("Location: index.php?controller=Auth&action=login");
        exit;
    }

    // Obtener estadísticas reales desde el modelo
    $estadisticas = $this->adminModel->obtenerEstadisticasDashboard();
    $distribucionRoles = $this->adminModel->obtenerDistribucionRoles();
    $actividadReciente = $this->adminModel->obtenerActividadReciente();

    // Pasar datos a la vista
    require __DIR__ . '/../views/admin/dashboard.php';
}

    // Mostrar formulario de registro
    public function mostrarRegistro() {
        if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'Administrador') {
            header("Location: index.php?controller=Auth&action=login");
            exit;
        }

        require __DIR__ . '/../views/auth/register.php';
    }

    // Registrar un nuevo usuario
    // Registrar un nuevo usuario con foto
public function registrarUsuario() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nombre = trim($_POST['nombre']);
        $correo = filter_var(trim($_POST['correo']), FILTER_VALIDATE_EMAIL);
        $password = $_POST['password'];
        $rol = (int)$_POST['rol'];
        $fotoPath = null;

        // Guardar la foto si se sube
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            $directorio = __DIR__ . '/../public/uploads/';
            if (!file_exists($directorio)) {
                mkdir($directorio, 0777, true);
            }
            $nombreArchivo = time() . '_' . basename($_FILES['foto']['name']);
            $rutaDestino = $directorio . $nombreArchivo;
            if (move_uploaded_file($_FILES['foto']['tmp_name'], $rutaDestino)) {
                $fotoPath = '/sistema-produccion/public/uploads/' . $nombreArchivo;
            }
        }

        // Validaciones
        if (empty($nombre) || strlen($nombre) < 3) {
            $_SESSION['error'] = 'El nombre debe tener al menos 3 caracteres';
            header("Location: index.php?controller=Auth&action=login");
            exit;
        }

        if (!$correo) {
            $_SESSION['error'] = 'El correo electrónico no es válido';
            header("Location: index.php?controller=Auth&action=login");
            exit;
        }

        if (strlen($password) < 6) {
            $_SESSION['error'] = 'La contraseña debe tener al menos 6 caracteres';
            header("Location: index.php?controller=Auth&action=login");
            exit;
        }

        if (!in_array($rol, [2, 3, 4])) {
            $_SESSION['error'] = 'Rol no válido';
            header("Location: index.php?controller=Auth&action=login");
            exit;
        }

        // Verificar si el correo ya existe
        if ($this->adminModel->verificarCorreoExistente($correo)) {
            $_SESSION['error'] = 'El correo electrónico ya está registrado';
            header("Location: index.php?controller=Auth&action=login");
            exit;
        }

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        if ($this->adminModel->registrarUsuario($nombre, $correo, $passwordHash, $rol, $fotoPath)) {
            $_SESSION['success'] = 'Registro exitoso. Pendiente de activación.';
            header("Location: index.php?controller=Admin&action=index");
        } else {
            $_SESSION['error'] = 'Error al registrar usuario.';
            header("Location: index.php?controller=Auth&action=login");
        }
        exit;
    }
}

    // Activar usuario
public function activarUsuario() {
    if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'Administrador') {
        header("Location: index.php?controller=Auth&action=login");
        exit;
    }

    $id_usuario = (int)$_GET['id'];
    
    if ($this->adminModel->cambiarEstadoUsuario($id_usuario, 'activo')) {
        $_SESSION['success'] = 'Usuario activado correctamente';
    } else {
        $_SESSION['error'] = 'Error al activar el usuario';
    }
    header("Location: index.php?controller=Admin&action=index");
    exit;
}

// Suspender usuario
public function suspenderUsuario() {
    if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'Administrador') {
        header("Location: index.php?controller=Auth&action=login");
        exit;
    }

    $id_usuario = (int)$_GET['id'];
    
    if ($this->adminModel->cambiarEstadoUsuario($id_usuario, 'suspendido')) {
        $_SESSION['success'] = 'Usuario suspendido correctamente';
    } else {
        $_SESSION['error'] = 'Error al suspender el usuario';
    }
    header("Location: index.php?controller=Admin&action=index");
    exit;
}
// Registrar un nuevo usuario con foto


// Editar usuario
public function editarUsuario() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = (int)$_POST['id_usuario'];
        $nombre = trim($_POST['nombre']);
        $correo = trim($_POST['correo']);
        $rol = (int)$_POST['rol'];
        $foto = null;

        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            $directorio = __DIR__ . '/../public/uploads/';
            if (!file_exists($directorio)) mkdir($directorio, 0777, true);
            $nombreArchivo = time() . '_' . basename($_FILES['foto']['name']);
            $rutaDestino = $directorio . $nombreArchivo;
            if (move_uploaded_file($_FILES['foto']['tmp_name'], $rutaDestino)) {
                $foto = '/sistema-produccion/public/uploads/' . $nombreArchivo;
            }
        }

        if ($this->adminModel->actualizarUsuario($id, $nombre, $correo, $rol, $foto)) {
            $_SESSION['success'] = 'Usuario actualizado correctamente';
        } else {
            $_SESSION['error'] = 'Error al actualizar usuario';
        }
        header("Location: index.php?controller=Admin&action=index");
        exit;
    }
}

// Eliminar usuario
public function eliminarUsuario() {
    if (isset($_GET['id'])) {
        $id = (int)$_GET['id'];
        if ($this->adminModel->eliminarUsuario($id)) {
            $_SESSION['success'] = 'Usuario eliminado correctamente';
        } else {
            $_SESSION['error'] = 'Error al eliminar usuario';
        }
        header("Location: index.php?controller=Admin&action=index");
        exit;
    }
}
// Obtener lista de roles
public function obtenerRoles() {
    if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'Administrador') {
        header("Location: index.php?controller=Auth&action=login");
        exit;
    }

    $roles = $this->adminModel->obtenerRoles();
    header('Content-Type: application/json');
    echo json_encode($roles);
    exit;
}
// En AdminController.php - agregar esta función helper
private function calcularTiempoTranscurrido($fecha) {
    $fechaActual = new DateTime();
    $fechaActividad = new DateTime($fecha);
    $diferencia = $fechaActual->diff($fechaActividad);
    
    if ($diferencia->y > 0) return "Hace " . $diferencia->y . " año" . ($diferencia->y > 1 ? 's' : '');
    if ($diferencia->m > 0) return "Hace " . $diferencia->m . " mes" . ($diferencia->m > 1 ? 'es' : '');
    if ($diferencia->d > 0) return "Hace " . $diferencia->d . " día" . ($diferencia->d > 1 ? 's' : '');
    if ($diferencia->h > 0) return "Hace " . $diferencia->h . " hora" . ($diferencia->h > 1 ? 's' : '');
    if ($diferencia->i > 0) return "Hace " . $diferencia->i . " minuto" . ($diferencia->i > 1 ? 's' : '');
    return "Hace unos segundos";
}
}
?>