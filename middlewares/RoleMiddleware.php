<?php
class RoleMiddleware {
    public static function handle($rolesPermitidos = []) {
        // Primero verificamos si está logueado
        if (!isset($_SESSION['usuario'])) {
            header("Location: index.php?controller=Auth&action=login");
            exit();
        }

        $usuario = $_SESSION['usuario'];

        // Verificar si el rol del usuario está en los roles permitidos
        if (!in_array($usuario['rol'], $rolesPermitidos)) {
            // Si no tiene permiso, redirigimos a un panel según su rol
            switch ($usuario['rol']) {
                case 'jefeplanta':
                    header("Location: index.php?controller=JefePlanta&action=dashboard");
                    break;
                case 'supervisor':
                    header("Location: index.php?controller=Supervisor&action=dashboard");
                    break;
                case 'colaborador':
                    header("Location: index.php?controller=Colaborador&action=dashboard");
                    break;
                case 'admin':
                    header("Location: index.php?controller=Admin&action=dashboard");
                    break;
                default:
                    header("Location: index.php?controller=Auth&action=login");
            }
            exit();
        }
    }
}
