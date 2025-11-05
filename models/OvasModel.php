<?php
class OvasModel {

    private $conn;

    public function __construct($db) {
        $this->conn = $db;
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /* ==========================
       📘 BPA1 - CONTROL DE OVAS
       ========================== */
       public function guardarSeleccionFertilizacion($data) {
    $sql = "INSERT INTO seleccion_fertilizacion_ovas (
                fecha_registro, responsable, hora_inicio, hora_final,
                cantidad_hembras_aptas, cantidad_machos_aptos,
                cantidad_hembras_desovadas, cantidad_machos_desovados,
                relacion_hembras_machos, volumen_ovulos_fertilizados,
                cantidad_ovas_fertiles, observaciones, id_lote, id_especie, id_sede
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $this->conn->prepare($sql);
    return $stmt->execute([
        $data['fecha_registro'],
        $data['responsable'],
        $data['hora_inicio'],
        $data['hora_final'],
        $data['cantidad_hembras_aptas'],
        $data['cantidad_machos_aptos'],
        $data['cantidad_hembras_desovadas'],
        $data['cantidad_machos_desovados'],
        $data['relacion_hembras_machos'],
        $data['volumen_ovulos_fertilizados'],
        $data['cantidad_ovas_fertiles'],
        $data['observaciones'],
        $data['id_lote'],
        $data['id_especie'],
        $data['id_sede']
    ]);
}

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
        // Convertir a NULL si no hay valor
        $id_lote = !empty($data['id_lote']) ? $data['id_lote'] : null;
        $id_sede = !empty($data['id_sede']) ? $data['id_sede'] : null;
        $id_especie = !empty($data['id_especie']) ? $data['id_especie'] : null;

        $sql = "INSERT INTO mortalidad_diaria_ovas (
            codigo_formato, version, fecha_registro, encargado, cantidad_siembra,
            lote, sede, id_lote, id_sede, id_especie, fecha_control,
            bateria, batea, c1, c2, c3, c4, c5, c6, c7, total,
            observacion, responsable_area, jefe_planta, jefe_produccion, creado_en
        ) VALUES (
            :codigo_formato, :version, :fecha_registro, :encargado, :cantidad_siembra,
            :lote, :sede, :id_lote, :id_sede, :id_especie, :fecha_control,
            :bateria, :batea, :c1, :c2, :c3, :c4, :c5, :c6, :c7, :total,
            :observacion, :responsable_area, :jefe_planta, :jefe_produccion, :creado_en
        )";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(':codigo_formato', $data['codigo_formato']);
        $stmt->bindValue(':version', $data['version']);
        $stmt->bindValue(':fecha_registro', $data['fecha_registro']);
        $stmt->bindValue(':encargado', $data['encargado']);
        $stmt->bindValue(':cantidad_siembra', $data['cantidad_siembra']);
        $stmt->bindValue(':lote', $data['lote']);
        $stmt->bindValue(':sede', $data['sede']);
        $stmt->bindValue(':id_lote', $id_lote, is_null($id_lote) ? PDO::PARAM_NULL : PDO::PARAM_INT);
        $stmt->bindValue(':id_sede', $id_sede, is_null($id_sede) ? PDO::PARAM_NULL : PDO::PARAM_INT);
        $stmt->bindValue(':id_especie', $id_especie, is_null($id_especie) ? PDO::PARAM_NULL : PDO::PARAM_INT);
        $stmt->bindValue(':fecha_control', $data['fecha_control']);
        $stmt->bindValue(':bateria', $data['bateria']);
        $stmt->bindValue(':batea', $data['batea']);
        $stmt->bindValue(':c1', $data['c1']);
        $stmt->bindValue(':c2', $data['c2']);
        $stmt->bindValue(':c3', $data['c3']);
        $stmt->bindValue(':c4', $data['c4']);
        $stmt->bindValue(':c5', $data['c5']);
        $stmt->bindValue(':c6', $data['c6']);
        $stmt->bindValue(':c7', $data['c7']);
        $stmt->bindValue(':total', $data['total']);
        $stmt->bindValue(':observacion', $data['observacion']);
        $stmt->bindValue(':responsable_area', $data['responsable_area']);
        $stmt->bindValue(':jefe_planta', $data['jefe_planta']);
        $stmt->bindValue(':jefe_produccion', $data['jefe_produccion']);
        $stmt->bindValue(':creado_en', $data['creado_en']);

        return $stmt->execute();
    } catch (PDOException $e) {
        error_log("Error al guardar BPA2: " . $e->getMessage());
        return false;
    }
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
    try {
        // ✅ Asegurar que los IDs sean válidos o NULL
        $id_lote = !empty($data['id_lote']) && is_numeric($data['id_lote']) ? $data['id_lote'] : null;
        $id_sede = !empty($data['id_sede']) && is_numeric($data['id_sede']) ? $data['id_sede'] : null;
        $id_especie = !empty($data['id_especie']) && is_numeric($data['id_especie']) ? $data['id_especie'] : null;
        $sql = "INSERT INTO mortalidad_diaria_larvas (
    codigo_formato, version, fecha_registro, encargado, cantidad_siembra,
    lote, sede, id_lote, id_sede, id_especie,
    c1_lm, c1_ld, c2_lm, c2_ld, c3_lm, c3_ld, c4_lm, c4_ld,
    c5_lm, c5_ld, c6_lm, c6_ld, c7_lm, c7_ld,
    total, observacion, responsable_area, jefe_planta, jefe_produccion, creado_en
) VALUES (
    :codigo_formato, :version, :fecha_registro, :encargado, :cantidad_siembra,
    :lote, :sede, :id_lote, :id_sede, :id_especie,
    :c1_lm, :c1_ld, :c2_lm, :c2_ld, :c3_lm, :c3_ld, :c4_lm, :c4_ld,
    :c5_lm, :c5_ld, :c6_lm, :c6_ld, :c7_lm, :c7_ld,
    :total, :observacion, :responsable_area, :jefe_planta, :jefe_produccion, :creado_en
)";


        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(':codigo_formato', $data['codigo_formato']);
        $stmt->bindValue(':version', $data['version']);
        $stmt->bindValue(':fecha_registro', $data['fecha_registro']);
        $stmt->bindValue(':encargado', $data['encargado']);
        $stmt->bindValue(':cantidad_siembra', $data['cantidad_siembra']);
        $stmt->bindValue(':lote', $data['lote']);
        $stmt->bindValue(':sede', $data['sede']);

        // ✅ Si el ID no es válido, lo manda como NULL (evita error de clave foránea)
        $stmt->bindValue(':id_lote', $id_lote, is_null($id_lote) ? PDO::PARAM_NULL : PDO::PARAM_INT);
        $stmt->bindValue(':id_sede', $id_sede, is_null($id_sede) ? PDO::PARAM_NULL : PDO::PARAM_INT);
        $stmt->bindValue(':id_especie', $id_especie, is_null($id_especie) ? PDO::PARAM_NULL : PDO::PARAM_INT);

        //$stmt->bindValue(':fecha_control', $data['fecha_control']);
        $stmt->bindValue(':c1_lm', $data['c1_lm']);
        $stmt->bindValue(':c1_ld', $data['c1_ld']);
        $stmt->bindValue(':c2_lm', $data['c2_lm']);
        $stmt->bindValue(':c2_ld', $data['c2_ld']);
        $stmt->bindValue(':c3_lm', $data['c3_lm']);
        $stmt->bindValue(':c3_ld', $data['c3_ld']);
        $stmt->bindValue(':c4_lm', $data['c4_lm']);
        $stmt->bindValue(':c4_ld', $data['c4_ld']);
        $stmt->bindValue(':c5_lm', $data['c5_lm']);
        $stmt->bindValue(':c5_ld', $data['c5_ld']);
        $stmt->bindValue(':c6_lm', $data['c6_lm']);
        $stmt->bindValue(':c6_ld', $data['c6_ld']);
        $stmt->bindValue(':c7_lm', $data['c7_lm']);
        $stmt->bindValue(':c7_ld', $data['c7_ld']);
        $stmt->bindValue(':total', $data['total']);
        $stmt->bindValue(':observacion', $data['observacion']);
        $stmt->bindValue(':responsable_area', $data['responsable_area']);
        $stmt->bindValue(':jefe_planta', $data['jefe_planta']);
        $stmt->bindValue(':jefe_produccion', $data['jefe_produccion']);
        $stmt->bindValue(':creado_en', $data['creado_en']);

        return $stmt->execute();

    } catch (PDOException $e) {
        error_log("Error al guardar BPA3: " . $e->getMessage());
        return false;
    }
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
    public function insertarMortalidadLarvas($data) {
    try {
        $sql = "INSERT INTO mortalidad_diaria_larvas 
                (codigo_formato, version, fecha_registro, encargado, cantidad_siembra, lote, sede, observacion, creado_en)
                VALUES (:codigo_formato, :version, NOW(), :encargado, :cantidad_siembra, :lote, :sede, :observacion, NOW())";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':codigo_formato', 'CORAQUA-BPA-05');
        $stmt->bindValue(':version', '2.0');
        $stmt->bindValue(':encargado', $data['encargado']);
        $stmt->bindValue(':cantidad_siembra', $data['cantidad_siembra']);
        $stmt->bindValue(':lote', $data['lote']);
        $stmt->bindValue(':sede', $data['sede']);
        $stmt->bindValue(':observacion', $data['observacion']);
        return $stmt->execute();
    } catch (PDOException $e) {
        return false;
    }
}

}
?>
