<?php
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
    <link rel="stylesheet" href="../public/css/visitante.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                            <h3>Cards Favoritos</h3>

                            <div class="form-group">

                            </div>
                        </div>

                    <?php
                } else if (isset($_GET['modo'])) {
                    $modo = $_GET['modo'];
                    if ($modo == 'tCard') {
                        ?>
                                <div style="display: flex;padding-top: 100px;flex-wrap: wrap;justify-content: center;align-items: center;flex-direction: column;"class="container eEvento">
                                    <h3>TODOS OS CARDs</h3>

                                    <div class="form-group">
                                        <select class="form-select" id="organizacao" onchange="organizacaoSelecionada()">
                                            <option value="0">Selecione a organização</option>
                                        <?php
                                        include '../model/sql.php';
                                        $conn = conection();
                                        $query = "SELECT `ID_Organizadores`, `Nome` FROM `organizadores`";
                                        $result = mysqli_query($conn, $query);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo '<option value="' . $row['ID_Organizadores'] . '">' . $row['Nome'] . '</option>';
                                        }

                                        $conn->close();
                                        ?>
                                        </select>
                                    </div>
                                </div>
                        <?php
                    }
                } else {
                    ?>
                            <div class="container visitante_main">
                                <h4 class="h_qrCode">Bem vindo
                            <?php echo $_SESSION['user_nickname'] ?>
                                </h4>
                            </div>
                            <div class="eEvento list-group">
                                <h5 style="text-align: center">Opções de Participante</h5><br>
                                <a style="cursor: pointer" href="../views/visitante.php?modo=eQr"
                                    class="list-group-item list-group-item-action">Escanear QRcode</a><br>
                                <a style="cursor: pointer" href="../views/visitante.php?modo=fCard"
                                    class="list-group-item list-group-item-action">Meus favorito</a><br>
                                <a style="cursor: pointer" href="../views/visitante.php?modo=tCard"
                                    class="list-group-item list-group-item-action">Todos os cards</a><br>
                            </div>
                    <?php
                }
            }
        }

        ?>
    </main>
</body>
<script type="text/javascript" src="../public/javascript/visitante.js"></script>
<script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>

</html>