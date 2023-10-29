<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!----======== CSS ======== -->
    <link rel="stylesheet" href="./public/css/slidemenu.css">

    <!----===== Boxicons CSS ===== -->
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>

    <title>Vcards</title>

</head>
<body>
    <header>
        <div class="header">
            <div class="header_logo">            
                <a class="tituloPrincipal" href="index.php">
                    <img width="120px" src="./public/imgs/vcardsHeader.png" alt="logo vCards">
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
                <li><a style="color: #F0F0F0;" href="login.php"><strong>Fazer login</strong></a></li>
                
            </ul>
        </div>
    </header>  
</body>
</html>