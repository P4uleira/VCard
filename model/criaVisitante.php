<?php
    include 'sql.php';
    
    if(isset($_POST["nomeLogin"]) && isset($_POST["numeroLogin"]) && isset($_POST["emailLogin"]) && isset($_POST["enderecoLogin"])&& isset($_POST["nomeUsuarioLogin"])&& isset($_POST["senhaLogin"])){
        $nome = $_POST['nomeLogin'];
        $numeroT = $_POST['numeroLogin'];
        $email = $_POST['emailLogin'];
        $endereco = $_POST['enderecoLogin'];
        $usuario = $_POST['nomeUsuarioLogin'];
        $senha = $_POST['senhaLogin'];
        criaVisitante($nome, $numeroT, $email,$endereco,$usuario, $senha);
    }
    
    function criaVisitante($nome, $numeroT, $email,$endereco,$usuario, $senha) {
        insereVisitante($nome, $numeroT, $email,$endereco, $usuario, $senha);
        header('location: ../views/login.php');
    }
?>