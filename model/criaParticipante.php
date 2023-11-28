<?php
    if(!session_start()){
        header('location: ../views/login.php');
    }else if($_SESSION['user_type'] != 'organizacao'){
        header('location: ../views/login.php');
    }
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/organizadores.css">
    <link rel="stylesheet" href="../public/css/slidemenu.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Cadastro de Participantes</title>
</head>

<body>
    <header>
        <?php include '../views/headerOrganizador.php'; ?>
    </header>
    <main>
        <?php if(isset($_POST['name']) && isset($_POST['user']) && isset($_POST['passwd']) && isset($_POST['eventos'])) { 
            $nomeParticipante = $_POST["name"];
            $usuarioParticipante = $_POST["user"];
            $senhaParticipante = $_POST["passwd"];
            $eventoParticipante = $_POST["eventos"];
            $idOrganizador = $_SESSION['user_id'];

            include '../model/sql.php';
            insereParticipante($idOrganizador, $nomeParticipante, $usuarioParticipante, $senhaParticipante, $eventoParticipante);
           
            echo "<div class=\"container eEvento\">";
            echo "<h3 style=\"text-align: center; margin-bottom: 1.5rem\">Participante $nomeParticipante foi adicionado com sucesso</h3>";
            echo "<a class=\"btn btn-info\" href=\"../model/criaParticipante.php\">Voltar</a></div>";
            } else {       
        ?>
            <div class="container eEvento">
                <h3>Cadastro de Participante</h3>
                <br>
                <form action="criaParticipante.php" method="post">
                    <div class="form-group">
                        <input name="name" type="text" class="form-control" id="nome_participante" placeholder="Nome do Participante">
                    </div>
                    <div class="row form-group">
                        <div class="col">
                        <input name="user" type="text" class="form-control" placeholder="Usuario para Login">
                        </div>
                        <div class="col">
                        <input name="passwd" type="text" class="form-control" placeholder="Senha para Login">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="eventos">Evento do Participante</label>                    
                        <select class="form-select" name="eventos" id="eventos" onchange="eventoSelecionado()">
                            <option value="0">Selecione um Evento</option>
                        <?php
                            include '../model/sql.php';
                            $conn = conection();
                            $query = "SELECT `Codigo_Evento`, `Nome` FROM `eventos` WHERE `fk_ID_Organizadores` = " .$_SESSION["user_id"];
                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<option value="' . $row['Codigo_Evento'] . '">' . $row['Nome'] . '</option>';
                            }

                            
                        ?>
                        </select>
                    </div>                 
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Foto</span>
                        </div>
                        <div class="custom-file">
                            <input disabled type="file" class="custom-file-input" id="inputGroupFile01">
                            <label class="custom-file-label" for="inputGroupFile01">Escolha uma imagem</label>
                        </div>
                    </div>
                    <div class="div_btn_criaParticipante">             
                        <input class="btn_criaParticipante btn btn-primary" style="text-align: center" type="submit" value="Cadastrar">
                        <button class="btn_criaParticipante btn btn-primary" type="reset" style="text-align: center">Limpar Formulário</button>
                    </div>                
                </form>
            </div>
        <?php } ?>       
    </main>
</body>

</html>