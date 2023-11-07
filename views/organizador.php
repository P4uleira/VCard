<!DOCTYPE html>
<html lang="pt-BR">
<?php
    session_start();
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/organizadores.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>VCard</title>
</head>

<body>
    <?php
    include 'headerOrganizador.php';
    ?>
    <main>
        <?php
            if(isset($_GET['modo'])){
                $modo = $_GET['modo'];
                if($modo == 'cEvento'){           
        ?>
            <div class="container login_main">
                <br>
                <br>
                <h3>Criar Evento</h3>

                <form class="login_form" action="../model/criaEvento.php" method="post">
                    <div class="group">
                        <input type="text" placeholder="Nome do Evento" class="input" name="nome">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                    </div>
                    <br>
                    <input class="login_submit" style="text-align: center" type="submit" value="Criar Evento">
                </form>
            </div>
        <?php
            } else if ($modo == 'eEvento') {
        ?>
            <div class="eEvento">
                <h3 style="text-align: center; margin-bottom: 1.5rem">Editar Evento</h3>
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
        <?php
                    if(isset($_GET['idEvento'])){
                        $idEvento = $_GET['idEvento'];
                        listaEvento($idEvento);
                    }
                }
            }
        ?>
    </main>
</body>
<script type="text/javascript" src="../model/javascript/organizador.js"></script>
</html>