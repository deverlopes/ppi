<?php 

require_once __DIR__ . '/../model/todolistModel.php';

class tarefaController{

    private Tarefa $tarefaModel; 

    public function __construct(){

        $this->tarefaModel = new Tarefa(); 
    }

    public function index(){// Concertei adicionando o To-Do List relacionado ao usuário

        $usuario_id = $_SESSION['id'];
        $tarefas = $this -> tarefaModel -> listar($usuario_id);
        include __DIR__ . '/../view/todolistView.php';
    }


    public function criar() {// Editei para ficar funcional com a nova tabela

        if (isset($_POST['descricao']) && !empty(trim($_POST['descricao']))) {

            $descricao = trim($_POST['descricao']);
            $usuario_id = $_SESSION['id'];
            $this -> tarefaModel -> criar($descricao, $usuario_id);
        }

        header("Location: todolist.php");// Concertei o destino
        exit;
    }

    public function excluir(){

        if (isset($_GET['id'])){

            $id = (int) $_GET['id'];
            $usuario_id = $_SESSION['id'];

            $this -> tarefaModel -> excluir($id, $usuario_id);
        }

        header("Location: todolist.php");
        exit;
    }

    public function editar(){

        if (isset($_POST['id']) && isset($_POST['descricao']) && !empty(trim($_POST['descricao']))){

            $descricao = trim($_POST['descricao']);
            $id = (int) $_POST['id'];
            $usuario_id = $_SESSION['id'];

            $this->tarefaModel->editar($descricao, $id, $usuario_id);
        }

        header("Location: todolist.php");
        exit;
}
}

?>