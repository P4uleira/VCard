<?php
    function  conection(){
        $servername = "127.0.0.1";
        $username = "root";
        $password = "";
        $database = "vcard";
        return $conn = new mysqli($servername, $username, $password, $database);
    }

    function insereUsuario($nome, $telefone, $email, $endereço, $usuario, $senha) {
        $con = conection();
        $sql = "INSERT INTO visitante (nome, telefone, email, endereco, usuario, senha) VALUES ('$nome', '$telefone', '$email', '$endereço', '$usuario','$senha' )";
        if ($con->query($sql) === TRUE) {
            header('index.php');
        } else {
            echo "Erro ao inserir dados: " . $con->error;
        }
        $con->close();
    }

    function login($email, $senha) {
        $conn = conection();
        
        $sql = "SELECT codigo_visitante FROM visitante WHERE email = ? AND senha = ?";
        $stmt = $conn->prepare($sql);
    
        if ($stmt) {
            $stmt->bind_param("ss", $email, $senha);
    
            $stmt->execute();
    
            $stmt->bind_result($id);
    
            if ($stmt->fetch()) {
                $stmt->close();
                $conn->close();
                return $id;
            } else {
                $stmt->close();
                $conn->close();
                return 0;
            }
        } else {
            echo "Erro na preparação da consulta: " . $conn->error;
        }
    }
?>
