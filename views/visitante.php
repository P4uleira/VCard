<?php
include '../model/sql.php';
if (!session_start()) {
    header('location: ./login.php');
} else if ($_SESSION['user_type'] != 'visitante') {
    header('location: ./login.php');
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/slidemenu.css">
    <link rel="stylesheet" href="../public/css/organizadores.css">
    <link rel="stylesheet" href="../public/css/visitante.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../public/javascript/qr.min.js"></script>
    <title>VCard</title>
</head>

<body>
    <?php
    include 'headerVisitante.php';
    ?>
    <main>
        <?php
        if (isset($_GET['modo'])) {
            $modo = $_GET['modo'];
            if ($modo == 'eQr') {
                ?>
                <div style="margin-top: 80px" class="">
                    <div class="row2">
                        <div class="col">
                            <div style="width:500px;" id="reader"></div>
                        </div>
                        <div id="resultadoDoScan" style="display: none">
                            <div class="col" style="padding:30px;">
                                <h4>Acessar Card</h4>
                                <a class="btn btn-info" href="#" id="result">Visualizar Card</a>
                            </div>
                        </div>
                    </div>         
                </div>

                
                <video id="video" style="display:none"></video>
                <?php
            } else if (isset($_GET['modo'])) {
                $modo = $_GET['modo'];
                if ($modo == 'fCard') {

                    ?>
                        <div class="container eEvento">
                            <h3 style="text-align: center">Cards Favoritos</h3>

                            <div class="form-group">

                            <?php
                                
                                $conn = conection();
                                $sql = "SELECT `fk_ID_Card` FROM `visualizar` WHERE `fk_ID_Visitantes` = ".$_SESSION['user_id']." AND `Favoritar` = 1";

                                $result = $conn->query($sql);                                
                                if ($result->num_rows > 0) {
                                    echo '<div class="container">';                                    
                                    echo '<div class="form-group">';
                                
                                    $cardCounter = 0; 
                                
                                    while ($row = $result->fetch_assoc()) {
                                        $id_card = $row['fk_ID_Card'];                                        
                                        

                                        $sql2 = "SELECT * FROM `cards` WHERE `ID_Card` = $id_card";
                                        $result2 = $conn->query($sql2);
                                
                                        if ($result2->num_rows > 0) {
                                            
                                            while ($row2 = $result2->fetch_assoc()) {
                                                if ($cardCounter % 2 == 0) {
                                                    
                                                    echo '<div style="display: flex; justify-content: space-around;" class="row">';
                                                }
                                
                                                echo '<div style="max-width: 325px; margin: 1rem 0" class="col-md-6">';
                                                
                                                echo "<img style=\"width: 325px; border-radius: 8px; height: 220px;\" src=\"../public/imgs/Uploads/{$row2['Imagem']}\" class=\"img-fluid\">";
                                                
                                                echo '<h4 style="text-align: center; margin-top: 5px; max-width: 325px;">' . $row2['Titulo'] . '</h4>';
                                                
                                                echo "<a style=\"max-width: 325px;\" class=\"btn btn-primary btn-block\" href=\"../views/card.php?id=$id_card&fav=1\">Visualizar Card</a>";
                                                echo '</div>';
                                
                                                if ($cardCounter % 2 != 0 || $cardCounter == $result->num_rows - 1) {
                                                    
                                                    echo '</div>';
                                                }
                                
                                                $cardCounter++;
                                            }
                                        } else {
                                            echo '<h3 style="text-align: center">Você ainda não tem um card favoritado.</h3>';
                                        }
                                    }
                                
                                    echo '</div>';
                                    echo '</div>';
                                } else {
                                    echo '<h3 style="text-align: center">Você ainda não tem um card favoritado.</h3>';
                                }
                                
                                $conn->close();
                            ?>
                            </div>
                        </div>

                    <?php
                } else if (isset($_GET['modo'])) {
                    $modo = $_GET['modo'];
                    if ($modo == 'tCard') {
                        ?>
                                <div style="display: flex;flex-wrap: wrap;justify-content: center;align-items: center;flex-direction: column;"class="container eEvento">
                                    <h3>Todos os Cards</h3>

                                    
                                    <select class="form-select" id="organizacao" onchange="organizacaoSelecionada()">
                                        <option value="0">Selecione a organização</option>
                                    <?php
                                    
                                    $conn = conection();
                                    $query = "SELECT `ID_Organizadores`, `Nome` FROM `organizadores`";
                                    $result = mysqli_query($conn, $query);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo '<option value="' . $row['ID_Organizadores'] . '">' . $row['Nome'] . '</option>';
                                    }

                                    $conn->close();
                                    ?>
                                    </select>
                                    
                                
                        <?php
                        if (isset($_GET['orgSelect'])) {
                            $orgSelect = $_GET['orgSelect'];
                            $idVisitante = $_SESSION['user_id'];
                            listaTodosCardsOrg($idVisitante, $orgSelect);                            
                        }
                        echo "</div>";
                    }
                }
            } 
        }
            else {
                    ?>
                            <div class="eEvento list-group">
                            <div class="container">
                                <h4 class="h_qrCode">Bem vindo
                            <?php echo $_SESSION['user_nickname'] ?>
                                </h4>
                            </div>
                                <h5 style="text-align: center">Opções de Participante</h5><br>
                                <a style="text-align: center; cursor: pointer" href="../views/visitante.php?modo=eQr"
                                    class="btn btn-primary list-group-item list-group-item-action">Escanear QRcode</a><br>
                                <a style="text-align: center; cursor: pointer" href="../views/visitante.php?modo=fCard"
                                    class="btn btn-primary list-group-item list-group-item-action">Meus favoritos</a><br>
                                <a style="text-align: center; cursor: pointer" href="../views/visitante.php?modo=tCard"
                                    class="btn btn-primary list-group-item list-group-item-action">Todos os cards</a><br>
                            </div>
                    <?php
                }
        ?>
    </main>
</body>
<script type="text/javascript" src="../public/javascript/visitante.js"></script>
<script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>

</html>