<?php
require_once __DIR__ . '/../models/BaseModel.php';

class AuthController extends BaseModel {

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $correo = $_POST['correo'] ?? '';
            $password = $_POST['password'] ?? '';

            $query = "SELECT u.*, r.nombre AS rol 
                      FROM usuarios u
                      INNER JOIN roles r ON u.id_rol = r.id_rol
                      WHERE correo = :correo AND estado = 'activo' LIMIT 1";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":correo", $correo);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                if (password_verify($password, $user['password'])) {
                    $_SESSION['usuario'] = $user;

                    // Redirección según rol
                    switch ($user['rol']) {
                        case 'Administrador':
                        case 'JefePlanta':
                        case 'Supervisor':
                        case 'Colaborador':
                            header("Location: index.php?controller=Panel&action=dashboard");
                            break;
                    }
                    exit;
                } else {
                    echo "❌ Contraseña incorrecta";
                }
            } else {
                echo "❌ Usuario no encontrado";
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
}
