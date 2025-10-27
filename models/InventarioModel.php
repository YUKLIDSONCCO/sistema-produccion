<?php
class InventarioModel {
    private $conexion;

    public function __construct($db) {
        $this->conexion = $db;
    }

    // 🟠 Obtener listado diario de BPA1
    public function obtenerListadoBPA1PorFecha($fecha) {
        $sql = "SELECT id, fecha, marca, calibre, cantidad, nombre, obs 
                FROM alimentacion_diaria
                WHERE DATE(fecha) = ?
                ORDER BY id DESC";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("s", $fecha);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }
}
?>
