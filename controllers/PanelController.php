<?php
class PanelController {
    public function dashboard() {
        if (!isset($_SESSION['usuario'])) {
            header("Location: index.php?controller=Auth&action=login");
            exit;
        }

        $usuario = $_SESSION['usuario'];
        $rol = $usuario['rol'];

        // Redirige según el rol
        switch ($rol) {
            case 'Administrador':
                include __DIR__ . '/../views/admin/dashboard.php';
                break;
            case 'JefePlanta':
                include __DIR__ . '/../views/jefeplanta/dashboard.php';
                break;
            case 'Supervisor':
                include __DIR__ . '/../views/supervisor/dashboard.php';
                break;
            case 'Colaborador':
                include __DIR__ . '/../views/colaborador/dashboard.php';
                break;
            default:
                echo "❌ Rol no reconocido.";
        }
    }
}
