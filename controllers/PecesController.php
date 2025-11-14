<?php
require_once "../config/database.php";
require_once "../models/PecesModel.php";

class PecesController {

    public function bpa6() {
        // Carga de formulario BPA6
        require_once __DIR__ . '/../views/jefeplanta/modulos-jefeplanta/peces/bpa6.php';
    }

    public function guardarBpa6() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new PecesModel();

            // Si el usuario creó una nueva especie
            $id_especie = $_POST['id_especie'] ?? null;

            if (empty($id_especie) && !empty($_POST['nombre'])) {
                $dataEspecie = [
                    'nombre' => $_POST['nombre'],
                    'nombre_comun' => $_POST['nombre_comun'],
                    'descripcion' => $_POST['descripcion'],
                    'fecha_creacion' => date('Y-m-d')
                ];
                $id_especie = $model->agregarEspecieYObtenerID($dataEspecie);
            }

            // Soporte multi-fila desde el formulario (arrays)
            $ups = $_POST['up'] ?? [];
            $lotes = $_POST['lote'] ?? [];
            $morts = $_POST['mortalidad'] ?? [];
            $morbs = $_POST['morbilidad'] ?? [];
            $totals = $_POST['total'] ?? [];
            $obs = $_POST['observaciones'] ?? [];

            // Si no vienen como arrays, normalizamos a un solo elemento
            if (!is_array($ups)) { $ups = [$ups]; }
            if (!is_array($lotes)) { $lotes = [$lotes]; }
            if (!is_array($morts)) { $morts = [$morts]; }
            if (!is_array($morbs)) { $morbs = [$morbs]; }
            if (!is_array($totals)) { $totals = [$totals]; }
            if (!is_array($obs)) { $obs = [$obs]; }

            $base = [
                'codigo_formato' => $_POST['codigo_formato'] ?? 'CORAQUA BPA-6',
                'version' => $_POST['version'] ?? '2.0',
                'fecha_registro' => $_POST['fecha_registro'] ?? date('Y-m-d'),
                'responsable' => $_POST['responsable'] ?? '',
                'sede' => $_POST['sede'] ?? '',
                'id_especie' => $id_especie,
                'id_lote' => $_POST['id_lote'] ?? null,
                'id_sede' => $_POST['id_sede'] ?? null,
                'creado_en' => date('Y-m-d H:i:s'),
                'actualizado_en' => date('Y-m-d H:i:s')
            ];

            $n = max(count($ups), count($lotes));
            for ($i = 0; $i < $n; $i++) {
                if (empty($lotes[$i]) && empty($ups[$i])) continue;
                $data = $base;
                $data['up'] = $ups[$i] ?? '';
                $data['lote'] = $lotes[$i] ?? '';
                $data['mortalidad'] = (int)($morts[$i] ?? 0);
                $data['morbilidad'] = (int)($morbs[$i] ?? 0);
                $data['observaciones'] = is_array($obs) ? ($obs[$i] ?? '') : ($obs ?? '');
                $model->guardarBpa6($data);
            }

            // Volver al formulario con mensaje de éxito; el listado se ve desde el botón en la vista
            header("Location: index.php?controller=Peces&action=bpa6&status=ok");
            exit;
        }
    }

    public function bpa6Listado() {
        $model = new PecesModel();
        $fechaBusqueda = isset($_GET['fechaBusqueda']) ? $_GET['fechaBusqueda'] : null;
        $registros = $model->getBpa6List($fechaBusqueda);
        require_once __DIR__ . '/../views/jefeplanta/modulos-jefeplanta/peces/bpa6-listado.php';
    }

    public function eliminarBpa6() {
        if (isset($_GET['id'])) {
            $model = new PecesModel();
            $model->eliminarBpa6($_GET['id']);
        }
        header("Location: index.php?controller=Peces&action=bpa6Listado");
        exit;
    }

    /* ======================
       BPA 7 - ALIMENTACIÓN DIARIA
       ====================== */
    public function bpa7() {
        require_once __DIR__ . '/../views/jefeplanta/modulos-jefeplanta/peces/bpa7.php';
    }

    /* ======================
       Exportaciones Excel BPA 6
       ====================== */
    public function exportBpa6ExcelSemana() {
        if (!isset($_GET['fecha_semana']) || empty($_GET['fecha_semana'])) {
            header("Location: index.php?controller=Peces&action=bpa6Listado");
            exit;
        }
        $fecha = $_GET['fecha_semana'];
        try {
            $dt = new DateTimeImmutable($fecha);
        } catch (Exception $e) {
            header("Location: index.php?controller=Peces&action=bpa6Listado");
            exit;
        }
        $inicio = $dt->modify('monday this week')->format('Y-m-d');
        $fin    = $dt->modify('sunday this week')->format('Y-m-d');

        $model = new PecesModel();
        $registros = $model->getBpa6Between($inicio, $fin);
        $titulo = "Mortalidad Alevinos - Semana del $inicio al $fin";
        $filename = "Mortalidad_Alevinos_Semanal_{$inicio}_{$fin}.xls";
        $this->emitirExcelBpa6($registros, $titulo, $filename);
    }

    public function exportBpa6ExcelMes() {
        if (!isset($_GET['fecha_mes']) || empty($_GET['fecha_mes'])) {
            header("Location: index.php?controller=Peces&action=bpa6Listado");
            exit;
        }
        // fecha_mes formato YYYY-MM
        $ym = preg_replace('/[^0-9\-]/', '', $_GET['fecha_mes']);
        $start = DateTimeImmutable::createFromFormat('Y-m-d', $ym . '-01');
        if (!$start) {
            header("Location: index.php?controller=Peces&action=bpa6Listado");
            exit;
        }
        $inicio = $start->format('Y-m-d');
        $fin = $start->modify('last day of this month')->format('Y-m-d');

        $model = new PecesModel();
        $registros = $model->getBpa6Between($inicio, $fin);
        $titulo = "Mortalidad Alevinos - Mes {$start->format('Y-m')}";
        $filename = "Mortalidad_Alevinos_Mensual_{$start->format('Y-m')}.xls";
        $this->emitirExcelBpa6($registros, $titulo, $filename);
    }

    public function exportBpa6ExcelAnio() {
        if (!isset($_GET['fecha_anio']) || empty($_GET['fecha_anio'])) {
            header("Location: index.php?controller=Peces&action=bpa6Listado");
            exit;
        }
        $anio = (int)$_GET['fecha_anio'];
        if ($anio < 2000 || $anio > 2100) {
            header("Location: index.php?controller=Peces&action=bpa6Listado");
            exit;
        }
        $inicio = sprintf('%04d-01-01', $anio);
        $fin    = sprintf('%04d-12-31', $anio);

        $model = new PecesModel();
        $registros = $model->getBpa6Between($inicio, $fin);
        $titulo = "Mortalidad Alevinos - Año {$anio}";
        $filename = "Mortalidad_Alevinos_Anual_{$anio}.xls";
        $this->emitirExcelBpa6($registros, $titulo, $filename);
    }

    private function emitirExcelBpa6(array $registros, string $titulo, string $filename): void {
        header('Content-Type: application/vnd.ms-excel; charset=UTF-8');
        header('Content-Disposition: attachment; filename=' . $filename);
        header('Pragma: no-cache');
        header('Expires: 0');

        echo "\xEF\xBB\xBF"; // BOM UTF-8 para Excel
        echo '<html><head><meta charset="UTF-8"><title>' . htmlspecialchars($titulo) . "</title></head><body>";
        echo '<h3 style="font-family:Segoe UI,Arial,sans-serif">' . htmlspecialchars($titulo) . '</h3>';
        echo '<table border="1" cellspacing="0" cellpadding="4">';
        echo '<thead style="background:#cfe2ff;font-weight:bold">';
        echo '<tr>';
        $cols = ['ID','Código Formato','Versión','Fecha Registro','Responsable','Sede','UP','Lote','Mortalidad','Morbilidad','Total','Observaciones'];
        foreach ($cols as $c) echo '<th>' . htmlspecialchars($c) . '</th>';
        echo '</tr></thead><tbody>';
        if (!empty($registros)) {
            foreach ($registros as $r) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars((string)$r['id']) . '</td>';
                echo '<td>' . htmlspecialchars((string)$r['codigo_formato']) . '</td>';
                echo '<td>' . htmlspecialchars((string)$r['version']) . '</td>';
                echo '<td>' . htmlspecialchars((string)$r['fecha_registro']) . '</td>';
                echo '<td>' . htmlspecialchars((string)$r['responsable']) . '</td>';
                echo '<td>' . htmlspecialchars((string)$r['sede']) . '</td>';
                echo '<td>' . htmlspecialchars((string)$r['up']) . '</td>';
                echo '<td>' . htmlspecialchars((string)$r['lote']) . '</td>';
                echo '<td>' . htmlspecialchars((string)$r['mortalidad']) . '</td>';
                echo '<td>' . htmlspecialchars((string)$r['morbilidad']) . '</td>';
                echo '<td>' . htmlspecialchars((string)($r['total'] ?? '')) . '</td>';
                echo '<td>' . htmlspecialchars((string)($r['observaciones'] ?? '')) . '</td>';
                echo '</tr>';
            }
        } else {
            echo '<tr><td colspan="12">Sin registros en el periodo seleccionado</td></tr>';
        }
        echo '</tbody></table>';
        echo '</body></html>';
        exit;
    }

    // Alias por compatibilidad: algunos enlaces usan 'bpa06' o 'bpa06Listado'
    public function bpa06() {
        return $this->bpa6();
    }

    public function guardarBpa7() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new PecesModel();

            // Arrays de filas
            $ups = $_POST['up'] ?? [];
            $lotes = $_POST['lote'] ?? [];
            $biomasas = $_POST['biomasa'] ?? [];
            $tasas = $_POST['tasa_alimentacion'] ?? [];
            $alim = $_POST['alimento_suministrado'] ?? [];
            $calibres = $_POST['calibre'] ?? [];
            $obs = $_POST['observaciones'] ?? [];

            if (!is_array($ups)) { $ups = [$ups]; }
            if (!is_array($lotes)) { $lotes = [$lotes]; }
            if (!is_array($biomasas)) { $biomasas = [$biomasas]; }
            if (!is_array($tasas)) { $tasas = [$tasas]; }
            if (!is_array($alim)) { $alim = [$alim]; }
            if (!is_array($calibres)) { $calibres = [$calibres]; }
            if (!is_array($obs)) { $obs = [$obs]; }

            $base = [
                'codigo_formato' => $_POST['codigo_formato'] ?? 'CORAQUA BPA-7',
                'version' => $_POST['version'] ?? '2.0',
                'fecha_registro' => $_POST['fecha_registro'] ?? date('Y-m-d'),
                'responsable' => $_POST['responsable'] ?? '',
                'sede' => $_POST['sede'] ?? '',
                'id_lote' => $_POST['id_lote'] ?? null,
                'id_especie' => $_POST['id_especie'] ?? null,
                'id_sede' => $_POST['id_sede'] ?? null,
                'creado_en' => date('Y-m-d H:i:s'),
                'actualizado_en' => date('Y-m-d H:i:s')
            ];

            $n = max(count($ups), count($lotes));
            for ($i = 0; $i < $n; $i++) {
                if (empty($lotes[$i]) && empty($ups[$i])) continue;
                $data = $base;
                $data['up'] = $ups[$i] ?? '';
                $data['lote'] = $lotes[$i] ?? '';
                $data['biomasa'] = (float)($biomasas[$i] ?? 0);
                $data['tasa_alimentacion'] = (float)($tasas[$i] ?? 0);
                $data['alimento_suministrado'] = (float)($alim[$i] ?? 0);
                $data['calibre'] = $calibres[$i] ?? '';
                $data['observaciones'] = is_array($obs) ? ($obs[$i] ?? '') : ($obs ?? '');
                $model->guardarBpa7($data);
            }

            // Permanecer en el formulario mostrando mensaje de éxito
            header("Location: index.php?controller=Peces&action=bpa7&status=ok");
            exit;
        }
    }

    public function bpa7Listado() {
        $model = new PecesModel();
        $fechaBusqueda = isset($_GET['fechaBusqueda']) ? $_GET['fechaBusqueda'] : null;
        $registros = $model->getBpa7List($fechaBusqueda);
        require_once __DIR__ . '/../views/jefeplanta/modulos-jefeplanta/peces/bpa7-listado.php';
    }

    public function eliminarBpa7() {
        if (isset($_GET['id'])) {
            $model = new PecesModel();
            $model->eliminarBpa7($_GET['id']);
        }
        header("Location: index.php?controller=Peces&action=bpa7Listado");
        exit;
    }

    /* ======================
       Exportaciones Excel BPA 7
       ====================== */
    public function exportBpa7ExcelSemana() {
        if (!isset($_GET['fecha_semana']) || empty($_GET['fecha_semana'])) {
            header("Location: index.php?controller=Peces&action=bpa7Listado");
            exit;
        }
        $fecha = $_GET['fecha_semana'];
        try {
            $dt = new DateTimeImmutable($fecha);
        } catch (Exception $e) {
            header("Location: index.php?controller=Peces&action=bpa7Listado");
            exit;
        }
        $inicio = $dt->modify('monday this week')->format('Y-m-d');
        $fin    = $dt->modify('sunday this week')->format('Y-m-d');

        $model = new PecesModel();
        $registros = $model->getBpa7Between($inicio, $fin);
        $titulo = "Alimentación Diaria - Semana del $inicio al $fin";
        $filename = "Alimentacion_Diaria_Semanal_{$inicio}_{$fin}.xls";
        $this->emitirExcelBpa7($registros, $titulo, $filename);
    }

    public function exportBpa7ExcelMes() {
        if (!isset($_GET['fecha_mes']) || empty($_GET['fecha_mes'])) {
            header("Location: index.php?controller=Peces&action=bpa7Listado");
            exit;
        }
        $ym = preg_replace('/[^0-9\-]/', '', $_GET['fecha_mes']);
        $start = DateTimeImmutable::createFromFormat('Y-m-d', $ym . '-01');
        if (!$start) {
            header("Location: index.php?controller=Peces&action=bpa7Listado");
            exit;
        }
        $inicio = $start->format('Y-m-d');
        $fin = $start->modify('last day of this month')->format('Y-m-d');

        $model = new PecesModel();
        $registros = $model->getBpa7Between($inicio, $fin);
        $titulo = "Alimentación Diaria - Mes {$start->format('Y-m')}";
        $filename = "Alimentacion_Diaria_Mensual_{$start->format('Y-m')}.xls";
        $this->emitirExcelBpa7($registros, $titulo, $filename);
    }

    public function exportBpa7ExcelAnio() {
        if (!isset($_GET['fecha_anio']) || empty($_GET['fecha_anio'])) {
            header("Location: index.php?controller=Peces&action=bpa7Listado");
            exit;
        }
        $anio = (int)$_GET['fecha_anio'];
        if ($anio < 2000 || $anio > 2100) {
            header("Location: index.php?controller=Peces&action=bpa7Listado");
            exit;
        }
        $inicio = sprintf('%04d-01-01', $anio);
        $fin    = sprintf('%04d-12-31', $anio);

        $model = new PecesModel();
        $registros = $model->getBpa7Between($inicio, $fin);
        $titulo = "Alimentación Diaria - Año {$anio}";
        $filename = "Alimentacion_Diaria_Anual_{$anio}.xls";
        $this->emitirExcelBpa7($registros, $titulo, $filename);
    }

    private function emitirExcelBpa7(array $registros, string $titulo, string $filename): void {
        header('Content-Type: application/vnd.ms-excel; charset=UTF-8');
        header('Content-Disposition: attachment; filename=' . $filename);
        header('Pragma: no-cache');
        header('Expires: 0');

        echo "\xEF\xBB\xBF"; // BOM UTF-8 para Excel
        echo '<html><head><meta charset="UTF-8"><title>' . htmlspecialchars($titulo) . "</title></head><body>";
        echo '<h3 style="font-family:Segoe UI,Arial,sans-serif">' . htmlspecialchars($titulo) . '</h3>';
        echo '<table border="1" cellspacing="0" cellpadding="4">';
        echo '<thead style="background:#cfe2ff;font-weight:bold">';
        echo '<tr>';
        $cols = ['ID','Fecha','Responsable','Sede','UP','Lote','Biomasa','Tasa Alimentación','Alimento Suministrado','Calibre','Observaciones'];
        foreach ($cols as $c) echo '<th>' . htmlspecialchars($c) . '</th>';
        echo '</tr></thead><tbody>';
        if (!empty($registros)) {
            foreach ($registros as $r) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars((string)$r['id']) . '</td>';
                echo '<td>' . htmlspecialchars((string)$r['fecha_registro']) . '</td>';
                echo '<td>' . htmlspecialchars((string)$r['responsable']) . '</td>';
                echo '<td>' . htmlspecialchars((string)$r['sede']) . '</td>';
                echo '<td>' . htmlspecialchars((string)$r['up']) . '</td>';
                echo '<td>' . htmlspecialchars((string)$r['lote']) . '</td>';
                echo '<td>' . htmlspecialchars((string)$r['biomasa']) . '</td>';
                echo '<td>' . htmlspecialchars((string)$r['tasa_alimentacion']) . '</td>';
                echo '<td>' . htmlspecialchars((string)$r['alimento_suministrado']) . '</td>';
                echo '<td>' . htmlspecialchars((string)$r['calibre']) . '</td>';
                echo '<td>' . htmlspecialchars((string)($r['observaciones'] ?? '')) . '</td>';
                echo '</tr>';
            }
        } else {
            echo '<tr><td colspan="11">Sin registros en el periodo seleccionado</td></tr>';
        }
        echo '</tbody></table>';
        echo '</body></html>';
        exit;
    }

    /* ======================
       BPA 10 - MUESTREO
       ====================== */
    public function bpa10() {
        require_once __DIR__ . '/../views/jefeplanta/modulos-jefeplanta/peces/bpa10.php';
    }

    public function guardarBpa10() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new PecesModel();

            // Procesar múltiples filas
            $lotes = $_POST['lote'] ?? [];
            $pesos = $_POST['peso_promedio'] ?? [];
            $coeficientes = $_POST['coeficiente_variacion'] ?? [];
            $factores = $_POST['factor_k'] ?? [];
            $ups = $_POST['up'] ?? [];

            // Si no mandan ups, generarlos
            if (empty($ups)) {
                $ups = [];
                for ($i = 0; $i < count($lotes); $i++) {
                    $ups[] = 'UP-' . str_pad($i + 1, 2, '0', STR_PAD_LEFT);
                }
            }

            // Validar campos requeridos del formulario
            $campos_requeridos = [
                'codigo_formato', 'version', 'fecha_registro', 'encargado',
                'fecha_muestreo', 'hora_muestreo'
            ];

            foreach ($campos_requeridos as $campo) {
                if (!isset($_POST[$campo]) || empty($_POST[$campo])) {
                    // Puedes manejar el error como prefieras, por ejemplo redirigiendo con un mensaje
                    header("Location: index.php?controller=Peces&action=bpa10&error=falta_campo_" . $campo);
                    exit;
                }
            }

            // Preparar datos base
            $baseData = [
                'codigo_formato' => $_POST['codigo_formato'],
                'version' => $_POST['version'],
                'fecha_registro' => $_POST['fecha_registro'],
                'encargado' => $_POST['encargado'],
                'sede' => $_POST['sede'] ?? '',
                'fecha_muestreo' => $_POST['fecha_muestreo'],
                'hora_muestreo' => $_POST['hora_muestreo'],
                'id_especie' => $_POST['id_especie'] ?? null,
                'id_sede' => $_POST['id_sede'] ?? null,
                'creado_en' => date('Y-m-d H:i:s'),
                'actualizado_en' => date('Y-m-d H:i:s')
            ];

            // Guardar cada fila como un registro separado
            for ($i = 0; $i < count($lotes); $i++) {
                if (!empty($lotes[$i])) { // Solo guardar si hay un lote especificado
                    $data = array_merge($baseData, [
                        'up' => $ups[$i],
                        'lote' => $lotes[$i],
                        'peso_promedio' => $pesos[$i] ?? 0,
                        'coeficiente_variacion' => $coeficientes[$i] ?? 0,
                        'factor_k' => $factores[$i] ?? 0,
                        'observaciones' => $_POST['observaciones'][$i] ?? '',
                        'id_lote' => $_POST['id_lote'] ?? null
                    ]);
                    
                    $model->guardarBpa10($data);
                }
            }
            
            // Permanecer en el formulario mostrando mensaje de éxito
            header("Location: index.php?controller=Peces&action=bpa10&status=ok");
            exit;
        }
    }

    public function bpa10Listado() {
        $model = new PecesModel();
        $registros = $model->getBpa10List();
        require_once __DIR__ . '/../views/jefeplanta/modulos-jefeplanta/peces/bpa10-listado.php';
    }


    // Alias para rutas que usan 'bpa06Listado'
    public function bpa06Listado() {
        return $this->bpa6Listado();
    }
    public function eliminarBpa10() {
        if (isset($_GET['id'])) {
            $model = new PecesModel();
            $model->eliminarBpa10($_GET['id']);
        }
        header("Location: index.php?controller=Peces&action=bpa10Listado");
        exit;
    }

    /* ======================
       BPA 12 - CONTROL DE PARÁMETROS
       ====================== */
    public function bpa12() {
        require_once __DIR__ . '/../views/jefeplanta/modulos-jefeplanta/peces/bpa12.php';
    }

    public function guardarBpa12() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new PecesModel();

            // Datos del registro principal (vienen desde la vista)
            // Nota: la vista envía responsables por fila (responsable[]). Para el registro principal
            // tomamos el primer responsable no vacío si existe, para evitar pasar un array al modelo.
            $firstResponsable = '';
            if (isset($_POST['responsable'])) {
                if (is_array($_POST['responsable'])) {
                    foreach ($_POST['responsable'] as $r) { if (trim($r) !== '') { $firstResponsable = $r; break; } }
                } else {
                    $firstResponsable = $_POST['responsable'];
                }
            }

            $data = [
                'codigo_formato' => $_POST['codigo_formato'] ?? 'CORAQUA BPA-12',
                'version' => $_POST['version'] ?? '2.0',
                'fecha_registro' => $_POST['fecha_registro'] ?? date('Y-m-d'),
                'mes' => $_POST['mes'] ?? '',
                'sede' => $_POST['sede'] ?? '',
                // responsable/observaciones generales: usar primer responsable de las filas si existe
                'responsable' => $firstResponsable,
                'observaciones' => ''
            ];

            // La vista actual usa tres tablas separadas y no envía `dia[]` como inputs.
            // Tomamos la longitud máxima entre los arrays de cada horario y usamos el índice+1 como día.
            $dias = [];

            $t0630 = $_POST['t_0630'] ?? [];
            $o20630 = $_POST['o2_0630'] ?? [];
            $sat0630 = $_POST['sat_0630'] ?? [];
            $ph0630 = $_POST['ph_0630'] ?? [];
            $obs0630 = $_POST['obs_0630'] ?? [];

            $t1200 = $_POST['t_1200'] ?? [];
            $o21200 = $_POST['o2_1200'] ?? [];
            $sat1200 = $_POST['sat_1200'] ?? [];
            $ph1200 = $_POST['ph_1200'] ?? [];
            $obs1200 = $_POST['obs_1200'] ?? [];

            $t1530 = $_POST['t_1530'] ?? [];
            $o21530 = $_POST['o2_1530'] ?? [];
            $sat1530 = $_POST['sat_1530'] ?? [];
            $ph1530 = $_POST['ph_1530'] ?? [];
            $obs1530 = $_POST['obs_1530'] ?? [];

            // Responsable global en la vista se llama responsable_global
            $responsable_global = $_POST['responsable_global'] ?? ($firstResponsable ?? '');

            $n = max(count($t0630), count($t1200), count($t1530));
            for ($i = 0; $i < $n; $i++) {
                $diaIndex = $i + 1;

                $p = [
                    'temp_6_30' => isset($t0630[$i]) && $t0630[$i] !== '' ? (float)$t0630[$i] : null,
                    'o2_6_30' => isset($o20630[$i]) && $o20630[$i] !== '' ? (float)$o20630[$i] : null,
                    'sat_6_30' => isset($sat0630[$i]) && $sat0630[$i] !== '' ? (float)$sat0630[$i] : null,
                    'ph_6_30' => isset($ph0630[$i]) && $ph0630[$i] !== '' ? (float)$ph0630[$i] : null,

                    'temp_12_00' => isset($t1200[$i]) && $t1200[$i] !== '' ? (float)$t1200[$i] : null,
                    'o2_12_00' => isset($o21200[$i]) && $o21200[$i] !== '' ? (float)$o21200[$i] : null,
                    'sat_12_00' => isset($sat1200[$i]) && $sat1200[$i] !== '' ? (float)$sat1200[$i] : null,
                    'ph_12_00' => isset($ph1200[$i]) && $ph1200[$i] !== '' ? (float)$ph1200[$i] : null,

                    'temp_3_30' => isset($t1530[$i]) && $t1530[$i] !== '' ? (float)$t1530[$i] : null,
                    'o2_3_30' => isset($o21530[$i]) && $o21530[$i] !== '' ? (float)$o21530[$i] : null,
                    'sat_3_30' => isset($sat1530[$i]) && $sat1530[$i] !== '' ? (float)$sat1530[$i] : null,
                    'ph_3_30' => isset($ph1530[$i]) && $ph1530[$i] !== '' ? (float)$ph1530[$i] : null,

                    // Preferir observación del mismo horario si existe, sino combinar
                    'observaciones' => (isset($obs0630[$i]) && $obs0630[$i] !== '') ? $obs0630[$i] : ((isset($obs1200[$i]) && $obs1200[$i] !== '') ? $obs1200[$i] : ($obs1530[$i] ?? '')),
                    'responsable' => $responsable_global
                ];

                // Añadir sólo si hay al menos un valor de medición (temperatura, O2, %SAT o pH)
                // No considerar "responsable" u "observaciones" como suficiente para guardar la fila.
                $measurementKeys = [
                    'temp_6_30','o2_6_30','sat_6_30','ph_6_30',
                    'temp_12_00','o2_12_00','sat_12_00','ph_12_00',
                    'temp_3_30','o2_3_30','sat_3_30','ph_3_30'
                ];

                $hasMeasurements = false;
                foreach ($measurementKeys as $k) {
                    if (isset($p[$k]) && $p[$k] !== '' && $p[$k] !== null) { $hasMeasurements = true; break; }
                }

                if ($hasMeasurements) {
                    $dias[$diaIndex] = $p;
                }
            }

            $data['dias'] = $dias;

            try {
                // Debugging: persist a small trace of the payload to project logs for quick inspection
                $count = is_array($data['dias']) ? count($data['dias']) : 0;
                $dbg = "guardarBpa12 - dias_count=" . $count . "\n";
                // also log keys present in POST and a sample row when available
                $postKeys = array_keys($_POST);
                $dbg .= "POST_KEYS=" . implode(',', $postKeys) . "\n";
                if ($count > 0) {
                    $first = reset($data['dias']);
                    $dbg .= "FIRST_ROW=" . json_encode($first, JSON_UNESCAPED_UNICODE) . "\n";
                }
                file_put_contents(__DIR__ . '/../logs/bpa12_debug.log', $dbg, FILE_APPEND);

                $ok = $model->guardarBpa12($data);
                // log result
                $resdbg = "guardarBpa12 - model_result=" . ($ok ? 'OK' : 'FAIL') . "\n";
                file_put_contents(__DIR__ . '/../logs/bpa12_debug.log', $resdbg, FILE_APPEND);
                if ($ok) {
                    header("Location: index.php?controller=Peces&action=bpa12&status=ok");
                } else {
                    header("Location: index.php?controller=Peces&action=bpa12&error=save_failed");
                }
            } catch (Exception $e) {
                // Log and redirect with error flag
                error_log('Error guardarBpa12: ' . $e->getMessage());
                header("Location: index.php?controller=Peces&action=bpa12&error=exception");
            }
            exit;
        }
    }
    public function bpa12Listado() {
        $model = new PecesModel();
        // Usar listado detallado por fila para mostrar las columnas de medición en la vista
        $fechaBusqueda = isset($_GET['fecha']) && !empty($_GET['fecha']) ? $_GET['fecha'] : null;
        $registros = $model->getBpa12ListDetailed($fechaBusqueda);
        require_once __DIR__ . '/../views/jefeplanta/modulos-jefeplanta/peces/bpa12-listado.php';
    }
    public function verBpa12() {
        if (isset($_GET['id'])) {
            $model = new PecesModel();
            $registro = $model->getBpa12ById($_GET['id']);
            if ($registro) {
                require_once __DIR__ . '/../views/jefeplanta/modulos-jefeplanta/peces/bpa12-ver.php';
            } else {
                header('Location: index.php?controller=Peces&action=bpa12Listado&error=notfound');
            }
        } else {
            header('Location: index.php?controller=Peces&action=bpa12Listado&error=noid');
        }
    }
    public function exportarBpa12() {
        if (isset($_GET['id'])) {
            $model = new PecesModel();
            $registro = $model->getBpa12ById($_GET['id']);
            if ($registro) {
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment; filename="BPA12_' . $registro['fecha_registro'] . '.xls"');
                require_once __DIR__ . '/../views/jefeplanta/modulos-jefeplanta/peces/bpa12-excel.php';
            } else {
                header('Location: index.php?controller=Peces&action=bpa12Listado&error=notfound');
            }
        } else {
            header('Location: index.php?controller=Peces&action=bpa12Listado&error=noid');
        }
    }

    public function exportBpa12ExcelSemana() {
        if (!isset($_GET['fecha_semana']) || empty($_GET['fecha_semana'])) {
            header("Location: index.php?controller=Peces&action=bpa12Listado");
            exit;
        }
        $fecha = $_GET['fecha_semana'];
        try {
            $dt = new DateTimeImmutable($fecha);
        } catch (Exception $e) {
            header("Location: index.php?controller=Peces&action=bpa12Listado");
            exit;
        }
        $inicio = $dt->modify('monday this week')->format('Y-m-d');
        $fin    = $dt->modify('sunday this week')->format('Y-m-d');

        $model = new PecesModel();
        $registros = $model->getBpa12Between($inicio, $fin);
        $titulo = "Control Parámetros Diarios - Semana del $inicio al $fin";
        $filename = "Control_Parametros_Semanal_{$inicio}_{$fin}.xls";
        $this->emitirExcelBpa12($registros, $titulo, $filename);
    }

    public function exportBpa12ExcelMes() {
        if (!isset($_GET['fecha_mes']) || empty($_GET['fecha_mes'])) {
            header("Location: index.php?controller=Peces&action=bpa12Listado");
            exit;
        }
        // fecha_mes formato YYYY-MM
        $ym = preg_replace('/[^0-9\-]/', '', $_GET['fecha_mes']);
        $start = DateTimeImmutable::createFromFormat('Y-m-d', $ym . '-01');
        if (!$start) {
            header("Location: index.php?controller=Peces&action=bpa12Listado");
            exit;
        }
        $inicio = $start->format('Y-m-d');
        $fin = $start->modify('last day of this month')->format('Y-m-d');

        $model = new PecesModel();
        $registros = $model->getBpa12Between($inicio, $fin);
        $titulo = "Control Parámetros Diarios - Mes {$start->format('Y-m')}";
        $filename = "Control_Parametros_Mensual_{$start->format('Y-m')}.xls";
        $this->emitirExcelBpa12($registros, $titulo, $filename);
    }

    public function exportBpa12ExcelAnio() {
        if (!isset($_GET['fecha_anio']) || empty($_GET['fecha_anio'])) {
            header("Location: index.php?controller=Peces&action=bpa12Listado");
            exit;
        }
        $anio = (int)$_GET['fecha_anio'];
        if ($anio < 2000 || $anio > 2100) {
            header("Location: index.php?controller=Peces&action=bpa12Listado");
            exit;
        }
        $inicio = sprintf('%04d-01-01', $anio);
        $fin    = sprintf('%04d-12-31', $anio);

        $model = new PecesModel();
        $registros = $model->getBpa12Between($inicio, $fin);
        $titulo = "Control Parámetros Diarios - Año {$anio}";
        $filename = "Control_Parametros_Anual_{$anio}.xls";
        $this->emitirExcelBpa12($registros, $titulo, $filename);
    }

    private function emitirExcelBpa12(array $registros, string $titulo, string $filename): void {
        header('Content-Type: application/vnd.ms-excel; charset=UTF-8');
        header('Content-Disposition: attachment; filename=' . $filename);
        header('Pragma: no-cache');
        header('Expires: 0');

        echo "\xEF\xBB\xBF"; // BOM UTF-8 para Excel
        echo '<html><head><meta charset="UTF-8"><title>' . htmlspecialchars($titulo) . "</title></head><body>";
        echo '<h3 style="font-family:Segoe UI,Arial,sans-serif">' . htmlspecialchars($titulo) . '</h3>';
        echo '<table border="1" cellspacing="0" cellpadding="4">';
        echo '<thead style="background:#cfe2ff;font-weight:bold">';
        echo '<tr>';
        $cols = ['ID','Código Formato','Versión','Fecha Registro','Mes','Sede','Día','T° (6:30)','O₂ (6:30)','Sat. (6:30)','pH (6:30)','T° (12:00)','O₂ (12:00)','Sat. (12:00)','pH (12:00)','T° (15:30)','O₂ (15:30)','Sat. (15:30)','pH (15:30)','Responsable','Observaciones'];
        foreach ($cols as $c) echo '<th>' . htmlspecialchars($c) . '</th>';
        echo '</tr></thead><tbody>';
        if (!empty($registros)) {
            foreach ($registros as $r) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars((string)$r['id']) . '</td>';
                echo '<td>' . htmlspecialchars((string)$r['codigo_formato']) . '</td>';
                echo '<td>' . htmlspecialchars((string)$r['version']) . '</td>';
                echo '<td>' . htmlspecialchars((string)$r['fecha_registro']) . '</td>';
                echo '<td>' . htmlspecialchars((string)$r['mes']) . '</td>';
                echo '<td>' . htmlspecialchars((string)$r['sede']) . '</td>';
                echo '<td>' . htmlspecialchars((string)$r['dia']) . '</td>';
                echo '<td>' . htmlspecialchars((string)($r['temperatura_am'] ?? '')) . '</td>';
                echo '<td>' . htmlspecialchars((string)($r['oxigeno_am'] ?? '')) . '</td>';
                echo '<td>' . htmlspecialchars((string)($r['saturacion_am'] ?? '')) . '</td>';
                echo '<td>' . htmlspecialchars((string)($r['ph_am'] ?? '')) . '</td>';
                echo '<td>' . htmlspecialchars((string)($r['temperatura_md'] ?? '')) . '</td>';
                echo '<td>' . htmlspecialchars((string)($r['oxigeno_md'] ?? '')) . '</td>';
                echo '<td>' . htmlspecialchars((string)($r['saturacion_md'] ?? '')) . '</td>';
                echo '<td>' . htmlspecialchars((string)($r['ph_md'] ?? '')) . '</td>';
                echo '<td>' . htmlspecialchars((string)($r['temperatura_pm'] ?? '')) . '</td>';
                echo '<td>' . htmlspecialchars((string)($r['oxigeno_pm'] ?? '')) . '</td>';
                echo '<td>' . htmlspecialchars((string)($r['saturacion_pm'] ?? '')) . '</td>';
                echo '<td>' . htmlspecialchars((string)($r['ph_pm'] ?? '')) . '</td>';
                echo '<td>' . htmlspecialchars((string)$r['responsable']) . '</td>';
                echo '<td>' . htmlspecialchars((string)($r['observaciones'] ?? '')) . '</td>';
                echo '</tr>';
            }
        } else {
            echo '<tr><td colspan="21">Sin registros en el periodo seleccionado</td></tr>';
        }
        echo '</tbody></table>';
        echo '</body></html>';
        exit;
    }
}
?>
