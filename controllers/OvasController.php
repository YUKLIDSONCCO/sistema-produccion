<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/OvasModel.php';

class OvasController {

    public function bpa1() {
        if (isset($_GET['success'])) {
            echo "<script>alert('Se guardaron " . $_GET['success'] . " registros correctamente');</script>";
        }
        if (isset($_GET['error'])) {
            echo "<script>alert('Error al guardar los registros');</script>";
        }

        include __DIR__ . '/../views/jefeplanta/modulos-jefeplanta/ovas/bpa1.php';
    }

    public function listarBPA1() {
        $fecha = isset($_GET['fecha']) ? $_GET['fecha'] : date('Y-m-d');
        $database = new Database();
        $conn = $database->getConnection();
        $model = new OvasModel($conn);
        $stmt = $model->obtenerListadoBPA1PorFecha($fecha);

        $datos = [];
        if ($stmt) {
            $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        $fechaBusqueda = $fecha;
        include __DIR__ . '/../views/jefeplanta/modulos-jefeplanta/ovas/lista1.php';
    }

    public function bpa2() {
        if (isset($_GET['success'])) {
            echo "<script>alert('Se guardaron " . $_GET['success'] . " registros correctamente');</script>";
        }
        if (isset($_GET['error'])) {
            echo "<script>alert('Error al guardar los registros');</script>";
        }

        include __DIR__ . '/../views/jefeplanta/modulos-jefeplanta/ovas/bpa2.php';
    }

    public function listarBPA2() {
        $fecha = isset($_GET['fecha']) ? $_GET['fecha'] : date('Y-m-d');
        $database = new Database();
        $conn = $database->getConnection();
        $model = new OvasModel($conn);
        $stmt = $model->obtenerListadoBPA2PorFecha($fecha);

        $datos = [];
        if ($stmt) {
            $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        $fechaBusqueda = $fecha;
        include __DIR__ . '/../views/jefeplanta/modulos-jefeplanta/ovas/lista2.php';
    }

    public function bpa3() {
        if (isset($_GET['success'])) {
            echo "<script>alert('Se guardaron " . $_GET['success'] . " registros correctamente');</script>";
        }
        if (isset($_GET['error'])) {
            echo "<script>alert('Error al guardar los registros');</script>";
        }

        include __DIR__ . '/../views/jefeplanta/modulos-jefeplanta/ovas/bpa3.php';
    }

    public function listarBPA3() {
        $fecha = isset($_GET['fecha']) ? $_GET['fecha'] : date('Y-m-d');
        $database = new Database();
        $conn = $database->getConnection();
        $model = new OvasModel($conn);
        $stmt = $model->obtenerListadoBPA3PorFecha($fecha);

        $datos = [];
        if ($stmt) {
            $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        $fechaBusqueda = $fecha;
        include __DIR__ . '/../views/jefeplanta/modulos-jefeplanta/ovas/lista3.php';
    }

    public function bpa4() {
        if (isset($_GET['success'])) {
            echo "<script>alert('Se guardaron " . $_GET['success'] . " registros correctamente');</script>";
        }
        if (isset($_GET['error'])) {
            echo "<script>alert('Error al guardar los registros');</script>";
        }

        include __DIR__ . '/../views/jefeplanta/modulos-jefeplanta/ovas/bpa4.php';
    }

    public function listarBPA4() {
        $fecha = isset($_GET['fecha']) ? $_GET['fecha'] : date('Y-m-d');
        $database = new Database();
        $conn = $database->getConnection();
        $model = new OvasModel($conn);
        $stmt = $model->obtenerListadoBPA4PorFecha($fecha);

        $datos = [];
        if ($stmt) {
            $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        $fechaBusqueda = $fecha;
        include __DIR__ . '/../views/jefeplanta/modulos-jefeplanta/ovas/lista4.php';
    }
}
?>
