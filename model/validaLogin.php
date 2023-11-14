<?php
    include 'sql.php';

    if(isset($_POST['validaNick'])) {
        $nickname = $_POST['validaNick'];        
        $encontrou = "nexiste";
        $conn = conection();
        $sql = "SELECT Usuario from visitantes WHERE Usuario = '$nickname' UNION 
                SELECT Usuario from participantes WHERE Usuario = '$nickname' UNION 
                SELECT Usuario from organizadores WHERE Usuario = '$nickname' UNION 
                SELECT Usuario from administradores WHERE Usuario = '$nickname'";

        $resultado = $conn->query($sql);
        if ($resultado->num_rows > 0) {
            $encontrou = "existe";            
        }
        echo json_encode(array("encontrou"=>$encontrou));
        $conn->close();
    } else {

        session_start();

        $usuario = $_POST['usuario'];
        $senha = $_POST['senha'];

        function login($usuario, $senha) {
            $conn = conection();

            $sql = "SELECT ID_Visitantes, Usuario FROM visitantes WHERE Usuario = ? AND Senha = ?";
            $resultado = $conn->prepare($sql);

            if ($resultado) {
                $resultado->bind_param("ss", $usuario, $senha);
                $resultado->execute();
                $resultado->bind_result($id, $nomeUsuario);

                if ($resultado->fetch()) {
                    $resultado->close();
                    $conn->close();
                    return ['user_type' => 'visitante', 'user_id' => $id, 'user_nickname' => $nomeUsuario];
                }
                $resultado->close();
            } else {
                echo "Erro na preparação da consulta: " . $conn->error;
            }

            $sql = "SELECT ID_Participantes FROM participantes WHERE Usuario = ? AND Senha = ?";
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

            $sql = "SELECT 	ID_Organizadores FROM organizadores WHERE Usuario = ? AND Senha = ?";
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
            if (array_key_exists('user_nickname', $loginData)) {
                $_SESSION["user_nickname"] = $loginData['user_nickname'];
            }

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
    }
?>