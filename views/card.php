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
        ?>
    </header>
    <main>
        <div class="container login_main">
            <h3>Título do Projeto</h3>
            <img src="caminho-para-imagem.jpg" alt="Imagem do Projeto">
            <p>Pequena descrição do projeto</p>
            <div class="login_create_profiles">
                <button class="login_submit" type="button" id="favoritarButton" onclick="favoritar()">
                    <span id="favoritarContent">
                        <img src="./public/imgs/coracao1.svg" alt="Favoritar" style="width: 25px;"> Favoritar 
                    </span>
                </button>

                <span id="contadorVisualizacoes">Aguarde...</span>
            </div>
        </div>
    </main>
</body>

</html>