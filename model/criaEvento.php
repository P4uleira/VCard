<?php
    include 'sql.php';
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if(isset($_POST['nome'])){
        $nomeEvento = $_POST['nome'];
        criaEvento($nomeEvento);
    } else if(isset($_POST['novoNome'])){
        echo "<script>console.log(Entrou Aqui)";
        $novoNomeEvento = $_POST['novoNome'];
        $idEvento = $_POST['idEvento'];              
        $idUsuario = $_SESSION['user_id'];        
        
        atualizaEvento($idUsuario, $idEvento, $novoNomeEvento);
        echo "console.log(Entrou Aqui .$novoNomeEvento)</script>";        
    }


    function criaEvento($nomeEvento){
        $idUsuario = $_SESSION['user_id'];
        $codigoConvite = rand(10, 1000);
        
        insereEvento($idUsuario, $nomeEvento, $codigoConvite);
        header('location: ../views/organizador.php');
    }

    if(isset($_POST['novoNome'])){
        echo "Entrou Aqui";
        $novoNomeEvento = $_POST['novoNome'];
        $idEvento = $_POST['idEvento'];              
        $idUsuario = $_SESSION['user_id'];        
        
        atualizaEvento($idUsuario, $idEvento, $novoNomeEvento);
        echo "Entrou Aqui .$novoNomeEvento";        
    }
    
?>