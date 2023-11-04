<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/slidemenu.css">
    <link rel="stylesheet" href="../public/css/visitante.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>VCard</title>
</head>

<body>
    <?php        
        include 'headerVisitante.php';
    ?>
    <main>
        <div class="container visitante_main">
            <h4 class="h_qrCode"><a class="link_qrCode" href="">Escanear QRcode</a></h4>
            <div style="display: flex; align-items: center; flex-direction: column; margin-top: 3.5rem">
                <a class="tituloPrincipal" href="index.php">
                    <img src="../public/imgs/qrcode.png">
                </a>
            </div> 
        </div>
    </main>
</body>

</html>