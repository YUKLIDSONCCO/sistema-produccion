<?php

class Router {
    public function handleRequest() {
        // Controlador y acción por defecto
        $controllerName = isset($_GET['controller']) ? ucfirst($_GET['controller']) : 'Auth';
        $action = isset($_GET['action']) ? $_GET['action'] : 'login';

        // Construir nombre del archivo y clase
        $controllerFile = __DIR__ . '/../controllers/' . $controllerName . 'Controller.php';
        $controllerClass = $controllerName . 'Controller';

        if (!file_exists($controllerFile)) {
            $this->error("Controlador <b>$controllerName</b> no encontrado.");
            return;
        }

        require_once $controllerFile;

        if (!class_exists($controllerClass)) {
            $this->error("Clase <b>$controllerClass</b> no existe.");
            return;
        }

        $controller = new $controllerClass();

        if (!method_exists($controller, $action)) {
            $this->error("Método <b>$action</b> no encontrado en <b>$controllerClass</b>");
            return;
        }

        // Ejecutar el método del controlador
        $controller->$action();
    }

    private function error($message) {
        // Puedes cambiar esto por una vista de error personalizada
        echo "<div style='font-family:Arial; color:#c00; padding:20px;'>
                <h2>Error en el enrutador</h2>
                <p>$message</p>
                <a href='index.php'>Volver al inicio</a>
              </div>";
    }
}
