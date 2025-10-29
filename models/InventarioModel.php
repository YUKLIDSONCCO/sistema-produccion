<?php
class InventarioModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // 🟠 Obtener listado diario de BPA1 - CORREGIDO
    public function obtenerListadoBPA1PorFecha($fecha) {
    $sql = "SELECT id, fecha, marca, calibre, cantidad, nombre_alimento as nombre, observaciones as obs 
            FROM control_alimento_almacen
            WHERE DATE(fecha) = :fecha
            ORDER BY id DESC";
    
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(":fecha", $fecha);
    
    if ($stmt->execute()) {
        return $stmt;
    } else {
        return false;
    }
}

    // 🟠 Método para guardar datos en BPA1 - ACTUALIZADO A PDO
    public function guardarBPA1($fecha, $sede, $encargado, $mes, $marca, $calibre, $cantidad, $nombre_alimento, $observaciones) {
        $sql = "INSERT INTO control_alimento_almacen 
                (fecha, sede, encargado, mes, marca, calibre, cantidad, nombre_alimento, observaciones) 
                VALUES (:fecha, :sede, :encargado, :mes, :marca, :calibre, :cantidad, :nombre_alimento, :observaciones)";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":fecha", $fecha);
        $stmt->bindParam(":sede", $sede);
        $stmt->bindParam(":encargado", $encargado);
        $stmt->bindParam(":mes", $mes);
        $stmt->bindParam(":marca", $marca);
        $stmt->bindParam(":calibre", $calibre);
        $stmt->bindParam(":cantidad", $cantidad);
        $stmt->bindParam(":nombre_alimento", $nombre_alimento);
        $stmt->bindParam(":observaciones", $observaciones);
        
        return $stmt->execute();
    }
    // Agregar estos métodos en la clase InventarioModel

// 🟠 Métodos para BPA2 - Control de Sal en Almacén
public function obtenerListadoBPA2PorFecha($fecha) {
    $sql = "SELECT id, fecha, sede, encargado, mes, cantidad, nombre_sal as nombre, observaciones as obs 
            FROM control_sal_almacen
            WHERE DATE(fecha) = :fecha
            ORDER BY id DESC";
    
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(":fecha", $fecha);
    
    if ($stmt->execute()) {
        return $stmt;
    } else {
        return false;
    }
}

public function guardarBPA2($fecha, $sede, $encargado, $mes, $cantidad, $nombre_sal, $observaciones) {
    $sql = "INSERT INTO control_sal_almacen 
            (fecha, sede, encargado, mes, cantidad, nombre_sal, observaciones) 
            VALUES (:fecha, :sede, :encargado, :mes, :cantidad, :nombre_sal, :observaciones)";
    
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(":fecha", $fecha);
    $stmt->bindParam(":sede", $sede);
    $stmt->bindParam(":encargado", $encargado);
    $stmt->bindParam(":mes", $mes);
    $stmt->bindParam(":cantidad", $cantidad);
    $stmt->bindParam(":nombre_sal", $nombre_sal);
    $stmt->bindParam(":observaciones", $observaciones);
    
    return $stmt->execute();
}
// Agregar estos métodos en la clase InventarioModel

// 🟠 Métodos para BPA3 - Control de Medicamento
public function obtenerListadoBPA3PorFecha($fecha) {
    $sql = "SELECT id, fecha, sede, encargado, mes, medicamento_suplemento, cantidad, nombre_empleado as nombre, observaciones as obs 
            FROM control_medicamento
            WHERE DATE(fecha) = :fecha
            ORDER BY id DESC";
    
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(":fecha", $fecha);
    
    if ($stmt->execute()) {
        return $stmt;
    } else {
        return false;
    }
}

public function guardarBPA3($fecha, $sede, $encargado, $mes, $medicamento_suplemento, $cantidad, $nombre_empleado, $observaciones) {
    $sql = "INSERT INTO control_medicamento 
            (fecha, sede, encargado, mes, medicamento_suplemento, cantidad, nombre_empleado, observaciones) 
            VALUES (:fecha, :sede, :encargado, :mes, :medicamento_suplemento, :cantidad, :nombre_empleado, :observaciones)";
    
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(":fecha", $fecha);
    $stmt->bindParam(":sede", $sede);
    $stmt->bindParam(":encargado", $encargado);
    $stmt->bindParam(":mes", $mes);
    $stmt->bindParam(":medicamento_suplemento", $medicamento_suplemento);
    $stmt->bindParam(":cantidad", $cantidad);
    $stmt->bindParam(":nombre_empleado", $nombre_empleado);
    $stmt->bindParam(":observaciones", $observaciones);
    
    return $stmt->execute();
}
// Agregar estos métodos en la clase InventarioModel

// 🟠 Métodos para BPA4 - Control de Dosificación
public function obtenerListadoBPA4PorFecha($fecha) {
    $sql = "SELECT id, fecha, medicamento_suplemento, dosis_gr, dias_tratamiento, lote_alevines, sala, responsable, observaciones as obs 
            FROM control_dosificacion
            WHERE DATE(fecha) = :fecha
            ORDER BY id DESC";
    
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(":fecha", $fecha);
    
    if ($stmt->execute()) {
        return $stmt;
    } else {
        return false;
    }
}

public function guardarBPA4($fecha, $medicamento_suplemento, $dosis_gr, $dias_tratamiento, $lote_alevines, $sala, $responsable, $observaciones) {
    $sql = "INSERT INTO control_dosificacion 
            (fecha, medicamento_suplemento, dosis_gr, dias_tratamiento, lote_alevines, sala, responsable, observaciones) 
            VALUES (:fecha, :medicamento_suplemento, :dosis_gr, :dias_tratamiento, :lote_alevines, :sala, :responsable, :observaciones)";
    
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(":fecha", $fecha);
    $stmt->bindParam(":medicamento_suplemento", $medicamento_suplemento);
    $stmt->bindParam(":dosis_gr", $dosis_gr);
    $stmt->bindParam(":dias_tratamiento", $dias_tratamiento);
    $stmt->bindParam(":lote_alevines", $lote_alevines);
    $stmt->bindParam(":sala", $sala);
    $stmt->bindParam(":responsable", $responsable);
    $stmt->bindParam(":observaciones", $observaciones);
    
    return $stmt->execute();
}
}
?>