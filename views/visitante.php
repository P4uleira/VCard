<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/slidemenu.css">
    <link rel="stylesheet" href="../public/css/visitante.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>VCard</title>
</head>

<body>
    <?php        
        include 'headerVisitante.php';
    ?>
    <main>
        <div class="container visitante_main">
            <h4 class="h_qrCode">Bem vindo <?php echo $_SESSION['user_nickname']?></h4>
            <div class="pesquisa">
                <button class="botao_Fav"> Favoritos</button> 
                <button class="botao_todoscards"> Todos os cards</button> 
                <input class="input" type="text" placeholder="Pesquisar"> 
            </div>
        </div>
    </main>
</body>

</html>

<?php 
    include '../model/sql.php';
    function exibe_card($id) {
        $conn = conection();

        $sql = "SELECT `c.ID_Card`, `p.Nome`, `cat.Nome_Categoria`, `c.Titulo`, `c.Imagem`, `c.Descricao`, `c.Contagem`, `c.URL`, `c.Email`, `c.Telefone`, `c.Data_publicacao` 
        FROM `cards c` 
        LEFT JOIN `participantes p` ON `p.ID_Usuario` = `c.ID_Usuario`
        LEFT JOIN `categorias cat` ON `cat.ID_Categoria` = `c.ID_Categoria`
        WHERE ID_Card = ? ;";
        $resultado = $conn->prepare($sql);

        if ($resultado) {
            $resultado->bind_param("ss", $id);
            $resultado->execute();
            $resultado->bind_result($id_card ,$nome_participante, $nome_categoria, $card_titulo, $card_img, $card_desc, $card_cont, $card_url, $card_email, $card_telef, $card_dt);

            if ($resultado->fetch()) {
                $resultado->close();
                $conn->close();
                return [
                'id_card' => $id_card, 
                'nome_participante' => $nome_participante, 
                'nome_categoria' => $nome_categoria, 
                'card_titulo' => $card_titulo, 
                'card_img' => $card_img, 
                'card_desc' => $card_desc, 
                'card_cont' => $card_cont,
                'card_url' => $card_url,
                'card_email' => $card_email,
                'card_tel' => $card_telef,
                'card_dt' => $card_dt
                ];
            }
            $resultado->close();
        } else {
            echo "Erro na preparação da consulta: " . $conn->error;
        }
    }