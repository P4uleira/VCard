<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/css/cadProjeto.css">
    <link rel="stylesheet" href="../public/css/slidemenu.css">
    <link rel="stylesheet" href="../public/css/visitante.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmM" crossorigin="anonymous">
        </script>
    <title>Informações do Card</title>
</head>


<body>
    <header>
        <?php include './headerVisitante.php'; ?>
    </header>
    <main>
        <div class="container login_main">
            <h3>Título do Projeto</h3>
            <img src="caminho-para-imagem.jpg" alt="Imagem do Projeto">
            <p>Pequena descrição do projeto</p>
            <div class="login_create_profiles">
                <button class="login_submit" type="button" id="favoritarButton" onclick="favoritar()">
                    <span id="favoritarContent">
                        <img src="./public/imgs/coracao1.svg" alt="Favoritar" style="width: 25px;"> Favoritar
                    </span>
                </button>

                <span id="contadorVisualizacoes">Aguarde...</span>
            </div>
        </div>
    </main>

    <script>
        let favoritado = false;

        function favoritar() {
            if (favoritado) {
                document.getElementById('favoritarContent').innerHTML = `
            <img src="./public/imgs/coracao1.svg" alt="Favoritar" style="width: 25px;">
            Favoritar
        `;

                removeFromFavorites();
            } else {
                document.getElementById('favoritarContent').innerHTML = `
            <img src="./public/imgs/coracao2.svg" alt="Favoritado" style="width: 25px;">
            Favoritado
        `;

                addToFavorites();
            }

            favoritado = !favoritado;
        }

        function addToFavorites() {

            fetch('adicionar_favorito.php', {
                method: 'POST',
                body: JSON.stringify({ pagina: 'URL_da_Pagina' }),
                headers: {
                    'Content-Type': 'application/json'
                }
            })
                .then(response => {
                    if (response.ok) {
                        console.log('Página adicionada à galeria de favoritos');
                    }
                })
                .catch(error => {
                    console.error('Erro ao adicionar página aos favoritos: ' + error);
                });
        }

        function removeFromFavorites() {

            fetch('remover_favorito.php', {
                method: 'POST',
                body: JSON.stringify({ pagina: 'URL_da_Pagina' }),
                headers: {
                    'Content-Type': 'application/json'
                }
            })
                .then(response => {
                    if (response.ok) {
                        console.log('Página removida da galeria de favoritos');
                    }
                })
                .catch(error => {
                    console.error('Erro ao remover página dos favoritos: ' + error);
                });
        }


        function atualizarContador() {
            fetch('contador.php')
                .then(response => response.text())
                .then(data => {
                    const contadorVisualizacoes = document.getElementById("contadorVisualizacoes");
                    contadorVisualizacoes.textContent = data + " Visualizações";
                });
        }


        atualizarContador();
    </script>
</body>

</html>