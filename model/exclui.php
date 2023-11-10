<?php

    include 'sql.php';

    if(isset($_POST['nome'])) {
        $usuario_a_excluir = $_POST['nome'];
        excluirUsuarios($usuario_a_excluir);
    } else if (isset($_POST['idEvento'])) {
        $evento_a_excluir = $_POST['idEvento'];
        excluirEventos($evento_a_excluir);
    }

    function excluirUsuarios($usuario_a_excluir) {
        excluirUsuario($usuario_a_excluir);
        header('Location: ../views/administrador.php');
    }

    function excluirEventos($evento_a_excluir) {
        excluirEvento($evento_a_excluir);
        header('Location: ../views/organizador.php?modo=exEvento');
    }

?>