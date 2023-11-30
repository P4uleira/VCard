<?php

session_start();
include '../model/sql.php';
if (isset($_SESSION["user_type"]) && $_SESSION["user_type"] == "visitante" || $_SESSION["user_type"] == "organizacao" ) {
    $isLogado = true;
} else {
    $isLogado = false;
}


if ($isLogado && isset($_GET['id'])) {
    $cardId = $_GET['id'];
    $idVisitante = $_SESSION["user_id"];

    adicionaViewCard($cardId);
    adicionaViewVisualizar($cardId, $idVisitante);


    if (isset($_GET['fav'])) {
        $cardFav = $_GET['fav'];
        adicionaViewVisualizar($cardId, $idVisitante, $cardFav);
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/cadProjeto.css">
    <link rel="stylesheet" href="../public/css/slidemenu.css">
    <link rel="stylesheet" href="../public/css/visitante.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>

    <title>Informações do Card</title>
</head>

<body>
    <header>
        <?php
        if(!$isLogado) {
            include './headerAnonimo.php';
        }else if ($_SESSION["user_type"] == "visitante")  {
            include './headerVisitante.php';
        }else {
            include './headerOrganizador.php';
        }
        
        if (isset($_GET['id'])) {            
            $cardId = $_GET['id'];            
            $conn = conection();
            $query = "SELECT * FROM `cards` WHERE `ID_Card` =  $cardId";
            $result = mysqli_query($conn, $query);

            if ($row = mysqli_fetch_assoc($result)) {
                $titulo = $row['Titulo'];
                $descricao = $row['Descricao'];
                $nomeArquivo = $row['Imagem'];
                $email = $row['Email'];
                $telefone = $row['Telefone'];
            } else {
                echo '<p>Card não encontrado</p>';
            }
        } else {
            echo '<p>ID do card não fornecido</p>';
        }
        $conn->close();
        ?>
    </header>
    <main>
        <h2 style="text-align: center; margin-top: 80px">
            <?php echo $titulo; ?>
        </h2>
        <div id="card_container" class="card_container">
            <div id="card_container_info" class="card_container_info">
                <div style="display: flex;flex-direction: column;flex-wrap: nowrap;justify-content: space-between;"
                    class="">
                    <div>
                        <?php echo "<img class=\"imagem-card\" src=\"../public/imgs/Uploads/$nomeArquivo\"> "; ?>
                        <h4 style="text-align: justify;padding: 10px;">
                            <?php echo $descricao; ?>
                        </h4>
                    </div>

                    <div class="card_links">
                        <a style="font-size: larger" onclick="rotacionar(0)">Mais informações</a>
                        <a href="#"><img id="icon_star" src="../public/imgs/star_branca.svg"></a>
                    </div>
                </div>
            </div>
            <div id="card_container_info_costas" class="card_container_info_costas">
                <div>
                    <h2 style="text-align: center;font-size: larger;margin: 1rem 0;">
                        <?php echo "Informações Adicionais"; ?>
                    </h2>
                    <h3 style="padding: 10px; font-size: 1.25rem">
                        Contato:<br>Email:<br>
                        <?php echo $email; ?><br><br>Telefone: <br>
                        <?php echo $telefone; ?>
                    </h3>
                </div>
                <div class="card_links">
                    <a style="font-size: larger" onclick="rotacionar(1)">Voltar</a>
                </div>
            </div>
        </div>
    </main>
    <script src="../public/javascript/card.js"></script>
</body>

</html>