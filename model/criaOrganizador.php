<?php
    include 'sql.php';

    if(isset($_POST['nome']) && isset($_POST['usuario']) && isset($_POST['senha']) ){
        $nome = $_POST['nome'];
        $usuario = $_POST['usuario'];
        $senha = $_POST['senha'];
        insereOrganizador($nome, $usuario, $senha);
        header('Location: ../views/administrador.php');
    }
?>