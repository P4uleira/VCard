<!DOCTYPE html>
<html lang="pt-br">
<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
?>
<body>
    <header>
        <div class="header">
            <div class="header_logo">
                <a class="tituloPrincipal" href="../views/organizador.php">
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
                <li><a style="color: #F0F0F0;" href="../views/organizador.php?modo=cEvento">Criar Evento</a></li>
                <li><a style="color: #F0F0F0;" href="../model/criaParticipante.php">Criar Participante</a></li>
                <li><a style="color: #F0F0F0;" href="../views/organizador.php?modo=eEvento">Editar Evento</a></li>
                <li><a style="color: #F0F0F0;" href="../views/organizador.php?modo=exEvento">Excluir Evento</a></li>
                <li><a style="color: #F0F0F0;" href="">Todos os cards</a></li>
                <li><a style="color: #F0F0F0;" href="../views/login.php"><strong>Sair</strong></a></li>

            </ul>
        </div>
    </header>
</body>

</html>