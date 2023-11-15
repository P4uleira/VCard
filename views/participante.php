<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Participante</title>
</head>
<body>
    <header>
        <?php
            include './headerParticipante.php'; 
        ?>
    <header>
    
    <main>
        <?php
            if(isset($_GET['modo'])){
                $modo = $_GET['modo'];
                if($modo == 'cCard'){           
        ?>
            <div class="container cCard">
                

            </div>

        <?php
                }else if($modo == 'eCard'){
        ?>
            <form action="../model/criaCard.php" method="POST">
                <h3 style="text-align: center; margin-bottom: 1.5rem">Cria Card</h3>
                <div class="container eCard">
                    <input type="text" placeholder="Titulo" class="form-control" name="titulo">
                    <span class="highlight"></span>
                    <span class="bar"></span>

                    <input type="text" placeholder="Descrição" class="form-control" name="descricao">
                    <span class="highlight"></span>
                    <span class="bar"></span>

                    <input type="text" placeholder="Descrição" class="form-control" name="descricao">
                    <span class="highlight"></span>
                    <span class="bar"></span>
                </div>
            </form>          
        <?php
                }else if($modo == 'excCard'){
        ?>

            <div class="container excCard">

            </div>

        <?php
                }
            }
        ?>
    </main>
</body>
</html>