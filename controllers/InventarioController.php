<?php
//require_once "../config/database.php";

class InventarioController {

    // 🔹 Método llamado directamente desde el router
    public function bpa1() {
        include "../views/jefeplanta/modulos-jefeplanta/inventario/bpa1.php";
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

     public function bpa2() {
        include "../views/jefeplanta/modulos-jefeplanta/inventario/bpa2.php";
    }

    // 🔹 (Opcional) Método para obtener datos dinámicos del BPA2
    public function obtenerDatosBPA2() {
        global $conexion;

        // Ajusta el nombre de la tabla y columnas según tu base de datos
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

     // ✅ Cargar la vista del Formato N°13
    public function bpa3() {
        include "../views/jefeplanta/modulos-jefeplanta/inventario/bpa3.php";
    }

    // ✅ (Opcional) Método para obtener datos dinámicos del BPA13
    public function obtenerDatosBPA3() {
        global $conexion;

        // Ajusta los nombres según tu tabla real
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

    public function bpa4() {
    include "../views/jefeplanta/modulos-jefeplanta/inventario/bpa4.php";
}

    // 🔹 (Opcional) Método para obtener datos dinámicos del BPA 14
    public function obtenerDatosBPA4() {
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

      public function bpa5() {
        include "../views/jefeplanta/modulos-jefeplanta/inventario/bpa5.php";
    }

    // 🔹 Método opcional para obtener datos dinámicos desde la base de datos
    public function obtenerDatosBPA5() {
        global $conexion;

        // Consulta adaptada a la estructura del formato
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
