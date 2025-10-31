<?php
class OvasModel {

    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    /* ==========================
       📘 BPA1 - CONTROL DE OVAS
       ========================== */

    public function guardarBPA1($data) {
        $sql = "INSERT INTO control_ovas (
                    codigo_formato, version, fecha_registro, responsable, sede,
                    id_sede, id_especie, id_lote, lote, cantidad_ovas,
                    fertilizacion, observaciones, creado_en
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $data['codigo_formato'],
            $data['version'],
            $data['fecha_registro'],
            $data['responsable'],
            $data['sede'],
            $data['id_sede'],
            $data['id_especie'],
            $data['id_lote'],
            $data['lote'],
            $data['cantidad_ovas'],
            $data['fertilizacion'],
            $data['observaciones'],
            $data['creado_en']
        ]);
    }

    public function obtenerListadoBPA1PorFecha($fecha) {
        $sql = "SELECT * FROM control_ovas WHERE DATE(fecha_registro) = ? ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$fecha]);
        return $stmt;
    }
    /* ==========================
       BPA2 - MORTALIDAD DIARIA OVAS
       ========================== */

    public function guardarBPA2($data) {
        try {
            $sql = "INSERT INTO mortalidad_diaria_ovas (
                codigo_formato, version, fecha_registro, encargado, cantidad_siembra, 
                lote, sede, id_lote, id_sede, id_especie, fecha_control, bateria, 
                batea, c1, c2, c3, c4, c5, c6, c7, total, observacion, 
                responsable_area, jefe_planta, jefe_produccion, creado_en
            ) VALUES (
                :codigo_formato, :version, :fecha_registro, :encargado, :cantidad_siembra,
                :lote, :sede, :id_lote, :id_sede, :id_especie, :fecha_control, :bateria,
                :batea, :c1, :c2, :c3, :c4, :c5, :c6, :c7, :total, :observacion,
                :responsable_area, :jefe_planta, :jefe_produccion, :creado_en
            )";

            $stmt = $this->conn->prepare($sql);
            
            return $stmt->execute([
                ':codigo_formato' => $data['codigo_formato'],
                ':version' => $data['version'],
                ':fecha_registro' => $data['fecha_registro'],
                ':encargado' => $data['encargado'],
                ':cantidad_siembra' => $data['cantidad_siembra'],
                ':lote' => $data['lote'],
                ':sede' => $data['sede'],
                ':id_lote' => $data['id_lote'],
                ':id_sede' => $data['id_sede'],
                ':id_especie' => $data['id_especie'],
                ':fecha_control' => $data['fecha_control'],
                ':bateria' => $data['bateria'],
                ':batea' => $data['batea'],
                ':c1' => $data['c1'],
                ':c2' => $data['c2'],
                ':c3' => $data['c3'],
                ':c4' => $data['c4'],
                ':c5' => $data['c5'],
                ':c6' => $data['c6'],
                ':c7' => $data['c7'],
                ':total' => $data['total'],
                ':observacion' => $data['observacion'],
                ':responsable_area' => $data['responsable_area'],
                ':jefe_planta' => $data['jefe_planta'],
                ':jefe_produccion' => $data['jefe_produccion'],
                ':creado_en' => $data['creado_en']
            ]);
        } catch (PDOException $e) {
            error_log("Error en guardarBPA2: " . $e->getMessage());
            return false;
        }
                    codigo_formato, version, fecha_registro, encargado, cantidad_siembra,
                    lote, sede, id_lote, id_sede, id_especie, fecha_control,
                    bateria, batea, c1, c2, c3, c4, c5, c6, c7,
                    total, observacion, responsable_area, jefe_planta, jefe_produccion, creado_en
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            $data['codigo_formato'],
            $data['version'],
            $data['fecha_registro'],
            $data['encargado'],
            $data['cantidad_siembra'],
            $data['lote'],
            $data['sede'],
            $data['id_lote'],
            $data['id_sede'],
            $data['id_especie'],
            $data['fecha_control'],
            $data['bateria'],
            $data['batea'],
            $data['c1'],
            $data['c2'],
            $data['c3'],
            $data['c4'],
            $data['c5'],
            $data['c6'],
            $data['c7'],
            $data['total'],
            $data['observacion'],
            $data['responsable_area'],
            $data['jefe_planta'],
            $data['jefe_produccion'],
            $data['creado_en']
        ]);
    }

    public function obtenerListadoBPA2PorFecha($fecha) {
        $sql = "SELECT * FROM mortalidad_diaria_ovas WHERE fecha_registro = ? ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$fecha]);
        return $stmt;
    }


    /* ==========================
       BPA3 - MORTALIDAD DIARIA LARVAS
       ========================== */

    public function guardarBPA3($data) {
        $sql = "INSERT INTO mortalidad_diaria_larvas (
                    codigo_formato, version, fecha_registro, encargado, cantidad_siembra,
                    lote, sede, id_lote, id_sede, id_especie,
                    c1_lm, c1_ld, c2_lm, c2_ld, c3_lm, c3_ld, c4_lm, c4_ld, c5_lm, c5_ld, c6_lm, c6_ld, c7_lm, c7_ld,
                    total, observacion, responsable_area, jefe_planta, jefe_produccion, creado_en
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            $data['codigo_formato'],
            $data['version'],
            $data['fecha_registro'],
            $data['encargado'],
            $data['cantidad_siembra'],
            $data['lote'],
            $data['sede'],
            $data['id_lote'],
            $data['id_sede'],
            $data['id_especie'],
            $data['c1_lm'],
            $data['c1_ld'],
            $data['c2_lm'],
            $data['c2_ld'],
            $data['c3_lm'],
            $data['c3_ld'],
            $data['c4_lm'],
            $data['c4_ld'],
            $data['c5_lm'],
            $data['c5_ld'],
            $data['c6_lm'],
            $data['c6_ld'],
            $data['c7_lm'],
            $data['c7_ld'],
            $data['total'],
            $data['observacion'],
            $data['responsable_area'],
            $data['jefe_planta'],
            $data['jefe_produccion'],
            $data['creado_en']
        ]);
    }

    public function obtenerListadoBPA3PorFecha($fecha) {
        $sql = "SELECT * FROM mortalidad_diaria_larvas WHERE fecha_registro = ? ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$fecha]);
        return $stmt;
    }


    /* ==========================
       BPA4 - CONTROL DE PARÁMETROS
       ========================== */

    public function guardarBPA4($data) {
        $sql = "INSERT INTO control_parametros (
                    codigo_formato, version, fecha_registro, mes,
                    sede, responsable, observaciones, creado_en, actualizado_en
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            $data['codigo_formato'],
            $data['version'],
            $data['fecha_registro'],
            $data['mes'],
            $data['sede'],
            $data['responsable'],
            $data['observaciones'],
            $data['creado_en'],
            $data['actualizado_en']
        ]);
    }

    public function obtenerListadoBPA4PorFecha($fecha) {
        $sql = "SELECT * FROM control_parametros WHERE fecha_registro = ? ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$fecha]);
        return $stmt;
    }
}
?>
