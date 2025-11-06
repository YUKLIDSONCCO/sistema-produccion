<?php
require_once __DIR__ . '/../config/database.php';

class AdminModel {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Obtener todos los usuarios con su rol
    public function obtenerUsuarios() {
        $query = "SELECT u.id_usuario, u.nombre, u.correo, r.nombre AS rol, u.estado, u.foto, u.fecha_creacion 
                  FROM usuarios u
                  INNER JOIN roles r ON u.id_rol = r.id_rol
                  ORDER BY u.id_usuario ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Verificar si el correo ya existe
    public function verificarCorreoExistente($correo) {
        $query = "SELECT id_usuario FROM usuarios WHERE correo = :correo";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':correo', $correo);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC) !== false;
    }

    // Registrar un nuevo usuario
    public function registrarUsuario($nombre, $correo, $password, $rol, $foto = null) {
        try {
            $query = "INSERT INTO usuarios (nombre, correo, password, id_rol, estado, foto) 
                      VALUES (:nombre, :correo, :password, :rol, 'suspendido', :foto)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':correo', $correo);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':rol', $rol);
            $stmt->bindParam(':foto', $foto);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error al registrar usuario: " . $e->getMessage());
            return false;
        }
    }

    // Cambiar estado del usuario (activar/suspender)
    public function cambiarEstadoUsuario($id_usuario, $estado) {
        try {
            $query = "UPDATE usuarios SET estado = :estado WHERE id_usuario = :id_usuario";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':estado', $estado);
            $stmt->bindParam(':id_usuario', $id_usuario);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error al cambiar estado: " . $e->getMessage());
            return false;
        }
    }

    // Actualizar datos del usuario
    public function actualizarUsuario($id, $nombre, $correo, $rol, $foto = null) {
        try {
            $sql = "UPDATE usuarios 
                    SET nombre = :nombre, correo = :correo, id_rol = :rol";
            if ($foto) $sql .= ", foto = :foto";
            $sql .= " WHERE id_usuario = :id";
            
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':correo', $correo);
            $stmt->bindParam(':rol', $rol);
            $stmt->bindParam(':id', $id);
            if ($foto) $stmt->bindParam(':foto', $foto);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error al actualizar usuario: " . $e->getMessage());
            return false;
        }
    }

    // Eliminar usuario
    public function eliminarUsuario($id) {
        try {
            $query = "DELETE FROM usuarios WHERE id_usuario = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error al eliminar usuario: " . $e->getMessage());
            return false;
        }
    }
    // Obtener roles disponibles
public function obtenerRoles() {
    try {
        $query = "SELECT id_rol, nombre FROM roles WHERE id_rol != 1 ORDER BY nombre ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error al obtener roles: " . $e->getMessage());
        return [];
    }
}
// En AdminModel.php - agregar estos métodos
public function obtenerEstadisticasDashboard() {
    try {
        $query = "SELECT 
                    COUNT(*) as total_usuarios,
                    SUM(CASE WHEN estado = 'activo' THEN 1 ELSE 0 END) as activos,
                    SUM(CASE WHEN estado = 'suspendido' THEN 1 ELSE 0 END) as suspendidos,
                    SUM(CASE WHEN estado = 'pendiente' THEN 1 ELSE 0 END) as pendientes
                  FROM usuarios";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error al obtener estadísticas: " . $e->getMessage());
        return ['total_usuarios' => 0, 'activos' => 0, 'suspendidos' => 0, 'pendientes' => 0];
    }
}

public function obtenerDistribucionRoles() {
    try {
        $query = "SELECT r.nombre as rol, COUNT(u.id_usuario) as cantidad
                  FROM roles r 
                  LEFT JOIN usuarios u ON r.id_rol = u.id_rol 
                  GROUP BY r.id_rol, r.nombre
                  ORDER BY cantidad DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error al obtener distribución de roles: " . $e->getMessage());
        return [];
    }
}

public function obtenerActividadReciente() {
    try {
        $query = "SELECT 
                    'Nuevo usuario registrado' as accion,
                    u.nombre as usuario,
                    u.fecha_creacion as fecha
                  FROM usuarios u 
                  ORDER BY u.fecha_creacion DESC 
                  LIMIT 5";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error al obtener actividad reciente: " . $e->getMessage());
        return [];
    }
}
}
?>
