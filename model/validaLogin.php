<?php
    include 'sql.php';

    session_start();

    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    function login($usuario, $senha)
    {
        $conn = conection();

        $sql = "SELECT ID_visitante FROM visitantes WHERE Usuario = ? AND Senha = ?";
        $resultado = $conn->prepare($sql);

        if ($resultado) {
            $resultado->bind_param("ss", $usuario, $senha);
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

        $sql = "SELECT ID_usuario FROM participantes WHERE Usuario = ? AND Senha = ?";
        $resultado = $conn->prepare($sql);

        if ($resultado) {
            $resultado->bind_param("ss", $usuario, $senha);
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

        $sql = "SELECT ID_Organizador FROM organizadores WHERE Usuario = ? AND Senha = ?";
        $resultado = $conn->prepare($sql);

        if ($resultado) {
            $resultado->bind_param("ss", $usuario, $senha);
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

        $sql = "SELECT ID_Admin FROM administradores WHERE Usuario = ? AND Senha = ?";
        $resultado = $conn->prepare($sql);

        if ($resultado) {
            $resultado->bind_param("ss", $usuario, $senha);
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

    $loginData = login($usuario, $senha);

    if ($loginData !== null) {
        $_SESSION["logado"] = true;
        $_SESSION["user_type"] = $loginData['user_type'];
        $_SESSION["user_id"] = $loginData['user_id'];

        switch ($_SESSION["user_type"]) {
            case 'visitante':
                header("Location: ../views/visitante.php");
                break;
            case 'participante':
                header("Location: ../views/participante.php");
                break;
            case 'organizacao':
                header("Location: ../views/organizador.php");
                break;
            case 'admin':
                header("Location: ../views/administrador.php");
                break;
        }

    } else {
        header("Location: /views/login.php?err=1");
    }

?>