<?php

class Router {
    public function handleRequest() {
        // 🔹 SOPORTE PARA RUTAS LIMPIAS (sin ?controller= ni ?action=)
        if (!isset($_GET['controller']) && !isset($_GET['action'])) {
            $uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
            $segments = explode('/', $uri);

            // Buscar la carpeta "public" para obtener los valores correctos
            $publicIndex = array_search('public', $segments);
            if ($publicIndex !== false) {
                $controller = $segments[$publicIndex + 1] ?? '';
                $action = $segments[$publicIndex + 2] ?? '';

                if ($controller) $_GET['controller'] = ucfirst($controller);
                if ($action) $_GET['action'] = $action;
            }
        }

        // Controlador y acción por defecto
        $controllerName = isset($_GET['controller']) ? ucfirst($_GET['controller']) : 'Auth';
        $action = isset($_GET['action']) ? $_GET['action'] : 'login';

        // 🔒 Iniciar sesión si no está iniciada
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // 🔒 Protección: si no hay usuario y no está en Auth/login o Auth/register, redirigir
        if (
            (!isset($_SESSION['usuario'])) &&
            !($controllerName === 'Auth' && in_array($action, ['login', 'register']))
        ) {
            header("Location: /sistema-produccion/public/Auth/login");
            exit;
        }

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

        // ✅ Ejecutar el método del controlador
        $controller->$action();
    }

    private function error($message) {
        echo "<div style='font-family:Arial; color:#c00; padding:20px;'>
                <h2>Error en el enrutador</h2>
                <p>$message</p>
                <a href='/sistema-produccion/public/Auth/login'>Volver al inicio</a>
              </div>";
    }
}
