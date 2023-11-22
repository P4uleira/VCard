<?php session_start(); ?>
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
                <form method="post" action="../model/criaCard.php" enctype="multipart/form-data">
                    <div style="display: flex; flex-direction: column; align-items: center">
                        <label for="imagem" class="file-upload-label">
                            <div class="file-upload-design">
                                <svg viewBox="0 0 640 512" height="1em">
                                <path
                                d="M144 480C64.5 480 0 415.5 0 336c0-62.8 40.2-116.2 96.2-135.9c-.1-2.7-.2-5.4-.2-8.1c0-88.4 71.6-160 160-160c59.3 0 111 32.2 138.7 80.2C409.9 102 428.3 96 448 96c53 0 96 43 96 96c0 12.2-2.3 23.8-6.4 34.6C596 238.4 640 290.1 640 352c0 70.7-57.3 128-128 128H144zm79-217c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l39-39V392c0 13.3 10.7 24 24 24s24-10.7 24-24V257.9l39 39c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-80-80c-9.4-9.4-24.6-9.4-33.9 0l-80 80z"
                                ></path>
                                </svg>
                                <p style="text-align: center">Insira a capa do card aqui</p>
                            </div>
                            <input id="imagem" type="file" name="imagem"/>
                        </label>
                    </div>               

                    <div class="form-group">                        
                        <input required class=" form-control" placeholder="Título" name="titulo">
                    </div>

                    <div class="form-group">
                        <textarea required name="conteudo"  class=" form-control" rows="5" placeholder="Conteúdo da Apresentação"></textarea>
                    </div>

                    <!-- tem que fazer o select como o banco de dados -->
                    <select class="form-select" name="categoria" id="categoria">
                        <option value="0">Selecione uma Categoria</option>
                        <?php
                            include '../model/sql.php';
                            $conn = conection();
                            $query = "SELECT `ID_Categoria`, `Nome_Categoria` FROM `categorias`";
                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<option value="' . $row['ID_Categoria'] . '">' . $row['Nome_Categoria'] . '</option>';
                            }
                        ?>
                    </select><br>
                    
                    <h5>Informações para contato</h5>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <img style="margin: 10px" width="20px" height="20px" src="../public/imgs/phone.png">
                        </div>
                        <input name="telefone" type="text" class="form-control" placeholder="Telefone" aria-label="Telefone" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <img style="margin: 10px" width="20px" height="20px" src="../public/imgs/email.png">
                        </div>
                        <input name="email" type="text" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="basic-addon1">
                    </div>                    
                        
                    </div><br>
                    
                    <button class="buttonPart btn-block">
                        <span>Cadastrar</span>
                        <span></span>
                    </button>
                    </div>
                </form>
            </div>

                <?php
            } else if ($modo == 'eCard') {
                ?>
            <div class="container eEvento">
                <form class="form-group"> 
                    <div class="form-group">
                    <select class="form-select" name="editarCard" id="editarCard">
                    <option value="0">Selecione um cartão</option>
                    </select><br>
                    </div><br>
                    
                    <button class="buttonPart btn-block">
                        <span>Cadastrar</span>
                        <span></span>
                    </button>
                    </div>
                </form>
            </div>

                <?php
            } else if ($modo == 'exCard') {
                ?>

            <div class="container eEvento">
                <form class="form-group"> 
                    <div class="form-group">
                    <select class="form-select" name="excluirCard" id="excluirCard">
                    <option value="0">Selecione um cartão</option>
                    </select><br>
                    </div><br>
                    
                    <button class="buttonPart btn-block">
                        <span>Cadastrar</span>
                        <span></span>
                    </button>
                    </div>
                </form>
            </div>

                <?php
            }
        }
        ?>
    </main>
</body>

</html>