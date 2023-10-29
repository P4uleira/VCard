<?php
    include 'sql.php';
    
    $nome;$numeroT;$email;$senha;
    
    if(isset($_POST["nomeLogin"]) && isset($_POST["numeroLogin"]) && isset($_POST["emailLogin"]) && isset($_POST["senhaLogin"])){
        $nome = $_POST['nomeLogin'];
        $numeroT = $_POST['numeroLogin'];
        $email = $_POST['emailLogin'];
        $senha = $_POST['senhaLogin'];
        criaConta($nome,$numeroT,$email,$senha);
    }

    function criaConta($nome, $numeroT, $email, $senha) {
        insereUsuario($nome, $numeroT, $email,"1",  "toptp", "paulingostoso", $senha);
        header('header.php');
    }
?>