<?php
class BaseController {
    public function __construct() {
        // Iniciar sesión si no está iniciada
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Obtener controlador y acción actuales
        $controller = $_GET['controller'] ?? '';
        $action = $_GET['action'] ?? '';

        // Rutas públicas (sin necesidad de sesión)
        $publicRoutes = [
            'Auth' => ['login', 'register']
        ];

        // Si no hay sesión y la ruta no es pública → redirigir al login
        if (
            (!isset($_SESSION['usuario'])) &&
            (!isset($publicRoutes[$controller]) || !in_array($action, $publicRoutes[$controller]))
        ) {
            header("Location: /sistema-produccion/public/Auth/login");
            exit;
        }

        // Protección adicional contra sesión inactiva o manipulada
        if (isset($_SESSION['usuario'])) {
            if (empty($_SESSION['usuario']['id_usuario']) || empty($_SESSION['usuario']['correo'])) {
                session_destroy();
                header("Location: /sistema-produccion/public/Auth/login");
                exit;
            }
        }
    }

    protected function view($view, $data = []) {
        extract($data);
        require_once __DIR__ . "/../views/$view.php";
    }

    protected function redirect($url) {
        header("Location: $url");
        exit;
    }
}
?>
