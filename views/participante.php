<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/slidemenu.css">
    <link rel="stylesheet" href="../public/css/visitante.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

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
                if (isset($_GET['modo'])) {
                    $modo = $_GET['modo'];
                    if ($modo == 'cCard') {
                        ?>
                        <div class="container cCard">
                            <form action="" class="inputs" method="post" enctype="multipart/form-data">
                                <input class="limpar-placeholder inputadc" id="titulo" placeholder="Titulo">
                                <input class="limpar-placeholder inputadc" id="apresentacao"
                                    placeholder="Conteudo da Apresentação">
                                <input class="limpar-placeholder inputadc" id="categoria" placeholder="Categoria">
                                <input class="limpar-placeholder inputadc" id="urls" placeholder="URLs">
                                <input class="limpar-placeholder inputadc" id="info" placeholder="Informações de contato">
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