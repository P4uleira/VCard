<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./public/css/login.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
    <title>Login</title>
</head>
<body>
    <header>
        <div class="login_header_logo"><img style="width: 185px;" src="./public/imgs/vcardsbg.png" alt="logo Vcards" ></div>
    </header>
</body>
    <main>
        <?php 
            if (!isset($_GET['modo'])) {
        ?>
            <div class="container login_main">
                <h3>Login</h3>

                <form class="login_form" action="login.php" method="post" onsubmit="return validaLogin()">
                    <div class="group">
                        <input required="" type="email" placeholder="Email" class="input">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                    </div>
                    <div class="group">
                        <input required="" type="password" placeholder="Senha" class="input">
                        <span class="highlight"></span>
                        <span class="bar"></span>                        
                    </div>
                    <br>
                    <button class="login_submit" style="text-align: center">Entrar</button>
                </form>
                <a class="login_links" href="login.php?modo=rSenha">Esqueci minha senha</a>
                <a class="login_links" href="login.php?modo=criar">Criar conta</a>
            </div>
        <?php 
            } else {
                $modo = $_GET['modo'];

                if ($modo == "criar") {
        ?> 
                <div class="container login_main">
                    <h3>Criar Conta</h3>
                    
                    <div class="login_create_profiles">
                        <a href="#" class="login_create_profile">Visitante</a>
                        <a href="#" class="login_create_profile">Expositor</a>
                        <a href="#" class="login_create_profile">Organizador</a>
                    </div>

                    <form style="margin-top: 5%" class="login_form" action="login.php" method="post" onsubmit="return validaLoginCreate()">
                        <div style="margin-top: 0" class="group">
                            <input required="" type="text" placeholder="Nome" class="input">
                            <span class="highlight"></span>
                            <span class="bar"></span>
                        </div>
                        <div style="margin-top: 0" class="group">
                            <input required="" type="text" placeholder="Número" class="input">
                            <span class="highlight"></span>
                            <span class="bar"></span>                        
                        </div>
                        <div style="margin-top: 0" class="group">
                            <input required="" type="Email" placeholder="Email" class="input">
                            <span class="highlight"></span>
                            <span class="bar"></span>                        
                        </div>
                        <div style="margin-top: 0" class="group">
                            <input required="" type="password" placeholder="Senha" class="input">
                            <span class="highlight"></span>
                            <span class="bar"></span>                        
                        </div>
                        <div style="margin-top: 0" class="group">
                            <input required="" type="password" placeholder="Repetir Senha" class="input">
                            <span class="highlight"></span>
                            <span class="bar"></span>                        
                        </div>                        
                        <button class="login_submit" style="text-align: center">Criar Conta</button>
                    </form>                    
                    <a class="login_links" href="login.php">Voltar</a>
                </div>
        <?php
                } else if ($modo == "rSenha") {
        ?>
                <div class="container login_main">
                    <h3>Recuperar Conta</h3><br>
                    <h6 style="text-align: center; color: #887F7F;">Insira seu e-mail cadastrado para</br>conseguir redefinir sua senha</h6>
                    
                    <form style="margin-top: 5%" class="login_form" action="login.php?modo=rSenhaEnviado" method="post" onsubmit="return validaLoginCreate()">
                        <div style="margin: 20% 0" class="group">
                            <input required="" type="Email" placeholder="Email" class="input">
                            <span class="highlight"></span>
                            <span class="bar"></span>                        
                        </div>                                               
                        <button class="login_submit" style="text-align: center">Enviar Email</button>
                    </form>                    
                    <a class="login_links" href="login.php">Voltar</a>
                </div>
        <?php
                } else if ($modo == "rSenhaEnviado") {
        ?>
                <div class="container login_main">
                    <h3>Recuperar Conta</h3><br>
                    <h6 style="text-align: center; color: #887F7F;">Email de recuperação enviado
                        </br></br>Confira sua caixa de mensagens para</br>redefinir sua senha
                    </h6>                                       
                    <a style="text-align:center" class="login_submit" href="login.php">Voltar</a>
                </div>
        <?php
                }

            }
        ?>
    </main>
</html>