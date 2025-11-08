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
        $registros = $model->getBpa6List();
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
        $registros = $model->getBpa7List();
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
        require_once __DIR__ . '/../views/jefeplanta/modulos-jefeplanta/peces/bpa12/bpa12.php';
    }

    public function guardarBpa12() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new PecesModel();

            // Datos del registro principal
            $data = [
                'codigo_formato' => $_POST['codigo_formato'] ?? 'CORAQUA BPA-12',
                'version' => $_POST['version'] ?? '2.0',
                'fecha_registro' => $_POST['fecha_registro'] ?? '',
                'mes' => $_POST['mes'] ?? '',
                'sede' => $_POST['sede'] ?? '',
                'responsable' => $_POST['responsable'] ?? '',
                'observaciones' => $_POST['observaciones'] ?? '',
            ];

            // Procesar los datos de cada día
            $dias = [];
            for ($dia = 1; $dia <= 31; $dia++) {
                if (isset($_POST["temp_6_30_$dia"])) { // Solo procesar si hay datos para este día
                    $dias[$dia] = [
                        'temp_6_30' => (float)$_POST["temp_6_30_$dia"] ?? 0,
                        'o2_6_30' => (float)$_POST["o2_6_30_$dia"] ?? 0,
                        'sat_6_30' => (float)$_POST["sat_6_30_$dia"] ?? 0,
                        'ph_6_30' => (float)$_POST["ph_6_30_$dia"] ?? 0,
                        'temp_12_00' => (float)$_POST["temp_12_00_$dia"] ?? 0,
                        'o2_12_00' => (float)$_POST["o2_12_00_$dia"] ?? 0,
                        'sat_12_00' => (float)$_POST["sat_12_00_$dia"] ?? 0,
                        'ph_12_00' => (float)$_POST["ph_12_00_$dia"] ?? 0,
                        'temp_3_30' => (float)$_POST["temp_3_30_$dia"] ?? 0,
                        'o2_3_30' => (float)$_POST["o2_3_30_$dia"] ?? 0,
                        'sat_3_30' => (float)$_POST["sat_3_30_$dia"] ?? 0,
                        'ph_3_30' => (float)$_POST["ph_3_30_$dia"] ?? 0,
                        'observaciones' => $_POST["observaciones_dia_$dia"] ?? ''
                    ];
                }
            }
            
            $data['dias'] = $dias;

            $model->guardarBpa12($data);
            header("Location: index.php?controller=Peces&action=bpa12");
            exit;
        }
    }

    public function bpa12Listado() {
        $model = new PecesModel();
        $registros = $model->getBpa12List();
        require_once __DIR__ . '/../views/jefeplanta/modulos-jefeplanta/peces/bpa12/bpa12-listado.php';
    }

    public function verBpa12() {
        if (isset($_GET['id'])) {
            $model = new PecesModel();
            $registro = $model->getBpa12ById($_GET['id']);
            if ($registro) {
                require_once __DIR__ . '/../views/jefeplanta/modulos-jefeplanta/peces/bpa12/bpa12-ver.php';
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
                require_once __DIR__ . '/../views/jefeplanta/modulos-jefeplanta/peces/bpa12/bpa12-excel.php';
            } else {
                header('Location: index.php?controller=Peces&action=bpa12Listado&error=notfound');
            }
        } else {
            header('Location: index.php?controller=Peces&action=bpa12Listado&error=noid');
        }
    }


}
?>
