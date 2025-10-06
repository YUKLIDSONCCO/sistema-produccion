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

    // Mostrar formulario de registro
    public function mostrarRegistro() {
        if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'Administrador') {
            header("Location: index.php?controller=Auth&action=login");
            exit;
        }

        require __DIR__ . '/../views/auth/register.php';
    }

    // Registrar un nuevo usuario
    // Registrar un nuevo usuario
public function registrarUsuario() {
    // QUITAR esta validación que te redirige
    // if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'Administrador') {
    //     header("Location: index.php?controller=Auth&action=login");
    //     exit;
    // }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Validar y sanitizar datos
        $nombre = trim($_POST['nombre']);
        $correo = filter_var(trim($_POST['correo']), FILTER_VALIDATE_EMAIL);
        $password = $_POST['password'];
        $rol = (int)$_POST['rol'];

        // Validaciones (las mismas que tienes)
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

        if ($this->adminModel->registrarUsuario($nombre, $correo, $passwordHash, $rol)) {
            $_SESSION['success'] = 'Registro exitoso. Tu cuenta está pendiente de activación por el administrador.';
            
            // SI ES ADMINISTRADOR, ir a la lista de usuarios
            if (isset($_SESSION['usuario']) && $_SESSION['usuario']['rol'] === 'Administrador') {
                header("Location: index.php?controller=Admin&action=index");
            } else {
                // SI ES USUARIO NORMAL, quedarse en el login
                header("Location: index.php?controller=Auth&action=login");
            }
        } else {
            $_SESSION['error'] = 'Error al registrar el usuario';
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
}
?>