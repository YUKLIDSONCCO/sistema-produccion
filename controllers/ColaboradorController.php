<?php
require_once "BaseController.php";
require_once __DIR__ . "/../models/ColaboradorModel.php";

class ColaboradorController extends BaseController {
    private $model;

    public function __construct() {
        $this->model = new ColaboradorModel();
    }

    public function dashboard() {
        if (!isset($_SESSION['usuario'])) {
            $this->redirect("index.php?controller=Auth&action=login");
        }

        $usuario = $_SESSION['usuario'];
        $tareas = $this->model->getTareasAsignadas($usuario['id_usuario']);
        $insumos = $this->model->getInsumosDisponibles();

        $this->view("colaborador/dashboard", compact("usuario", "tareas", "insumos"));
    }

    public function registrarProduccion() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_usuario = $_SESSION['usuario']['id_usuario'];
            $lote = $_POST['lote'] ?? '';
            $cantidad = $_POST['cantidad'] ?? 0;

            $this->model->registrarProduccion($id_usuario, $lote, $cantidad);
            $this->redirect("index.php?controller=Colaborador&action=dashboard");
        } else {
            $usuario = $_SESSION['usuario'];
            $this->view("colaborador/registrar_produccion", compact("usuario"));
        }
    }
}
