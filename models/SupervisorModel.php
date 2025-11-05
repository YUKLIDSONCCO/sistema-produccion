<?php
require_once "BaseModel.php";

class SupervisorModel extends BaseModel {


    public function getResumenProduccion() {
        $sql = "SELECT COUNT(*) AS total_lotes, SUM(cantidad) AS total_producido 
                FROM produccion 
                WHERE estado = 'En Proceso'";
        $stmt = $this->conn->query($sql);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: ["total_lotes" => 0, "total_producido" => 0];
    }


    public function getInsumosAsignados() {
        $sql = "SELECT nombre, stock, unidad_medida 
                FROM insumos 
                WHERE stock > 0 
                ORDER BY nombre ASC";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ==============================
    // 3️⃣ Personal en turno
    // ==============================
    public function getPersonalEnTurno() {
        $sql = "SELECT nombre, rol, turno 
                FROM trabajadores 
                WHERE activo = 1 
                ORDER BY nombre ASC";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ==============================
    // 4️⃣ Reportes BPA-1 pendientes
    // ==============================
    public function getBPA1Pendientes() {
    $sql = "SELECT 
                b.id,
                b.sede,
                b.encargado,
                b.fecha,
                b.mes,
                b.estado,
                COALESCE(u.nombre, '—') AS registrado_por
            FROM control_alimento_almacen b
            LEFT JOIN usuarios u ON u.id_usuario = b.id_usuario
            WHERE b.revisado = 0
            ORDER BY b.fecha DESC";

    $stmt = $this->conn->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}




    // ==============================
    // 5️⃣ Reportes BPA-2 pendientes
    // ==============================
    public function getBPA2Pendientes() {
        $sql = "SELECT id, sede, encargado, fecha, mes, estado 
                FROM control_alimento_proceso
                WHERE revisado = 0
                ORDER BY fecha DESC";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ==============================
    // 6️⃣ Reportes BPA-3 pendientes
    // ==============================
    public function getBPA3Pendientes() {
        $sql = "SELECT id, sede, encargado, fecha, mes, estado 
                FROM control_producto_terminado
                WHERE revisado = 0
                ORDER BY fecha DESC";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // ✅ Reportes BPA-4 pendientes
public function getBPA4Pendientes() {
    $sql = "SELECT id, sede, encargado, fecha, mes 
            FROM control_empaque
            WHERE revisado = 0
            ORDER BY fecha DESC";
    $stmt = $this->conn->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


    // ==============================
    // 8️⃣ Obtener detalle de BPA
    // ==============================
    public function getDetalleBPA($tabla, $id) {
    $sql = "SELECT * FROM {$tabla} WHERE id = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    $reporte = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$reporte) {
        return null;
    }

    return [
        'id' => $reporte['id'],
        'fecha' => $reporte['fecha'],
        'sede' => $reporte['sede'] ?? '',
        'encargado' => $reporte['encargado'] ?? '',
        'mes' => $reporte['mes'] ?? '',
        'datos' => [$reporte] // puedes ajustar esto si agregas más filas relacionadas
    ];
}


    // ==============================
    // 9️⃣ Actualizar estado BPA (Aprobado/Rechazado)
    // ==============================
    public function actualizarEstadoBPA($tablaControl, $id, $accion, $comentarios) {
        $estado = ($accion === 'aprobar') ? 'Aprobado' : 'Rechazado';
        $sql = "UPDATE {$tablaControl} 
                SET revisado = 1,
                    estado = :estado,
                    comentarios_supervisor = :comentarios,
                    fecha_revision = NOW()
                WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':estado' => $estado,
            ':comentarios' => $comentarios,
            ':id' => $id
        ]);
    }
    public function getReportesBPA1Pendientes()
{
    $sql = "SELECT b.id, b.sede, b.encargado, b.fecha, b.mes, b.estado,
               u.nombre AS registrado_por
        FROM bpa1 b
        LEFT JOIN usuarios u ON u.id = b.id_usuario
        WHERE b.estado = 'Pendiente'
        ORDER BY b.fecha DESC";

    $stmt = $this->conn->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
public function guardarBPA1()
{
    // Aseguramos que la sesión esté activa
    session_start();

    // Obtenemos el ID del usuario que está llenando el formulario
    $id_usuario = $_SESSION['usuario_id'] ?? null;

    // Validamos que exista un usuario logueado
    if (!$id_usuario) {
        die("Error: No hay usuario en sesión. Inicia sesión nuevamente.");
    }

    // Verificamos que los datos vengan del formulario
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        // Preparamos el SQL con el campo id_usuario incluido
        $sql = "INSERT INTO control_alimento_almacen 
                    (fecha, sede, encargado, mes, marca, calibre, cantidad, nombre_alimento, observaciones, id_usuario)
                VALUES 
                    (:fecha, :sede, :encargado, :mes, :marca, :calibre, :cantidad, :nombre_alimento, :observaciones, :id_usuario)";

        $stmt = $this->conn->prepare($sql);

        // Obtenemos los valores comunes
        $fecha = $_POST['fecha'] ?? date('Y-m-d');
        $sede = $_POST['sede'] ?? '';
        $encargado = $_POST['encargado'] ?? '';
        $mes = $_POST['mes'] ?? '';

        // Campos que pueden venir en arrays (varios registros)
        $marcas = $_POST['marca'] ?? [];
        $calibres = $_POST['calibre'] ?? [];
        $cantidades = $_POST['cantidad'] ?? [];
        $alimentos = $_POST['nombre_alimento'] ?? [];
        $observaciones = $_POST['observaciones'] ?? [];

        // Insertamos cada registro BPA1
        for ($i = 0; $i < count($alimentos); $i++) {
            $stmt->bindParam(":fecha", $fecha);
            $stmt->bindParam(":sede", $sede);
            $stmt->bindParam(":encargado", $encargado);
            $stmt->bindParam(":mes", $mes);
            $stmt->bindParam(":marca", $marcas[$i]);
            $stmt->bindParam(":calibre", $calibres[$i]);
            $stmt->bindParam(":cantidad", $cantidades[$i]);
            $stmt->bindParam(":nombre_alimento", $alimentos[$i]);
            $stmt->bindParam(":observaciones", $observaciones[$i]);
            $stmt->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);

            $stmt->execute();
        }

        // Redirigimos a la vista del supervisor
        header("Location: index.php?controller=Supervisor&action=listarBPA1");
        exit;
    }
}
public function getTodosReportesBPA1() {
    $sql = "SELECT 
                id,
                fecha,
                sede,
                encargado,
                mes,
                marca,
                calibre,
                cantidad,
                nombre_alimento,
                observaciones,
                estado,
                id_usuario,
                fecha_registro,
                id_sede,
                id_lote,
                id_especie,
                revisado,
                fecha_revision
            FROM control_alimento_almacen
            ORDER BY fecha_registro DESC, id DESC";
    
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
    // ==============================
    // 🔁 Reportes BPA-1 nuevos desde cierto ID (para AJAX)
    // ==============================
    public function getNuevosBPA1($ultimoId) {
        $sql = "SELECT 
                    id,
                    fecha,
                    sede,
                    encargado,
                    mes,
                    marca,
                    calibre,
                    cantidad,
                    nombre_alimento,
                    observaciones,
                    estado,
                    fecha_registro,
                    revisado
                FROM control_alimento_almacen
                WHERE id > :ultimoId
                ORDER BY id DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':ultimoId', $ultimoId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // ==============================
// 🔹 Resumen de estados BPA-1 (Aprobado/Pendiente)
// ==============================
public function getResumenBpa1() {
    $sql = "SELECT 
                SUM(CASE WHEN estado = 'Aprobado' THEN 1 ELSE 0 END) AS aprobado,
                SUM(CASE WHEN estado = 'Pendiente' THEN 1 ELSE 0 END) AS pendiente
            FROM control_alimento_almacen";
    $stmt = $this->conn->query($sql);
    return $stmt->fetch(PDO::FETCH_ASSOC) ?: ['aprobado' => 0, 'pendiente' => 0];
}
public function getGraficoProduccion() {
    $sql = "SELECT mes AS label, SUM(cantidad) AS value 
            FROM produccion 
            WHERE YEAR(fecha) = YEAR(CURDATE())
            GROUP BY mes ORDER BY mes ASC";
    $stmt = $this->conn->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
public function getTodosReportesBPA2() {
    try {
        $sql = "SELECT id, fecha, sede, encargado, mes, cantidad, nombre_sal, observaciones, 
                       estado, revisado, fecha_registro
                FROM control_sal_almacen
                ORDER BY fecha_registro DESC, id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error en getTodosReportesBPA2: " . $e->getMessage());
        return [];
    }
}
public function getNuevosReportesBPA2($ultimoId) {
    try {
        $sql = "SELECT 
                    id,
                    fecha,
                    sede,
                    encargado,
                    mes,
                    nombre_sal,
                    cantidad,
                    observaciones,
                    estado,
                    revisado,
                    fecha_revision,
                    fecha_registro
                FROM control_sal_almacen
                WHERE id > :ultimoId
                ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':ultimoId', $ultimoId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log('Error en getNuevosReportesBPA2: ' . $e->getMessage());
        return [];
    }
}

public function getTodosReportesBPA3() {
    try {
        $sql = "SELECT 
                    id,
                    fecha,
                    sede,
                    encargado,
                    mes,
                    medicamento_suplemento,
                    cantidad,
                    nombre_empleado,
                    observaciones,
                    estado,
                    revisado,
                    fecha_revision,
                    fecha_registro
                FROM control_medicamento
                ORDER BY fecha_registro DESC, id DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log('Error en getTodosReportesBPA3: ' . $e->getMessage());
        return [];
    }
}


public function getNuevosReportesBPA3($ultimoId) {
    try {
        $sql = "SELECT 
                    id,
                    fecha,
                    sede,
                    encargado,
                    mes,
                    medicamento_suplemento,
                    cantidad,
                    nombre_empleado,
                    observaciones,
                    estado,
                    revisado,
                    fecha_revision,
                    fecha_registro
                FROM control_medicamento
                WHERE id > :ultimoId
                ORDER BY id DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':ultimoId', $ultimoId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        error_log('Error en getNuevosReportesBPA3: ' . $e->getMessage());
        return [];
    }
}

// ==============================
// 📊 Obtener todos los reportes BPA-4 (Control de Dosificación)
// ==============================
public function getTodosReportesBPA4() {
    try {
        $sql = "SELECT 
                    id,
                    fecha,
                    medicamento_suplemento,
                    dosis_gr,
                    dias_tratamiento,
                    lote_alevines,
                    sala,
                    responsable,
                    registro_diario,
                    observaciones,
                    fecha_registro
                FROM control_dosificacion
                ORDER BY fecha_registro DESC, id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log('Error en getTodosReportesBPA4: ' . $e->getMessage());
        return [];
    }
}

// ==============================
// ⚡ Nuevos reportes BPA-4 (para AJAX)
// ==============================
public function getNuevosReportesBPA4($ultimoId) {
    try {
        $sql = "SELECT 
                    id,
                    fecha,
                    medicamento_suplemento,
                    dosis_gr,
                    dias_tratamiento,
                    lote_alevines,
                    sala,
                    responsable,
                    registro_diario,
                    observaciones,
                    fecha_registro
                FROM control_dosificacion
                WHERE id > :ultimoId
                ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':ultimoId', $ultimoId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log('Error en getNuevosReportesBPA4: ' . $e->getMessage());
        return [];
    }
}
// ==============================
// 🥚 Listar selección y fertilización de OVAS
// ==============================
public function getTodosReportesOvas() {
    $sql = "SELECT 
                id,
                codigo_formato,
                version,
                fecha_registro,
                ambito_aplicacion,
                responsable,
                hora_inicio,
                hora_final,
                cantidad_hembras_aptas,
                cantidad_machos_aptos,
                cantidad_hembras_desovadas,
                cantidad_machos_desovados,
                relacion_hembras_machos,
                volumen_ovulos_fertilizados,
                cantidad_ovas_fertiles,
                observaciones,
                id_lote,
                id_especie,
                id_sede,
                creado_en
            FROM seleccion_fertilizacion_ovas
            ORDER BY fecha_registro DESC, id DESC";
    
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
// Obtener todos los reportes BPA-1 (OVAS)
public function getBPA1_OVAS()
{
    try {
        $sql = "SELECT *
                FROM seleccion_fertilizacion_ovas
                ORDER BY fecha_registro DESC, id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error en getBPA1_OVAS: " . $e->getMessage());
        return [];
    }
}

// Obtener detalle de un BPA-1 OVAS por id
public function getDetalleBPA1_OVAS($id)
{
    try {
        $sql = "SELECT * FROM seleccion_fertilizacion_ovas WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error en getDetalleBPA1_OVAS: " . $e->getMessage());
        return null;
    }
}
public function getBPA2_OVAS()
{
    $sql = "SELECT * FROM mortalidad_diaria_ovas ORDER BY fecha_registro DESC, id DESC";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function getDetalleBPA2_OVAS($id)
{
    $sql = "SELECT * FROM mortalidad_diaria_ovas WHERE id = :id LIMIT 1";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
// Obtener todos los reportes BPA-3 (OVAS Larvas)
public function getBPA3_OVAS()
{
    try {
        $sql = "SELECT *
                FROM mortalidad_diaria_larvas
                ORDER BY fecha_registro DESC, id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error getBPA3_OVAS: " . $e->getMessage());
        return [];
    }
}

// Obtener detalle BPA-3 OVAS
public function getDetalleBPA3_OVAS($id)
{
    try {
        $sql = "SELECT * FROM mortalidad_diaria_larvas WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error getDetalleBPA3_OVAS: " . $e->getMessage());
        return null;
    }
}
// Obtener BPA-4 OVAS
public function getBPA4_OVAS()
{
    try {
        $sql = "SELECT * FROM control_diario_parametros_ovas ORDER BY fecha_registro DESC, id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error getBPA4_OVAS: " . $e->getMessage());
        return [];
    }
}

// Obtener detalle por ID
public function getDetalleBPA4_OVAS($id)
{
    try {
        $sql = "SELECT * FROM control_diario_parametros_ovas WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error getDetalleBPA4_OVAS: " . $e->getMessage());
        return null;
    }
}

}
