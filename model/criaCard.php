<?php
    if(!session_start()){
        header('location: ../views/login.php');
    }else if($_SESSION['user_type'] != 'participante'){
        header('location: ../views/login.php');
    }
?>
<?php
    include 'sql.php';

    if(isset($_FILES['imagem']) && isset($_POST['titulo']) && isset($_POST['conteudo'])&& isset($_POST['categoria']) && isset($_POST['telefone']) && isset($_POST['email'])){
        
        $titulo = $_POST['titulo'];
        $descricao = $_POST['conteudo'];
        $categoria = $_POST['categoria'];
        $telefone = $_POST['telefone'];
        $email = $_POST['email'];
        $capaCard = $_FILES['imagem'];

        $extensaoCard = explode(".", $capaCard['name']);
        $nomeArquivo  = $_SESSION['user_nickname'].".".$extensaoCard[1];

        date_default_timezone_set('America/Sao_Paulo');
        $dataNow = date('Y-m-d'); 

        move_uploaded_file($capaCard["tmp_name"], '../public/imgs/Uploads/'.$nomeArquivo); 

        $idUsuario = $_SESSION['user_id'];
        $visualizacao = 0;
        
        insereCard($idUsuario, $categoria, $titulo, $nomeArquivo, $descricao, $visualizacao, $email, $telefone, $dataNow);      

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
            <h4>Card:</h4><br>
            <h2 style="text-align: center;"><?php echo $titulo; ?></h2>
            <div id="card_container" class="card_container">
                <div id="card_container_info" class="card_container_info"> 
                    <div style="height: 485px;display: flex;flex-direction: column;flex-wrap: nowrap;justify-content: space-between;" class="">
                        <div>
                            <?php echo "<img class=\"imagem-card\" src=\"../public/imgs/Uploads/$nomeArquivo\"> "; ?>
                            <h4 style="text-align: justify;padding: 10px;"><?php echo $descricao; ?></h4>
                        </div>

                        <div class="card_links">
                            <a href="#"><img id="icon_coracao" src="../public/imgs/coracao_branco.svg"></a>
                            <a onclick="rotacionar(0)">Mais informações</a>
                            <a href="#"><img id="icon_star" src="../public/imgs/star_branca.svg"></a>
                        </div>
                    </div>
                </div>
                <div id="card_container_info_costas" class="card_container_info_costas">
                    <div style="height: 70px;">
                        <h2 style="text-align: center"><?php echo "Informações Adicionais"; ?></h2>                    
                        <h3 style="padding: 10px">
                            Contato:<br>Email: 
                            <?php echo $email; ?><br><br>Telefone: <br> <?php echo $telefone; ?>
                        </h3>
                    </div>
                    <div class="card_links">                        
                        <a onclick="rotacionar(1)">Voltar</a>                        
                    </div>
                </div>
            </div>
        <?php } ?>
    </main>
    <script src="../public/javascript/card.js"></script>
</body>

</html>
