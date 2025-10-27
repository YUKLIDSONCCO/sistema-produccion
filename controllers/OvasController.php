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

    
    public function bpa1() {
        include "../views/jefeplanta/modulos-jefeplanta/ovas/bpa1.php";
    }

    // 🔹 (Opcional) Método para obtener datos dinámicos
    public function obtenerDatosBPA1() {
        global $conexion;

        $sql = "SELECT up, lote, biomasa, ta, al_sum, calibre, obs 
                FROM alimentacion_diaria 
                ORDER BY id DESC";
        $result = $conexion->query($sql);

        $datos = [];
        if ($result && $result->num_rows > 0) {
            while ($fila = $result->fetch_assoc()) {
                $datos[] = $fila;
            }
        }

        return $datos;
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
