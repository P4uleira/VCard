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

    function login($email, $senha) {
        $sql = "SELECT codigo_visitante FROM visitante WHERE email = $email AND senha = $senha ";
        $conn = conection();
        $resultado = $conn->query($query);

        if ($resultado->num_rows == 1) {
            $row = $result->fetch_assoc(); 
            $id = $row["codigo_visitante"]; 
            
            return $id;
        } else {
            return 0;
        }
        
        $conn->close();

    }
?>
