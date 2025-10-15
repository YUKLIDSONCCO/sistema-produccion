<?php
require_once __DIR__ . '/../models/JefePlantaModel.php';
require_once __DIR__ . '/BaseController.php';

class JefePlantaController extends BaseController {
    private $model;

    public function __construct() {
        $this->model = new JefePlantaModel();
    }

    // ✅ Dashboard
    public function dashboard() {
        $this->checkAuth();
        $usuario = $_SESSION['usuario'];
        $produccion = $this->model->getResumenProduccion();
        $insumos = $this->model->getEstadoInsumos();

        $this->view('jefeplanta/dashboard', [
            'usuario' => $usuario,
            'produccion' => $produccion,
            'insumos' => $insumos
        ]);
    }

    // ✅ Módulo Inventario (Vista con los BPAs)
    public function moduloInventario() {
        $this->checkAuth();
        $usuario = $_SESSION['usuario'];

        // Aquí puedes pasar variables si las necesitas más adelante
        $this->view('jefeplanta/modulos-jefeplanta/inventario/dashboard', [
            'usuario' => $usuario
        ]);
    }

        // ✅ Módulo Ovas (Vista con los BPAs)
    public function moduloOvas() {
        $this->checkAuth();
        $usuario = $_SESSION['usuario'];

        $this->view('jefeplanta/modulos-jefeplanta/ovas/dashboard', [
            'usuario' => $usuario
        ]);
    }

    // ✅ Módulo Peces (Vista con los BPAs)
    public function moduloPeces() {
        $this->checkAuth();
        $usuario = $_SESSION['usuario'];

        $this->view('jefeplanta/modulos-jefeplanta/peces/dashboard', [
            'usuario' => $usuario
        ]);
    }

    // ✅ Listar reportes
    public function reportes() {
        $this->checkAuth();
        $reportes = $this->model->getReportes();
        $this->view('jefeplanta/reportes', ['reportes' => $reportes]);
    }

    // ✅ Crear nuevo reporte
    public function crearReporte() {
        $this->checkAuth();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'descripcion' => $_POST['descripcion'],
                'id_usuario' => $_SESSION['usuario']['id_usuario']
            ];
            $this->model->insertReporte($data);
            $this->redirect("index.php?controller=JefePlanta&action=reportes");
        } else {
            $this->view('jefeplanta/crear_reporte');
        }
    }

    // ✅ Editar reporte
    public function editarReporte() {
        $this->checkAuth();
        $id = $_GET['id'] ?? null;
        if (!$id) $this->redirect("index.php?controller=JefePlanta&action=reportes");

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'id_reporte' => $id,
                'descripcion' => $_POST['descripcion']
            ];
            $this->model->updateReporte($data);
            $this->redirect("index.php?controller=JefePlanta&action=reportes");
        } else {
            $reporte = $this->model->getReporteById($id);
            $this->view('jefeplanta/editar_reporte', ['reporte' => $reporte]);
        }
    }

    // ✅ Eliminar reporte
    public function eliminarReporte() {
        $this->checkAuth();
        $id = $_GET['id'] ?? null;
        if ($id) $this->model->deleteReporte($id);
        $this->redirect("index.php?controller=JefePlanta&action=reportes");
    }

    // ✅ Seguridad (validar sesión)
    private function checkAuth() {
        if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'JefePlanta') {
            $this->redirect("index.php?controller=Auth&action=login");
        }
    }
}
?>
