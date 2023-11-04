<?php
    function  conection(){
        $servername = "127.0.0.1";
        $username = "root";
        $password = "";
        $database = "vcard";
        return $conn = new mysqli($servername, $username, $password, $database);
    }

    function insereVisitante($nome, $telefone, $email, $endereço, $usuario, $senha) {
        $con = conection();
        $sql = "INSERT INTO visitantes (nome, telefone, email, endereco, usuario, senha) VALUES ('$nome', '$telefone', '$email', '$endereço', '$usuario','$senha' )";
        if ($con->query($sql) === TRUE) {
            header('index.php');
        } else {
            echo "Erro ao inserir dados: " . $con->error;
        }
        $con->close();
    }

    function insereOrganizador($nome, $usuario, $senha) {
        $con = conection();
        $sql = "INSERT INTO organizadores (nome, usuario, senha) VALUES ('$nome', '$usuario', '$senha')";
        if ($con->query($sql) === TRUE) {
            echo "Erro ao inserir dados: " . $con->error;
        } 
        
        $con->close();
    }

    function excluirUsuario($usuario_a_excluir){
        $conn = conection();

        // Verifica em qual tabela o usuário está
        $tabelas = ['Visitantes', 'Participantes', 'Organizadores', 'Admin'];

        foreach ($tabelas as $tabela) {
            $sql = "DELETE FROM $tabela WHERE Usuario = ?";
            $resultado = $conn->prepare($sql);

            if ($resultado) {
                $resultado->bind_param("s", $usuario_a_excluir);
                $resultado->execute();
                $resultado->close();
            } else {
                echo "Erro na preparação da consulta: " . $conn->error;
            }
        }

        $conn->close();
    }

    function insereEvento($idOrganizador,$nomeEvento, $codigoConvite){
        $con = conection();
        $sql = "INSERT INTO eventos (id_organizador, nome, chave_convite) VALUES ('$idOrganizador', '$nomeEvento', '$codigoConvite')";

        if ($con->query($sql) === FALSE) {
            echo "Erro ao inserir dados: " . $con->error;
        } 
        
        $con->close();
    }
?>
