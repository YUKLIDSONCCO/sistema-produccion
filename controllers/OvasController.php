<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/OvasModel.php';

class OvasController {
    private $conn;
    private $model;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
        $this->model = new OvasModel($this->conn);
    }

    public function bpa1() {
        if (isset($_GET['success'])) {
            echo "<script>alert('Se guardaron " . $_GET['success'] . " registros correctamente');</script>";
        }
        if (isset($_GET['error'])) {
            echo "<script>alert('Error al guardar los registros');</script>";
        }

        include __DIR__ . '/../views/jefeplanta/modulos-jefeplanta/ovas/bpa1.php';
    }

    public function listarBPA1() {
        $fecha = isset($_GET['fecha']) ? $_GET['fecha'] : date('Y-m-d');
        $database = new Database();
        $conn = $database->getConnection();
        $model = new OvasModel($conn);
        $stmt = $model->obtenerListadoBPA1PorFecha($fecha);

        $datos = [];
        if ($stmt) {
            $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        $fechaBusqueda = $fecha;
        include __DIR__ . '/../views/jefeplanta/modulos-jefeplanta/ovas/lista1.php';
    }
    public function guardarBPA1() {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: index.php?controller=Ovas&action=bpa1&error=method');
        exit;
    }

    // Recoger datos:
    $data = [
        'fecha_registro' => $_POST['fecha'] ?? date('Y-m-d'),
        'responsable' => $_POST['responsable'] ?? '',
        'hora_inicio' => $_POST['horaInicio'] ?? '',
        'hora_final' => $_POST['horaFinal'] ?? '',
        'cantidad_hembras_aptas' => $_POST['sec_aptos_valor'][0] ?? 0,
        'cantidad_machos_aptos' => $_POST['sec_aptos_valor'][1] ?? 0,
        'cantidad_hembras_desovadas' => $_POST['sec_desovados_valor'][0] ?? 0,
        'cantidad_machos_desovados' => $_POST['sec_desovados_valor'][1] ?? 0,
        'relacion_hembras_machos' => $_POST['sec_desovados_valor'][2] ?? '',
        'volumen_ovulos_fertilizados' => $_POST['sec_volumen_valor'][0] ?? 0,
        'cantidad_ovas_fertiles' => $_POST['sec_ovas_valor'][0] ?? 0,
        'observaciones' => $_POST['observaciones'] ?? '',
        'id_lote' => (!empty($_POST['id_lote']) && is_numeric($_POST['id_lote'])) ? $_POST['id_lote'] : null,
        'id_sede' => (!empty($_POST['id_sede']) && is_numeric($_POST['id_sede'])) ? $_POST['id_sede'] : null,
        'id_especie' => (!empty($_POST['id_especie']) && is_numeric($_POST['id_especie'])) ? $_POST['id_especie'] : null,
    ];

    $result = $this->model->guardarSeleccionFertilizacion($data);

    if ($result) {
        header("Location: index.php?controller=Ovas&action=bpa1&success=1");
    } else {
        header("Location: index.php?controller=Ovas&action=bpa1&error=1");
    }
    exit;
}


    
    /* =========================================
       BPA 2 - MORTALIDAD DIARIA DE OVAS
       ========================================= */
       public function guardarBPA2() {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        echo json_encode(['success' => false, 'error' => 'Método no permitido']);
        exit;
    }

    try {
        $registrosGuardados = 0;

        // Varios registros
        if (isset($_POST['fecha_control']) && is_array($_POST['fecha_control'])) {
            $filas = count($_POST['fecha_control']);

            for ($i = 0; $i < $filas; $i++) {
                $data = [
                    'codigo_formato' => 'CORAQUA-BPA2',
                    'version' => '2.0',
                    'fecha_registro' => date('Y-m-d'),
                    'encargado' => $_POST['encargado'] ?? '',
                    'cantidad_siembra' => $_POST['cantidad_siembra'] ?? 0,
                    'lote' => $_POST['lote'] ?? '',
                    'sede' => $_POST['sede'] ?? '',
                    'id_lote' => $_POST['id_lote'] ?? 0,
                    'id_sede' => $_POST['id_sede'] ?? 0,
                    'id_especie' => $_POST['id_especie'] ?? 0,
                    'fecha_control' => $_POST['fecha_control'][$i] ?? date('Y-m-d'),
                    'bateria' => $_POST['bateria'][$i] ?? '',
                    'batea' => $_POST['batea'][$i] ?? '',
                    'c1' => $_POST['c1'][$i] ?? 0,
                    'c2' => $_POST['c2'][$i] ?? 0,
                    'c3' => $_POST['c3'][$i] ?? 0,
                    'c4' => $_POST['c4'][$i] ?? 0,
                    'c5' => $_POST['c5'][$i] ?? 0,
                    'c6' => $_POST['c6'][$i] ?? 0,
                    'c7' => $_POST['c7'][$i] ?? 0,
                    'total' => $_POST['total'][$i] ?? 0,
                    'observacion' => $_POST['observacion'][$i] ?? '',
                    'responsable_area' => $_POST['responsable_area'] ?? '',
                    'jefe_planta' => $_POST['jefe_planta'] ?? '',
                    'jefe_produccion' => $_POST['jefe_produccion'] ?? '',
                    'creado_en' => date('Y-m-d H:i:s')
                ];

                if ($this->model->guardarBPA2($data)) {
                    $registrosGuardados++;
                }
            }

            echo json_encode(['success' => true, 'message' => "Se guardaron {$registrosGuardados} registros."]);
            exit;
        }

        // Un solo registro
        $data = [
            'codigo_formato' => 'CORAQUA-BPA2',
            'version' => '2.0',
            'fecha_registro' => date('Y-m-d'),
            'encargado' => $_POST['encargado'] ?? '',
            'cantidad_siembra' => $_POST['cantidad_siembra'] ?? 0,
            'lote' => $_POST['lote'] ?? '',
            'sede' => $_POST['sede'] ?? '',
            'id_lote' => $_POST['id_lote'] ?? 0,
            'id_sede' => $_POST['id_sede'] ?? 0,
            'id_especie' => $_POST['id_especie'] ?? 0,
            'fecha_registro' => $_POST['fecha_control'] ?? date('Y-m-d'),
            'bateria' => $_POST['bateria'] ?? '',
            'batea' => $_POST['batea'] ?? '',
            'c1' => $_POST['c1'] ?? 0,
            'c2' => $_POST['c2'] ?? 0,
            'c3' => $_POST['c3'] ?? 0,
            'c4' => $_POST['c4'] ?? 0,
            'c5' => $_POST['c5'] ?? 0,
            'c6' => $_POST['c6'] ?? 0,
            'c7' => $_POST['c7'] ?? 0,
            'total' => $_POST['total'] ?? 0,
            'observacion' => $_POST['observacion'] ?? '',
            'responsable_area' => $_POST['responsable_area'] ?? '',
            'jefe_planta' => $_POST['jefe_planta'] ?? '',
            'jefe_produccion' => $_POST['jefe_produccion'] ?? '',
            'creado_en' => date('Y-m-d H:i:s')
        ];

        if ($this->model->guardarBPA2($data)) {
            echo json_encode(['success' => true, 'message' => 'Registro guardado correctamente.']);
        } else {
            echo json_encode(['success' => false, 'error' => 'Error al guardar el registro.']);
        }
        exit;

    } catch (Exception $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        exit;
    }
}

    public function bpa2() {
        include __DIR__ . '/../views/jefeplanta/modulos-jefeplanta/ovas/bpa2.php';
    }

    public function listarBPA2() {
        $fecha = isset($_GET['fecha']) ? $_GET['fecha'] : date('Y-m-d');
        $registros = $this->model->obtenerListadoBPA2PorFecha($fecha);
        $datos = $registros ? $registros->fetchAll(PDO::FETCH_ASSOC) : [];
        $fechaBusqueda = $fecha;
        include __DIR__ . '/../views/jefeplanta/modulos-jefeplanta/ovas/lista2.php';
    }

    public function obtenerListadoBPA2PorFecha($fecha) {
        $sql = "SELECT * FROM mortalidad_diaria_ovas WHERE DATE(fecha_registro) = ? ORDER BY fecha_registro DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$fecha]);
        return $stmt;
    }

    /* =========================================
       BPA 3 - MORTALIDAD DIARIA DE LARVAS
       ========================================= */

    public function bpa3() {
    include __DIR__ . '/../views/jefeplanta/modulos-jefeplanta/ovas/bpa3.php';
}

    // =========================================
// BPA3 - PROCESAR FORMULARIO (VARIAS FILAS)
// =========================================
public function procesarBPA3()
{
    try {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false, 'error' => 'Método no permitido']);
            return;
        }

        // 🔹 Log para depuración

        // Conexión PDO
        $pdo = new PDO("mysql:host=localhost;dbname=coraqua_produccion;charset=utf8", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->beginTransaction();

        // =============================
        // 1️⃣ DATOS GENERALES
        // =============================
        $encargado          = $_POST['encargado'] ?? null;
        $id_sede            = $_POST['id_sede'] ?? null;
        $id_especie         = $_POST['id_especie'] ?? null;
        $cantidad_siembra   = $_POST['cantidad_siembra'] ?? null;
        $responsable_area   = $_POST['responsable_area'] ?? null;
        $jefe_planta        = $_POST['jefe_planta'] ?? null;
        $jefe_produccion    = $_POST['jefe_produccion'] ?? null;
        $codigo_formato     = $_POST['codigo_formato'] ?? null;
        $version            = $_POST['version'] ?? null;
        $observacion_general= $_POST['observacion_general'] ?? null;

        // =============================
        // 2️⃣ VALIDAR RELACIONES (pasar NULL si no existen)
        // =============================

        // 🔹 Validar lote
        $idLote = !empty($_POST['id_lote']) ? $_POST['id_lote'] : null;
        if ($idLote !== null) {
            $stmtCheckLote = $pdo->prepare("SELECT COUNT(*) FROM lotes WHERE id_lote = ?");
            $stmtCheckLote->execute([$idLote]);
            if ($stmtCheckLote->fetchColumn() == 0) {
                error_log("⚠️ Lote no válido ($idLote), se pasará como NULL");
                $idLote = null;
            }
        }

        // 🔹 Validar sede
        if (!empty($id_sede)) {
            $stmtCheckSede = $pdo->prepare("SELECT COUNT(*) FROM sedes WHERE id_sede = ?");
            $stmtCheckSede->execute([$id_sede]);
            if ($stmtCheckSede->fetchColumn() == 0) {
                error_log("⚠️ Sede no válida ($id_sede), se pasará como NULL");
                $id_sede = null;
            }
        } else {
            $id_sede = null;
        }

        // 🔹 Validar especie
        if (!empty($id_especie)) {
            $stmtCheckEspecie = $pdo->prepare("SELECT COUNT(*) FROM especies WHERE id_especie = ?");
            $stmtCheckEspecie->execute([$id_especie]);
            if ($stmtCheckEspecie->fetchColumn() == 0) {
                error_log("⚠️ Especie no válida ($id_especie), se pasará como NULL");
                $id_especie = null;
            }
        } else {
            $id_especie = null;
        }

        // =============================
        // 3️⃣ ARRAYS DE REGISTROS
        // =============================
        $fecha_control = $_POST['fecha_control'] ?? [];
        $bateria       = $_POST['bateria'] ?? [];
        $batea         = $_POST['batea'] ?? [];
        $c1_lm         = $_POST['c1_lm'] ?? [];
        $c1_ld         = $_POST['c1_ld'] ?? [];
        $c2_lm         = $_POST['c2_lm'] ?? [];
        $c2_ld         = $_POST['c2_ld'] ?? [];
        $c3_lm         = $_POST['c3_lm'] ?? [];
        $c3_ld         = $_POST['c3_ld'] ?? [];
        $c4_lm         = $_POST['c4_lm'] ?? [];
        $c4_ld         = $_POST['c4_ld'] ?? [];
        $c5_lm         = $_POST['c5_lm'] ?? [];
        $c5_ld         = $_POST['c5_ld'] ?? [];
        $c6_lm         = $_POST['c6_lm'] ?? [];
        $c6_ld         = $_POST['c6_ld'] ?? [];
        $c7_lm         = $_POST['c7_lm'] ?? [];
        $c7_ld         = $_POST['c7_ld'] ?? [];
        $total         = $_POST['total'] ?? [];
        $observacion   = $_POST['observacion'] ?? [];

        // =============================
        // 4️⃣ PREPARAR INSERT
        // =============================
        $stmt = $pdo->prepare("
            INSERT INTO mortalidad_diaria_larvas (
                id_lote, id_sede, id_especie, fecha_control,
                bateria, batea, c1_lm, c1_ld, c2_lm, c2_ld,
                c3_lm, c3_ld, c4_lm, c4_ld, c5_lm, c5_ld,
                c6_lm, c6_ld, c7_lm, c7_ld, total, observacion
            ) VALUES (
                :id_lote, :id_sede, :id_especie, :fecha_control,
                :bateria, :batea, :c1_lm, :c1_ld, :c2_lm, :c2_ld,
                :c3_lm, :c3_ld, :c4_lm, :c4_ld, :c5_lm, :c5_ld,
                :c6_lm, :c6_ld, :c7_lm, :c7_ld, :total, :observacion
            )
        ");

        // =============================
        // 5️⃣ GUARDAR FILAS
        // =============================
        $totalInsertados = 0;

        for ($i = 0; $i < count($fecha_control); $i++) {
            $stmt->execute([
                ':id_lote' => $idLote,
                ':id_sede' => $id_sede,
                ':id_especie' => $id_especie,
                ':fecha_control' => $fecha_control[$i] ?? null,
                ':bateria' => $bateria[$i] ?? null,
                ':batea' => $batea[$i] ?? null,
                ':c1_lm' => $c1_lm[$i] ?? 0,
                ':c1_ld' => $c1_ld[$i] ?? 0,
                ':c2_lm' => $c2_lm[$i] ?? 0,
                ':c2_ld' => $c2_ld[$i] ?? 0,
                ':c3_lm' => $c3_lm[$i] ?? 0,
                ':c3_ld' => $c3_ld[$i] ?? 0,
                ':c4_lm' => $c4_lm[$i] ?? 0,
                ':c4_ld' => $c4_ld[$i] ?? 0,
                ':c5_lm' => $c5_lm[$i] ?? 0,
                ':c5_ld' => $c5_ld[$i] ?? 0,
                ':c6_lm' => $c6_lm[$i] ?? 0,
                ':c6_ld' => $c6_ld[$i] ?? 0,
                ':c7_lm' => $c7_lm[$i] ?? 0,
                ':c7_ld' => $c7_ld[$i] ?? 0,
                ':total' => $total[$i] ?? 0,
                ':observacion' => $observacion[$i] ?? null
            ]);
            $totalInsertados++;
        }

        $pdo->commit();

        echo json_encode([
            'success' => true,
            'message' => "Se guardaron $totalInsertados registros correctamente."
        ]);
    } catch (Exception $e) {
        if ($pdo->inTransaction()) $pdo->rollBack();
        error_log("Error al guardar BPA3: " . $e->getMessage());
        echo json_encode([
            'success' => false,
            'error' => 'Error al guardar los datos: ' . $e->getMessage()
        ]);
    }
}


public function listarBPA3() {
    $fecha = isset($_GET['fecha']) ? $_GET['fecha'] : date('Y-m-d');
    $registros = $this->model->obtenerListadoBPA3PorFecha($fecha);
    $datos = $registros ? $registros->fetchAll(PDO::FETCH_ASSOC) : [];
    $fechaBusqueda = $fecha;
    include __DIR__ . '/../views/jefeplanta/modulos-jefeplanta/ovas/lista3.php';
}



    public function obtenerListadoBPA3PorFecha($fecha) {
        $sql = "SELECT * FROM mortalidad_diaria_larvas WHERE DATE(fecha_registro) = ? ORDER BY fecha_registro DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$fecha]);
        return $stmt;
    }
    
    /* =====================
       Exportaciones Excel BPA 1..4
       ===================== */
    private function emitirExcelDesdeRegistros(array $registros, string $titulo, string $filename): void {
        header('Content-Type: application/vnd.ms-excel; charset=UTF-8');
        header('Content-Disposition: attachment; filename=' . $filename);
        header('Pragma: no-cache');
        header('Expires: 0');

        echo "\xEF\xBB\xBF"; // BOM UTF-8
        echo '<html><head><meta charset="UTF-8"><title>' . htmlspecialchars($titulo) . "</title></head><body>";
        echo '<h3 style="font-family:Segoe UI,Arial,sans-serif">' . htmlspecialchars($titulo) . '</h3>';
        echo '<table border="1" cellspacing="0" cellpadding="4">';

        // Encabezados dinámicos — tomar keys de la primera fila si existe
        echo '<thead style="background:#cfe2ff;font-weight:bold"><tr>';
        if (!empty($registros) && is_array($registros[0])) {
            foreach (array_keys($registros[0]) as $col) {
                echo '<th>' . htmlspecialchars($col) . '</th>';
            }
        } else {
            echo '<th>No hay datos</th>';
        }
        echo '</tr></thead><tbody>';

        if (!empty($registros)) {
            foreach ($registros as $r) {
                echo '<tr>';
                foreach ($r as $val) {
                    echo '<td>' . htmlspecialchars((string)$val) . '</td>';
                }
                echo '</tr>';
            }
        } else {
            echo '<tr><td>Sin registros en el periodo seleccionado</td></tr>';
        }

        echo '</tbody></table>';
        echo '</body></html>';
        exit;
    }

    // Helper para obtener registros entre fechas usando el modelo (asume métodos getXBetween añadidos o consulta directa)
    private function obtenerRegistrosBetween(string $table, string $inicio, string $fin) {
        // Intentaremos usar el modelo si tiene método get...Between, si no, hacemos consulta directa
        try {
            $method = 'get' . ucfirst($table) . 'Between';
            if (method_exists($this->model, $method)) {
                return $this->model->{$method}($inicio, $fin);
            }
        } catch (Exception $e) {
            // continuar a consulta directa
        }

        // Consulta directa genérica (no recomendable para producción pero útil aquí)
        $sql = sprintf("SELECT * FROM %s WHERE DATE(fecha_registro) BETWEEN ? AND ? ORDER BY fecha_registro DESC", $table);
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$inicio, $fin]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Exportadores para BPA1..BPA4 (semana/mes/año)
    public function exportBpa1ExcelSemana() {
        if (!isset($_GET['fecha_semana']) || empty($_GET['fecha_semana'])) {
            header("Location: index.php?controller=Ovas&action=listarBPA1"); exit;
        }
        $fecha = $_GET['fecha_semana'];
        try { $dt = new DateTimeImmutable($fecha); } catch (Exception $e) { header("Location: index.php?controller=Ovas&action=listarBPA1"); exit; }
        $inicio = $dt->modify('monday this week')->format('Y-m-d');
        $fin = $dt->modify('sunday this week')->format('Y-m-d');
        $registros = $this->obtenerRegistrosBetween('control_ovas', $inicio, $fin);
        $titulo = "Selección y Fertilización - Semana {$inicio} a {$fin}";
        $filename = "Seleccion_Fertilizacion_Semanal_{$inicio}_{$fin}.xls";
        $this->emitirExcelDesdeRegistros($registros, $titulo, $filename);
    }

    public function exportBpa1ExcelMes() {
        if (!isset($_GET['fecha_mes']) || empty($_GET['fecha_mes'])) { header("Location: index.php?controller=Ovas&action=listarBPA1"); exit; }
        $ym = preg_replace('/[^0-9\-]/', '', $_GET['fecha_mes']);
        $start = DateTimeImmutable::createFromFormat('Y-m-d', $ym . '-01');
        if (!$start) { header("Location: index.php?controller=Ovas&action=listarBPA1"); exit; }
        $inicio = $start->format('Y-m-d');
        $fin = $start->modify('last day of this month')->format('Y-m-d');
        $registros = $this->obtenerRegistrosBetween('control_ovas', $inicio, $fin);
        $titulo = "Selección y Fertilización - Mes {$start->format('Y-m')}";
        $filename = "Seleccion_Fertilizacion_Mensual_{$start->format('Y-m')}.xls";
        $this->emitirExcelDesdeRegistros($registros, $titulo, $filename);
    }

    public function exportBpa1ExcelAnio() {
        if (!isset($_GET['fecha_anio']) || empty($_GET['fecha_anio'])) { header("Location: index.php?controller=Ovas&action=listarBPA1"); exit; }
        $anio = (int)$_GET['fecha_anio']; if ($anio < 2000 || $anio > 2100) { header("Location: index.php?controller=Ovas&action=listarBPA1"); exit; }
        $inicio = sprintf('%04d-01-01', $anio); $fin = sprintf('%04d-12-31', $anio);
        $registros = $this->obtenerRegistrosBetween('control_ovas', $inicio, $fin);
        $titulo = "Selección y Fertilización - Año {$anio}";
        $filename = "Seleccion_Fertilizacion_Anual_{$anio}.xls";
        $this->emitirExcelDesdeRegistros($registros, $titulo, $filename);
    }

    // BPA2
    public function exportBpa2ExcelSemana() {
        if (!isset($_GET['fecha_semana']) || empty($_GET['fecha_semana'])) { header("Location: index.php?controller=Ovas&action=listarBPA2"); exit; }
        $fecha = $_GET['fecha_semana']; try { $dt = new DateTimeImmutable($fecha); } catch (Exception $e) { header("Location: index.php?controller=Ovas&action=listarBPA2"); exit; }
        $inicio = $dt->modify('monday this week')->format('Y-m-d'); $fin = $dt->modify('sunday this week')->format('Y-m-d');
        $registros = $this->obtenerRegistrosBetween('mortalidad_diaria_ovas', $inicio, $fin);
        $titulo = "Mortalidad OVAS - Semana {$inicio} a {$fin}"; $filename = "Mortalidad_OVAS_Semanal_{$inicio}_{$fin}.xls";
        $this->emitirExcelDesdeRegistros($registros, $titulo, $filename);
    }
    public function exportBpa2ExcelMes() {
        if (!isset($_GET['fecha_mes']) || empty($_GET['fecha_mes'])) { header("Location: index.php?controller=Ovas&action=listarBPA2"); exit; }
        $ym = preg_replace('/[^0-9\-]/', '', $_GET['fecha_mes']); $start = DateTimeImmutable::createFromFormat('Y-m-d', $ym . '-01'); if (!$start) { header("Location: index.php?controller=Ovas&action=listarBPA2"); exit; }
        $inicio = $start->format('Y-m-d'); $fin = $start->modify('last day of this month')->format('Y-m-d');
        $registros = $this->obtenerRegistrosBetween('mortalidad_diaria_ovas', $inicio, $fin);
        $titulo = "Mortalidad OVAS - Mes {$start->format('Y-m')}"; $filename = "Mortalidad_OVAS_Mensual_{$start->format('Y-m')}.xls";
        $this->emitirExcelDesdeRegistros($registros, $titulo, $filename);
    }
    public function exportBpa2ExcelAnio() {
        if (!isset($_GET['fecha_anio']) || empty($_GET['fecha_anio'])) { header("Location: index.php?controller=Ovas&action=listarBPA2"); exit; }
        $anio = (int)$_GET['fecha_anio']; if ($anio < 2000 || $anio > 2100) { header("Location: index.php?controller=Ovas&action=listarBPA2"); exit; }
        $inicio = sprintf('%04d-01-01', $anio); $fin = sprintf('%04d-12-31', $anio);
        $registros = $this->obtenerRegistrosBetween('mortalidad_diaria_ovas', $inicio, $fin);
        $titulo = "Mortalidad OVAS - Año {$anio}"; $filename = "Mortalidad_OVAS_Anual_{$anio}.xls";
        $this->emitirExcelDesdeRegistros($registros, $titulo, $filename);
    }

    // BPA3
    public function exportBpa3ExcelSemana() {
        if (!isset($_GET['fecha_semana']) || empty($_GET['fecha_semana'])) { header("Location: index.php?controller=Ovas&action=listarBPA3"); exit; }
        $fecha = $_GET['fecha_semana']; try { $dt = new DateTimeImmutable($fecha); } catch (Exception $e) { header("Location: index.php?controller=Ovas&action=listarBPA3"); exit; }
        $inicio = $dt->modify('monday this week')->format('Y-m-d'); $fin = $dt->modify('sunday this week')->format('Y-m-d');
        $registros = $this->obtenerRegistrosBetween('mortalidad_diaria_larvas', $inicio, $fin);
        $titulo = "Mortalidad Larvas - Semana {$inicio} a {$fin}"; $filename = "Mortalidad_Larvas_Semanal_{$inicio}_{$fin}.xls";
        $this->emitirExcelDesdeRegistros($registros, $titulo, $filename);
    }
    public function exportBpa3ExcelMes() {
        if (!isset($_GET['fecha_mes']) || empty($_GET['fecha_mes'])) { header("Location: index.php?controller=Ovas&action=listarBPA3"); exit; }
        $ym = preg_replace('/[^0-9\-]/', '', $_GET['fecha_mes']); $start = DateTimeImmutable::createFromFormat('Y-m-d', $ym . '-01'); if (!$start) { header("Location: index.php?controller=Ovas&action=listarBPA3"); exit; }
        $inicio = $start->format('Y-m-d'); $fin = $start->modify('last day of this month')->format('Y-m-d');
        $registros = $this->obtenerRegistrosBetween('mortalidad_diaria_larvas', $inicio, $fin);
        $titulo = "Mortalidad Larvas - Mes {$start->format('Y-m')}"; $filename = "Mortalidad_Larvas_Mensual_{$start->format('Y-m')}.xls";
        $this->emitirExcelDesdeRegistros($registros, $titulo, $filename);
    }
    public function exportBpa3ExcelAnio() {
        if (!isset($_GET['fecha_anio']) || empty($_GET['fecha_anio'])) { header("Location: index.php?controller=Ovas&action=listarBPA3"); exit; }
        $anio = (int)$_GET['fecha_anio']; if ($anio < 2000 || $anio > 2100) { header("Location: index.php?controller=Ovas&action=listarBPA3"); exit; }
        $inicio = sprintf('%04d-01-01', $anio); $fin = sprintf('%04d-12-31', $anio);
        $registros = $this->obtenerRegistrosBetween('mortalidad_diaria_larvas', $inicio, $fin);
        $titulo = "Mortalidad Larvas - Año {$anio}"; $filename = "Mortalidad_Larvas_Anual_{$anio}.xls";
        $this->emitirExcelDesdeRegistros($registros, $titulo, $filename);
    }

    // BPA4
    public function exportBpa4ExcelSemana() {
        if (!isset($_GET['fecha_semana']) || empty($_GET['fecha_semana'])) { header("Location: index.php?controller=Ovas&action=listarBPA4"); exit; }
        $fecha = $_GET['fecha_semana']; try { $dt = new DateTimeImmutable($fecha); } catch (Exception $e) { header("Location: index.php?controller=Ovas&action=listarBPA4"); exit; }
        $inicio = $dt->modify('monday this week')->format('Y-m-d'); $fin = $dt->modify('sunday this week')->format('Y-m-d');
        $registros = $this->obtenerRegistrosBetween('control_diario_parametros_ovas', $inicio, $fin);
        $titulo = "Control Parámetros OVAS - Semana {$inicio} a {$fin}"; $filename = "Control_Parametros_OVAS_Semanal_{$inicio}_{$fin}.xls";
        $this->emitirExcelDesdeRegistros($registros, $titulo, $filename);
    }
    public function exportBpa4ExcelMes() {
        if (!isset($_GET['fecha_mes']) || empty($_GET['fecha_mes'])) { header("Location: index.php?controller=Ovas&action=listarBPA4"); exit; }
        $ym = preg_replace('/[^0-9\-]/', '', $_GET['fecha_mes']); $start = DateTimeImmutable::createFromFormat('Y-m-d', $ym . '-01'); if (!$start) { header("Location: index.php?controller=Ovas&action=listarBPA4"); exit; }
        $inicio = $start->format('Y-m-d'); $fin = $start->modify('last day of this month')->format('Y-m-d');
        $registros = $this->obtenerRegistrosBetween('control_diario_parametros_ovas', $inicio, $fin);
        $titulo = "Control Parámetros OVAS - Mes {$start->format('Y-m')}"; $filename = "Control_Parametros_OVAS_Mensual_{$start->format('Y-m')}.xls";
        $this->emitirExcelDesdeRegistros($registros, $titulo, $filename);
    }
    public function exportBpa4ExcelAnio() {
        if (!isset($_GET['fecha_anio']) || empty($_GET['fecha_anio'])) { header("Location: index.php?controller=Ovas&action=listarBPA4"); exit; }
        $anio = (int)$_GET['fecha_anio']; if ($anio < 2000 || $anio > 2100) { header("Location: index.php?controller=Ovas&action=listarBPA4"); exit; }
        $inicio = sprintf('%04d-01-01', $anio); $fin = sprintf('%04d-12-31', $anio);
        $registros = $this->obtenerRegistrosBetween('control_diario_parametros_ovas', $inicio, $fin);
        $titulo = "Control Parámetros OVAS - Año {$anio}"; $filename = "Control_Parametros_OVAS_Anual_{$anio}.xls";
        $this->emitirExcelDesdeRegistros($registros, $titulo, $filename);
    }

    /* =========================================
       BPA 4 - CONTROL DE PARÁMETROS
       ========================================= */
       // Agregar en OvasController.php dentro de la clase OvasController
public function guardarBPA4() {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        echo json_encode(['success' => false, 'error' => 'Método no permitido']);
        exit;
    }

    try {
        // Datos generales
        $mes = $_POST['mes'] ?? null;
        $sede = $_POST['sede'] ?? null;
        $responsable = $_POST['responsable'] ?? null;
        $codigo_formato = $_POST['codigo_formato'] ?? 'CORAQUA-BPA-12';
        $version = $_POST['version'] ?? '2.0';
        $id_sede = isset($_POST['id_sede']) && is_numeric($_POST['id_sede']) ? (int)$_POST['id_sede'] : null;

        // Arrays (esperamos nombres con [])
        $dias = $_POST['dia'] ?? [];
        $t_0630 = $_POST['t_0630'] ?? [];
        $o2_0630 = $_POST['o2_0630'] ?? [];
        $sat_0630 = $_POST['sat_0630'] ?? [];
        $ph_0630 = $_POST['ph_0630'] ?? [];

        $t_1200 = $_POST['t_1200'] ?? [];
        $o2_1200 = $_POST['o2_1200'] ?? [];
        $sat_1200 = $_POST['sat_1200'] ?? [];
        $ph_1200 = $_POST['ph_1200'] ?? [];

        $t_1530 = $_POST['t_1530'] ?? [];
        $o2_1530 = $_POST['o2_1530'] ?? [];
        $sat_1530 = $_POST['sat_1530'] ?? [];
        $ph_1530 = $_POST['ph_1530'] ?? [];

        $t_acumulada = $_POST['t_acumulada'] ?? [];
        $observacion = $_POST['observacion'] ?? [];

        $filas = max(
            count($dias),
            count($t_0630),
            count($t_1200),
            count($t_1530),
            count($t_acumulada)
        );

        if ($filas === 0) {
            echo json_encode(['success' => false, 'error' => 'No se recibieron filas para guardar.']);
            exit;
        }

        $guardados = 0;

        // Si el modelo tiene método guardarBPA4 que inserta una fila en control_diario_parametros_ovas
        for ($i = 0; $i < $filas; $i++) {
            // construir fecha_registro: usar fecha actual para el registro (puedes ajustar si quieres otra lógica)
            $fecha_registro = date('Y-m-d');

            // Si el campo 'dia' viene como número, lo pasamos tal cual.
            $dia = isset($dias[$i]) && $dias[$i] !== '' ? (int)$dias[$i] : null;

            $data = [
                'codigo_formato' => $codigo_formato,
                'version' => $version,
                'fecha_registro' => $fecha_registro,
                'mes' => $mes,
                'sede' => $sede,
                'responsable' => $responsable,
                'dia' => $dia,
                't_0630' => $t_0630[$i] !== '' ? $t_0630[$i] : null,
                'o2_0630' => $o2_0630[$i] !== '' ? $o2_0630[$i] : null,
                'sat_0630' => $sat_0630[$i] !== '' ? $sat_0630[$i] : null,
                'ph_0630' => $ph_0630[$i] !== '' ? $ph_0630[$i] : null,
                't_1200' => $t_1200[$i] !== '' ? $t_1200[$i] : null,
                'o2_1200' => $o2_1200[$i] !== '' ? $o2_1200[$i] : null,
                'sat_1200' => $sat_1200[$i] !== '' ? $sat_1200[$i] : null,
                'ph_1200' => $ph_1200[$i] !== '' ? $ph_1200[$i] : null,
                't_1530' => $t_1530[$i] !== '' ? $t_1530[$i] : null,
                'o2_1530' => $o2_1530[$i] !== '' ? $o2_1530[$i] : null,
                'sat_1530' => $sat_1530[$i] !== '' ? $sat_1530[$i] : null,
                'ph_1530' => $ph_1530[$i] !== '' ? $ph_1530[$i] : null,
                't_acumulada' => $t_acumulada[$i] !== '' ? $t_acumulada[$i] : null,
                'observacion' => $observacion[$i] ?? null,
                'id_sede' => $id_sede
            ];

            // Llamada al modelo — debe existir guardarBPA4 en OvasModel para insertar una fila
            if ($this->model->guardarBPA4($data)) {
                $guardados++;
            }
        }

        echo json_encode([
            'success' => true,
            'message' => "Se guardaron {$guardados} registros correctamente.",
            'inserted' => $guardados
        ]);
        exit;

    } catch (Exception $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        exit;
    }
}


    public function obtenerListadoBPA4PorFecha($fecha) {
        $sql = "SELECT * FROM control_parametros WHERE DATE(fecha_registro) = ? ORDER BY fecha_registro DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$fecha]);
        return $stmt;
    }
}

?>
