<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/organizadores.css">
    <link rel="stylesheet" href="../public/css/slidemenu.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Participante</title>
</head>

<body>
        <header>
        <?php
        include './headerParticipante.php';
        ?>
        </header>

            <main>
                <?php
                if (isset($_GET['modo'])) {
                    $modo = $_GET['modo'];
                    if ($modo == 'cCard') {
                ?>
                    <div class="container">
                        <form action="" style="margin-top: 10rem" class="login_form" method="post" enctype="multipart/form-data">
                            <input class="limpar-placeholder inputadc" class="form-control" placeholder="Titulo">
                            <input class="limpar-placeholder inputadc" class="form-control" placeholder="Conteudo da Apresentação">
                            <input class="limpar-placeholder inputadc" class="form-control" placeholder="Categoria">
                            <input class="limpar-placeholder inputadc" class="form-control" placeholder="URLs">
                            <input class="limpar-placeholder inputadc" class="form-control" placeholder="Informações de contato">
                            <label class="custum-file-upload inputadc" for="imagem">

                                <div class="text">
                                    <span>Selecione uma Imagem</span>
                                </div>
                                <input type="file" name="imagem" id="imagem">
                            </label><br>
                            <button class="animated-button">
                                <span>Cadastrar</span>
                                <span></span>
                            </button>
                            </div>
                        </form>
                    </div>

                        <?php
                    } else if ($modo == 'eCard') {
                        ?>

                        <?php
                    } else if ($modo == 'excCard') {
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