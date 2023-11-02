<?php

    include 'sql.php';

    if(isset($_POST['nome'])) {
        $usuario_a_excluir = $_POST['nome'];
        excluir($usuario_a_excluir);
    }

    function excluir($usuario_a_excluir) {
        excluirUsuario($usuario_a_excluir);
        header('Location: ../views/administrador.php');
    }

?>