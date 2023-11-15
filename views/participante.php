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
    <?php
        include './headerParticipante.php';
    ?>
        
    <main>
        <?php
        if (isset($_GET['modo'])) {
            $modo = $_GET['modo'];
            if ($modo == 'cCard') {
        ?>
            <div class="container eEvento">
                <form action="" class="login_form" method="post" enctype="multipart/form-data">
                    <h5 style="text-align: center; margin-bottom: 1.5rem">Criar Card</h5>
                    <div class="form-group">
                        <label class="custum-file-upload inputadc" for="imagem">Capa do Card</label>                                                
                            <input class="custom-file-input" placeholder="Selecione uma Imagem" type="file" name="imagem" id="imagem"> 
                    </div>
                    <div class="form-group">                        
                        <input class=" form-control" placeholder="Titulo" name="titulo">
                    </div>
                    <div class="form-group">
                        <textarea name="conteudo"  class="form-control" rows="5" placeholder="Conteudo da Apresentação"></textarea>
                    </div>

                    <!-- trocar por um select -->
                    <div class="form-group">
                        <input name="categoria" class="form-control" placeholder="Categoria">
                    </div>
                    
                    <h5>Informações para contato</h5>
                    <div class="form-group">
                        <input name="telefon" class="form-control" placeholder="Telefone">
                    </div>
                    <div class="form-group">
                        <input name="email" class="form-control" placeholder="Email">
                    </div>
                    
                    <button class="animated-button btn-block">
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