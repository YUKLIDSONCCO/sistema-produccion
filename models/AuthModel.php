<?php
require_once "BaseModel.php";

class AuthModel extends BaseModel {
    public function login($usuario, $password) {
        $stmt = $this->conn->prepare("SELECT * FROM usuarios WHERE correo = :usuario LIMIT 1");
        $stmt->bindParam(":usuario", $usuario);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }
}
?>
