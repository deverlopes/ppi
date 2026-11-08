<?php

session_start();// Adicionei a sessão e agora só da pra entrar no to-do list via login

if (!isset($_SESSION['id'])){ 

    header("Location: index.php");
    exit;
}// Adicionei o redirecionamento

require_once __DIR__ . '/app/controller/todolistController.php'; 

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