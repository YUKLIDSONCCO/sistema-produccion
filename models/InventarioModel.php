<?php
require_once "../config/database.php";
$db = (new Database())->getConnection();
$model = new InventarioModel($db);

require_once "../config/database.php";

class InventarioModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // ============================
    // 🟢 BPA1 - Control de Alimento
    // ============================
    public function obtenerListadoBPA1PorFecha($fecha) {
        $sql = "SELECT id, fecha, marca, calibre, cantidad, nombre_alimento AS nombre, observaciones AS obs 
                FROM control_alimento_almacen
                WHERE DATE(fecha) = :fecha
                ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":fecha", $fecha);
        $stmt->execute();
        return $stmt;
    }

    public function guardarBPA1($fecha, $sede, $encargado, $mes, $marca, $calibre, $cantidad, $nombre_alimento, $observaciones) {
        $sql = "INSERT INTO control_alimento_almacen 
                        (fecha, sede, encargado, mes, marca, calibre, cantidad, nombre_alimento, observaciones) 
                        VALUES (:fecha, :sede, :encargado, :mes, :marca, :calibre, :cantidad, :nombre_alimento, :observaciones)";
                $stmt = $this->conn->prepare($sql);
                return $stmt->execute([
                    ':fecha' => $fecha,
                    ':sede' => $sede,
                    ':encargado' => $encargado,
                    ':mes' => $mes,
                    ':marca' => $marca,
                    ':calibre' => $calibre,
                    ':cantidad' => $cantidad,
                    ':nombre_alimento' => $nombre_alimento,
                    ':observaciones' => $observaciones
                ]);
    }

    // ============================
    // 🟠 BPA2 - Control de Sal
    // ============================
    public function obtenerTodosBPA2() {
        $sql = "SELECT 
                    id, fecha, sede, encargado, mes, cantidad, 
                    nombre_sal AS nombre, observaciones AS obs,
                    estado, revisado, fecha_revision, fecha_registro
                FROM control_sal_almacen
                ORDER BY fecha DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

    public function obtenerListadoBPA2PorFecha($fecha) {
        $sql = "SELECT 
                    id, fecha, sede, encargado, mes, cantidad, 
                    nombre_sal AS nombre, observaciones AS obs,
                    estado, revisado, fecha_revision, fecha_registro
                FROM control_sal_almacen
                WHERE DATE(fecha) = :fecha
                ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":fecha", $fecha);
        $stmt->execute();
        return $stmt;
    }

    public function guardarBPA2($fecha, $sede, $encargado, $mes, $cantidad, $nombre_sal, $obs, $id_usuario = null) {
        $sql = "INSERT INTO control_sal_almacen 
                (fecha, sede, encargado, mes, cantidad, nombre_sal, observaciones, id_usuario) 
                VALUES (:fecha, :sede, :encargado, :mes, :cantidad, :nombre_sal, :observaciones, :id_usuario)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':fecha' => $fecha,
            ':sede' => $sede,
            ':encargado' => $encargado,
            ':mes' => $mes,
            ':cantidad' => $cantidad,
            ':nombre_sal' => $nombre_sal,
            ':observaciones' => $obs,
            ':id_usuario' => $id_usuario
        ]);
    }

    // ============================
    // 🔵 BPA3 - Control de Medicamentos
    // ============================
    public function obtenerTodosBPA3() {
        $sql = "SELECT 
                    id, fecha, sede, encargado, mes, 
                    medicamento_suplemento AS medicamento_suplemento, 
                    cantidad, nombre_empleado AS nombre_empleado, 
                    observaciones AS observaciones, 
                    estado, fecha_registro
                FROM control_medicamento
                ORDER BY fecha DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

    public function obtenerListadoBPA3PorFecha($fecha) {
        $sql = "SELECT 
                    id, fecha, sede, encargado, mes, 
                    medicamento_suplemento AS medicamento_suplemento, 
                    cantidad, nombre_empleado AS nombre_empleado, 
                    observaciones AS observaciones, 
                    estado, fecha_registro
                FROM control_medicamento
                WHERE DATE(fecha) = :fecha
                ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":fecha", $fecha);
        $stmt->execute();
        return $stmt;
    }
    public function guardarBPA3($fecha, $sede, $encargado, $mes, $cantidades, $medicamentos, $observaciones) {
    try {
        $sql = "INSERT INTO control_medicamento 
                (fecha, sede, encargado, mes, medicamento_suplemento, cantidad, nombre_empleado, observaciones, fecha_registro, estado) 
                VALUES 
                (:fecha, :sede, :encargado, :mes, :medicamento, :cantidad, :nombre_empleado, :observaciones, NOW(), 'pendiente')";

        $stmt = $this->conn->prepare($sql);

        foreach ($medicamentos as $i => $medicamento) {
            // Validar que la fila no esté vacía
            if (empty($medicamento) && empty($cantidades[$i]) && empty($observaciones[$i])) {
                continue;
            }

            $stmt->execute([
                ':fecha' => $fecha,
                ':sede' => $sede,
                ':encargado' => $encargado,
                ':mes' => $mes,
                ':medicamento' => $medicamento,
                ':cantidad' => $cantidades[$i],
                ':nombre_empleado' => '-', // Si no se captura en el formulario
                ':observaciones' => $observaciones[$i] ?? ''
            ]);
        }

        return true;
    } catch (PDOException $e) {
        error_log("Error en guardarBPA3: " . $e->getMessage());
        return false;
    }
}


    // ============================
    // 🟣 BPA4 - Control de Dosificación
    // ============================
    public function obtenerListadoBPA4PorFecha($fecha) {
        $sql = "SELECT id, fecha, medicamento_suplemento, dosis_gr, dias_tratamiento, lote_alevines, sala, responsable, observaciones AS obs 
                FROM control_dosificacion
                WHERE DATE(fecha) = :fecha
                ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":fecha", $fecha);
        $stmt->execute();
        return $stmt;
    }
    public function guardarBPA4($fecha, $medicamento_suplemento, $dosis_gr, $dias_tratamiento, $lote_alevines, $sala, $responsable, $observaciones) {
    $sql = "INSERT INTO control_dosificacion 
            (fecha, medicamento_suplemento, dosis_gr, dias_tratamiento, lote_alevines, sala, responsable, observaciones, fecha_registro) 
            VALUES (:fecha, :medicamento_suplemento, :dosis_gr, :dias_tratamiento, :lote_alevines, :sala, :responsable, :observaciones, NOW())";
    
    $stmt = $this->conn->prepare($sql);
    return $stmt->execute([
        ':fecha' => $fecha,
        ':medicamento_suplemento' => $medicamento_suplemento,
        ':dosis_gr' => $dosis_gr,
        ':dias_tratamiento' => $dias_tratamiento,
        ':lote_alevines' => $lote_alevines,
        ':sala' => $sala,
        ':responsable' => $responsable,
        ':observaciones' => $observaciones
    ]);
}
public function insertarControlDosificacion($data) {
    try {
        $sql = "INSERT INTO control_dosificacion 
            (fecha, medicamento_suplemento, dosis_gr, dias_tratamiento,
             lote_alevines, sala, responsable, observaciones)
            VALUES 
            (:fecha, :medicamento_suplemento, :dosis_gr, :dias_tratamiento,
             :lote_alevines, :sala, :responsable, :observaciones)";
        
        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(':fecha', $data['fecha']);
        $stmt->bindParam(':medicamento_suplemento', $data['medicamento_suplemento']);
        $stmt->bindParam(':dosis_gr', $data['dosis_gr']);
        $stmt->bindParam(':dias_tratamiento', $data['dias_tratamiento']);
        $stmt->bindParam(':lote_alevines', $data['lote_alevines']);
        $stmt->bindParam(':sala', $data['sala']);
        $stmt->bindParam(':responsable', $data['responsable']);
        $stmt->bindParam(':observaciones', $data['observaciones']);

        $stmt->execute();
        return true;
    } catch (PDOException $e) {
        throw new Exception("Error al insertar registro: " . $e->getMessage());
    }
}


    // ============================
    // 📊 RESUMEN GENERAL INVENTARIO
    // ============================
    public function obtenerResumenInventario() {
        try {
            $sql = "
                SELECT 
                    (SELECT COALESCE(SUM(cantidad), 0) FROM control_alimento_almacen) AS alimento,
                    (SELECT COALESCE(SUM(cantidad), 0) FROM control_sal_almacen) AS sal,
                    (SELECT COALESCE(SUM(cantidad), 0) FROM control_medicamento) AS medicamento,
                    (SELECT COALESCE(SUM(dosis_gr), 0) FROM control_dosificacion) AS dosificacion
            ";
            $stmt = $this->conn->query($sql);
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            $data['total_cantidad'] = $data['alimento'] + $data['sal'] + $data['medicamento'] + $data['dosificacion'];
            return $data ?: ['total_cantidad' => 0];
        } catch (PDOException $e) {
            error_log("Error en InventarioModel::obtenerResumenInventario -> " . $e->getMessage());
            return ['total_cantidad' => 0];
        }
    }
}
?>
