<?php
require_once __DIR__ . '/../models/PecesModel.php';
require_once __DIR__ . '/BaseController.php';

class PecesController extends BaseController {
    private $model;

    public function __construct() {
        $this->model = new PecesModel();
    }

    public function bpa6() {
        // formulario BPA6
        require_once __DIR__ . '/../views/jefeplanta/modulos-jefeplanta/peces/bpa6/bpa6.php';
    }

    public function bpa6Listado() {
        // obtener datos (si hay) desde el model — actualmente devuelve un array vacío cuando no hay BD
        $registros = $this->model->getBpa6List();
        require_once __DIR__ . '/../views/jefeplanta/modulos-jefeplanta/peces/bpa6/bpa6-listado.php';
    }

    public function bpa7() {
        require_once __DIR__ . '/../views/jefeplanta/modulos-jefeplanta/peces/bpa7/bpa7.php';
    }

    public function bpa7Listado() {
        $registros = $this->model->getBpa7List();
        require_once __DIR__ . '/../views/jefeplanta/modulos-jefeplanta/peces/bpa7/bpa7-listado.php';
    }

    public function bpa10() {
        require_once __DIR__ . '/../views/jefeplanta/modulos-jefeplanta/peces/bpa10/bpa10.php';
    }

    public function bpa10Listado() {
        $registros = $this->model->getBpa10List();
        require_once __DIR__ . '/../views/jefeplanta/modulos-jefeplanta/peces/bpa10/bpa10-listado.php';
    }

    public function bpa11() {
        require_once __DIR__ . '/../views/jefeplanta/modulos-jefeplanta/peces/bpa11/bpa11.php';
    }

    public function bpa11Listado() {
        $registros = $this->model->getBpa11List();
        require_once __DIR__ . '/../views/jefeplanta/modulos-jefeplanta/peces/bpa11/bpa11-listado.php';
    }

    public function bpa12() {
        require_once __DIR__ . '/../views/jefeplanta/modulos-jefeplanta/peces/bpa12/bpa12.php';
    }

    public function bpa12Listado() {
        $registros = $this->model->getBpa12List();
        require_once __DIR__ . '/../views/jefeplanta/modulos-jefeplanta/peces/bpa12/bpa12-listado.php';
    }

    public function bpa15() {
        require_once __DIR__ . '/../views/jefeplanta/modulos-jefeplanta/peces/bpa15/bpa15.php';
    }

    public function bpa15Listado() {
        $registros = $this->model->getBpa15List();
        require_once __DIR__ . '/../views/jefeplanta/modulos-jefeplanta/peces/bpa15/bpa15-listado.php';
    }

    

}
?>
