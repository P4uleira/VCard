<?php
    include 'sql.php';

    if(isset($_POST['nomeCategoria'])){
        $nome = $_POST['nomeCategoria'];
        criaCategoria($nome);
    }

    function criaCategoria($nome){
        insereCategoria($nome); 
        header('Location: ../views/administrador.php');
    }
?>