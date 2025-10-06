<?php
require_once __DIR__ . '/../models/BaseModel.php';

class AuthController extends BaseModel {

public function login() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $correo = $_POST['correo'] ?? '';
        $password = $_POST['password'] ?? '';

        // Primero verificar si el usuario existe (sin importar estado)
        $queryCheck = "SELECT u.*, r.nombre AS rol 
                      FROM usuarios u
                      INNER JOIN roles r ON u.id_rol = r.id_rol
                      WHERE correo = :correo LIMIT 1";
        
        $stmtCheck = $this->conn->prepare($queryCheck);
        $stmtCheck->bindParam(":correo", $correo);
        $stmtCheck->execute();

        if ($stmtCheck->rowCount() > 0) {
            $user = $stmtCheck->fetch(PDO::FETCH_ASSOC);
            
            // Verificar si está suspendido
            if ($user['estado'] === 'suspendido') {
                $_SESSION['error'] = 'Usuario no activado. Contacta al administrador.';
                header("Location: index.php?controller=Auth&action=login");
                exit;
            }
            
            // Verificar contraseña para usuarios activos
            if (password_verify($password, $user['password'])) {
                $_SESSION['usuario'] = $user;
                header("Location: index.php?controller=Panel&action=dashboard");
                exit;
            } else {
                $_SESSION['error'] = 'Contraseña incorrecta';
                header("Location: index.php?controller=Auth&action=login");
                exit;
            }
        } else {
            $_SESSION['error'] = 'Usuario no encontrado';
            header("Location: index.php?controller=Auth&action=login");
            exit;
        }
    } else {
        // Mostrar vista login
        include __DIR__ . '/../views/auth/login.php';
    }
}

    // ✅ Agregar este método logout
    public function logout() {
        // Asegurar que la sesión está iniciada
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Destruir variables de sesión
        $_SESSION = [];
        session_destroy();

        // Redirigir al login
        header("Location: index.php?controller=Auth&action=login");
        exit;
    }
    public function register() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nombre = trim($_POST['nombre']);
        $correo = filter_var(trim($_POST['correo']), FILTER_VALIDATE_EMAIL);
        $password = $_POST['password'];
        $rol = (int)$_POST['rol'];

        // Validaciones básicas
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
        $queryCheck = "SELECT id_usuario FROM usuarios WHERE correo = :correo";
        $stmtCheck = $this->conn->prepare($queryCheck);
        $stmtCheck->bindParam(':correo', $correo);
        $stmtCheck->execute();

        if ($stmtCheck->rowCount() > 0) {
            $_SESSION['error'] = 'El correo electrónico ya está registrado';
            header("Location: index.php?controller=Auth&action=login");
            exit;
        }

        // Registrar usuario con estado 'suspendido'
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        
        $query = "INSERT INTO usuarios (nombre, correo, password, id_rol, estado) 
                  VALUES (:nombre, :correo, :password, :rol, 'suspendido')";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':password', $passwordHash);
        $stmt->bindParam(':rol', $rol);

        if ($stmt->execute()) {
            $_SESSION['success'] = 'Registro exitoso. Tu cuenta está pendiente de activación por el administrador.';
        } else {
            $_SESSION['error'] = 'Error al registrar el usuario';
        }

        // Redirigir al login (siempre mostrará el formulario de inicio de sesión)
        header("Location: index.php?controller=Auth&action=login");
        exit;
        
    } else {
        // Si no es POST, mostrar el login
        header("Location: index.php?controller=Auth&action=login");
        exit;
    }
}
}
