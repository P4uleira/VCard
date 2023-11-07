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
        $sql = "INSERT INTO eventos (fk_ID_Organizadores, nome, chave_convite) VALUES ('$idOrganizador', '$nomeEvento', '$codigoConvite')";

        if ($con->query($sql) === FALSE) {
            echo "Erro ao inserir dados: " . $con->error;
        } 
        
        $con->close();
    }

    if (isset($_POST['funcao']) && $_POST['funcao'] === 'listaEvento') {
        $idEvento = $_POST['idEvento'];
        listaEvento($idEvento);
    }

    function listaEvento($id) {
        $conn = conection();
        $sql = "SELECT `fk_ID_Organizadores`, `Nome` FROM `eventos` WHERE `Codigo_Evento` = " .$id;

        $result = $conn->query($sql);

        if ($result) {
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
    
                $fk_ID_Organizadores = $row['fk_ID_Organizadores'];
                $Nome = $row['Nome'];
                
                echo "<div class=\"eEvento_result\"><div class=\"container input-group mb-3\"><div class=\"input-group-prepend\">";
                echo "<span class=\"input-group-text\" id=\"inputGroup-sizing-default\">Nome do Evento</span></div>";
                echo "<input value=\"$Nome\" type=\"text\" class=\"form-control\" aria-label=\"Sizing example input\" aria-describedby=\"inputGroup-sizing-default\"></div>";
                
                $sql2 = "SELECT `ID_Participantes`, `Nome`, `Usuario` FROM `participantes` WHERE `ID_Organizadores` = " . $fk_ID_Organizadores;
                $result2 = $conn->query($sql2);

                if ($result2) {
                    if ($result2->num_rows > 0) {
                        echo "<table class=\"container table table-sm table-hover\" style=\"text-align: center\"><thead><tr>";
                        echo "<th scope=\"col\">ID</th><th scope=\"col\">Nome</th><th scope=\"col\">Usuario</th><th scope=\"col\">Excluir Participante</th></tr></thead>";
                        echo "<tbody>";
                        while ($row2 = $result2->fetch_assoc()) {
                            
                            $idParticipante = $row2['ID_Participantes'];
                            $nomeParticipante = $row2['Nome'];
                            $usuarioParticipante = $row2['Usuario']; 
                            
                            echo "<tr>";
                            echo "<th scope=\"row\">$idParticipante</th>";
                            echo "<td>$nomeParticipante</td>";
                            echo "<td>$usuarioParticipante</td>";
                            echo "<td><a onclick=\"removeParticipante('$usuarioParticipante')\" class=\"btn btn-danger\">Excluir</a></td>";
                            echo "</tr>";                          
                            
                        }
                        echo "</tbody></table>";
                    }
                }
                echo "</div>";
            }
        }

        $conn->close(); 
    }
?>
