<?php
require_once "../config/database.php";
require_once "../models/PecesModel.php";

class PecesController {

    public function bpa6() {
        $model = new PecesModel();
        $especies = $model->obtenerEspecies();
        include "../views/jefeplanta/modulos-jefeplanta/peces/bpa6/bpa6.php";
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

            // Datos principales del formato BPA6
            $data = [
                'codigo_formato' => $_POST['codigo_formato'] ?? '',
                'version' => $_POST['version'] ?? '',
                'fecha_registro' => $_POST['fecha_registro'] ?? '',
                'responsable' => $_POST['responsable'] ?? '',
                'sede' => $_POST['sede'] ?? '',
                'up' => $_POST['up'] ?? '',
                'lote' => $_POST['lote'] ?? '',
                'mortalidad' => $_POST['mortalidad'] ?? 0,
                'morbilidad' => $_POST['morbilidad'] ?? 0,
                'total' => $_POST['total'] ?? 0,
                'observaciones' => $_POST['observaciones'] ?? '',
                'id_especie' => $id_especie,
                'id_lote' => $_POST['id_lote'] ?? null,
                'id_sede' => $_POST['id_sede'] ?? null,
                'creado_en' => date('Y-m-d H:i:s'),
                'actualizado_en' => date('Y-m-d H:i:s')
            ];

            $model->guardarBpa6($data);

            header("Location: index.php?controller=Peces&action=bpa6");
            exit;
        }
    }

    /* ======================
       BPA 7 - ALIMENTACIÓN DIARIA
       ====================== */
    public function bpa7() {
        require_once __DIR__ . '/../views/jefeplanta/modulos-jefeplanta/peces/bpa7/bpa7.php';
    }

    public function guardarBpa7() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new PecesModel();

            $data = [
                'codigo_formato' => $_POST['codigo_formato'] ?? '',
                'version' => $_POST['version'] ?? '',
                'fecha_registro' => $_POST['fecha_registro'] ?? '',
                'responsable' => $_POST['responsable'] ?? '',
                'sede' => $_POST['sede'] ?? '',
                'up' => $_POST['up'] ?? '',
                'lote' => $_POST['lote'] ?? '',
                'biomasa' => $_POST['biomasa'] ?? 0,
                'tasa_alimentacion' => $_POST['tasa_alimentacion'] ?? 0,
                'alimento_suministrado' => $_POST['alimento_suministrado'] ?? 0,
                'calibre' => $_POST['calibre'] ?? '',
                'observaciones' => $_POST['observaciones'] ?? '',
                'id_lote' => $_POST['id_lote'] ?? null,
                'id_especie' => $_POST['id_especie'] ?? null,
                'id_sede' => $_POST['id_sede'] ?? null,
                'creado_en' => date('Y-m-d H:i:s'),
                'actualizado_en' => date('Y-m-d H:i:s')
            ];

            $model->guardarBpa7($data);
            header("Location: index.php?controller=Peces&action=bpa7");
            exit;
        }
    }

    public function bpa7Listado() {
        $model = new PecesModel();
        $registros = $model->getBpa7List();
        require_once __DIR__ . '/../views/jefeplanta/modulos-jefeplanta/peces/bpa7/bpa7-listado.php';
    }

    /* ======================
       BPA 10 - MUESTREO
       ====================== */
    public function bpa10() {
        require_once __DIR__ . '/../views/jefeplanta/modulos-jefeplanta/peces/bpa10/bpa10.php';
    }

    public function guardarBpa10() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new PecesModel();

            // Procesar múltiples filas
            $lotes = $_POST['lote'] ?? [];
            $pesos = $_POST['peso_promedio'] ?? [];
            $coeficientes = $_POST['coeficiente_variacion'] ?? [];
            $factores = $_POST['factor_k'] ?? [];
            $ups = [];

            // Generar UPs basado en el número de filas
            for ($i = 0; $i < count($lotes); $i++) {
                $ups[] = 'UP-' . str_pad($i + 1, 2, '0', STR_PAD_LEFT);
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
                        'observaciones' => '', // Se puede agregar manejo de observaciones por fila si es necesario
                        'id_lote' => null // Se puede agregar manejo de id_lote si es necesario
                    ]);
                    
                    $model->guardarBpa10($data);
                }
            }
            
            header("Location: index.php?controller=Peces&action=bpa10");
            exit;
        }
    }

    public function bpa10Listado() {
        $model = new PecesModel();
        $registros = $model->getBpa10List();
        require_once __DIR__ . '/../views/jefeplanta/modulos-jefeplanta/peces/bpa10/bpa10-listado.php';
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
