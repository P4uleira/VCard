<?php
if (!session_start()) {
    header('location: ./login.php');
} else if ($_SESSION['user_type'] != 'participante') {
    header('location: ./login.php');
}
?>
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
                    <h4 style="text-align: center; margin-bottom: 1rem">Criar Card</h4>
                    <form method="post" action="../model/criaCard.php" enctype="multipart/form-data">
                        <div style="display: flex; flex-direction: column; align-items: center">
                            <label for="imagem" class="file-upload-label">
                            <div class="file-upload-design">
                                <svg viewBox="0 0 640 512" height="1em">
                                    <path
                                        d="M144 480C64.5 480 0 415.5 0 336c0-62.8 40.2-116.2 96.2-135.9c-.1-2.7-.2-5.4-.2-8.1c0-88.4 71.6-160 160-160c59.3 0 111 32.2 138.7 80.2C409.9 102 428.3 96 448 96c53 0 96 43 96 96c0 12.2-2.3 23.8-6.4 34.6C596 238.4 640 290.1 640 352c0 70.7-57.3 128-128 128H144zm79-217c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l39-39V392c0 13.3 10.7 24 24 24s24-10.7 24-24V257.9l39 39c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-80-80c-9.4-9.4-24.6-9.4-33.9 0l-80 80z">
                                    </path>
                                </svg>
                                <p style="text-align: center">Insira a capa do card aqui</p>
                            </div>
                            <input id="imagem" type="file" name="imagem" />
                            </label>
                        </div>

                        <div class="form-group">
                            <input required class=" form-control" placeholder="Título" name="titulo">
                        </div>

                        <div class="form-group">
                            <textarea required name="conteudo" class=" form-control" rows="5"
                                placeholder="Conteúdo da Apresentação"></textarea>
                        </div>

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
                            <input name="telefone" type="text" class="form-control" placeholder="Telefone" aria-label="Telefone"
                                aria-describedby="basic-addon1">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <img style="margin: 10px" width="20px" height="20px" src="../public/imgs/email.png">
                            </div>
                            <input name="email" type="text" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="basic-addon1">
                        </div>
                        <button class="btn btn-primary btn-block">Criar</button>
                    </form>
                </div>               
                <?php
            } else if ($modo == 'eCard') {
                ?>
                    <div class="container eEvento">
                        <div class="form-group">

                            <h4 style="text-align: center; margin-bottom: 1rem">Editar Card</h4>
                            <select class="form-select" id="editCard" onchange="cardSelecionado()">
                                <option value="0">Selecione o card que deseja editar</option>
                                <?php
                                include '../model/sql.php';
                                $conn = conection();
                                $query = "SELECT `ID_Card`, `Titulo` FROM `cards` WHERE fk_ID_Participantes = " . $_SESSION["user_id"];
                                $result = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '<option value="' . $row['ID_Card'] . '">' . $row['Titulo'] . '</option>';
                                }
                                $conn->close();
                                ?>
                            </select>
                        </div>
                        <?php
                        if (isset($_GET['card'])) {
                            $idCard = $_GET['card'];
                            listaCardSelecionado($idCard);
                        }
                        ?>
                    </div>


                <?php
            } else if ($modo == 'Qrcode') {
                ?>

                        <div class="container eEvento">

                            <div class="form-group">
                                <h3 style="display: flex;justify-content: center;padding: 0 0 20px;">Gerar QRcode</h3>

                                <select class="form-select" id="qrcode">
                                    <option value="0">Selecione o card que deseja gerar o QR code</option>
                                <?php
                                include '../model/sql.php';
                                $conn = conection();
                                $query = "SELECT `ID_Card`, `Titulo` FROM `cards` WHERE fk_ID_Participantes = " . $_SESSION["user_id"];
                                $result = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '<option value="' . $row['ID_Card'] . '">' . $row['Titulo'] . '</option>';
                                }
                                ?>
                                </select><br>
                            </div>
                            <button onclick="generateQRCode()" class="btn btn-primary btn-block">
                                <span>Gerar QR Code</span>
                                <span></span>
                            </button>

                            <div style="display: flex; padding-top: 50px; justify-content: center" id="qrcode-container"></div>
                        </div>
                        </div>

                <?php
            } else if ($modo == 'excCard') {
                ?>
                            <div class="eEvento">
                                <h3 style="text-align: center; margin-bottom: 1.5rem">Excluir Card</h3>
                                <br>
                        <?php
                        $idParticipante = $_SESSION['user_id'];
                        include '../model/sql.php';
                        listaCards($idParticipante);
            } else if ($modo == 'eEvento') { ?>
                <div class="eEvento">
                    <h3 style="text-align: center; margin-bottom: 1.5rem">Participar de um Evento</h3><br>
                        <select class="form-select" id="eventoParticipa" onchange="eventoParticipar()">
                            <option value="0">Selecione uma organização</option>
            <?php
                    include '../model/sql.php';
                    $conn = conection();
                    $query = "SELECT `ID_Organizadores`, `Nome` FROM `organizadores`";
                    $result = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<option value="' . $row['ID_Organizadores'] . '">' . $row['Nome'] . '</option>';
                    }
            ?>
                        </select><br>                                    
            <?php if (isset($_GET['evento'])) {
                $evento = $_GET['evento'];
                listaEventos($evento);
            ?>
                <form action="../model/novoEventoParti.php" method="post">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Chave</span>
                        </div>
                        <input class="form-control" type="text" name="chaveConvite" placeholder="Digite a chave convite">
                    </div>
                    <button type="button" class="btn btn-primary btn-block">Entrar no Evento</button>
                </form>
                </div>
            <?php
                }
            }
            ?>

                <?php
        } else {
            ?>
                <div class="eEvento list-group">
                    <h5 style="text-align: center">Opções de Participante</h5><br>
                    <a style="cursor: pointer" href="../views/participante.php?modo=cCard"
                        class="list-group-item list-group-item-action">Criar Card</a><br>
                    <a style="cursor: pointer" href="../views/participante.php?modo=eCard"
                        class="list-group-item list-group-item-action">Editar Card</a><br>
                    <a style="cursor: pointer" href="../views/participante.php?modo=Qrcode"
                        class="list-group-item list-group-item-action">Gerar QRCode</a><br>
                    <a style="cursor: pointer" href="../views/participante.php?modo=excCard"
                        class="list-group-item list-group-item-action">Excluir Card</a><br>
                    <a style="cursor: pointer" href="../views/participante.php?modo=eEvento"
                        class="list-group-item list-group-item-action">Participar de um Evento</a><br>
                </div>

            </div>
        <?php } ?>
    </main>
    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
    <script>
        function generateQRCode() {
            var selectedCardId = document.getElementById('qrcode').value;

            if (selectedCardId > 0) {
                // Gera o link da página com base no ID do card
                var link = 'https://192.168.0.110/VCard/views/card.php?id=' + selectedCardId;

                // Limpa o conteúdo anterior, se houver
                document.getElementById('qrcode-container').innerHTML = '';

                // Cria o QR code usando qrcode.js
                var qrcode = new QRCode(document.getElementById('qrcode-container'), {
                    text: link,
                    width: 128,
                    height: 128
                });
            } else {
                alert('Por favor, selecione um card válido.');
            }
        }
    </script>
    <script src="../public/javascript/participante.js"></script>
</body>

</html>