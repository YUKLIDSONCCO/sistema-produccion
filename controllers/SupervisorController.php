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
}
