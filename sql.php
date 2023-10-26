<?php
    function  conection(){
        $servername = "127.0.0.1";
        $username = "root";
        $password = "";
        $database = "vcard";
        return $conn = new mysqli($servername, $username, $password,$database);
    }

    function insereUsuario($nome, $telefone, $email, $id, $endereço, $usuario, $senha) {
        $sql = "INSERT INTO visitante (nome, telefone, email, codigo_visitante, endereco, usuario, senha) VALUES ('$nome', '$telefone', '$email','$id', '$endereço', '$usuario','$senha' )";
        $con = conection();
        if ($con->query($sql) === TRUE) {
            echo "Dados inseridos com sucesso!";
        } else {
            echo "Erro ao inserir dados: " . $con->error;
        }
        $con->close();
    }
?>
