<?php

session_start();// Adicionei a sessão e agora só da pra entrar no to-do list via login

if (!isset($_SESSION['id'])){ echo "<script> alert('Você não pode acessar o To-Do List sem fazer login! Você será redirecionado para a página de login.'); window.location.href = '../login/'; </script>"; exit; }// Adicionei alerta de redirecionamento

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