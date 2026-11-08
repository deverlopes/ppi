<?php

require_once __DIR__ . '/../model/loginModel.php';

Class UsuarioController{

    private Usuario $usuarioModel;

    public function __construct(){

        $this -> usuarioModel = new Usuario(); 
    }

    public function login(){

        if(isset($_SESSION['id'])){

            header("Location: todolist.php"); //Concertei redirecionamentos
            exit;
        }

        include __DIR__ . '/../view/loginView.php';
    }

    public function autenticar(){

        if (!isset($_POST['email'], $_POST['senha'])){

            header("Location: index.php");
            exit;
        }

        $email = $_POST['email'];
        $senha = $_POST['senha'];

        if (empty($email) || empty($senha)){

            $erro = "Preencha seu email e senha";
            include __DIR__ . '/../view/loginView.php';
            exit;
        }

        $usuario = $this -> usuarioModel -> buscarPorEmail($email);

        if ($usuario && password_verify($senha, $usuario['senha'])){

            session_regenerate_id(true);
            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];

            header("Location: todolist.php");//Alterei o redicionamento para o to-do list
            exit;
        }

        $erro = "E-mail ou senha estão incorretos";
        include __DIR__ . '/../view/loginView.php';
    }

    public function logout(){

        session_destroy();

        header("Location: index.php");
        exit;
    }
}

?>