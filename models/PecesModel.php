<?php

class PecesModel {

    public function obtenerConexion() {
        $db = new Database();
        return $db->getConnection(); // usamos getConnection() como en inventario
    }

    public function obtenerEspecies() {
        $conn = $this->obtenerConexion();
        $query = $conn->query("SELECT * FROM especies ORDER BY nombre ASC");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function agregarEspecieYObtenerID($data) {
        $conn = $this->obtenerConexion();
        $sql = "INSERT INTO especies (nombre, nombre_comun, descripcion, fecha_creacion)
                VALUES (?, ?, ?, ?)";
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
        // La columna "total" es generada (mortalidad + morbilidad), no se inserta manualmente.
        // Normalizar FKs vacíos a NULL para evitar violar restricciones.
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

    public function getBpa6List() {
        $conn = $this->obtenerConexion();
        $sql = "SELECT * FROM mortalidad_alevines ORDER BY fecha_registro DESC, up ASC";
        $stmt = $conn->query($sql);
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

    /* =========================================
       BPA 7 - ALIMENTACIÓN DIARIA
       ========================================= */
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

    public function getBpa7List() {
        $conn = $this->obtenerConexion();
        $sql = "SELECT * FROM alimentacion_diaria ORDER BY fecha_registro DESC";
        $stmt = $conn->query($sql);
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

    /* =========================================
       BPA 10 - MUESTREO
       ========================================= */
    public function guardarBpa10($data) {
    $conn = $this->obtenerConexion();

    // Campos requeridos
    $campos_requeridos = [
        'codigo_formato', 'version', 'fecha_registro', 'encargado', 'sede',
        'fecha_muestreo', 'hora_muestreo', 'up', 'lote',
        'peso_promedio', 'coeficiente_variacion', 'factor_k',
        'creado_en', 'actualizado_en'
    ];

    // Campos opcionales con valores por defecto
    $campos_opcionales = [
        'observaciones' => '',
        'id_lote' => null,
        'id_especie' => null,
        'id_sede' => null
    ];

    // Validar campos requeridos
    foreach ($campos_requeridos as $campo) {
        if (!isset($data[$campo]) || $data[$campo] === '') {
            throw new Exception("Falta el campo requerido '$campo' en guardarBpa10()");
        }
    }

    // Establecer valores por defecto para campos opcionales
    foreach ($campos_opcionales as $campo => $valor_defecto) {
        if (!isset($data[$campo]) || $data[$campo] === '') {
            $data[$campo] = $valor_defecto;
        }
    }

    foreach ($data as $key => $value) {
        if (is_array($value)) {
            $data[$key] = implode(',', $value);
        }
    }

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

    /* =========================================
       BPA 12 - CONTROL DE PARÁMETROS
       ========================================= */
    public function guardarBpa12($data) {
        $conn = $this->obtenerConexion();
        
        // Primero guardamos el registro principal en control_parametros
        $sqlControl = "INSERT INTO control_parametros (
            codigo_formato, version, fecha_registro, mes, sede,
            responsable, observaciones, creado_en, actualizado_en
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($sqlControl);
        $stmt->execute([
            $data['codigo_formato'],
            $data['version'],
            $data['fecha_registro'],
            $data['mes'],
            $data['sede'],
            $data['responsable'],
            $data['observaciones'],
            date('Y-m-d H:i:s'),
            date('Y-m-d H:i:s')
        ]);

        $id_control = $conn->lastInsertId();

        // Luego guardamos los detalles de parámetros
        $sqlDetalle = "INSERT INTO detalle_control_parametros (
            id_control, dia, 
            temp_6_30, o2_6_30, sat_6_30, ph_6_30,
            temp_12_00, o2_12_00, sat_12_00, ph_12_00,
            temp_3_30, o2_3_30, sat_3_30, ph_3_30,
            temp_prom, o2_prom, sat_prom, ph_prom,
            observaciones, creado_en
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sqlDetalle);

        // Procesar cada día del mes
        foreach ($data['dias'] as $dia => $parametros) {
            // Calcular promedios
            $temp_prom = ($parametros['temp_6_30'] + $parametros['temp_12_00'] + $parametros['temp_3_30']) / 3;
            $o2_prom = ($parametros['o2_6_30'] + $parametros['o2_12_00'] + $parametros['o2_3_30']) / 3;
            $sat_prom = ($parametros['sat_6_30'] + $parametros['sat_12_00'] + $parametros['sat_3_30']) / 3;
            $ph_prom = ($parametros['ph_6_30'] + $parametros['ph_12_00'] + $parametros['ph_3_30']) / 3;

            $stmt->execute([
                $id_control,
                $dia,
                $parametros['temp_6_30'],
                $parametros['o2_6_30'],
                $parametros['sat_6_30'],
                $parametros['ph_6_30'],
                $parametros['temp_12_00'],
                $parametros['o2_12_00'],
                $parametros['sat_12_00'],
                $parametros['ph_12_00'],
                $parametros['temp_3_30'],
                $parametros['o2_3_30'],
                $parametros['sat_3_30'],
                $parametros['ph_3_30'],
                $temp_prom,
                $o2_prom,
                $sat_prom,
                $ph_prom,
                $parametros['observaciones'] ?? '',
                date('Y-m-d H:i:s')
            ]);
        }
    }

    public function getBpa12List() {
        $conn = $this->obtenerConexion();
        
        // Primero obtenemos los registros principales
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

    public function getBpa12ById($id) {
        $conn = $this->obtenerConexion();
        
        // Obtener el registro principal
        $sql = "SELECT * FROM control_parametros WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        $registro = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($registro) {
            // Obtener los detalles
            $sqlDetalles = "SELECT * FROM detalle_control_parametros 
                           WHERE id_control = ? 
                           ORDER BY dia ASC";
            $stmtDetalles = $conn->prepare($sqlDetalles);
            $stmtDetalles->execute([$id]);
            $registro['detalles'] = $stmtDetalles->fetchAll(PDO::FETCH_ASSOC);
        }
        
        return $registro;
    }
}

?>

