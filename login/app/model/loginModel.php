<?php

require_once __DIR__ . '/../config/database.php';

Class Usuario{

    private mysqli $conexao;

    public function __construct(){

        $db = new Database();
        $this -> conexao = $db -> conectar();
    }

    public function buscarPorEmail(string $email){

        $sql = "SELECT * FROM usuarios WHERE email = ?";
        $stmt = $this -> conexao -> prepare($sql);
        $stmt -> bind_param("s", $email);
        $stmt -> execute();

        $resultado = $stmt -> get_result();
        return $resultado -> fetch_assoc();
    }
}

?>