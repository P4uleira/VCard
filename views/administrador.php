<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/organizadores.css">
    <link rel="stylesheet" href="../public/css/slidemenu.css">
    <link rel="stylesheet" href="../public/css/administrador.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>VCard</title>
</head>

<body>
    <?php
    include 'headerAdministrador.php';
    ?>
    <main>
        <?php 
            if (isset($_GET['cOrg'])) {
        ?>
        <div class="container admin_container">
            <h3>Criar Organizador</h3>
            <br>
            <form action="../model/criaOrganizador.php" method="post">                
                <div class="form-group">
                    <input type="text" placeholder="Nome da instituição" class="form-control" name="nome">
                    <span class="highlight"></span>
                    <span class="bar"></span>
                </div>
                <div class="form-group">
                    <input type="text" placeholder="Usuário" class="form-control" name="usuario">
                    <span class="highlight"></span>
                    <span class="bar"></span>                        
                </div>
                <div class="form-group">
                    <input type="password" placeholder="Senha" class="form-control" name="senha">
                    <span class="highlight"></span>
                    <span class="bar"></span>                        
                </div>
                <br>
                <input class="btn btn-primary btn-block" style="text-align: center" type="submit" value="Cria Organizador ">
            </form>
        </div>

        <?php
            } else if (isset($_GET['esc'])) {
        ?>
            <div class="container eEvento">
                <h3 style="text-align: center;">Excluir usuário</h3><br>      
                <div class="form-group">
                    <select class="form-select" id="tipouserexcluir" onchange="tipoUsuarioSelecionadoExcluir()">
                        <option value="0">Selecione um tipo de usuário</option>
                        <option value="organizadores">Organizadores</option>
                        <option value="participantes">Participantes</option>
                        <option value="visitantes">Visitantes</option>
                    </select>                                   
                </div>                    
            </div>
        <?php
            if (isset($_GET['user'])) { 
                include '../model/sql.php';
                $userExc = $_GET['user'];
                listaUsuarios($userExc);   
            }
        } else if (isset($_GET['edit'])) {
        ?>
            <div class="container eEvento">
                <h3 style="text-align: center;">Editar usuário</h3><br>      
                <div class="form-group">
                    <select class="form-select" id="tipousereditar" onchange="tipoUsuarioSelecionadoEditar()">
                        <option value="0">Selecione um tipo de usuário</option>
                        <option value="organizadores">Organizadores</option>
                        <option value="participantes">Participantes</option>
                        <option value="visitantes">Visitantes</option>
                    </select>                                   
                </div>                    
            </div>
        <?php
            if (isset($_GET['user'])) {
                include '../model/sql.php';
                $userEdit = $_GET['user'];
                selectListaUsuarios($userEdit); 
            }
        }
        ?>
    </main>
    <script type="text/javascript" src="../model/javascript/administrador.js"></script>
</body>

</html>