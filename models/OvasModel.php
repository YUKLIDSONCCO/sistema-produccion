<?php
class OvasModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // === BPA 1 ===
    public function obtenerListadoBPA1PorFecha($fecha) {
        $sql = "SELECT * FROM bpa1 WHERE fecha = :fecha";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->execute();
        return $stmt;
    }

    // === BPA 2 ===
    public function obtenerListadoBPA2PorFecha($fecha) {
        $sql = "SELECT * FROM bpa2 WHERE fecha = :fecha";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->execute();
        return $stmt;
    }

    // === BPA 3 ===
    public function obtenerListadoBPA3PorFecha($fecha) {
        $sql = "SELECT * FROM bpa3 WHERE fecha = :fecha";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->execute();
        return $stmt;
    }

    // === BPA 4 ===
    public function obtenerListadoBPA4PorFecha($fecha) {
        $sql = "SELECT * FROM bpa4 WHERE fecha = :fecha";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->execute();
        return $stmt;
    }
}
?>
