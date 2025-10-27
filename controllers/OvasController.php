<?php
require_once __DIR__ . '/BaseController.php';

class OvasController extends BaseController {

    public function __construct() {
        // Puedes inicializar modelos aquí si más adelante trabajas con base de datos
    }

    // ✅ Dashboard principal de Ovas
    public function dashboard() {
        $this->checkAuth();
        $usuario = $_SESSION['usuario'];

        $this->view('jefeplanta/modulos-jefeplanta/ovas/dashboard', [
            'usuario' => $usuario
        ]);
    }

    // ✅ Formato BPA N°9 - Selección, Pesaje y Traslado
    public function bpa9() {
        $this->checkAuth();
        require_once __DIR__ . '/../views/jefeplanta/modulos-jefeplanta/ovas/bpa-9.php';
    }

    // ✅ Seguridad (validar sesión)
    private function checkAuth() {
        if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'JefePlanta') {
            $this->redirect("index.php?controller=Auth&action=login");
        }
    }
}
?>
