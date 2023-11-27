<!DOCTYPE html>
<html lang="pt-br">

<body>
    <header>
        <div class="header">
            <div class="header_logo">
                <a class="tituloPrincipal" href="../views/administrador.php">
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
        <div style="z-index: 2" id="sidebarMenu">
            <ul class="sidebarMenuInner">

                <br><br><br>
                <li><a style="color: #F0F0F0;" href="../views/administrador.php?cOrg">Criar Organizador</a></li>
                <li><a style="color: #F0F0F0;" href="../views/administrador.php?cCat">Criar Categoria</a></li>
                <li><a style="color: #F0F0F0;" href="../views/administrador.php?esc">Excluir usuário</a></li>
                <li><a style="color: #F0F0F0;" href="../views/administrador.php?edit">Editar usuário</a></li>                    
                <li><a style="color: #F0F0F0;" href="login.php"><strong>Sair</strong></a></li>

            </ul>
        </div>
    </header>
</body>

</html>