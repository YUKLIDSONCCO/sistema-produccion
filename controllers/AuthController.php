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
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];
        $passwordHash = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $rol = $_POST['rol'];

        // --- NUEVO: manejar subida de foto ---
        $fotoRuta = null;
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {
            $carpeta = __DIR__ . '/../public/uploads/rostros/';
            if (!file_exists($carpeta)) {
                mkdir($carpeta, 0777, true);
            }

            $nombreArchivo = uniqid('rostro_') . '.' . pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
            $rutaDestino = $carpeta . $nombreArchivo;

            if (move_uploaded_file($_FILES['foto']['tmp_name'], $rutaDestino)) {
                $fotoRuta = '/sistema-produccion/public/uploads/rostros/' . $nombreArchivo;
            } else {
                $_SESSION['error'] = 'Error al subir la foto del rostro.';
                header("Location: index.php?controller=Auth&action=login");
                exit;
            }
        } else {
            $_SESSION['error'] = 'Debes subir una foto nítida de tu rostro.';
            header("Location: index.php?controller=Auth&action=login");
            exit;
        }

        // --- Verificar si el correo ya existe ---
        $queryCheck = "SELECT id_usuario FROM usuarios WHERE correo = :correo";
        $stmtCheck = $this->conn->prepare($queryCheck);
        $stmtCheck->bindParam(':correo', $correo);
        $stmtCheck->execute();

        if ($stmtCheck->rowCount() > 0) {
            $_SESSION['error'] = 'El correo electrónico ya está registrado.';
            header("Location: index.php?controller=Auth&action=login");
            exit;
        }

        // --- Insertar en la base de datos ---
        $query = "INSERT INTO usuarios (nombre, correo, password, id_rol, estado, foto) 
                  VALUES (:nombre, :correo, :password, :rol, 'suspendido', :foto)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':password', $passwordHash);
        $stmt->bindParam(':rol', $rol);
        $stmt->bindParam(':foto', $fotoRuta);

        if ($stmt->execute()) {
            $_SESSION['success'] = 'Registro exitoso. Tu cuenta está pendiente de activación por el administrador.';
        } else {
            $_SESSION['error'] = 'Error al registrar el usuario.';
        }

        // Redirigir al login
        header("Location: index.php?controller=Auth&action=login");
        exit;
    }
}




}
