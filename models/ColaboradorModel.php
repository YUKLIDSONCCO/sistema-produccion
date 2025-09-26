<?php
require_once "BaseModel.php";

class ColaboradorModel extends BaseModel {
    public function getTareasAsignadas($id_usuario) {
        $sql = "SELECT id, descripcion, estado, fecha 
                FROM tareas WHERE id_usuario = :id_usuario 
                ORDER BY fecha DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id_usuario", $id_usuario);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getInsumosDisponibles() {
        $sql = "SELECT nombre, stock, unidad_medida 
                FROM insumos WHERE stock > 0";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function registrarProduccion($id_usuario, $lote, $cantidad) {
        $sql = "INSERT INTO produccion (id_usuario, lote, cantidad, estado, fecha) 
                VALUES (:id_usuario, :lote, :cantidad, 'Pendiente', NOW())";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id_usuario", $id_usuario);
        $stmt->bindParam(":lote", $lote);
        $stmt->bindParam(":cantidad", $cantidad);
        return $stmt->execute();
    }
}
