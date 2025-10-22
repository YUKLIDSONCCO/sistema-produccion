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
}
?>
