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
    $fecha = isset($_GET['fecha']) ? $_GET['fecha'] : date('Y-m-d');

    $database = new Database();
    $conn = $database->getConnection();
    $sql = "SELECT 
            id,
            fecha,
            marca,
            calibre,
            cantidad,
            nombre_alimento AS nombre,
            observaciones AS obs
        FROM control_alimento_almacen
        WHERE estado = 'pendiente'
        ORDER BY fecha DESC";



    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $fecha = $_POST['fecha'] ?? '';
        $sede = $_POST['sede'] ?? '';
        $encargado = $_POST['encargado'] ?? '';
        $mes = $_POST['mes'] ?? '';
        
        // Obtener los arrays de datos de la tabla
        $medicamentos = $_POST['medicamento_suplemento'] ?? [];
        $dosis_gr = $_POST['dosis_gr'] ?? [];
        $dias_tratamiento = $_POST['dias_tratamiento'] ?? [];
        $lotes_alevines = $_POST['lote_alevines'] ?? [];
        $salas = $_POST['sala'] ?? [];
        $responsables = $_POST['responsable'] ?? [];
        $observaciones = $_POST['observaciones'] ?? [];
        
        // Validar campos obligatorios
        if (empty($fecha) || empty($sede) || empty($encargado) || empty($mes)) {
            header("Location: /sistema-produccion/public/Inventario/bpa4?error=1&message=Complete todos los campos del formulario");
            exit;
        }
        
        // Crear conexión PDO
        $database = new Database();
        $conn = $database->getConnection();
        $model = new InventarioModel($conn);
        $successCount = 0;
        
        // Insertar cada fila de la tabla
        for ($i = 0; $i < count($medicamentos); $i++) {
            $medicamento_suplemento = trim($medicamentos[$i] ?? '');
            $dosis = $dosis_gr[$i] ?? 0;
            $dias = $dias_tratamiento[$i] ?? 0;
            $lote_alevines_val = trim($lotes_alevines[$i] ?? '');
            $sala_val = trim($salas[$i] ?? '');
            $responsable_val = trim($responsables[$i] ?? '');
            $obs = trim($observaciones[$i] ?? '');
            
            // Validar que tenga al menos medicamento y dosis
            if (!empty($medicamento_suplemento) && !empty($dosis)) {
                if ($model->guardarBPA4($fecha, $medicamento_suplemento, $dosis, $dias, $lote_alevines_val, $sala_val, $responsable_val, $obs)) {
                    $successCount++;
                }
            }
        }
        
        // Redirigir después de guardar
        if ($successCount > 0) {
            header("Location: /sistema-produccion/public/Inventario/bpa4?success=" . $successCount);
        } else {
            header("Location: /sistema-produccion/public/Inventario/bpa4?error=1&message=No se pudieron guardar los datos. Verifique que haya al menos una fila con medicamento y dosis válidos");
        }
        exit;
    }
}

public function listarBPA4() {
    require_once "../config/database.php";
    $fecha = isset($_GET['fecha']) ? $_GET['fecha'] : date('Y-m-d');
    
    $database = new Database();
    $conn = $database->getConnection();
    $model = new InventarioModel($conn);
    $stmt = $model->obtenerListadoBPA4PorFecha($fecha);
    
    $datos = [];
    if ($stmt) {
        $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Pasar la fecha de búsqueda a la vista
    $fechaBusqueda = $fecha;
    
    include "../views/jefeplanta/modulos-jefeplanta/inventario/lista4.php";
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
}
?>
