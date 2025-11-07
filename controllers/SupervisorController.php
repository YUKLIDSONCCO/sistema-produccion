<?php
ini_set('display_errors', 0);
error_reporting(E_ERROR | E_PARSE);
require_once "BaseController.php";
require_once __DIR__ . "/../models/SupervisorModel.php";
require_once __DIR__ . "/../config/database.php";
class SupervisorController extends BaseController {
    private $model;
    public function __construct() {
        $this->model = new SupervisorModel();
    }
    public function dashboard() {
    if (!isset($_SESSION['usuario'])) {
        $this->redirect("index.php?controller=Auth&action=login");
    }

    $usuario = $_SESSION['usuario'];
    $produccion = $this->model->getResumenProduccion();
    $insumos = $this->model->getInsumosAsignados();
    $personal = $this->model->getPersonalEnTurno();

    // Reportes BPA pendientes
    $bpa1 = $this->model->getBPA1Pendientes();
    $bpa2 = $this->model->getBPA2Pendientes();
    $bpa3 = $this->model->getBPA3Pendientes();

    // 🔸 NUEVO: Resumen general de estados BPA-1 (para gráfico)
    $bpaResumen = $this->model->getResumenBpa1();

    // Enviamos todo a la vista
    $this->view("supervisor/dashboard", compact(
        "usuario", "produccion", "insumos", "personal",
        "bpa1", "bpa2", "bpa3", "bpaResumen"
    ));
}
    // 📋 VISUALIZAR CUALQUIER BPA (1, 2, 3, 4)
    public function verBPA($tipo = 1, $id = null) {
    // Mapear las tablas según el tipo de BPA
    $mapaTablas = [
        1 => ['control' => 'control_alimento_almacen'],
        2 => ['control' => 'control_sal_almacen'],
        3 => ['control' => 'control_medicamento'],
        4 => ['control' => 'dosificacion_medicamentos'],
    ];
    if (!isset($mapaTablas[$tipo])) {
        echo "<script>alert('Tipo de BPA no válido.'); window.location.href='/sistema-produccion/public/index.php?controller=Supervisor&action=inventarioGeneral';</script>";
        exit;
    }
    if (!$id) {
        echo "<script>alert('Debe especificar un ID de reporte.'); window.location.href='/sistema-produccion/public/index.php?controller=Supervisor&action=inventarioGeneral';</script>";
        exit;
    }
    $tabla = $mapaTablas[$tipo]['control'];
    $reporte = $this->model->getDetalleBPA($tabla, $id);
    if (!$reporte) {
        echo "<script>alert('No se encontró el reporte BPA seleccionado.'); window.location.href='/sistema-produccion/public/index.php?controller=Supervisor&action=inventarioGeneral';</script>";
        exit;
    }
    $vista = "supervisor/revision_bpa{$tipo}";

    // Renderizar la vista correspondiente
    $this->view($vista, [
        'id' => $reporte['id'],
        'fecha' => $reporte['fecha'],
        'sede' => $reporte['sede'] ?? '',
        'encargado' => $reporte['encargado'] ?? '',
        'mes' => $reporte['mes'] ?? '',
        'datos' => $reporte['datos']
    ]);
}


    // ==============================
    // ✅ APROBAR / ❌ RECHAZAR BPA
    // ==============================
    public function aprobarBPA() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tipo = $_POST['tipo'] ?? 1;
            $id = $_POST['id_reporte'] ?? null;
            $accion = $_POST['accion'] ?? '';
            $comentarios = trim($_POST['comentarios'] ?? '');

            $mapaTablas = [
                1 => 'control_alimento_almacen',
                2 => 'control_alimento_almacen_bpa2',
                3 => 'control_alimento_almacen_bpa3',
                4 => 'control_alimento_almacen_bpa4'
            ];

            if (!isset($mapaTablas[$tipo]) || !$id) {
                echo "<script>alert('Error: datos del reporte inválidos.'); window.history.back();</script>";
                exit;
            }

            $tabla = $mapaTablas[$tipo];
            $this->model->actualizarEstadoBPA($tabla, $id, $accion, $comentarios);

            $mensaje = ($accion === 'aprobar')
                ? "✅ El reporte BPA-$tipo fue aprobado correctamente."
                : "❌ El reporte BPA-$tipo fue rechazado.";

            echo "<script>alert('$mensaje'); window.location.href='/sistema-produccion/public/Supervisor/dashboard';</script>";
            exit;
        }
    }
    // ==============================
// REVISIÓN GENERAL DE INVENTARIOS (BPA 1–4)
// ==============================
public function inventarioGeneral() {
    // Cargar los modelos de datos pendientes de cada BPA
    $bpa1 = $this->model->getBPA1Pendientes();

    // 👇 Estos métodos los agregaremos enseguida al modelo
    $bpa2 = $this->model->getBPA2Pendientes();
    $bpa3 = $this->model->getBPA3Pendientes();
    $bpa4 = $this->model->getBPA4Pendientes();

    // Renderizar la vista general
    $this->view("supervisor/inventario_general", compact("bpa1", "bpa2", "bpa3", "bpa4"));
}
// ==============================
// 📋 Ver BPA-1 directamente
// ==============================
public function bpa1() {
    // Obtener el ID del reporte desde la URL
    $id = $_GET['id'] ?? null;

    if (!$id) {
        echo "<script>
            alert('Debe especificar un ID de reporte BPA-1.');
            window.location.href='/sistema-produccion/public/index.php?controller=Supervisor&action=inventarioGeneral';
        </script>";
        exit;
    }

    // Llamamos al método genérico para mostrar el BPA-1
    $this->verBPA(1, $id);
}
// ==============================
// 📋 Listar todos los BPA-1 pendientes
// ==============================
public function listarBPA1() {
    $reportes = $this->model->getTodosReportesBPA1();
    require_once __DIR__ . '/../views/supervisor/listar_bpa1.php';
}

// ==============================
// 📤 RECIBIR REPORTE BPA-1 DESDE JEFE DE PLANTA
// ==============================
public function recibirReporteBPA1()
{
    // Aceptar solo solicitudes POST con JSON
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        echo json_encode(['status' => 'error', 'message' => 'Método no permitido']);
        return;
    }

    $data = json_decode(file_get_contents('php://input'), true);

    if (!$data || !isset($data['sede'])) {
        echo json_encode(['status' => 'error', 'message' => 'Datos incompletos o inválidos']);
        return;
    }

    // Ruta donde se almacenarán temporalmente los reportes recibidos
    $path = __DIR__ . '/../data/reportes_bpa1.json';
    if (!file_exists(dirname($path))) {
        mkdir(dirname($path), 0777, true);
    }

    // Leer reportes anteriores
    $reportes = file_exists($path) ? json_decode(file_get_contents($path), true) : [];

    // Agregar el nuevo reporte
    $reportes[] = [
        'fecha' => $data['fecha'] ?? date('Y-m-d'),
        'sede' => $data['sede'] ?? '',
        'encargado' => $data['encargado'] ?? '',
        'mes' => $data['mes'] ?? '',
        'marcas' => $data['marcas'] ?? [],
        'calibres' => $data['calibres'] ?? [],
        'cantidades' => $data['cantidades'] ?? [],
        'observaciones' => $data['observaciones'] ?? ''
    ];

    // Guardar
    file_put_contents($path, json_encode($reportes, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    echo json_encode(['status' => 'ok', 'message' => 'Reporte BPA-1 recibido por el supervisor']);
}
// ==============================
// 🧩 ACTUALIZACIÓN AJAX BPA-1
// ==============================
public function listarBpaAjax() {
    header('Content-Type: application/json');

    try {
        $ultimoId = isset($_GET['ultimoId']) ? intval($_GET['ultimoId']) : 0;
        $model = new SupervisorModel();
        $nuevos = $model->getNuevosBPA1($ultimoId);

        echo json_encode(['nuevos' => $nuevos]);
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }

    exit;
}
public function getProduccionJSON() {
    header('Content-Type: application/json; charset=utf-8');

    try {
        $data = $this->model->getResumenBpa1();

        // Validamos datos vacíos para no devolver null
        if (!$data) {
            $data = ['aprobado' => 0, 'pendiente' => 0];
        }

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }

    exit;
}
public function listarBPA2() {
    try {
        $reportes = $this->model->getTodosReportesBPA2();
        require_once __DIR__ . '/../views/supervisor/listar_bpa2.php';
    } catch (Exception $e) {
        error_log("Error en listarBPA2: " . $e->getMessage());
        echo "Error al cargar los reportes BPA-2.";
    }
}


public function listarBpa2Ajax() {
    header('Content-Type: application/json');
    $ultimoId = isset($_GET['ultimoId']) ? (int)$_GET['ultimoId'] : 0;
    $nuevos = $this->model->getNuevosReportesBPA2($ultimoId);
    echo json_encode(['nuevos' => $nuevos]);
}
// ==============================
// 📋 Listar todos los BPA-3 (Control de Medicamentos)
// ==============================
public function listarBPA3() {
    try {
        // Llamamos al modelo para traer todos los reportes BPA-3
        $reportes = $this->model->getTodosReportesBPA3();

        // Cargamos la vista
        require_once __DIR__ . '/../views/supervisor/listar_bpa3.php';
    } catch (Exception $e) {
        error_log("Error en listarBPA3: " . $e->getMessage());
        echo "Error al cargar los reportes BPA-3.";
    }
}

// ==============================
// ⚡ Versión AJAX BPA-3
// ==============================
public function listarBpa3Ajax() {
    header('Content-Type: application/json');
    try {
        $ultimoId = isset($_GET['ultimoId']) ? (int)$_GET['ultimoId'] : 0;
        $nuevos = $this->model->getNuevosReportesBPA3($ultimoId);
        echo json_encode(['nuevos' => $nuevos]);
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
    exit;
}
// ==============================
// 📋 Listar todos los BPA-4 (Control de Dosificación de Medicamentos)
// ==============================
public function listarBPA4() {
    try {
        // Llamamos al modelo para traer todos los reportes BPA-4
        $reportes = $this->model->getTodosReportesBPA4();

        // Cargamos la vista correspondiente
        require_once __DIR__ . '/../views/supervisor/listar_bpa4.php';
    } catch (Exception $e) {
        error_log("Error en listarBPA4: " . $e->getMessage());
        echo "Error al cargar los reportes BPA-4.";
    }
}

// ==============================
// ⚡ Versión AJAX BPA-4
// ==============================
public function listarBpa4Ajax() {
    header('Content-Type: application/json');
    try {
        $ultimoId = isset($_GET['ultimoId']) ? (int)$_GET['ultimoId'] : 0;
        $nuevos = $this->model->getNuevosReportesBPA4($ultimoId);
        echo json_encode(['nuevos' => $nuevos]);
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
    exit;
}
// ==============================
// 🥚 MÓDULO OVAS
// ==============================
public function ovas()
{
    require_once __DIR__ . '/../views/supervisor/ovas_general.php';
}
// ==============================
// 📋 Listar OVAS
// ==============================
public function listarOvas() {
    $reportes = $this->model->getTodosReportesOvas();
    require_once __DIR__ . '/../views/supervisor/listar_ovas.php';
}
// Lista BPA-1 (OVAS)
public function listarBPA1_OVAS()
{
    try {
        $reportes = $this->model->getBPA1_OVAS();
        require_once __DIR__ . '/../views/supervisor/listarbpa1_ovas.php';
    } catch (Exception $e) {
        error_log("Error listarBPA1_OVAS: " . $e->getMessage());
        echo "Error al cargar reportes BPA-1 OVAS.";
    }
}

// Ver detalle BPA-1 OVAS
public function bpa1Ovas()
{
    $id = $_GET['id'] ?? null;
    if (!$id) {
        echo "<script>alert('ID no especificado'); window.history.back();</script>";
        exit;
    }

    $detalle = $this->model->getDetalleBPA1_OVAS($id);
    if (!$detalle) {
        echo "<script>alert('Reporte no encontrado'); window.location.href='index.php?controller=Supervisor&action=listarBPA1_OVAS';</script>";
        exit;
    }

    require_once __DIR__ . '/../views/supervisor/detalle_bpa1_ovas.php';
}
public function listarBPA2_OVAS()
{
    $reportes = $this->model->getBPA2_OVAS();
    require_once __DIR__ . '/../views/supervisor/listarbpa2_ovas.php';
}

public function bpa2Ovas()
{
    $id = $_GET['id'] ?? null;

    if (!$id) {
        echo "<script>alert('ID no enviado'); window.history.back();</script>";
        exit;
    }

    $detalle = $this->model->getDetalleBPA2_OVAS($id);

    if (!$detalle) {
        echo "<script>alert('Reporte no encontrado'); window.location.href='index.php?controller=Supervisor&action=listarBPA2_OVAS';</script>";
        exit;
    }

    require_once __DIR__ . '/../views/supervisor/detalle_bpa2_ovas.php';
}
// LISTAR BPA-3 OVAS
public function listarBPA3_OVAS()
{
    try {
        $reportes = $this->model->getBPA3_OVAS();
        require_once __DIR__ . '/../views/supervisor/listarbpa3_ovas.php';
    } catch (Exception $e) {
        error_log("Error listarBPA3_OVAS: ".$e->getMessage());
        echo "Error al cargar reportes BPA-3 OVAS.";
    }
}

// DETALLE BPA-3 OVAS
public function bpa3Ovas()
{
    $id = $_GET['id'] ?? null;

    if (!$id) {
        echo "<script>alert('ID no especificado'); window.history.back();</script>";
        exit;
    }

    $detalle = $this->model->getDetalleBPA3_OVAS($id);

    if (!$detalle) {
        echo "<script>alert('Reporte no encontrado'); window.location.href='index.php?controller=Supervisor&action=listarBPA3_OVAS';</script>";
        exit;
    }

    require_once __DIR__ . '/../views/supervisor/detalle_bpa3_ovas.php';
}
// Listar BPA-4 OVAS
public function listarBPA4_OVAS()
{
    try {
        $reportes = $this->model->getBPA4_OVAS();
        require_once __DIR__ . '/../views/supervisor/listarbpa4_ovas.php';
    } catch (Exception $e) {
        error_log("Error listarBPA4_OVAS: " . $e->getMessage());
        echo "Error al cargar reportes BPA-4 OVAS.";
    }
}

// Ver detalle BPA-4 OVAS
public function bpa4Ovas()
{
    $id = $_GET['id'] ?? null;
    if (!$id) {
        echo "<script>alert('ID no especificado'); history.back();</script>";
        exit;
    }

    $detalle = $this->model->getDetalleBPA4_OVAS($id);

    if (!$detalle) {
        echo "<script>alert('Registro no encontrado'); window.location.href='index.php?controller=Supervisor&action=listarBPA4_OVAS';</script>";
        exit;
    }

    require_once __DIR__ . '/../views/supervisor/detalle_bpa4_ovas.php';
}
public function listaGlobal() {
    $filtro = $_GET['filtro'] ?? 'dia';
    $fecha = $_GET['fecha'] ?? null; // ✅ Capturamos la fecha del input
    $reportes = $this->model->getListaGlobalBPA($filtro, $fecha);
    $this->view("supervisor/lista_global_bpa", compact("reportes", "filtro", "fecha"));
}

public function verDetallesBPA() {
    $tipo = $_GET['tipo'] ?? '';
    $id = $_GET['id'] ?? 0;

    if (!$tipo || !$id) {
        echo "<p>Error: datos incompletos.</p>";
        return;
    }

    // Determinar la tabla según el tipo de BPA
    switch ($tipo) {
        case 'BPA-1':
            $tabla = 'control_alimento_almacen';
            break;
        case 'BPA-2':
            $tabla = 'control_sal_almacen';
            break;
        case 'BPA-3':
            $tabla = 'control_producto_terminado';
            break;
        case 'BPA-4':
            $tabla = 'control_empaque';
            break;
        default:
            echo "<p>Tipo de formulario no válido.</p>";
            return;
    }

    $detalle = $this->model->getDetalleBPAGeneral($tabla, $id);
    $this->view("supervisor/detalle_bpa", compact("detalle", "tipo", "tabla"));
}
public function actualizarEstadoBPA() {
    $tipo = $_POST['tipo'] ?? '';
    $id = $_POST['id'] ?? 0;
    $estado = $_POST['estado'] ?? '';

    // 🔍 DEPURAR
    error_log("Tipo: $tipo | ID: $id | Estado: $estado");

    if (!$tipo || !$id || !$estado) {
        echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
        return;
    }

    switch ($tipo) {
        case 'BPA-1':
            $tabla = 'control_alimento_almacen';
            break;
        case 'BPA-2':
            $tabla = 'control_sal_almacen';
            break;
        case 'BPA-3':
            $tabla = 'control_producto_terminado';
            break;
        case 'BPA-4':
            $tabla = 'control_empaque';
            break;
        default:
            echo json_encode(['success' => false, 'message' => 'Tipo inválido']);
            return;
    }

    $ok = $this->model->actualizarEstado($tabla, $id, $estado);

    // 🔍 DEPURAR
    error_log("UPDATE resultado: " . ($ok ? 'éxito' : 'falló'));

    echo json_encode(['success' => $ok]);
}



}
