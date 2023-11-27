<?php
    if(!session_start()){
        header('location: ./login.php');
    }else if($_SESSION['user_type'] != 'visitante'){
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>VCard</title>
</head>

<body>
    <?php        
        include 'headerVisitante.php';
    ?>
    <main>
        <div class="container visitante_main">
            <h4 class="h_qrCode">Bem vindo <?php echo $_SESSION['user_nickname']?></h4>
        </div>
        <?php
            if(isset($_GET['modo'])){
                $modo = $_GET['modo'];
                if($modo == 'tCard'){           
        ?>
                    <div class="container eEvento">
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
            if(isset($_GET['orgSelect'])){
                $idOrg = $_GET['orgSelect'];
        ?>
            <div class="form-group">
                <select class="form-select" id="eventos">
                    <option value="0">Selecione o evento</option>
                    <?php                        
                        $conn = conection();
                        $query = "SELECT `Codigo_Evento`, `Nome` FROM `eventos` WHERE fk_ID_Organizadores = $idOrg";
                        $result = mysqli_query($conn, $query);
                        var_dump($result);
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<option value="' . $row['Codigo_Evento'] . '">' . $row['Nome'] . '</option>';
                        }

                        $conn->close();
                    ?>
                </select> 
            </div>
        <?php
                if(isset($_GET['evento'])){
                    $idOrg = $_GET['orgSelect'];
                    $evento = $_GET['evento'];                    
                    exibeCards($idOrg, $evento);
                }
            }
            }
        }
        ?>
    </main>
</body>
<script type="text/javascript" src="../public/javascript/visitante.js"></script>

</html>