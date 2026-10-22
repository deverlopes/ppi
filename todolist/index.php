<?php

session_start(); //Agora só da pra entrar no to-do list via login

if (!isset($_SESSION['id'])){

    header("Location: ../login/");
    exit;
}

require_once __DIR__ . '/app/controller/tarefaController.php'; 

$controller = new tarefaController(); 
$action = $_GET['action'] ?? 'index'; 

switch ($action){
    case 'criar': 
        $controller -> criar(); 
        break; 
    case 'excluir': 
        $controller -> excluir(); 
        break; 
    case 'editar': 
        $controller -> editar(); 
        break;
    default:
        $controller -> index(); 
        break; 
}

?>