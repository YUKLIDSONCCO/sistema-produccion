<?php
class AuthMiddleware {
    public static function handle() {
        // Validar si el usuario está logueado
        if (!isset($_SESSION['usuario'])) {
            header("Location: index.php?controller=Auth&action=login");
            exit();
        }
    }
    
}
