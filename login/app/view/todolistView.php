<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>To-Do List</title>
    <style>

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }
        
        .modal-conteudo {
            background-color: white;
            width: 400px;
            margin: 150px auto;
            padding: 20px;
            border-radius: 10px;
        }

    </style>
</head>
<body>

    <h1>To-Do List</h1> 
    
    <h2> Bem-vindo, <?php echo htmlspecialchars($_SESSION['nome']); ?>! </h2>

    <form action="todolist.php?action=criar" method="POST">
        <input type="text" name="descricao" placeholder="Descrição da tarefa">
        <button type="submit">Adicionar</button>
    </form>

    <h2>Suas tarefas</h2>

    <?php if (!empty($tarefas)): ?>
        <ul>
            <?php foreach ($tarefas as $tarefa): ?>
                <li>
                    <?php echo htmlspecialchars($tarefa['descricao']); ?>
                    <a href="todolist.php?action=excluir&id=<?php echo $tarefa['id']; ?>"> Excluir </a>
                    <a href="#" onclick='abrirModal(<?php echo (int) $tarefa["id"]; ?>, <?php echo htmlspecialchars(json_encode($tarefa["descricao"]), ENT_QUOTES, "UTF-8"); ?>)'>Editar</a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Não há tarefas ainda!</p>
    <?php endif; ?>

    <?php include __DIR__ . '/editarView.php'; ?>

    <script>

        function abrirModal(id, descricao){

            document.getElementById("editarId").value = id
            document.getElementById("editarDescricao").value = descricao
            document.getElementById("modalEditar").style.display = "block"; 
        }

        function fecharModal(){

            document.getElementById("modalEditar").style.display = "none";
        }

    </script>

    <a href="index.php?action=logout">Sair</a><!--Adicionei um botão para encerrar a sessão-->

</body>
</html>