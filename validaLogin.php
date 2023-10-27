<?php
    include 'sql.php';

    session_start();

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $loginID = login($email, $senha);

    if ($loginID > 0) {
        $_SESSION["logado"] = true;
        $_SESSION["user"] = $loginID;

        header("Location: index.php");
    } else {
        header("Location: login.php?err=1");
    }
        
?>