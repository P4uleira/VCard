<?php

    session_start();
    if(isset($_POST['chaveConvite']) && $_SESSION['user_id']){
        $chaveConvite = $_POST['chaveConvite'];
        $idParticipante = $_SESSION['user_id'];
        include 'sql.php';

        insereNovoEventoParticipante($chaveConvite, $idParticipante);

        header('Location: ../views/participante.php?modo=eEvento');
    }
?>