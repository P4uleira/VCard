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
        include './headerVisitante.php';


        if (isset($_GET['id'])) {
            $cardId = $_GET['id'];


            include '../model/sql.php';
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
        ?>
    </header>
    <main>
        <h4>Card:</h4><br><br>
        <div id="card_container" class="card_container">
            <div id="card_container_info" class="card_container_info">
                <div style="height: 70px;">
                    <h2>
                        <?php echo $titulo; ?>
                    </h2>
                </div>
                <?php echo "<img src=\"../public/imgs/Uploads/$nomeArquivo\"> "; ?>
                <div style="height: 365px" class="">
                    <h4 style="text-align: justify">
                        <?php echo $descricao; ?>
                    </h4>
                </div>
                <div class="card_links">
                    <a href="#"><img id="icon_coracao" src="../public/imgs/coracao_branco.svg"></a>
                    <a onclick="rotacionar(0)">Mais informações</a>
                    <a href="#"><img id="icon_star" src="../public/imgs/star_branca.svg"></a>
                </div>
            </div>
            <div id="card_container_info_costas" class="card_container_info_costas">
                <div style="height: 70px;">
                    <h2>
                        <?php echo "Informações Adicionais"; ?>
                    </h2>
                </div>
                <div style="height: 400px" class="">
                    <h3>
                        Contato:<br>Email:
                        <?php echo $email; ?><br><br>Telefone: <br>
                        <?php echo $telefone; ?>
                    </h3>
                </div>
                <div class="card_links">
                    <a onclick="rotacionar(1)">Voltar</a>
                </div>
            </div>
        </div>
    </main>
</body>

</html>