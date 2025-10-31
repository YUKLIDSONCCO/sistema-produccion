<?php
require_once "BaseController.php";
require_once __DIR__ . "/../models/SupervisorModel.php";

class SupervisorController extends BaseController {
    private $model;

    public function __construct() {
        $this->model = new SupervisorModel();
    }

    public function dashboard() {
        if (!isset($_SESSION['usuario'])) {
            $this->redirect("index.php?controller=Auth&action=login");
        }

        $usuario = $_SESSION['usuario'];
        $produccion = $this->model->getResumenProduccion();
        $insumos = $this->model->getInsumosAsignados();
        $personal = $this->model->getPersonalEnTurno();

        $this->view("supervisor/dashboard", compact("usuario", "produccion", "insumos", "personal"));
    }

    public function reportes() {
        if (!isset($_SESSION['usuario'])) {
            $this->redirect("index.php?controller=Auth&action=login");
        }

        $usuario = $_SESSION['usuario'];
        $reportes = $this->model->getReportes();

        $this->view("supervisor/reportes", compact("usuario", "reportes"));
    }
    public function recibirBPA1() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Datos generales
        $fecha = $_POST['fecha'] ?? '';
        $sede = $_POST['sede'] ?? '';
        $encargado = $_POST['encargado'] ?? '';
        $mes = $_POST['mes'] ?? '';

        // Datos de alimentos (arrays)
        $marcas = $_POST['marca'] ?? [];
        $calibres = $_POST['calibre'] ?? [];
        $cantidades = $_POST['cantidad'] ?? [];
        $nombres = $_POST['nombre_alimento'] ?? [];
        $observaciones = $_POST['observaciones'] ?? [];

        $alimentos = [];
        for ($i = 0; $i < count($marcas); $i++) {
            $alimentos[] = [
                'marca' => $marcas[$i] ?? '',
                'calibre' => $calibres[$i] ?? '',
                'cantidad' => $cantidades[$i] ?? '',
                'nombre' => $nombres[$i] ?? '',
                'observacion' => $observaciones[$i] ?? ''
            ];
        }

        // Enviar datos a la vista de revisión
        $data = [
            'fecha' => $fecha,
            'sede' => $sede,
            'encargado' => $encargado,
            'mes' => $mes,
            'alimentos' => $alimentos
        ];

        // Mostrar vista de revisión directamente
        $this->view("supervisor/revision_bpa1", ["data" => $data]);
    } else {
        $this->redirect("index.php?controller=Supervisor&action=dashboard");
    }
}


}
