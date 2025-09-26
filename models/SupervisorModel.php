<?php
require_once "BaseModel.php";

class SupervisorModel extends BaseModel {
    public function getResumenProduccion() {
        $sql = "SELECT COUNT(*) as total_lotes, SUM(cantidad) as total_producido 
                FROM produccion WHERE estado = 'En Proceso'";
        $stmt = $this->conn->query($sql);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: ["total_lotes" => 0, "total_producido" => 0];
    }

    public function getInsumosAsignados() {
        $sql = "SELECT nombre, stock, unidad_medida 
                FROM insumos WHERE stock > 0 ORDER BY nombre ASC";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPersonalEnTurno() {
        $sql = "SELECT nombre, rol, turno 
                FROM trabajadores WHERE turno = CURDATE()";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getReportes() {
        $sql = "SELECT id, titulo, fecha, descripcion 
                FROM reportes ORDER BY fecha DESC LIMIT 10";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
