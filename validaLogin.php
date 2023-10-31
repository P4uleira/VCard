<?php
    include 'sql.php';

    session_start();

    $email = $_POST['email'];
    $senha = $_POST['senha'];

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

    $loginID = login($email, $senha);

    if ($loginID > 0) {
        $_SESSION["logado"] = true;
        $_SESSION["user"] = $loginID;

        header("Location: perfil.php");
    } else {
        header("Location: login.php?err=1");
    }
        
?>