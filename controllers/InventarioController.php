<?php
//require_once "../config/database.php";
//require_once "../models/InventarioModel.php";
class InventarioController {

     public function bpa1() {
        include "../views/jefeplanta/modulos-jefeplanta/inventario/bpa1.php";
    }

    public function obtenerDatosBPA1() {
        global $conexion;

        $sql = "SELECT fecha, sede, encargado, mes, marca, calibre, cantidad, nombre, obs 
                FROM control_alimento_almacen
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

    public function listarBPA1() {
    global $conexion;

    // Si se envía una fecha por GET, se usa; sino, se toma la de hoy
    $fecha = isset($_GET['fecha']) ? $_GET['fecha'] : date('Y-m-d');

    $sql = "SELECT fecha, sede, encargado, mes, marca, calibre, cantidad, nombre, obs 
            FROM control_alimento_almacen
            WHERE DATE(fecha) = ?
            ORDER BY id DESC";

    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $fecha);
    $stmt->execute();
    $result = $stmt->get_result();

    $datos = [];
    if ($result && $result->num_rows > 0) {
        while ($fila = $result->fetch_assoc()) {
            $datos[] = $fila;
        }
    }

    // Incluir la vista del listado (lista1.php)
    include "../views/jefeplanta/modulos-jefeplanta/inventario/lista1.php";
}

    public function bpa2() {
        include "../views/jefeplanta/modulos-jefeplanta/inventario/bpa2.php";
    }

    public function obtenerDatosBPA2() {
        global $conexion;

        $sql = "SELECT fecha, sede, encargado, mes, cantidad, nombre, obs 
                FROM control_sal_almacen
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

    public function bpa3() {
    include "../views/jefeplanta/modulos-jefeplanta/inventario/bpa3.php";
}

    public function obtenerDatosBPA3() {
        global $conexion;

        $sql = "SELECT fecha, medicamento, cantidad, nombre, observaciones 
                FROM control_medicamento 
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

      public function bpa4() {
        include "../views/jefeplanta/modulos-jefeplanta/inventario/bpa4.php";
    }

    public function obtenerDatosBPA4() {
        global $conexion;

        $sql = "SELECT fecha, medicamento, dosis, dias_tratamiento, lote_alevines, sala, responsable 
                FROM dosificacion_medicamentos 
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
}
?>
