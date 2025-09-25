<?php

class Router {
    public function handleRequest() {
        // Controlador y acción por defecto
        $controllerName = isset($_GET['controller']) ? $_GET['controller'] : 'Auth';
        $action = isset($_GET['action']) ? $_GET['action'] : 'login';

        // Construir nombre del archivo y clase
        $controllerFile = __DIR__ . '/../controllers/' . $controllerName . 'Controller.php';
        $controllerClass = $controllerName . 'Controller';

        if (file_exists($controllerFile)) {
            require_once $controllerFile;

            if (class_exists($controllerClass)) {
                $controller = new $controllerClass();

                if (method_exists($controller, $action)) {
                    $controller->$action();
                } else {
                    echo "Método <b>$action</b> no encontrado en <b>$controllerClass</b>";
                }
            } else {
                echo "Clase <b>$controllerClass</b> no existe.";
            }
        } else {
            echo "Controlador <b>$controllerName</b> no encontrado.";
        }
    }
}
