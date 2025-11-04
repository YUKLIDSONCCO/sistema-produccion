<?php
class PanelController {
    public function dashboard() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['usuario'])) {
        header("Location: index.php?controller=Auth&action=login");
        exit;
    }

    $usuario = $_SESSION['usuario'];
    $rol = $usuario['rol'];

    // ⚙️ Si es Jefe de Planta, cargar inventario antes del dashboard
    if ($rol === 'JefePlanta') {
        require_once __DIR__ . '/../config/database.php';
        require_once __DIR__ . '/../models/InventarioModel.php';

        $database = new Database();
        $conn = $database->getConnection();

        $inventarioModel = new InventarioModel($conn);
        $inventarioResumen = $inventarioModel->obtenerResumenInventario();

        $produccion = [
            'ovas' => 3200,
            'peces' => 14500,
            'insumos' => $inventarioResumen['total_cantidad'] ?? 0
        ];

        include __DIR__ . '/../views/jefeplanta/dashboard.php';
        return;
    }

    // 🚦 Redirección por roles
    switch ($rol) {
        case 'Administrador':
            include __DIR__ . '/../views/admin/dashboard.php';
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
