<?php
    include '../model/sql.php';
    
    if(isset($_POST["nomeLogin"]) && isset($_POST["numeroLogin"]) && isset($_POST["emailLogin"]) && isset($_POST["enderecoLogin"])&& isset($_POST["nomeUsuarioLogin"])&& isset($_POST["senhaLogin"])){
        $nome = $_POST['nomeLogin'];
        $numeroT = $_POST['numeroLogin'];
        $email = $_POST['emailLogin'];
        $endereco = $_POST['enderecoLogin'];
        $usuario = $_POST['nomeUsuarioLogin'];
        $senha = $_POST['senhaLogin'];        
        criaVisitante($nome, $numeroT, $email,$endereco,$usuario, $senha);

    } else if(isset($_POST["aUser"]) && isset($_POST["id"]) && isset($_POST["aNome"]) && isset($_POST["aSenha"])){
        $id =  $_POST["id"];
        $usuario = $_POST["aUser"];
        $nome = $_POST["aNome"];
        $senha = $_POST["aSenha"];
        if(isset($_POST["aIdOrg"]) && isset($_POST["aIdEvento"])){
            $tipoUser = "participantes";
            $idOrg = $_POST["aIdOrg"];
            $idEvento = $_POST["aIdEvento"];
            atualizaUsuario($id, $nome, $usuario, $senha, $tipoUser, $idOrg, $idEvento);
            
        } else if (isset($_POST["aTel"]) && isset($_POST["aEmail"]) && isset($_POST["aEndereco"])) {
            $tipoUser = "visitantes";
            $telefone = $_POST["aTel"];
            $email = $_POST["aEmail"];
            $endereco = $_POST["aEndereco"];
            atualizaUsuario($id, $nome, $usuario, $senha, $tipoUser, "", "", $telefone, $email, $endereco);

        } else {
            $tipoUser = "organizadores";
            atualizaUsuario($id, $nome, $usuario, $senha, $tipoUser);
        }

    }
    
    function criaVisitante($nome, $numeroT, $email,$endereco,$usuario, $senha) {
        insereVisitante($nome, $numeroT, $email,$endereco, $usuario, $senha);
        header('location: ../views/login.php');
    }

    function atualizaUsuario($id, $nome, $usuario, $senha, $tipoUser, $idOrg = "", $idEvento = "", $telefone = "", $email = "", $endereco = "") {
        $conn = conection();

        if ($tipoUser == "participantes") {
            $sql = "UPDATE `participantes` SET `ID_Organizadores` = '$idOrg', `Nome` = '$nome', `Usuario` = '$usuario', `Senha` = '$senha', `fk_Codigo_Evento` = '$idEvento' WHERE `participantes`.`ID_Participantes` = '$id'";       
        } else if ($tipoUser == "visitantes") {
            $sql = "UPDATE `visitantes` SET `Nome` = '$nome', `Usuario` = '$usuario', `Senha` = '$senha', `Telefone` = '$telefone', `Email` = '$email', `Endereco` = '$endereco' WHERE `visitantes`.`ID_Visitantes` = '$id'";
        } else {
            $sql = "UPDATE `organizadores` SET `Nome` = '$nome', `Usuario` = '$usuario', `Senha` = '$senha' WHERE `organizadores`.`ID_Organizadores` = '$id'";
        }

        if ($conn->query($sql) === TRUE) {
            header('location: ../views/administrador.php?edit');
        } else {
            echo "Erro ao atualizar dados: " . $con->error;
        }

        $conn->close();
    }
?>