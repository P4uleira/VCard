<!DOCTYPE html>
<html lang="pt-br">

<body>
    <header>
        <div class="header">
            <div class="header_logo">
                <a class="tituloPrincipal" href="visitante.php">
                    <img width="120px" src="../public/imgs/vcardsHeader.png" alt="logo vCards">
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
            <div style="display: flex; align-items: center; flex-direction: column; margin-top: 1.5rem">
                <a class="tituloPrincipal" href="index.php">
                    <img src="../public/imgs/ellipse1.png">
                </a>            
            <?php
                if (isset($_SESSION['logado'])) {
                    $usuario = $_SESSION['user_nickname'];
                    echo "<p style=\"color: white; margin-top: 0.5rem\">$usuario</p>";
                }else {
                    echo "<p style=\"color: white; margin-top: 0.5rem\">Login</p>";
                }                
            ?>
            </div>
                
                <li><a style="color: #F0F0F0;" href="meusAlugados.php">Escanear QRcode</a></li>
                <br>
                <li><a style="color: #F0F0F0;" href="index.php?cat=28">Meus favoritos</a></li>
                <li><a style="color: #F0F0F0;" href="index.php?cat=878">Todos os cards</a></li>
                <li><a style="color: #F0F0F0;" href="login.php"><strong>Sair</strong></a></li>

            </ul>
        </div>
    </header>
</body>

</html>