<?php 

require_once __DIR__ . '/../model/tarefa.php';

class tarefaController{

    private Tarefa $tarefaModel; 

    public function __construct(){

        $this->tarefaModel = new Tarefa(); 
    }

    public function index(){// Concertei adicionando o To-Do List relacionado ao usuário

        $usuario_id = $_SESSION['id'];
        $tarefas = $this -> tarefaModel -> listar($usuario_id);
        include __DIR__ . '/../view/listar.php';
    }


    public function criar() {// Editei para ficar funcional com a nova tabela

        if (isset($_POST['descricao']) && !empty(trim($_POST['descricao']))) {

            $descricao = trim($_POST['descricao']);
            $usuario_id = $_SESSION['id'];
            $this -> tarefaModel -> criar($descricao, $usuario_id);
        }

        header("Location: index.php");
        exit;
    }

    public function excluir(){
        if (isset($_GET['id'])){ 

            $this -> tarefaModel -> excluir($_GET['id']);
        }

        header("Location: index.php"); 
    }

    public function editar(){
        
        if (isset($_POST['id']) && isset($_POST['descricao']) && !empty(trim($_POST['descricao']))){
            
            $this -> tarefaModel -> editar($_POST['descricao'], $_POST['id']);
        }

        header("Location: index.php");
    }
}

?>