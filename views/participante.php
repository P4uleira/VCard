<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Participante</title>
</head>
<body>
    <header>
        <?php include 'headerParticipante.php'; ?>
    <header>
    
    <main>
    <?php
    if(isset($_GET['modo'])){
        $modo = $_GET['modo'];
        if($modo == 'cCard'){           
    ?>
            <div class="container eEvento">
                

            </div>
    </main>
</body>
</html>