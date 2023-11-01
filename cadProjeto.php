<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/css/cadProjeto.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmM"
        crossorigin="anonymous">
    </script>
    <title>Cadastro de Projetos</title>
</head>

<body>
    <header>
        <div class="login_header_logo"><img style="width: 185px;" src="./public/imgs/vcardsbg.png" alt="logo Vcards"></div>
    </header>
    <main>
        <div class="container login_main">
            <h3>Cadastro de Projeto</h3>
            <form class="login_form" action="validaLogin.php" method="post">
                <div class="group">
                    <input type="titulo" placeholder="Título do Projeto" class="input" name="titulo">
                    <span class="highlight"></span>
                    <span class="bar"></span>
                </div>
                <div class="group">
                    <input type="descricao" placeholder="Breve descrição" class="input" name="descricao">
                    <span class="highlight"></span>
                    <span class="bar"></span>
                </div>
                <div class="group">
                    <input type="imagem" placeholder="Legenda da Imagem" class="input" name="imagem">
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    </div>
                <div class="group">
                    <input type="file" name="imagem" id="imagem" accept="image/*" required>
                    <span class="highlight"></span>
                    <span class="bar"></span>
                </div>
                <br>
                <button class="login_submit" type="submit" style="text-align: center">Cadastrar</button>
                <button class="login_submit" type="reset" style="text-align: center">Limpar Formulário</button>
                <br>
                <br>
                <br>
            </form>
        </div>
    </main>
</body>
</html>
