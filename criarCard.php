<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/css/organizadores.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>VCard</title>
</head>

<body>
    <header>
        <div class="header">
            <div class="header_logo">
                <a class="tituloPrincipal" href="index.php">
                    <img width="60 px" src="./public/imgs/logo_vcards_branco.png" alt="logo vCards">
                </a>
            </div>
        </div>
        <input type="checkbox" class="openSidebarMenu" id="openSidebarMenu">
        <label for="openSidebarMenu" class="sidebarIconToggle">
            <div class="spinner diagonal part-1"></div>
            <div class="spinner horizontal"></div>
            <div class="spinner diagonal part-2"></div>
        </label>
        <div id="sidebarMenu">
            <ul class="sidebarMenuInner">

                <br><br><br>
                <li><a style="color: #F0F0F0;" href="organizadores.php">Voltar</a></li>
                <li><a style="color: #F0F0F0;" href="login.php"><strong>Sair</strong></a></li>

            </ul>
        </div>
    </header>
    <div>
    <form action="" class="inputs" method="post" enctype="multipart/form-data">
        <input class="limpar-placeholder inputadc" id="titulo" placeholder="Titulo">
        <input class="limpar-placeholder inputadc" id="apresentacao" placeholder="Conteudo da Apresentação">
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
    


    <script>
        document.addEventListener("click", function (event) {
  if (event.target.classList.contains("limpar-placeholder")) {
    event.target.placeholder = "";
  }
});
    </script>
</body>

</html>