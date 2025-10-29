<?php
require_once "../config/database.php";
require_once "../models/InventarioModel.php";
class InventarioController {

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

        $sql = "SELECT fecha, sede, encargado, mes, marca, calibre, cantidad, nombre, obs 
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
    public function guardarBPA1() {
    require_once "../config/database.php";
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $fecha = $_POST['fecha'] ?? '';
        $sede = $_POST['sede'] ?? '';
        $encargado = $_POST['encargado'] ?? '';
        $mes = $_POST['mes'] ?? '';
        
        // Obtener los arrays de datos de la tabla
        $marcas = $_POST['marca'] ?? [];
        $calibres = $_POST['calibre'] ?? [];
        $cantidades = $_POST['cantidad'] ?? [];
        $nombres = $_POST['nombre_alimento'] ?? [];
        $observaciones = $_POST['observaciones'] ?? [];
        
        // Crear conexión PDO
        $database = new Database();
        $conn = $database->getConnection();
        $successCount = 0;
        
        // Insertar cada fila de la tabla
        for ($i = 0; $i < count($marcas); $i++) {
            $marca = $marcas[$i] ?? '';
            $calibre = $calibres[$i] ?? '';
            $cantidad = $cantidades[$i] ?? 0;
            $nombre_alimento = $nombres[$i] ?? '';
            $obs = $observaciones[$i] ?? '';
            
            if (!empty($marca) && !empty($cantidad)) {
                $sql = "INSERT INTO control_alimento_almacen 
                        (fecha, sede, encargado, mes, marca, calibre, cantidad, nombre_alimento, observaciones) 
                        VALUES (:fecha, :sede, :encargado, :mes, :marca, :calibre, :cantidad, :nombre_alimento, :observaciones)";
                
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(":fecha", $fecha);
                $stmt->bindParam(":sede", $sede);
                $stmt->bindParam(":encargado", $encargado);
                $stmt->bindParam(":mes", $mes);
                $stmt->bindParam(":marca", $marca);
                $stmt->bindParam(":calibre", $calibre);
                $stmt->bindParam(":cantidad", $cantidad);
                $stmt->bindParam(":nombre_alimento", $nombre_alimento);
                $stmt->bindParam(":observaciones", $obs);
                
                if ($stmt->execute()) {
                    $successCount++;
                }
            }
        }
        
        // Redirigir después de guardar
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
    $model = new InventarioModel($conn);
    $stmt = $model->obtenerListadoBPA1PorFecha($fecha);
    
    $datos = [];
    if ($stmt) {
        $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Pasar la fecha de búsqueda a la vista
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
                if ($model->guardarBPA2($fecha, $sede, $encargado, $mes, $cantidad, $nombre_sal, $obs)) {
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
    require_once "../config/database.php";
    $fecha = isset($_GET['fecha']) ? $_GET['fecha'] : date('Y-m-d');
    
    $database = new Database();
    $conn = $database->getConnection();
    $model = new InventarioModel($conn);
    $stmt = $model->obtenerListadoBPA2PorFecha($fecha);
    
    $datos = [];
    if ($stmt) {
        $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Pasar la fecha de búsqueda a la vista
    $fechaBusqueda = $fecha;
    
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

public function guardarBPA3() {
    require_once "../config/database.php";
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $fecha = $_POST['fecha'] ?? '';
        $sede = $_POST['sede'] ?? '';
        $encargado = $_POST['encargado'] ?? '';
        $mes = $_POST['mes'] ?? '';
        
        // Obtener los arrays de datos de la tabla
        $medicamentos = $_POST['medicamento_suplemento'] ?? [];
        $cantidades = $_POST['cantidad'] ?? [];
        $nombres_empleado = $_POST['nombre_empleado'] ?? [];
        $observaciones = $_POST['observaciones'] ?? [];
        
        // Crear conexión PDO
        $database = new Database();
        $conn = $database->getConnection();
        $model = new InventarioModel($conn);
        $successCount = 0;
        
        // Insertar cada fila de la tabla
        for ($i = 0; $i < count($medicamentos); $i++) {
            $medicamento_suplemento = $medicamentos[$i] ?? '';
            $cantidad = $cantidades[$i] ?? 0;
            $nombre_empleado = $nombres_empleado[$i] ?? '';
            $obs = $observaciones[$i] ?? '';
            
            if (!empty($medicamento_suplemento) && !empty($cantidad)) {
                if ($model->guardarBPA3($fecha, $sede, $encargado, $mes, $medicamento_suplemento, $cantidad, $nombre_empleado, $obs)) {
                    $successCount++;
                }
            }
        }
        
        // Redirigir después de guardar
        if ($successCount > 0) {
            header("Location: /sistema-produccion/public/Inventario/bpa3?success=" . $successCount);
        } else {
            header("Location: /sistema-produccion/public/Inventario/bpa3?error=1");
        }
        exit;
    }
}

public function listarBPA3() {
    require_once "../config/database.php";
    $fecha = isset($_GET['fecha']) ? $_GET['fecha'] : date('Y-m-d');
    
    $database = new Database();
    $conn = $database->getConnection();
    $model = new InventarioModel($conn);
    $stmt = $model->obtenerListadoBPA3PorFecha($fecha);
    
    $datos = [];
    if ($stmt) {
        $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Pasar la fecha de búsqueda a la vista
    $fechaBusqueda = $fecha;
    
    include "../views/jefeplanta/modulos-jefeplanta/inventario/lista3.php";
}

    public function obtenerDatosBPA3() {
        global $conexion;

        $sql = "SELECT fecha, medicamento, cantidad, nombre, observaciones 
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
        
        // Obtener los arrays de datos de la tabla
        $medicamentos = $_POST['medicamento_suplemento'] ?? [];
        $dosis_gr = $_POST['dosis_gr'] ?? [];
        $dias_tratamiento = $_POST['dias_tratamiento'] ?? [];
        $lotes_alevines = $_POST['lote_alevines'] ?? [];
        $salas = $_POST['sala'] ?? [];
        $responsables = $_POST['responsable'] ?? [];
        $observaciones = $_POST['observaciones'] ?? [];
        
        // Crear conexión PDO
        $database = new Database();
        $conn = $database->getConnection();
        $model = new InventarioModel($conn);
        $successCount = 0;
        
        // Insertar cada fila de la tabla
        for ($i = 0; $i < count($medicamentos); $i++) {
            $medicamento_suplemento = $medicamentos[$i] ?? '';
            $dosis = $dosis_gr[$i] ?? 0;
            $dias = $dias_tratamiento[$i] ?? 0;
            $lote_alevines = $lotes_alevines[$i] ?? '';
            $sala = $salas[$i] ?? '';
            $responsable = $responsables[$i] ?? '';
            $obs = $observaciones[$i] ?? '';
            
            if (!empty($medicamento_suplemento) && !empty($dosis)) {
                if ($model->guardarBPA4($fecha, $medicamento_suplemento, $dosis, $dias, $lote_alevines, $sala, $responsable, $obs)) {
                    $successCount++;
                }
            }
        }
        
        // Redirigir después de guardar
        if ($successCount > 0) {
            header("Location: /sistema-produccion/public/Inventario/bpa4?success=" . $successCount);
        } else {
            header("Location: /sistema-produccion/public/Inventario/bpa4?error=1");
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
