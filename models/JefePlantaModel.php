<?php
require_once "BaseModel.php";

class JefePlantaModel extends BaseModel {

    // ✅ Resumen de producción
    public function getResumenProduccion() {
        $sql = "SELECT COUNT(*) AS total_lotes, SUM(cantidad) AS total_producido 
                FROM lotes";
        $stmt = $this->conn->query($sql);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ✅ Estado de insumos
    public function getEstadoInsumos() {
        $sql = "SELECT nombre, stock, unidad_medida 
                FROM insumos
                ORDER BY nombre ASC";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ✅ Listar reportes
    public function getReportes() {
        $sql = "SELECT r.*, u.nombre AS responsable
                FROM reportes r
                INNER JOIN usuarios u ON r.id_usuario = u.id_usuario
                ORDER BY r.fecha DESC";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ✅ Obtener reporte por ID
    public function getReporteById($id) {
        $sql = "SELECT * FROM reportes WHERE id_reporte = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ✅ Crear reporte
    public function insertReporte($data) {
        $sql = "INSERT INTO reportes (descripcion, id_usuario, fecha) 
                VALUES (:descripcion, :id_usuario, NOW())";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':descripcion' => $data['descripcion'],
            ':id_usuario' => $data['id_usuario']
        ]);
    }

    // ✅ Actualizar reporte
    public function updateReporte($data) {
        $sql = "UPDATE reportes SET descripcion = :descripcion WHERE id_reporte = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':descripcion' => $data['descripcion'],
            ':id' => $data['id_reporte']
        ]);
    }

    // ✅ Eliminar reporte
    public function deleteReporte($id) {
        $sql = "DELETE FROM reportes WHERE id_reporte = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
    }
        public function obtenerProduccion() {
        $stmt = $this->conn->query("
            SELECT COUNT(*) as total_lotes, 
                   SUM(cantidad) as total_unidades 
            FROM produccion
        ");
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function obtenerInsumos() {
        $stmt = $this->conn->query("SELECT nombre, stock, unidad FROM insumos");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
?>
