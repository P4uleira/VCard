<?php
    function conection(){
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
        if ($con->query($sql) === FALSE) {
            echo "Erro ao inserir dados: " . $con->error;
        } 
        
        $con->close();
    }

    function insereCard($idUsuario, $categoria, $titulo, $nomeArquivo, $descricao, $visualizacao, $email, $telefone, $dataNow){
        $con = conection();
        $sql = "INSERT INTO cards (fk_ID_Participantes, fk_ID_Categoria, Titulo, Imagem, Descricao, Contagem, Email, Telefone, Data_publicacao) VALUES ('$idUsuario', '$categoria', '$titulo', '$nomeArquivo', '$descricao', '$visualizacao', '$email', '$telefone', '$dataNow')";
        if ($con->query($sql) === FALSE) {
            echo "Erro ao inserir dados: " . $con->error;
        } 
        
        $con->close();
    }

    function listaTodosCardsOrg($idVisitante, $orgSelect) {
        $conn = conection();
        $sql = "SELECT * FROM cards AS C 
                WHERE c.ID_Card in 
                    (SELECT fk_ID_Card FROM visualizar WHERE fk_ID_Visitantes = $idVisitante)
                AND c.fk_ID_Participantes IN 
                    (SELECT fk_ID_Participantes FROM participa WHERE fk_Codigo_Evento = 
                        (SELECT Codigo_Evento FROM eventos WHERE fk_ID_Organizadores = $orgSelect))";
        
        $result = $conn->query($sql);

        if ($result) {
            if ($result->num_rows > 0) {                                             

                echo '<div class="container">';                                    
                echo '<div class="form-group">';
                
                while ($row = $result->fetch_assoc()) {
                            
                    $id_card = $row['ID_Card']; 
                    
                    echo '<div style="max-width: 325px; margin: 1rem 0" class="col-md-6">';
                                                
                    echo "<img style=\"width: 325px; border-radius: 8px; height: 220px;\" src=\"../public/imgs/Uploads/{$row['Imagem']}\" class=\"img-fluid\">";
                    
                    echo '<h4 style="text-align: center; margin-top: 5px; max-width: 325px;">' . $row['Titulo'] . '</h4>';
                    
                    echo "<a style=\"max-width: 325px;\" class=\"btn btn-primary btn-block\" href=\"../views/card.php?id=$id_card&fav=1\">Visualizar Card</a>";
                    echo '</div></div>';
                    
                }                

            } else {
                echo "<h3 style=\"text-align: center; margin-bottom: 1.5rem\">Você ainda não visualizou nenhum card dessa organização.</h3>";
            }
        } 

        $conn->close(); 

    }

    function listaTodosCardsParaOrg($idOrg) {
        $conn = conection();
        $sql = "SELECT * FROM cards AS C 
            WHERE c.fk_ID_Participantes in (SELECT fk_ID_Participantes FROM participa WHERE fk_Codigo_Evento = (SELECT Codigo_Evento from eventos WHERE fk_ID_Organizadores = $idOrg))";

        $result = $conn->query($sql);

        if ($result) {
            if ($result->num_rows > 0) {                                             

                echo '<div class="container">';                                    
                echo '<div class="form-group">';
                
                while ($row = $result->fetch_assoc()) {
                            
                    $id_card = $row['ID_Card']; 
                    
                    echo '<div style="max-width: 325px; margin: 1rem 0" class="col-md-6">';
                                                
                    echo "<img style=\"width: 325px; border-radius: 8px; height: 220px;\" src=\"../public/imgs/Uploads/{$row['Imagem']}\" class=\"img-fluid\">";
                    
                    echo '<h4 style="text-align: center; margin-top: 5px; max-width: 325px;">' . $row['Titulo'] . '</h4>';
                    
                    echo "<a style=\"max-width: 325px;\" class=\"btn btn-primary btn-block\" href=\"../views/card.php?id=$id_card&fav=1\">Visualizar Card</a>";
                    echo '</div></div>';
                    
                }                

            } else {
                echo "<h3 style=\"text-align: center; margin-bottom: 1.5rem\">Você ainda não visualizou nenhum card dessa organização.</h3>";
            }
        } 

        $conn->close(); 
    }

    function insereParticipante($idOrg, $nome, $usuario, $senha, $evento) {
        $conn = conection();
        $sql = "INSERT INTO participantes (fk_ID_Organizadores, Nome, Usuario, Senha) VALUES ($idOrg, '$nome', '$usuario', '$senha')";

        if ($conn->query($sql) === FALSE) {
            echo "Erro ao inserir dados: " . $conn->error;            
        } else {
            $sql2 = "INSERT INTO participa (fk_Codigo_Evento, fk_ID_Participantes) VALUES ($evento, (SELECT ID_Participantes FROM participantes WHERE Usuario = '$usuario'))";

            if ($conn->query($sql2) === FALSE) {
                echo "Erro ao inserir dados: " . $conn->error; 
            }
        }
        $conn->close();         
    }
    
    function insereCategoria($nome) {
        $conn = conection();
        $sql = "INSERT INTO categorias (Nome_Categoria) VALUES ('$nome')";

        if ($conn->query($sql) === FALSE) {
            echo "Erro ao inserir dados: " . $conn->error;            
        }
        $conn->close();         
    }

    function selectListaUsuarios($userEdit, $userSelect = "") {
        $conn = conection();        
        
        $sql = "SELECT * FROM $userEdit";

        $result = $conn->query($sql);
        if ($result) {            
            if ($result->num_rows > 0) {                
                echo "<h3 style=\"text-align: center; margin-bottom: 1.5rem\">Escolha um usuário</h3>";
                echo "<div id=\"tipoUsuario\" style=\"display: none;\">$userEdit</div>";
                echo "<select class=\"container form-select\" name=\"usuariosS\" id=\"usuariosS\">";
                echo "<option value=\"0\">Selecione um Usuario</option>";
                while ($row2 = $result->fetch_assoc()) {  
                    $nome = $row2['Nome'];                    
                    $user = $row2['Usuario'];                    
                    echo "<option value=\"$user\">$user - $nome</option>";                                            
                }
                echo "</select>";                
                if ($userSelect != ""){
                    $sql2 = "SELECT * FROM $userEdit WHERE Usuario = '$userSelect'";
                                         
                    $result2 = $conn->query($sql2);                                             
                    $row2 = $result2->fetch_assoc();

                    $nomeS = $row2['Nome'];                    
                    $userS = $row2['Usuario']; 
                    $senhaS = $row2['Senha'];

                    echo "<br><form id=\"formAtualiza\" action=\"../model/criaVisitante.php\" method=\"post\" style=\"margin-bottom: 3rem\" class=\"container\">";
                    if ($userEdit == "organizadores") {
                        $id = $row2['ID_Organizadores'];

                        echo "<div class=\"input-group mb-3\"><div class=\"input-group-prepend\">";
                        echo "<span class=\"input-group-text\" id=\"basic-addon1\">ID</span></div>";
                        echo "<input id=\"aID\" readonly name=\"id\" type=\"text\" class=\"form-control\" value=\"$id\" aria-label=\"ID\" aria-describedby=\"basic-addon1\"></div>";
                    }                  
                                                            
                    echo "<div class=\"input-group mb-3\"><div class=\"input-group-prepend\">";
                    echo "<span class=\"input-group-text\" id=\"basic-addon1\">Usuario</span></div>";
                    echo "<input id=\"aUser\" name=\"aUser\" type=\"text\" class=\"form-control\" value=\"$userS\" aria-label=\"Usuario\" aria-describedby=\"basic-addon1\"></div>";
                    echo "<span class=\"mensagem-erro\" id=\"mensagemUsuario\"></span>";
                    
                    echo "<div class=\"input-group mb-3\"><div class=\"input-group-prepend\">";
                    echo "<span class=\"input-group-text\" id=\"basic-addon1\">Nome</span></div>";
                    echo "<input name=\"aNome\" type=\"text\" class=\"form-control\" value=\"$nomeS\" aria-label=\"Nome\" aria-describedby=\"basic-addon1\"></div>"; 

                    echo "<div class=\"input-group mb-3\"><div class=\"input-group-prepend\">";
                    echo "<span class=\"input-group-text\" id=\"basic-addon1\">Senha</span></div>";
                    echo "<input name=\"aSenha\" type=\"text\" class=\"form-control\" value=\"$senhaS\" aria-label=\"Senha\" aria-describedby=\"basic-addon1\"></div>"; 
                    
                    if ($userEdit == "participantes") {
                        $id = $row2['ID_Participantes'];
                        $idOrgS = $row2['fk_ID_Organizadores'];
                         
                        echo "<div class=\"input-group mb-3\"><div class=\"input-group-prepend\">";
                        echo "<span class=\"input-group-text\" id=\"basic-addon1\">ID</span></div>";
                        echo "<input id=\"aID\" readonly name=\"id\" type=\"text\" class=\"form-control\" value=\"$id\" aria-label=\"ID\" aria-describedby=\"basic-addon1\"></div>";

                        echo "<div class=\"input-group mb-3\"><div class=\"input-group-prepend\">";
                        echo "<span class=\"input-group-text\" id=\"basic-addon1\">ID Organizador</span></div>";
                        echo "<input name=\"aIdOrg\" type=\"text\" class=\"form-control\" value=\"$idOrgS\" aria-label=\"ID Organizador\" aria-describedby=\"basic-addon1\"></div>"; 

                    } else if ($userEdit == "visitantes") {
                        $id = $row2['ID_Visitantes'];                       
                        $telS = $row2['Telefone'];
                        $emailS = $row2['Email'];
                        $endS = $row2['Endereco'];
                        
                        echo "<div class=\"input-group mb-3\"><div class=\"input-group-prepend\">";
                        echo "<span class=\"input-group-text\" id=\"basic-addon1\">ID</span></div>";
                        echo "<input id=\"aID\" readonly name=\"id\" type=\"text\" class=\"form-control\" value=\"$id\" aria-label=\"ID\" aria-describedby=\"basic-addon1\"></div>";

                        echo "<div class=\"input-group mb-3\"><div class=\"input-group-prepend\">";
                        echo "<span class=\"input-group-text\" id=\"basic-addon1\">Telefone</span></div>";
                        echo "<input name=\"aTel\" type=\"text\" class=\"form-control\" value=\"$telS\" aria-label=\"Telefone\" aria-describedby=\"basic-addon1\"></div>"; 

                        echo "<div class=\"input-group mb-3\"><div class=\"input-group-prepend\">";
                        echo "<span class=\"input-group-text\" id=\"basic-addon1\">Email</span></div>";
                        echo "<input name=\"aEmail\" type=\"text\" class=\"form-control\" value=\"$emailS\" aria-label=\"Email\" aria-describedby=\"basic-addon1\"></div>"; 

                        echo "<div class=\"input-group mb-3\"><div class=\"input-group-prepend\">";
                        echo "<span class=\"input-group-text\" id=\"basic-addon1\">Endereço</span></div>";
                        echo "<input name=\"aEndereco\" type=\"text\" class=\"form-control\" value=\"$endS\" aria-label=\"Endereco\" aria-describedby=\"basic-addon1\"></div>"; 
                    }
                    echo "<button type=\"submit\" class=\"btn btn-primary btn-block\">Atualizar</button>";
                    echo "</form>";
                     
                }
            }
        }
        $conn->close();
    }

    function listaUsuarios($usuarios) {
        $conn = conection();
        $sql = "SELECT nome, usuario, senha From $usuarios";

        $result = $conn->query($sql);

        if ($result) {
            if ($result->num_rows > 0) {
                echo "<h3 style=\"text-align: center; margin-bottom: 1.5rem; text-transform: capitalize;\">$usuarios</h3>";
                echo "<table class=\"container table table-sm table-hover\" style=\"text-align: center\"><thead><tr>";
                echo "<th scope=\"col\">Nome</th><th scope=\"col\">Usuario</th><th scope=\"col\">Senha</th><th scope=\"col\">Excluir usuario</th></tr></thead>";
                echo "<tbody>";
                while ($row2 = $result->fetch_assoc()) {
                            
                    $nome = $row2['nome'];
                    $usuario = $row2['usuario'];
                    $senha = $row2['senha']; 
                    
                    echo "<tr>";
                    echo "<th scope=\"row\">$nome</th>";
                    echo "<td>$usuario</td>";
                    echo "<td>$senha</td>";
                    echo "<td><a onclick=\"removeUsuario('$usuario')\" class=\"btn btn-danger\">Excluir</a></td>";
                    echo "</tr>";                          
                    
                }
                echo "</tbody></table>";
            }else {
                echo "<h3 style=\"text-align: center; margin-bottom: 1.5rem\">Ainda não foi criado nenhum evento</h3>";
            }
        }
        $conn->close();    
    }

    function listaEventos($idOrganizacao) {
        $conn = conection();
        $sql = "SELECT Nome, Chave_Convite From eventos WHERE fk_ID_Organizadores = $idOrganizacao";

        $result = $conn->query($sql);

        if ($result) {
            if ($result->num_rows > 0) {
                echo "<h3 style=\"text-align: center; margin-bottom: 1.5rem; text-transform: capitalize;\"></h3>";
                echo "<table class=\"container table table-sm table-hover\" style=\"text-align: center\"><thead><tr>";
                echo "<th scope=\"col\">Nome</th><th scope=\"col\">Chave Convite</th><th</tr></thead>";
                echo "<tbody>";
                while ($row2 = $result->fetch_assoc()) {
                            
                    $nome = $row2['Nome'];
                    $codigo = $row2['Chave_Convite'];
                    
                    
                    echo "<tr>";
                    echo "<th scope=\"row\">$nome</th>";
                    echo "<td>$codigo</td>";
                    echo "</tr>";                          
                    
                }
                echo "</tbody></table>";

            }else {
                echo "<h5 style=\"padding-top: 30px;text-align: center; margin-bottom: 1.5rem\">Ainda não foi criado nenhum evento</h5>";
            }
        }
        $conn->close();    
    }

    function insereNovoEventoParticipante($chaveConvite, $idParticipante){
        $conn = conection();
        $sqlEvento = "SELECT Codigo_Evento FROM eventos WHERE Chave_Convite = $chaveConvite";
        $resultEvento = $conn->query($sqlEvento);

        if ($resultEvento && $resultEvento->num_rows > 0) {
            $rowEvento = $resultEvento->fetch_assoc();
            $codigoEvento = $rowEvento['Codigo_Evento'];

            // Insere na tabela participa
            $sqlInserirParticipa = "INSERT INTO participa (fk_Codigo_Evento, fk_ID_Participantes) VALUES ($codigoEvento, $idParticipante)";
            
            if ($conn->query($sqlInserirParticipa) === TRUE) {
                // Inserção bem-sucedida
                echo "Novo evento inserido para o participante!";
            } else {
                // Erro na inserção
                echo "Erro ao inserir evento: " . $conn->error;
            }
        } else {
            // Evento não encontrado
            echo "Evento não encontrado com a chave de convite fornecida.";
        }

    // Fecha a conexão
    $conn->close();
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

    function listaCards($idParticipante) {
        $conn = conection();

        $sql = "SELECT ID_Card, fk_ID_Categoria, Titulo FROM cards WHERE fk_ID_Participantes = $idParticipante";
        $result = $conn->query($sql);

        if ($result) {
            if ($result->num_rows > 0) {                                             

                echo "<table class=\"container table table-sm table-hover\" style=\"text-align: center\"><thead><tr>";
                echo "<th scope=\"col\">ID</th><th scope=\"col\">Categoria</th><th scope=\"col\">Titulo</th><th scope=\"col\">Excluir Card</th></tr></thead>";
                echo "<tbody>";
                
                while ($row = $result->fetch_assoc()) {
                            
                    $idCard = $row['ID_Card'];
                    $idCardCat = $row['fk_ID_Categoria'];
                    $idCardTit = $row['Titulo']; 
                    
                    echo "<tr>";
                    echo "<th scope=\"row\">$idCard</th>";
                    echo "<td>$idCardCat</td>";
                    echo "<td>$idCardTit</td>";
                    echo "<td><a onclick=\"removeCard('$idCard')\" class=\"btn btn-danger\">Excluir</a></td>";
                    echo "</tr>";                          
                    
                }
                echo "</tbody></table>";

            } else {
                echo "<h3 style=\"text-align: center; margin-bottom: 1.5rem\">Ainda não foi criado nenhum Card</h3>";
            }
        } 

        $conn->close(); 

    }

    function listaCardSelecionado($idCard) {
        $conn = conection();

        $sql = "SELECT fk_ID_Categoria, Titulo, Imagem, Descricao, Email, Telefone FROM cards WHERE ID_Card = $idCard";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();

        $cardCat = $row['fk_ID_Categoria']; //                   
        $cardTit = $row['Titulo'];//
        $cardImg = $row['Imagem'];//
        $cardDesc = $row['Descricao']; //                   
        $cardEmail = $row['Email']; 
        $cardTel = $row['Telefone'];

        echo "<div style=\"display: flex; justify-content: center\"><img style=\"max-width: 325px\" src=\"../public/imgs/Uploads/$cardImg\"></div>";        
        echo "<form action=\"../model/criaCard.php\" method=\"post\" enctype=\"multipart/form-data\">";

        echo "<input name=\"imagemAntiga\" value=\"$cardImg\" style=\"display: none\">";
        echo "<input name=\"idCard\" value=\"$idCard\" style=\"display: none\">";

        echo "<div style=\"margin-top: 1rem\" class=\"input-group mb-3\"><div class=\"input-group-prepend\"><span class=\"input-group-text\">Substituir Imagem</span></div>";
        echo "<div class=\"custom-file\"><input name=\"aImagem\" id=\"imgCard\" type=\"file\" class=\"custom-file-input\">";
        echo "<label class=\"custom-file-label\" for=\"imgCard\">Escolher Arquivo</label></div></div>";

        echo "<div class=\"input-group mb-3\"><div class=\"input-group-prepend\">";
        echo "<span class=\"input-group-text\" id=\"basic-addon1\">Titulo</span></div>";
        echo "<input name=\"aTitulo\" type=\"text\" class=\"form-control\" value=\"$cardTit\" aria-label=\"cardTit\" aria-describedby=\"basic-addon1\"></div>";
        
        echo "<div class=\"input-group mb-3\"><div class=\"input-group-prepend\">";
        echo "<span class=\"input-group-text\" id=\"basic-addon1\">Descrição</span></div>";
        echo "<textarea rows=\"5\" name=\"aConteudo\" type=\"text\" class=\"form-control\" aria-label=\"cardDesc\" aria-describedby=\"basic-addon1\">$cardDesc</textarea></div>";

        echo "<div class=\"input-group mb-3\"><div class=\"input-group-prepend\">";
        echo "<label class=\"input-group-text\" for=\"selectCat\">Categoria</label></div>";

        $sql2 = "SELECT Nome_Categoria FROM categorias WHERE ID_Categoria = $cardCat";
        $result2 = $conn->query($sql2);
        $row2 = $result2->fetch_assoc();
        $cardCatNome = $row2['Nome_Categoria'];

        echo "<select id=\"selectCat\" class=\"custom-select\" name=\"aCategoria\">";
        echo "<option value=\"$cardCat\">$cardCatNome</option>";
                                                                                                        
        $query = "SELECT `ID_Categoria`, `Nome_Categoria` FROM `categorias` WHERE ID_Categoria <> $cardCat";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<option value="' . $row['ID_Categoria'] . '">' . $row['Nome_Categoria'] . '</option>';
        }
        echo "</select></div>";

        echo "<label>Informações de Contato</label>";        
        echo "<div class=\"input-group mb-3\"><div class=\"input-group-prepend\">";
        echo "<span class=\"input-group-text\" id=\"basic-addon1\">Email</span></div>";
        echo "<input name=\"aEmail\" type=\"text\" class=\"form-control\" value=\"$cardEmail\" aria-label=\"Username\" aria-describedby=\"basic-addon1\"></div>";
        echo "<div class=\"input-group mb-3\"><div class=\"input-group-prepend\">";
        echo "<span class=\"input-group-text\" id=\"basic-addon1\">Telefone</span></div>";
        echo "<input name=\"aTelefone\" type=\"text\" class=\"form-control\" value=\"$cardTel\" aria-label=\"Username\" aria-describedby=\"basic-addon1\"></div>";  
        
        echo "<button type=\"submit\" class=\"btn btn-primary btn-block\">Atualizar</button>";
        echo "</form>";

        $conn->close();
    }

    function atualizaCard($idCard, $idUsuario, $categoria, $titulo, $descricao, $email, $telefone, $dataNow, $nomeArquivo = "") {
        $conn = conection();
        if ($nomeArquivo != "") {
            $sql = "UPDATE `cards` SET `fk_ID_Categoria` = $categoria, `Titulo` = '$titulo', Imagem = '$nomeArquivo', `Descricao` = '$descricao', `Email` = '$email', `Telefone` = '$telefone', `Data_publicacao` = '$dataNow' WHERE ID_Card = $idCard";
        } else {
            $sql = "UPDATE `cards` SET `fk_ID_Categoria` = $categoria, `Titulo` = '$titulo', `Descricao` = '$descricao', `Email` = '$email', `Telefone` = '$telefone', `Data_publicacao` = '$dataNow' WHERE ID_Card = $idCard";
        }
        if ($conn->query($sql) === FALSE) {
            echo "Erro ao inserir dados: " . $conn->error;
        } 
        
        $conn->close();
    }

    function excluirCards($idCard) {
        $conn = conection();

        $sql = "DELETE FROM cards WHERE ID_Card = $idCard";

        if ($conn->query($sql) === FALSE) {
            echo "<script>alert(Erro ao deletar card: " . $conn->error . ")</script>";
        } else {
            //$sql2 = "DELETE FROM visualizar WHERE fk_ID_Card = $idCard";
        }
        
        $conn->close();
    }

    function adicionaViewCard($idCard) {
        $con = conection();

        $sql = "UPDATE cards SET contagem = contagem + 1 WHERE ID_Card = $idCard";

        if ($con->query($sql) === FALSE) {
            echo "Erro ao inserir dados: " . $con->error;
        } 
        
        $con->close();
    }

    function adicionaViewVisualizar($cardId, $idVisitante, $cardFav = -1) {
        $con = conection();

        $sql = "SELECT * FROM visualizar WHERE fk_ID_Card = $cardId AND fk_ID_Visitantes = $idVisitante";        
        $result = $con->query($sql);

        if ($result->num_rows <= 0) {
            $sql1 = "INSERT INTO visualizar (fk_ID_Card, fk_ID_Visitantes) VALUES ($cardId, $idVisitante)";
            if ($con->query($sql1) === FALSE) {
                echo "Erro ao inserir dados: " . $con->error;
            } 
            
        } else if ($cardFav != -1) {
            $sql2 = "UPDATE visualizar SET Favoritar = $cardFav WHERE fk_ID_Card = $cardId AND fk_ID_Visitantes = $idVisitante";
            if ($con->query($sql2) === FALSE) {
                echo "Erro ao atualizar dados: " . $con->error;
            }
        }


        $con->close();
    }

    // Funções com a tabela de eventos.

    function insereEvento($idOrganizador,$nomeEvento, $codigoConvite){
        $con = conection();
        $sql = "INSERT INTO eventos (fk_ID_Organizadores, nome, chave_convite) VALUES ('$idOrganizador', '$nomeEvento', '$codigoConvite')";

        if ($con->query($sql) === FALSE) {
            echo "Erro ao inserir dados: " . $con->error;
        } 
        
        $con->close();
    }

    function atualizaEvento($idUsuario, $idEvento, $novoNomeEvento){
        $conn = conection();
        $sql = "UPDATE `eventos` SET `Nome` = '$novoNomeEvento' WHERE `Codigo_Evento` = $idEvento AND `fk_ID_Organizadores` = $idUsuario";

        if ($conn->query($sql) === FALSE) {
            echo "<script>alert(Erro ao inserir dados: " . $conn->error . ")</script>";
        } 
        
        $conn->close();        
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
                
                echo "<div class=\"container input-group mb-3\"><div class=\"input-group-prepend\">";
                echo "<span class=\"input-group-text\" id=\"inputGroup-sizing-default\">Nome do Evento</span></div>";
                echo "<input id=\"eventoNome\" value=\"$Nome\" type=\"text\" class=\"form-control\" aria-label=\"Sizing example input\" aria-describedby=\"inputGroup-sizing-default\"></div>";
                echo "<br><a onclick=\"salvarEdicaoEvento($id)\" class=\"btn btn-success\">Salvar Nome</a><br>";
                $sql2 = "SELECT p.ID_Participantes, p.Nome, p.Usuario FROM participantes AS p
                         LEFT JOIN participa AS par ON par.fk_id_participantes = p.ID_Participantes
                         WHERE p.fk_ID_Organizadores = $fk_ID_Organizadores AND par.fk_Codigo_Evento = $id";
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
            }
        }

        $conn->close(); 
    }

    function listarEventos($idOrganizador) {
        $conn = conection();
        $sql = "SELECT `Codigo_Evento`, `Nome`, `Chave_Convite` FROM `eventos` WHERE `fk_ID_Organizadores` = " .$idOrganizador;

        $result = $conn->query($sql);

        if ($result) {
            if ($result->num_rows > 0) {
                echo "<table class=\"container table table-sm table-hover\" style=\"text-align: center\"><thead><tr>";
                echo "<th scope=\"col\">ID</th><th scope=\"col\">Nome</th><th scope=\"col\">Chave</th><th scope=\"col\">Excluir Evento</th></tr></thead>";
                echo "<tbody>";
                while ($row2 = $result->fetch_assoc()) {
                            
                    $idEvento = $row2['Codigo_Evento'];
                    $nomeEvento = $row2['Nome'];
                    $chaveEvento = $row2['Chave_Convite']; 
                    
                    echo "<tr>";
                    echo "<th scope=\"row\">$idEvento</th>";
                    echo "<td>$nomeEvento</td>";
                    echo "<td>$chaveEvento</td>";
                    echo "<td><a onclick=\"removeEvento('$idEvento')\" class=\"btn btn-danger\">Excluir</a></td>";
                    echo "</tr>";                          
                    
                }
                echo "</tbody></table>";
            }else {
                echo "<h3 style=\"text-align: center; margin-bottom: 1.5rem\">Ainda não foi criado nenhum evento</h3>";
            }
        }
        $conn->close();    
    } 
    
    function excluirEvento($evento_a_excluir) {
        $conn = conection();
    
        // Seleciona os participantes associados ao evento
        $sqlParticipantes = "SELECT `fk_ID_Participantes` FROM `participa` WHERE `fk_Codigo_Evento` = $evento_a_excluir";
        $resultParticipantes = $conn->query($sqlParticipantes);
    
        if ($resultParticipantes === FALSE) {
            echo "<script>alert('Erro ao encontrar eventos: " . $conn->error . "')</script>";
            $conn->close();
            return;
        }
    
        // Itera sobre os participantes
        while ($rowParticipante = $resultParticipantes->fetch_assoc()) {
            $idParticipante = $rowParticipante['fk_ID_Participantes'];
    
            // Obtém o nome do arquivo da imagem para o participante atual
            $sqlImagem = "SELECT `Imagem` FROM `cards` WHERE `fk_ID_Participantes` = $idParticipante";
            $resultImagem = $conn->query($sqlImagem);
    
            if ($resultImagem === FALSE) {
                echo "<script>alert('Erro ao obter o nome do arquivo da imagem: " . $conn->error . "')</script>";
                $conn->close();
                return;
            }
    
            $rowImagem = $resultImagem->fetch_assoc();
            $nomeArquivo = $rowImagem['Imagem'];
    
            // Constrói o caminho completo para o arquivo
            $caminhoDaImagem = "../public/imgs/Uploads/$nomeArquivo";
    
            // Verifica se o arquivo existe antes de tentar excluir
            if (file_exists($caminhoDaImagem)) {
                // Tenta excluir a imagem
                if (unlink($caminhoDaImagem)) {
                    echo 'Imagem removida com sucesso.';
                } else {
                    echo 'Erro ao remover a imagem.';
                }
            } else {
                echo 'A imagem não foi encontrada.';
            }
    
            // Deleta os cards associados ao participante
            $sqlDeleteCards = "DELETE FROM `cards` WHERE `fk_ID_Participantes` = $idParticipante";
            if ($conn->query($sqlDeleteCards) === FALSE) {
                echo "<script>alert('Erro ao deletar cards: " . $conn->error . "')</script>";
                $conn->close();
                return;
            }
        }
    
        // Deleta os participantes associados ao evento
        $sqlDeleteParticipa = "DELETE FROM `participa` WHERE `fk_Codigo_Evento` = $evento_a_excluir";
        if ($conn->query($sqlDeleteParticipa) === FALSE) {
            echo "<script>alert('Erro ao deletar participantes associados ao evento: " . $conn->error . "')</script>";
            $conn->close();
            return;
        }
    
        // Deleta o evento
        $sqlDeleteEvento = "DELETE FROM `eventos` WHERE `Codigo_Evento` = $evento_a_excluir";
        if ($conn->query($sqlDeleteEvento) === FALSE) {
            echo "<script>alert('Erro ao deletar evento: " . $conn->error . "')</script>";
        }
    
        $conn->close();
    }
?>
