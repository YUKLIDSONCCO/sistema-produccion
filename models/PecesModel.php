<?php

class PecesModel {

    public function obtenerConexion() {
        $db = new Database();
        return $db->getConnection();
    }

    public function obtenerEspecies() {
        $conn = $this->obtenerConexion();
        $query = $conn->query("SELECT * FROM especies ORDER BY nombre ASC");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function agregarEspecieYObtenerID($data) {
        $conn = $this->obtenerConexion();
        $sql = "INSERT INTO especies (nombre, nombre_comun, descripcion, fecha_creacion) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            $data['nombre'],
            $data['nombre_comun'],
            $data['descripcion'],
            $data['fecha_creacion']
        ]);
        return $conn->lastInsertId();
    }

    public function guardarBpa6($data) {
        $conn = $this->obtenerConexion();
        $id_lote = (isset($data['id_lote']) && is_numeric($data['id_lote']) && (int)$data['id_lote'] > 0) ? (int)$data['id_lote'] : null;
        $id_especie = (isset($data['id_especie']) && is_numeric($data['id_especie']) && (int)$data['id_especie'] > 0) ? (int)$data['id_especie'] : null;
        $id_sede = (isset($data['id_sede']) && is_numeric($data['id_sede']) && (int)$data['id_sede'] > 0) ? (int)$data['id_sede'] : null;

        $sql = "INSERT INTO mortalidad_alevines (
                    codigo_formato, version, fecha_registro, responsable, sede, up, lote,
                    mortalidad, morbilidad, observaciones,
                    id_lote, id_especie, id_sede, creado_en, actualizado_en
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            $data['codigo_formato'],
            $data['version'],
            $data['fecha_registro'],
            $data['responsable'],
            $data['sede'],
            $data['up'],
            $data['lote'],
            $data['mortalidad'],
            $data['morbilidad'],
            $data['observaciones'],
            $id_lote,
            $id_especie,
            $id_sede,
            $data['creado_en'],
            $data['actualizado_en']
        ]);
    }

    public function getBpa6List($fecha = null) {
        $conn = $this->obtenerConexion();
        if ($fecha) {
            $sql = "SELECT * FROM mortalidad_alevines WHERE fecha_registro = ? ORDER BY fecha_registro DESC, up ASC";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$fecha]);
        } else {
            $sql = "SELECT * FROM mortalidad_alevines ORDER BY fecha_registro DESC, up ASC";
            $stmt = $conn->query($sql);
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Obtiene registros entre dos fechas (inclusive)
     */
    public function getBpa6Between(string $startDate, string $endDate): array {
        $conn = $this->obtenerConexion();
        $sql = "SELECT * FROM mortalidad_alevines WHERE fecha_registro BETWEEN ? AND ? ORDER BY fecha_registro ASC, up ASC";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$startDate, $endDate]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getBpa6ById($id) {
        $conn = $this->obtenerConexion();
        $stmt = $conn->prepare("SELECT * FROM mortalidad_alevines WHERE id = ? LIMIT 1");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function eliminarBpa6($id) {
        $conn = $this->obtenerConexion();
        $stmt = $conn->prepare("DELETE FROM mortalidad_alevines WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function guardarBpa7($data) {
        $conn = $this->obtenerConexion();
        $sql = "INSERT INTO alimentacion_diaria (
                    codigo_formato, version, fecha_registro, responsable, sede, up, lote,
                    biomasa, tasa_alimentacion, alimento_suministrado, calibre, observaciones,
                    id_lote, id_especie, id_sede, creado_en, actualizado_en
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            $data['codigo_formato'],
            $data['version'],
            $data['fecha_registro'],
            $data['responsable'],
            $data['sede'],
            $data['up'],
            $data['lote'],
            $data['biomasa'],
            $data['tasa_alimentacion'],
            $data['alimento_suministrado'],
            $data['calibre'],
            $data['observaciones'],
            $data['id_lote'],
            $data['id_especie'],
            $data['id_sede'],
            $data['creado_en'],
            $data['actualizado_en']
        ]);
    }

    public function getBpa7List($fecha = null) {
        $conn = $this->obtenerConexion();
        if ($fecha) {
            $sql = "SELECT * FROM alimentacion_diaria WHERE fecha_registro = ? ORDER BY fecha_registro DESC";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$fecha]);
        } else {
            $sql = "SELECT * FROM alimentacion_diaria ORDER BY fecha_registro DESC";
            $stmt = $conn->query($sql);
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Obtiene registros de alimentación entre dos fechas (inclusive)
     */
    public function getBpa7Between(string $startDate, string $endDate): array {
        $conn = $this->obtenerConexion();
        $sql = "SELECT * FROM alimentacion_diaria WHERE fecha_registro BETWEEN ? AND ? ORDER BY fecha_registro ASC";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$startDate, $endDate]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getBpa7ById($id) {
        $conn = $this->obtenerConexion();
        $stmt = $conn->prepare("SELECT * FROM alimentacion_diaria WHERE id = ? LIMIT 1");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function eliminarBpa7($id) {
        $conn = $this->obtenerConexion();
        $stmt = $conn->prepare("DELETE FROM alimentacion_diaria WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function guardarBpa10($data) {
        $conn = $this->obtenerConexion();
        $sql = "INSERT INTO muestreo (
                    codigo_formato, version, fecha_registro, encargado, sede,
                    fecha_muestreo, hora_muestreo, up, lote,
                    peso_promedio, coeficiente_variacion, factor_k, observaciones,
                    id_lote, id_especie, id_sede, creado_en, actualizado_en
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            $data['codigo_formato'],
            $data['version'],
            $data['fecha_registro'],
            $data['encargado'],
            $data['sede'],
            $data['fecha_muestreo'],
            $data['hora_muestreo'],
            $data['up'],
            $data['lote'],
            $data['peso_promedio'],
            $data['coeficiente_variacion'],
            $data['factor_k'],
            $data['observaciones'],
            $data['id_lote'],
            $data['id_especie'],
            $data['id_sede'],
            $data['creado_en'],
            $data['actualizado_en']
        ]);
    }

    public function getBpa10List() {
        $conn = $this->obtenerConexion();
        $sql = "SELECT * FROM muestreo ORDER BY fecha_registro DESC, up ASC";
        $stmt = $conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getBpa10ById($id) {
        $conn = $this->obtenerConexion();
        $stmt = $conn->prepare("SELECT * FROM muestreo WHERE id = ? LIMIT 1");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function eliminarBpa10($id) {
        $conn = $this->obtenerConexion();
        $stmt = $conn->prepare("DELETE FROM muestreo WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // =========================
    // BPA12 - CONTROL DE PARÁMETROS (PECES)
    // Se insertará en la tabla control_diario_parametros_peces (una fila por día)
    // columnas esperadas: codigo_formato, version, fecha_registro, mes, sede, dia,
    // t_0630, o2_0630, sat_0630, ph_0630, t_1200, o2_1200, sat_1200, ph_1200,
    // t_1530, o2_1530, sat_1530, ph_1530, responsable, observacion, id_sede, creado_en
    public function guardarBpa12($data) {
        $conn = $this->obtenerConexion();

        // Verificar que vengan dias
        if (empty($data['dias']) || !is_array($data['dias'])) {
            return false;
        }

        $sql = "INSERT INTO control_diario_parametros_peces (
            codigo_formato, version, fecha_registro, mes, sede, dia,
            t_0630, o2_0630, sat_0630, ph_0630,
            t_1200, o2_1200, sat_1200, ph_1200,
            t_1530, o2_1530, sat_1530, ph_1530,
            responsable, observacion, id_sede, creado_en
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);

        try {
            $conn->beginTransaction();

            foreach ($data['dias'] as $dia => $parametros) {
            // Mapear desde los keys del controlador (temp_6_30, o2_6_30, ...)
            $t0630 = isset($parametros['temp_6_30']) ? $parametros['temp_6_30'] : null;
            $o20630 = isset($parametros['o2_6_30']) ? $parametros['o2_6_30'] : null;
            $sat0630 = isset($parametros['sat_6_30']) ? $parametros['sat_6_30'] : null;
            $ph0630 = isset($parametros['ph_6_30']) ? $parametros['ph_6_30'] : null;

            $t1200 = isset($parametros['temp_12_00']) ? $parametros['temp_12_00'] : null;
            $o21200 = isset($parametros['o2_12_00']) ? $parametros['o2_12_00'] : null;
            $sat1200 = isset($parametros['sat_12_00']) ? $parametros['sat_12_00'] : null;
            $ph1200 = isset($parametros['ph_12_00']) ? $parametros['ph_12_00'] : null;

            $t1530 = isset($parametros['temp_3_30']) ? $parametros['temp_3_30'] : null;
            $o21530 = isset($parametros['o2_3_30']) ? $parametros['o2_3_30'] : null;
            $sat1530 = isset($parametros['sat_3_30']) ? $parametros['sat_3_30'] : null;
            $ph1530 = isset($parametros['ph_3_30']) ? $parametros['ph_3_30'] : null;

            $responsable = $parametros['responsable'] ?? ($data['responsable'] ?? null);
            $observacion = $parametros['observaciones'] ?? null;

            $id_sede = $data['id_sede'] ?? null;

                $stmt->execute([
                    $data['codigo_formato'] ?? 'CORAQUA BPA-12',
                    $data['version'] ?? '2.0',
                    $data['fecha_registro'] ?? date('Y-m-d'),
                    $data['mes'] ?? '',
                    $data['sede'] ?? '',
                    $dia,
                    $t0630,
                    $o20630,
                    $sat0630,
                    $ph0630,
                    $t1200,
                    $o21200,
                    $sat1200,
                    $ph1200,
                    $t1530,
                    $o21530,
                    $sat1530,
                    $ph1530,
                    $responsable,
                    $observacion,
                    $id_sede,
                    date('Y-m-d H:i:s')
                ]);
            }

            $conn->commit();
            return true;
        } catch (PDOException $e) {
            // Rollback and log
            try { $conn->rollBack(); } catch (Exception $x) {}
            error_log('PecesModel::guardarBpa12 DB error: ' . $e->getMessage());
            return false;
        }
    }

    public function getBpa12List() {
        $conn = $this->obtenerConexion();

        // Preferir la tabla moderna control_diario_parametros_peces si tiene datos
        try {
            $check = $conn->query("SELECT COUNT(*) as c FROM information_schema.tables WHERE table_schema = DATABASE() AND table_name = 'control_diario_parametros_peces'")->fetch(PDO::FETCH_ASSOC);
            $hasTable = ($check && $check['c'] > 0);
        } catch (Exception $e) {
            $hasTable = false;
        }

        if ($hasTable) {
            // Agrupar por fecha/mes/sede para presentar un listado parecido al anterior
            $sql = "SELECT fecha_registro, mes, sede, COUNT(*) as total_dias, MIN(id) as id_sample, MIN(creado_en) as creado_en
                    FROM control_diario_parametros_peces
                    GROUP BY fecha_registro, mes, sede
                    ORDER BY fecha_registro DESC, sede ASC";
            $stmt = $conn->query($sql);
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            // Normalizar estructura: proporcionar id and detalles will be fetched by getBpa12ById
            $result = [];
            foreach ($rows as $r) {
                $result[] = [
                    'id' => $r['id_sample'],
                    'fecha_registro' => $r['fecha_registro'],
                    'mes' => $r['mes'],
                    'sede' => $r['sede'],
                    'total_dias' => $r['total_dias'],
                    'creado_en' => $r['creado_en']
                ];
            }
            return $result;
        }

        // Fallback: esquema antiguo
        $sql = "SELECT cp.*, COUNT(dcp.id) as total_dias 
                FROM control_parametros cp 
                LEFT JOIN detalle_control_parametros dcp ON cp.id = dcp.id_control 
                GROUP BY cp.id 
                ORDER BY cp.fecha_registro DESC";

        $stmt = $conn->query($sql);
        $registros = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Para cada registro, obtenemos sus detalles
        foreach ($registros as &$registro) {
            $sqlDetalles = "SELECT * FROM detalle_control_parametros 
                           WHERE id_control = ? 
                           ORDER BY dia ASC";
            $stmtDetalles = $conn->prepare($sqlDetalles);
            $stmtDetalles->execute([$registro['id']]);
            $registro['detalles'] = $stmtDetalles->fetchAll(PDO::FETCH_ASSOC);
        }

        return $registros;
    }

    /**
     * Devuelve listado detallado de filas individuales (una fila por día) desde
     * la tabla control_diario_parametros_peces si existe. Esto permite mostrar
     * directamente columnas como t_0630, o2_0630, sat_0630, ph_0630, etc.
     */
    public function getBpa12ListDetailed($fecha = null) {
        $conn = $this->obtenerConexion();
        if ($fecha) {
            $sql = "SELECT * FROM control_diario_parametros_peces WHERE fecha_registro = ? ORDER BY fecha_registro DESC, dia ASC";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$fecha]);
        } else {
            $sql = "SELECT * FROM control_diario_parametros_peces ORDER BY fecha_registro DESC, dia ASC";
            $stmt = $conn->query($sql);
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Obtiene registros de control de parámetros entre dos fechas (inclusive)
     */
    public function getBpa12Between(string $startDate, string $endDate): array {
        $conn = $this->obtenerConexion();
        $sql = "SELECT * FROM control_diario_parametros_peces WHERE fecha_registro BETWEEN ? AND ? ORDER BY fecha_registro ASC, dia ASC";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$startDate, $endDate]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getBpa12ById($id) {
        $conn = $this->obtenerConexion();

        // Primero intentar esquema moderno: si existe una fila con id en control_diario_parametros_peces
        try {
            $stmt = $conn->prepare("SELECT * FROM control_diario_parametros_peces WHERE id = ? LIMIT 1");
            $stmt->execute([$id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                // Recuperar todos los registros con la misma fecha_registro y sede
                $sqlDetalles = "SELECT * FROM control_diario_parametros_peces WHERE fecha_registro = ? AND sede = ? ORDER BY dia ASC";
                $stmtDetalles = $conn->prepare($sqlDetalles);
                $stmtDetalles->execute([$row['fecha_registro'], $row['sede']]);
                return [
                    'id' => $row['id'],
                    'fecha_registro' => $row['fecha_registro'],
                    'mes' => $row['mes'],
                    'sede' => $row['sede'],
                    'detalles' => $stmtDetalles->fetchAll(PDO::FETCH_ASSOC)
                ];
            }
        } catch (Exception $e) {
            // ignore and fallback
        }

        // Fallback to old schema
        $stmt = $conn->prepare("SELECT * FROM control_parametros WHERE id = ?");
        $stmt->execute([$id]);
        $registro = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($registro) {
            $sqlDetalles = "SELECT * FROM detalle_control_parametros 
                           WHERE id_control = ? 
                           ORDER BY dia ASC";
            $stmtDetalles = $conn->prepare($sqlDetalles);
            $stmtDetalles->execute([$id]);
            $registro['detalles'] = $stmtDetalles->fetchAll(PDO::FETCH_ASSOC);
        }
        
        return $registro;
    }

    /**
     * Elimina un registro BPA12. Si existe la tabla moderna `control_diario_parametros_peces`
     * elimina todas las filas con la misma fecha_registro y sede (grupo mostrado en el listado).
     * Si no existe, intenta eliminar el esquema antiguo (control_parametros + detalle_control_parametros).
     */
    public function eliminarBpa12($id) {
        $conn = $this->obtenerConexion();
        try {
            $conn->beginTransaction();

            // Intentar esquema moderno
            $stmt = $conn->prepare("SELECT fecha_registro, sede FROM control_diario_parametros_peces WHERE id = ? LIMIT 1");
            $stmt->execute([$id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                $del = $conn->prepare("DELETE FROM control_diario_parametros_peces WHERE fecha_registro = ? AND sede = ?");
                $del->execute([$row['fecha_registro'], $row['sede']]);
                $conn->commit();
                return true;
            }

            // Fallback esquema antiguo
            $stmt2 = $conn->prepare("SELECT id FROM control_parametros WHERE id = ? LIMIT 1");
            $stmt2->execute([$id]);
            $old = $stmt2->fetch(PDO::FETCH_ASSOC);
            if ($old) {
                $delDet = $conn->prepare("DELETE FROM detalle_control_parametros WHERE id_control = ?");
                $delDet->execute([$id]);
                $delMain = $conn->prepare("DELETE FROM control_parametros WHERE id = ?");
                $delMain->execute([$id]);
                $conn->commit();
                return true;
            }

            $conn->rollBack();
            return false;
        } catch (Exception $e) {
            try { $conn->rollBack(); } catch (Exception $_) {}
            error_log('PecesModel::eliminarBpa12 error: ' . $e->getMessage());
            return false;
        }
    }
}

?>

