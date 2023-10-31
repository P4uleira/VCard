<?php
include 'sql.php';

session_start();

$email = $_POST['email'];
$senha = $_POST['senha'];

function login($email, $senha) {
    $conn = conection();

    $sql = "SELECT codigo_visitante FROM visitante WHERE Email = ? AND Senha = ?";
    $resultado = $conn->prepare($sql);
    
    if ($resultado) {
        $resultado->bind_param("ss", $email, $senha);
        $resultado->execute();
        $resultado->bind_result($id);

        if ($resultado->fetch()) {
            $resultado->close();
            $conn->close();
            return ['user_type' => 'visitante', 'user_id' => $id];
        }
        $resultado->close();
    } else {
        echo "Erro na preparação da consulta: " . $conn->error;
    }

    $sql = "SELECT ID_usuario FROM Participantes WHERE Usuario = ? AND Senha = ?";
    $resultado = $conn->prepare($sql);

    if ($resultado) {
        $resultado->bind_param("ss", $email, $senha);
        $resultado->execute();
        $resultado->bind_result($id);

        if ($resultado->fetch()) {
            $resultado->close();
            $conn->close();
            return ['user_type' => 'participante', 'user_id' => $id];
        }
        $resultado->close();
    } else {
        echo "Erro na preparação da consulta: " . $conn->error;
    }

    $sql = "SELECT ID_Organizacao FROM Organizacao WHERE Usuario = ? AND Senha = ?";
    $resultado = $conn->prepare($sql);

    if ($resultado) {
        $resultado->bind_param("ss", $email, $senha);
        $resultado->execute();
        $resultado->bind_result($id);

        if ($resultado->fetch()) {
            $resultado->close();
            $conn->close();
            return ['user_type' => 'organizacao', 'user_id' => $id];
        }
        $resultado->close();
    } else {
        echo "Erro na preparação da consulta: " . $conn->error;
    }

    $sql = "SELECT ID_Admin FROM Admin WHERE Usuario = ? AND Senha = ?";
    $resultado = $conn->prepare($sql);

    if ($resultado) {
        $resultado->bind_param("ss", $email, $senha);
        $resultado->execute();
        $resultado->bind_result($id);

        if ($resultado->fetch()) {
            $resultado->close();
            $conn->close();
            return ['user_type' => 'admin', 'user_id' => $id];
        }
        $resultado->close();
    } else {
        echo "Erro na preparação da consulta: " . $conn->error;
    }

    $conn->close();
    return null;
}

$loginData = login($email, $senha);

if ($loginData !== null) {
    $_SESSION["logado"] = true;
    $_SESSION["user_type"] = $loginData['user_type'];
    $_SESSION["user_id"] = $loginData['user_id'];

    header("Location: perfil.php");
} else {
    header("Location: login.php?err=1");
}
?>
