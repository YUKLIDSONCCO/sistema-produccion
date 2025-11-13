<?php
// ==========================================
// 🚀 SISTEMA PRODUCCIÓN - FRONT CONTROLLER
// ==========================================
require_once __DIR__ . '/../core/Session.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../core/Router.php';

$router = new Router();
$router->handleRequest();

?>
