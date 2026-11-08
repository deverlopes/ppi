<?php

session_start();// Adicionei a sessão

require_once __DIR__ . '/app/controller/loginController.php';

$controller = new UsuarioController();
$action = $_GET['action'] ?? 'index';

switch($action){
    case 'autenticar':
        $controller->autenticar();
        break;
    case 'logout':
        $controller->logout();
        break;
    default:
        $controller->login();
        break;
}

?>