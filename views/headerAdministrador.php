<!DOCTYPE html>
<html lang="pt-br">

<body>
    <header>
        <div class="header">
            <div class="header_logo">
                <a class="tituloPrincipal" href="index.php">
                    <img width="60 px" src="../public/imgs/logo_vcards_branco.png" alt="logo vCards">
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
                <li><a style="color: #F0F0F0;" href="headerAdministrador.php">Criar Organizador</a></li>
                <li><a style="color: #F0F0F0;" href="Administrador.php?esc=excluir">Excluir usuário</a></li>
                <li><a style="color: #F0F0F0;" href="">Editar usuário</a></li>
                <li><a style="color: #F0F0F0;" href="index.php?cat=878">Listar usuários</a></li>
                <li><a style="color: #F0F0F0;" href="login.php"><strong>Sair</strong></a></li>

            </ul>
        </div>
    </header>

    <main>
        <?php 
            if (!isset($_GET['esc'])) {
        ?>
        <div class="container login_main">
                <h3>Criar Organizador</h3>

                <form class="login_form" action="../model/criaOrganizador.php" method="post">
                    <br>
                    <br>
                    <div class="group">
                        <input type="text" placeholder="Nome da instituição" class="input" name="nome">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                    </div>
                    <div class="group">
                        <input type="text" placeholder="Usuário" class="input" name="usuario">
                        <span class="highlight"></span>
                        <span class="bar"></span>                        
                    </div>
                    <div class="group">
                        <input type="password" placeholder="Senha" class="input" name="senha">
                        <span class="highlight"></span>
                        <span class="bar"></span>                        
                    </div>
                    <br>
                    <input class="login_submit" style="text-align: center" type="submit" value="Cria Conta">
                </form>
            </div>

        <?php
            } else {
                $esc = $_GET['esc'];

                if ($esc == "excluir") {
        ?>

            <div class="container login_main">
                <h3>Excluir usuário</h3>

                <form class="login_form" action="./model/excluiUsuario.php" method="post">
                    <br>
                    <br>
                    <div class="group">
                        <input type="text" placeholder="Nome do Usuário" class="input" name="nome">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                    </div>
                    
                    <br>
                    <input class="login_submit" style="text-align: center" type="submit" value="Exclui Usuário">
                </form>
            </div>

            <?php
                } 

            }
            ?>
    </main>

</body>

</html>