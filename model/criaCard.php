<?php
    include 'sql.php';

    if(isset($_POST['titulo']) && isset($_POST['descricao']) && isset($_POST['telefone']) && isset($_POST['email'])){
        $titulo = $_POST['titulo'];
        $descricao = $_POST['descricao'];
        $telefone = $_POST['telefone'];
        $email = $_POST['email'];
        criaCard($titulo, $descricao, $telefone, $email);
    }

    function criaCard($titulo, $descricao, $telefone, $email){

        $dataNow = date('d/m/Y');
        insereCard($idParticipante, $idCategoria, $titulo, $imagem, $descricao, 0, $email, $telefone, $dataNow);
    }
?>