<?php 

require_once __DIR__ . '/../config/database.php';

class Tarefa{

    private $conexao; 

    public function __construct(){

        $db = new Database();
        $this -> conexao = $db -> conectar();
    }

    public function listar(int $usuario_id): array{// Editei o método editar para filtrar as tarefas por id

        $tarefas = [];

        $sql = "SELECT * FROM tarefas WHERE usuario_id = ? ORDER BY data_criacao DESC";

        $stmt = $this -> conexao -> prepare($sql);
        $stmt -> bind_param("i", $usuario_id);
        $stmt -> execute();

        $resultado = $stmt->get_result();

        while ($row = $resultado->fetch_assoc()) {

            $tarefas[] = $row;
        }

        $stmt -> close();
        return $tarefas;
    }

    public function criar(string $descricao, int $usuario_id): bool { //editei a função criar pois estava dando erro

        $sql = "INSERT INTO tarefas (descricao, usuario_id) VALUES (?, ?)";

        $stmt = $this -> conexao->prepare($sql);
        $stmt -> bind_param("si", $descricao, $usuario_id);

        return $stmt -> execute();
    }

    public function excluir(int $id): bool {

        $id = intval($id);
        $sql = "DELETE FROM tarefas WHERE id = $id"; 
        return $this -> conexao -> query($sql); 
    }
    
    public function editar(string $descricao, int $id): bool {
        
        $descricao = $this -> conexao -> real_escape_string($descricao);
        $id = intval($id);
        $sql = "UPDATE tarefas SET descricao = '$descricao' WHERE id = '$id'";
        return $this -> conexao -> query($sql); 
    }
}