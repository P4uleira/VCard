<?php
    if(!session_start()){
        header('location: ../views/login.php');
    }else if($_SESSION['user_type'] != 'participante'){
        header('location: ../views/login.php');
    }
?>
<?php
    include 'sql.php';
    date_default_timezone_set('America/Sao_Paulo');
    $dataNow = date("Y-m-d");
    $dataNomeArquivo = date('H_i_s');

    if(isset($_FILES['imagem']) && isset($_POST['titulo']) && isset($_POST['conteudo'])&& isset($_POST['categoria']) && isset($_POST['telefone']) && isset($_POST['email'])){
        
        $titulo = $_POST['titulo'];
        $descricao = $_POST['conteudo'];
        $categoria = $_POST['categoria'];
        $telefone = $_POST['telefone'];
        $email = $_POST['email'];
        $capaCard = $_FILES['imagem'];

        $extensaoCard = explode(".", $capaCard['name']);
        $nomeArquivo  = $_SESSION['user_nickname']."_".$dataNomeArquivo.".".$extensaoCard[1];
        move_uploaded_file($capaCard["tmp_name"], '../public/imgs/Uploads/'.$nomeArquivo);

        $idUsuario = $_SESSION['user_id'];
        $visualizacao = 0;
        
        insereCard($idUsuario, $categoria, $titulo, $nomeArquivo, $descricao, $visualizacao, $email, $telefone, $dataNow);      
        
    } else if (isset($_POST['imagemAntiga']) && isset($_POST['aTitulo']) && isset($_POST['aConteudo'])&& isset($_POST['aCategoria']) && isset($_POST['aTelefone']) && isset($_POST['aEmail'])){
        $titulo = $_POST['aTitulo'];
        $descricao = $_POST['aConteudo'];
        $categoria = $_POST['aCategoria'];
        $telefone = $_POST['aTelefone'];
        $email = $_POST['aEmail'];
        $idUsuario = $_SESSION['user_id'];
        $imagemAntiga = $_POST['imagemAntiga'];
        $idCard = $_POST['idCard'];

        if (isset($_FILES["aImagem"])) {
            unlink("../public/imgs/Uploads/$imagemAntiga");         
            $capaCard = $_FILES['aImagem'];            
            $extensaoCard = explode(".", $capaCard['name']);
            $nomeArquivo  = $_SESSION['user_nickname']."_".$dataNomeArquivo.".".$extensaoCard[1];
            move_uploaded_file($capaCard["tmp_name"], '../public/imgs/Uploads/'.$nomeArquivo);
            atualizaCard($idCard, $idUsuario, $categoria, $titulo, $descricao, $email, $telefone, $dataNow, $nomeArquivo);
        } else {
            echo "a imagem n chegou";
            atualizaCard($idCard, $idUsuario, $categoria, $titulo, $descricao, $email, $telefone, $dataNow);
        }
        header("location: ../views/participante.php"); 
    }

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exibe Card</title>
    <link rel="stylesheet" href="../public/css/organizadores.css">
    <link rel="stylesheet" href="../public/css/cadProjeto.css">
    <link rel="stylesheet" href="../public/css/slidemenu.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <header>
        <?php include '../views/headerParticipante.php'; ?>
    </header>

    <main>
        <?php 
            if (isset($_FILES['imagem']) && isset($_POST['titulo']) && isset($_POST['conteudo']) && isset($_POST['telefone']) && isset($_POST['email'])) {
        ?>            
            <h2 style="text-align: center; margin-top: 80px"><?php echo $titulo; ?></h2>
            <div id="card_container" class="card_container">
                <div id="card_container_info" class="card_container_info"> 
                    <div style="display: flex;flex-direction: column;flex-wrap: nowrap;justify-content: space-between; max-width: 325px; word-wrap: break-word;" class="">
                        <div>
                            <?php echo "<img class=\"imagem-card\" src=\"../public/imgs/Uploads/$nomeArquivo\"> "; ?>
                            <h4 style="text-align: justify;padding: 10px;"><?php echo $descricao; ?></h4>
                        </div>

                        <div class="card_links">                            
                            <a onclick="rotacionar(0)">Mais informações</a>
                            <a href="#"><img src="../public/imgs/star_branca.svg"></a>
                        </div>
                    </div>
                </div>
                <div id="card_container_info_costas" class="card_container_info_costas">
                    <div style="height: 70px;">
                        <h2 style="font-size:medium; margin-top: 1rem; text-align: center"><?php echo "Informações Adicionais"; ?></h2>                    
                        <h3 style="font-size:medium; padding: 10px">
                            Contato:<br>Email: 
                            <?php echo $email; ?><br><br>Telefone: <br> <?php echo $telefone; ?>
                        </h3>
                    </div>
                    <div class="card_links">                        
                        <a onclick="rotacionar(1)">Voltar</a>                        
                    </div>
                </div>
            </div>
            <div style="display: flex; gap: 5%; justify-content: center;">
                <a style="margin-top: 1rem; width:150px" class="btn btn-primary" href="../views/participante.php?modo=eCard">Editar Card</a>
                <a style="margin-top: 1rem; width:150px" class="btn btn-primary" href="../views/participante.php">Voltar</a>
            </div>

        <?php } ?>
    </main>
    <script src="../public/javascript/card.js"></script>
</body>

</html>
