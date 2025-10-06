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
        $query = "SELECT u.id_usuario, u.nombre, u.correo, r.nombre AS rol, u.estado, u.fecha_creacion 
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
    public function registrarUsuario($nombre, $correo, $password, $rol) {
        try {
            $query = "INSERT INTO usuarios (nombre, correo, password, id_rol, estado) 
                      VALUES (:nombre, :correo, :password, :rol, 'suspendido')";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':correo', $correo);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':rol', $rol);
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
}
?>