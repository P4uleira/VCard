<?php session_start(); ?>
<?php
    include 'sql.php';

    if(isset($_FILES['imagem']) && isset($_POST['titulo']) && isset($_POST['conteudo']) && isset($_POST['telefone']) && isset($_POST['email'])){
        $titulo = $_POST['titulo'];
        $descricao = $_POST['conteudo'];
        $telefone = $_POST['telefone'];
        $email = $_POST['email'];
        $capaCard = $_FILES['imagem'];

        $extensaoCard = explode(".", $capaCard['name']);
        $nomeArquivo  = $_SESSION['user_nickname'].".".$extensaoCard[1];

        move_uploaded_file($capaCard["tmp_name"], '../public/imgs/Uploads/'.$nomeArquivo);        

        //criaCard($titulo, $descricao, $telefone, $email);
    }

    function criaCard($titulo, $descricao, $telefone, $email){

        $dataNow = date('d/m/Y');
        insereCard($idParticipante, $idCategoria, $titulo, $imagem, $descricao, 0, $email, $telefone, $dataNow);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exibe Card</title>
    <link rel="stylesheet" href="../public/css/organizadores.css">
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
            <h4>Card:</h4><br><br>
            <div id="card_container" class="card_container">
                <div id="card_container_info" class="card_container_info">
                    <div style="height: 70px;">
                        <h2><?php echo $titulo; ?></h2>
                    </div>
                    <?php echo "<img src=\"../public/imgs/Uploads/$nomeArquivo\"> "; ?>
                    <div style="height: 365px" class="">
                        <h4 style="text-align: justify"><?php echo $descricao; ?></h4>
                    </div>
                    <div class="card_links">
                        <a href="#"><img id="icon_coracao" src="../public/imgs/coracao_branco.svg"></a>
                        <a onclick="rotacionar(0)">Mais informações</a>
                        <a href="#"><img id="icon_star" src="../public/imgs/star_branca.svg"></a>
                    </div>
                </div>
                <div id="card_container_info_costas" class="card_container_info_costas">
                    <div style="height: 70px;">
                        <h2><?php echo "Informações Adicionais"; ?></h2>
                    </div>
                    <div style="height: 400px" class="">
                        <h3>
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
</body>

<style>
    .card_container {
        display: flex;
        width: 100%;
        justify-content: center;
        transition: transform 0.5s;
    }

    .card_container_info {
        display: flex;
        width: 325px;
        height: 525px;
        flex-direction: column;
        align-content: center;
        justify-content: center;
        align-items: center;
        padding: 10px;
        border-radius: 10px;
        border: 1px solid;
        transition: transform 0.5s;
       
    }

    .card_container_info_costas {
        display: none;
        width: 325px;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 10px;
        border-radius: 10px;
        border: 1px solid;
        transition: transform 0.5s;
        height: 525px;        
    }

    .card_links {
        height: 30px;
        display: flex;
        width: 100%;
        justify-content: space-around;
    }


</style>

<script>

    $( document ).ready(function() {
        var estadoCoracao = 0; 
        $("#icon_coracao").click(function(){ 
            if (estadoCoracao == 0) {
                $("#icon_coracao").attr("src","../public/imgs/coracao_vermelho.svg");
                estadoCoracao = 1;
            } else {
                $("#icon_coracao").attr("src","../public/imgs/coracao_branco.svg");
                estadoCoracao = 0;
            }

        });

        var estadoEstrela = 0; 
        $("#icon_star").click(function(){ 
            if (estadoEstrela == 0) {
                $("#icon_star").attr("src","../public/imgs/star_amarela.svg");
                estadoEstrela = 1;
            } else {
                $("#icon_star").attr("src","../public/imgs/star_branca.svg");
                estadoEstrela = 0;
            }

        });


    });


    function rotacionar(lado) {       

        if (lado == 0) {  
            $("#card_container").css("transform", "rotateY(90deg)");        
            $("#card_container_info_costas").css("transform", "rotateY(180deg)");             
            setTimeout(() => {
                $("#card_container_info").css("display", "none"); 
                $("#card_container_info_costas").css("display", "flex");    
                $("#card_container").css("transform", "rotateY(180deg)"); 
            }, 300);
                         
        } else {
            $("#card_container").css("transform", "rotateY(90deg)");            
            setTimeout(() => {
                $("#card_container_info_costas").css("display", "none");
                $("#card_container_info").css("display", "flex"); 
                $("#card_container").css("transform", "rotateY(0deg)");
            }, 300);                                   
        }
    }

</script>

</html>
