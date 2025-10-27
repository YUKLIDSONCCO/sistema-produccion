<?php
// ==========================================
// 🚀 SISTEMA PRODUCCIÓN - FRONT CONTROLLER
// ==========================================

require_once __DIR__ . '/../core/Session.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../core/Router.php';

// Iniciar sesión y bloquear cache
Session::init();

// ==========================================
// 🔓 ACCESO LIBRE TEMPORAL (sin restricción de sesión)
// ==========================================
// 🔸 Se desactiva la validación de sesión para desarrollo
/*
$publicControllers = ['Auth'];
$controller = $_GET['controller'] ?? '';
$action = $_GET['action'] ?? '';

if (!in_array($controller, $publicControllers)) {
    if (!Session::has('usuario')) {
        header("Location: /sistema-produccion/public/Auth/login");
        exit;
    }
}
*/

// ==========================================
// 🧹 LIMPIAR URLS CON index.php
// ==========================================
$basePath = '/sistema-produccion/public/';
$requestUri = $_SERVER['REQUEST_URI'] ?? '';
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

if ($method === 'GET' && stripos($requestUri, 'index.php') !== false) {
    $controllerClean = ucfirst($_GET['controller'] ?? '');
    $actionClean = $_GET['action'] ?? '';

    $target = rtrim($basePath, '/');
    if ($controllerClean && $actionClean) {
        $target .= '/' . $controllerClean . '/' . $actionClean;
    }

    header("Location: $target", true, 301);
    exit;
}

if ($method === 'POST' && stripos($requestUri, 'index.php') !== false) {
    $allowedPosts = [
        'Auth' => ['login', 'register']
    ];
    $allowed = (isset($allowedPosts[$controller]) && in_array($action, $allowedPosts[$controller]));
    if (!$allowed) {
        http_response_code(403);
        echo "403 Forbidden - acceso directo a index.php no permitido.";
        exit;
    }
}

// ==========================================
// 🚦 CARGAR APLICACIÓN MVC
// ==========================================
$router = new Router();
$router->handleRequest();

// ==========================================
// 🧠 SE QUITA BLOQUEO DE NAVEGACIÓN (JS)
// ==========================================
// 🔸 Ya no se bloquea el botón atrás o adelante del navegador.
// Si deseas reactivarlo, descomenta el siguiente bloque:
/*
<script>
  history.pushState(null, null, location.href);
  window.onpopstate = function () {
    history.go(1);
  };
</script>
*/
?>
