<?php
    include 'sql.php';
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if(isset($_POST['nome'])){
        $nomeEvento = $_POST['nome'];
        criaEvento($nomeEvento);
    }
    function criaEvento($nomeEvento){
        $idUsuario = $_SESSION['user_id'];
        $codigoConvite = rand(10, 1000);
        
        insereEvento($idUsuario, $nomeEvento, $codigoConvite);
        header('location: ../views/organizador.php');
    }
?>