<?php
require_once "BaseModel.php";

class ColaboradorModel extends BaseModel {
    public function getTareasAsignadas($id_usuario) {
        // Opción A: Si quieres usar la tabla de formularios como tareas
        $sql = "SELECT id_formulario as id, tipo as descripcion, estado, fecha_envio as fecha 
                FROM formularios 
                WHERE id_usuario = :id_usuario 
                ORDER BY fecha_envio DESC";
        
        // Opción B: Si no hay tareas, devolver array vacío temporalmente
        // return [];
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id_usuario", $id_usuario);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getInsumosDisponibles() {
        $sql = "SELECT nombre, stock_actual as stock, unidad 
                FROM insumos 
                WHERE stock_actual > 0";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function registrarProduccion($id_usuario, $lote, $cantidad) {
        $sql = "INSERT INTO produccion (id_usuario, etapa, cantidad, fecha) 
                VALUES (:id_usuario, :lote, :cantidad, NOW())";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id_usuario", $id_usuario);
        $stmt->bindParam(":lote", $lote);
        $stmt->bindParam(":cantidad", $cantidad);
        return $stmt->execute();
    }
}