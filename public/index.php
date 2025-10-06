<?php
session_start();

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../core/Router.php';
require_once __DIR__ . '/../core/Session.php';

$router = new Router();
$router->handleRequest();

