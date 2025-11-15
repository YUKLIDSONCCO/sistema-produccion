<?php
require_once "../config/database.php";
require_once "../models/InventarioModel.php";
class InventarioController {

    public function dashboard() {
    include "../views/jefeplanta/modulos-jefeplanta/inventario/dashboard.php";
}

    public function bpa1() {
    // Mostrar mensajes de éxito/error
    if (isset($_GET['success'])) {
        echo "<script>alert('Se guardaron " . $_GET['success'] . " registros correctamente');</script>";
    }
    if (isset($_GET['error'])) {
        echo "<script>alert('Error al guardar los registros');</script>";
    }
    
    include "../views/jefeplanta/modulos-jefeplanta/inventario/bpa1.php";
}
    public function obtenerDatosBPA1() {
        global $conexion;

     $sql = "SELECT fecha, sede, encargado, mes, marca, calibre, cantidad, nombre_alimento, observaciones 
        FROM control_alimento_almacen
        ORDER BY id DESC";

        $result = $conexion->query($sql);
        $datos = [];

        if ($result && $result->num_rows > 0) {
            while ($fila = $result->fetch_assoc()) {
                $datos[] = $fila;
            }
        }

        return $datos;
    }
    public function guardarBPA1()
{
    require_once "../config/database.php";
    require_once "../models/InventarioModel.php";
    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $fechaGeneral = $_POST['fecha'] ?? ''; // Fecha principal
        $sede = $_POST['sede'] ?? '';
        $encargado = $_POST['encargado'] ?? '';
        $mes = $_POST['mes'] ?? '';
        $id_usuario = $_SESSION['id_usuario'] ?? null;

        // Arrays del formulario
        $fechas = $_POST['fecha_fila'] ?? $_POST['fecha'] ?? []; // Soporte para fechas individuales o única
        $marcas = $_POST['marca'] ?? [];
        $calibres = $_POST['calibre'] ?? [];
        $cantidades = $_POST['cantidad'] ?? [];
        $nombres = $_POST['nombre_alimento'] ?? [];
        $observaciones = $_POST['observaciones'] ?? [];

        $database = new Database();
        $conn = $database->getConnection();
        $model = new InventarioModel($conn);

        $successCount = 0;

        // Insertar cada fila
        for ($i = 0; $i < count($marcas); $i++) {
            $fecha = $fechas[$i] ?? $fechaGeneral; // Usa la fecha de la fila o la general
            $marca = trim($marcas[$i] ?? '');
            $calibre = trim($calibres[$i] ?? '');
            $cantidad = (float)($cantidades[$i] ?? 0);
            $nombre_alimento = trim($nombres[$i] ?? '');
            $obs = trim($observaciones[$i] ?? '');

            if ($marca !== '' && $cantidad > 0 && !empty($fecha)) {
                if ($model->guardarBPA1($fecha, $sede, $encargado, $mes, $marca, $calibre, $cantidad, $nombre_alimento, $obs)) {
                    $successCount++;
                }
            }
        }

        if ($successCount > 0) {
            header("Location: /sistema-produccion/public/Inventario/bpa1?success=" . $successCount);
        } else {
            header("Location: /sistema-produccion/public/Inventario/bpa1?error=1");
        }
        exit;
    }
}


public function listarBPA1() {
    require_once "../config/database.php";

    // Obtener fecha enviada por el buscador
    $fecha = isset($_GET['fecha']) ? $_GET['fecha'] : date('Y-m-d');

    $database = new Database();
    $conn = $database->getConnection();

    // FILTRADO CORRECTO POR FECHA
    $sql = "SELECT 
                id,
                fecha,
                marca,
                calibre,
                cantidad,
                nombre_alimento AS nombre,
                observaciones AS obs
            FROM control_alimento_almacen
            WHERE DATE(fecha) = :fecha   -- 👈 FILTRA CORRECTO
            ORDER BY fecha DESC";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":fecha", $fecha);
    $stmt->execute();

    $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Pasar la fecha a la vista
    $fechaBusqueda = $fecha;

    include "../views/jefeplanta/modulos-jefeplanta/inventario/lista1.php";
}


// Agregar estos métodos en la clase InventarioController

public function bpa2() {
    // Mostrar mensajes de éxito/error
    if (isset($_GET['success'])) {
        echo "<script>alert('Se guardaron " . $_GET['success'] . " registros correctamente');</script>";
    }
    if (isset($_GET['error'])) {
        echo "<script>alert('Error al guardar los registros');</script>";
    }
    
    include "../views/jefeplanta/modulos-jefeplanta/inventario/bpa2.php";
}
public function guardarBPA2() {
    require_once "../config/database.php";
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $fecha = $_POST['fecha'] ?? '';
        $sede = $_POST['sede'] ?? '';
        $encargado = $_POST['encargado'] ?? '';
        $mes = $_POST['mes'] ?? '';
        $id_usuario = $_SESSION['id_usuario'] ?? null;  // Agregado: Capturar ID del usuario logueado
        
        // Obtener los arrays de datos de la tabla
        $cantidades = $_POST['cantidad'] ?? [];
        $nombres_sal = $_POST['nombre_sal'] ?? [];
        $observaciones = $_POST['observaciones'] ?? [];
        
        // Crear conexión PDO
        $database = new Database();
        $conn = $database->getConnection();
        $model = new InventarioModel($conn);
        $successCount = 0;
        
        // Insertar cada fila de la tabla
        for ($i = 0; $i < count($cantidades); $i++) {
            $cantidad = $cantidades[$i] ?? 0;
            $nombre_sal = $nombres_sal[$i] ?? '';
            $obs = $observaciones[$i] ?? '';
            
            if (!empty($cantidad) && !empty($nombre_sal)) {
                // Pasar id_usuario al modelo (actualiza InventarioModel::guardarBPA2 si es necesario)
                if ($model->guardarBPA2($fecha, $sede, $encargado, $mes, $cantidad, $nombre_sal, $obs, $id_usuario)) {
                    $successCount++;
                }
            }
        }
        
        // Redirigir después de guardar
        if ($successCount > 0) {
            header("Location: /sistema-produccion/public/Inventario/bpa2?success=" . $successCount);
        } else {
            header("Location: /sistema-produccion/public/Inventario/bpa2?error=1");
        }
        exit;
    }
}
public function listarBPA2() {
    $database = new Database();
    $conn = $database->getConnection();
    $model = new InventarioModel($conn);

    $fechaBusqueda = isset($_GET['fecha']) ? $_GET['fecha'] : date('Y-m-d');
    $datos = [];

    if (isset($_GET['ver_todo'])) {
        $stmt = $model->obtenerTodosBPA2();
    } else {
        $stmt = $model->obtenerListadoBPA2PorFecha($fechaBusqueda);
    }

    if ($stmt) $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    include "../views/jefeplanta/modulos-jefeplanta/inventario/lista2.php";
}



    public function obtenerDatosBPA2() {
        global $conexion;

        $sql = "SELECT fecha, sede, encargado, mes, cantidad, nombre, obs 
                FROM control_sal_almacen
                ORDER BY id DESC";

        $result = $conexion->query($sql);
        $datos = [];

        if ($result && $result->num_rows > 0) {
            while ($fila = $result->fetch_assoc()) {
                $datos[] = $fila;
            }
        }

        return $datos;
    }
    // Agregar estos métodos en la clase InventarioController

public function bpa3() {
    // Mostrar mensajes de éxito/error
    if (isset($_GET['success'])) {
        echo "<script>alert('Se guardaron " . $_GET['success'] . " registros correctamente');</script>";
    }
    if (isset($_GET['error'])) {
        echo "<script>alert('Error al guardar los registros');</script>";
    }
    
    include "../views/jefeplanta/modulos-jefeplanta/inventario/bpa3.php";
}
// ==============================
// 🧾 GUARDAR BPA-3 (CONTROL DE MEDICAMENTOS)
// ==============================



public function listarBPA3() {
    $database = new Database();
    $conn = $database->getConnection();
    $model = new InventarioModel($conn);

    $fechaBusqueda = isset($_GET['fecha']) ? $_GET['fecha'] : date('Y-m-d');
    $datos = [];

    if (isset($_GET['ver_todo'])) {
        $stmt = $model->obtenerTodosBPA3();
    } else {
        $stmt = $model->obtenerListadoBPA3PorFecha($fechaBusqueda);
    }

    if ($stmt) $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    include "../views/jefeplanta/modulos-jefeplanta/inventario/lista3.php";
}
public function guardarBPA3() {
    require_once "../config/database.php";
    require_once __DIR__ . '/../models/InventarioModel.php';

    $database = new Database();
    $conn = $database->getConnection();
    $model = new InventarioModel($conn); // ✅ Se pasa la conexión correctamente

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $fecha = $_POST['fecha'] ?? '';
        $sede = $_POST['sede'] ?? '';
        $encargado = $_POST['encargado'] ?? '';
        $mes = $_POST['mes'] ?? '';
        $cantidades = $_POST['cantidad'] ?? [];
        $medicamentos = $_POST['medicamento'] ?? [];
        $observaciones = $_POST['observaciones'] ?? [];

        $guardado = $model->guardarBPA3($fecha, $sede, $encargado, $mes, $cantidades, $medicamentos, $observaciones);

        if ($guardado) {
            header("Location: /sistema-produccion/public/Inventario/bpa3?success=1");
            exit;
        } else {
            header("Location: /sistema-produccion/public/Inventario/bpa3?error=1");
            exit;
        }
    }
}

public function obtenerDatosBPA3() {
    global $conexion;

    $sql = "SELECT fecha, sede, encargado, mes, medicamento_suplemento, cantidad, nombre_empleado, observaciones 
            FROM control_medicamento 
            ORDER BY id DESC";

        $result = $conexion->query($sql);

        $datos = [];
        if ($result && $result->num_rows > 0) {
            while ($fila = $result->fetch_assoc()) {
                $datos[] = $fila;
            }
        }

        return $datos;
    }
    // Agregar estos métodos en la clase InventarioController

public function bpa4() {
    // Mostrar mensajes de éxito/error
    if (isset($_GET['success'])) {
        echo "<script>alert('Se guardaron " . $_GET['success'] . " registros correctamente');</script>";
    }
    if (isset($_GET['error'])) {
        echo "<script>alert('Error al guardar los registros');</script>";
    }
    
    include "../views/jefeplanta/modulos-jefeplanta/inventario/bpa4.php";
}
public function guardarBPA4() {
    require_once "../config/database.php";
    require_once __DIR__ . '/../models/InventarioModel.php';
    $database = new Database();
    $conn = $database->getConnection();
    $model = new InventarioModel($conn);
    try {
        // Asegurarse de que los datos sean arrays
        $fechas = isset($_POST['fecha']) && is_array($_POST['fecha']) ? $_POST['fecha'] : [];
        $medicamentos = isset($_POST['medicamento_suplemento']) && is_array($_POST['medicamento_suplemento']) ? $_POST['medicamento_suplemento'] : [];
        $dosis = isset($_POST['dosis_gr']) && is_array($_POST['dosis_gr']) ? $_POST['dosis_gr'] : [];
        $dias = isset($_POST['dias_tratamiento']) && is_array($_POST['dias_tratamiento']) ? $_POST['dias_tratamiento'] : [];
        $lotes = isset($_POST['lote_alevines']) && is_array($_POST['lote_alevines']) ? $_POST['lote_alevines'] : [];
        $salas = isset($_POST['sala']) && is_array($_POST['sala']) ? $_POST['sala'] : [];
        $responsables = isset($_POST['responsable']) && is_array($_POST['responsable']) ? $_POST['responsable'] : [];
        $observaciones = isset($_POST['observaciones']) && is_array($_POST['observaciones']) ? $_POST['observaciones'] : [];
        $contador = 0;
        // Verificar que tenemos datos para procesar
        if (count($medicamentos) > 0) {
            for ($i = 0; $i < count($medicamentos); $i++) {
                // Validar que la fila no esté vacía
                if (empty(trim($medicamentos[$i]))) continue;
                $data = [
                    'fecha' => $fechas[$i] ?? date('Y-m-d'),
                    'medicamento_suplemento' => $medicamentos[$i] ?? '',
                    'dosis_gr' => $dosis[$i] ?? 0,
                    'dias_tratamiento' => $dias[$i] ?? 0,
                    'lote_alevines' => $lotes[$i] ?? '',
                    'sala' => $salas[$i] ?? '',
                    'responsable' => $responsables[$i] ?? '',
                    'observaciones' => $observaciones[$i] ?? ''
                ];
                if ($model->insertarControlDosificacion($data)) {
                    $contador++;
                }
            }
        }
        if ($contador > 0) {
            header("Location: /sistema-produccion/public/Inventario/bpa4?success={$contador}");
        } else {
            header("Location: /sistema-produccion/public/Inventario/bpa4?error=1&message=No se pudieron guardar los registros");
        }
        exit;
    } catch (Exception $e) {
        $msg = urlencode($e->getMessage());
        header("Location: /sistema-produccion/public/Inventario/bpa4?error=1&message={$msg}");
        exit;
    }
}
public function listarBPA4()
{
    require_once __DIR__ . '/../models/InventarioModel.php';

    $database = new Database();
    $conn = $database->getConnection();   // ✅ Conexión creada

    $model = new InventarioModel($conn);  // ✅ Conexión pasada al modelo

    $fecha = isset($_GET["fecha"]) ? $_GET["fecha"] : date("Y-m-d");

    $datos = $model->obtenerListadoBPA4PorFecha($fecha);  // Ya tiene conexión, no da error

    $fechaBusqueda = $fecha;

    require_once "../views/jefeplanta/modulos-jefeplanta/inventario/lista4.php";
}


    public function obtenerDatosBPA4() {
        global $conexion;

        $sql = "SELECT fecha, medicamento, dosis, dias_tratamiento, lote_alevines, sala, responsable 
                FROM dosificacion_medicamentos 
                ORDER BY id DESC";
        $result = $conexion->query($sql);

        $datos = [];
        if ($result && $result->num_rows > 0) {
            while ($fila = $result->fetch_assoc()) {
                $datos[] = $fila;
            }
        }

        return $datos;
    }

    // Exportador genérico a Excel (HTML table + BOM) para los BPA del inventario
    public function exportBPAExcel()
    {
        require_once __DIR__ . '/../config/database.php';
        require_once __DIR__ . '/../models/InventarioModel.php';

        $bpa = isset($_GET['bpa']) ? (int)$_GET['bpa'] : 1;
        $tipo = $_GET['tipo'] ?? null; // opcional, preferimos usar los campos concretos

        // Calcular rango inicio/fin según tipo y parámetros recibidos
        try {
            if (isset($_GET['fecha_semana']) && !empty($_GET['fecha_semana'])) {
                $fecha = $_GET['fecha_semana'];
                $dt = new DateTime($fecha);
                // Llevar al lunes de la semana
                $dt->modify('monday this week');
                $inicio = $dt->format('Y-m-d');
                $fin = (new DateTime($inicio))->modify('+6 days')->format('Y-m-d');
            } elseif (isset($_GET['fecha_mes']) && !empty($_GET['fecha_mes'])) {
                // formato esperado: YYYY-MM
                $mes = $_GET['fecha_mes'];
                $inicio = $mes . '-01';
                $fin = (new DateTime($inicio))->modify('last day of this month')->format('Y-m-d');
            } elseif (isset($_GET['fecha_anio']) && !empty($_GET['fecha_anio'])) {
                $anio = (int)$_GET['fecha_anio'];
                $inicio = sprintf('%04d-01-01', $anio);
                $fin = sprintf('%04d-12-31', $anio);
            } else {
                // Por defecto: hoy
                $inicio = date('Y-m-d');
                $fin = date('Y-m-d');
            }

            // Seleccionar tabla según BPA
            switch ($bpa) {
                case 1:
                    $table = 'control_alimento_almacen';
                    $titulo = 'Control de Alimento';
                    break;
                case 2:
                    $table = 'control_sal_almacen';
                    $titulo = 'Control de Sal';
                    break;
                case 3:
                    $table = 'control_medicamento';
                    $titulo = 'Control de Medicamento';
                    break;
                case 4:
                    $table = 'control_dosificacion';
                    $titulo = 'Control de Dosificación';
                    break;
                default:
                    $table = 'control_alimento_almacen';
                    $titulo = 'Control de Alimento';
            }

            $database = new Database();
            $conn = $database->getConnection();

            $sql = "SELECT * FROM {$table} WHERE DATE(fecha) BETWEEN :inicio AND :fin ORDER BY fecha ASC";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':inicio', $inicio);
            $stmt->bindParam(':fin', $fin);
            $stmt->execute();
            $registros = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $filename = "inventario_bpa{$bpa}_{$inicio}_to_{$fin}.xls";
            $this->emitirExcelDesdeRegistros($registros, $titulo, $filename);
        } catch (Exception $e) {
            header('Content-Type: text/plain; charset=UTF-8');
            echo "Error al generar el reporte: " . $e->getMessage();
            exit;
        }
    }

    // Helper: emite un archivo Excel simple (HTML table) desde un array de registros
    private function emitirExcelDesdeRegistros(array $registros, string $titulo, string $filename)
    {
        if (empty($registros)) {
            header('Content-Type: text/plain; charset=UTF-8');
            echo "No hay registros para exportar.";
            exit;
        }

        // Encabezados para forzar descarga en formato Excel (HTML)
        header('Content-Type: application/vnd.ms-excel; charset=UTF-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        // BOM UTF-8
        echo "\xEF\xBB\xBF";

        // Construir tabla HTML
        echo "<table border=1><thead><tr>";
        // Usar las claves del primer registro como encabezados
        $keys = array_keys($registros[0]);
        foreach ($keys as $k) {
            echo '<th>' . htmlspecialchars(strtoupper($k)) . '</th>';
        }
        echo "</tr></thead><tbody>";

        foreach ($registros as $row) {
            echo "<tr>";
            foreach ($keys as $k) {
                $val = isset($row[$k]) ? $row[$k] : '';
                echo '<td>' . htmlspecialchars($val) . '</td>';
            }
            echo "</tr>";
        }

        echo "</tbody></table>";
        exit;
    }
}
?>
