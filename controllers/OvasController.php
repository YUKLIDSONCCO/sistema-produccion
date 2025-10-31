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

    
    /* =========================================
       BPA 2 - MORTALIDAD DIARIA DE OVAS
       ========================================= */
    public function guardarBPA2() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?controller=Ovas&action=bpa2&error=method');
            exit;
        }

        $data = [
            'codigo_formato' => $_POST['codigo_formato'] ?? '',
            'version' => $_POST['version'] ?? '',
            'fecha_registro' => $_POST['fecha_registro'] ?? date('Y-m-d'),
            'encargado' => $_POST['encargado'] ?? '',
            'cantidad_siembra' => $_POST['cantidad_siembra'] ?? 0,
            'lote' => $_POST['lote'] ?? '',
            'sede' => $_POST['sede'] ?? '',
            'id_lote' => $_POST['id_lote'] ?? 0,
            'id_sede' => $_POST['id_sede'] ?? 0,
            'id_especie' => $_POST['id_especie'] ?? 0,
            'fecha_control' => $_POST['fecha_control'] ?? date('Y-m-d'),
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
            header('Location: index.php?controller=Ovas&action=listarBPA2&success=1');
        } else {
            header('Location: index.php?controller=Ovas&action=bpa2&error=save');
        }
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
    public function guardarBPA3($data) {
        $sql = "INSERT INTO mortalidad_diaria_larvas (
                    codigo_formato, version, fecha_registro, encargado, cantidad_siembra, lote, sede,
                    id_lote, id_sede, id_especie,
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
        $sql = "SELECT * FROM mortalidad_diaria_larvas WHERE DATE(fecha_registro) = ? ORDER BY fecha_registro DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$fecha]);
        return $stmt;
    }

    /* =========================================
       BPA 4 - CONTROL DE PARÁMETROS
       ========================================= */
    public function guardarBPA4($data) {
        $sql = "INSERT INTO control_parametros (
                    codigo_formato, version, fecha_registro, mes, sede, responsable,
                    observaciones, creado_en, actualizado_en
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
        $sql = "SELECT * FROM control_parametros WHERE DATE(fecha_registro) = ? ORDER BY fecha_registro DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$fecha]);
        return $stmt;
    }

}

?>
