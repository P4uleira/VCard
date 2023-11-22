<?php
    include 'sql.php';

    if(isset($_POST['nomeCategoria'])){
        $nome = $_POST['nomeCategoria'];
        insereCategoria($nome);
        header('Location: ../views/administrador.php');
    }
?>