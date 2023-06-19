<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Web II Movies</title>
    <style>
        /* Estilos para o catálogo de filmes */
        body {
            background-color: #333333;
            color: #ffffff;
            font-family: monospace, Arial, sans-serif;
            margin: 0;
        }

        .container {
            margin: 20px;
        }

        .cartaz {
            width: 10vw;

        }

        .catalogo-filmes {
            display: flex;
            flex-wrap: wrap;
            flex-grow: 2;
            justify-content: center;
            margin-top: 80px;
            /* Espaço para evitar que os filmes fiquem escondidos atrás do cabeçalho */
        }

        .filme {
            flex: 0 0 300px;
            flex-grow: 1;
            margin: 10px;
            background-color: #444;
            border-radius: 5px;
            overflow: hidden;
            transition: transform 0.3s;
            z-index: 1;
            width: 25vw;
            height: 90vh;
        }

        .filme:hover {
            transform: scale(1.05);
        }

        .filme img {
            width: 100%;
            height: 400px;
            object-fit: cover;
        }

        .filme .descricao {
            padding: 10px;
        }

        .filme h2 {
            margin: 0;
            font-size: 20px;
            color: #fff;
            line-break: auto;
            max-width: fit-content;
        }

        .filme p {
            margin-top: 10px;
            color: #ddd;
        }

        /* Estilos para o cabeçalho */
        .cabecalho {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: #222;
        }

        .titulo {
            font-size: 24px;
        }

        .submenu {
            position: relative;
            display: inline-block;
            cursor: pointer;
        }

        .submenu-list {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            background-color: #222;
            padding: 10px;
            z-index: 999;
        }

        .submenu-item {
            cursor: pointer;
            color: #fff;
            margin-top: 5px;
        }

        .submenu-item:hover {
            color: #ddd;
        }

        .submenu-list::before {
            content: attr(data-label);
            color: #ddd;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 5px;
        }

        /* Estilo adicionado para remover os bullets do submenu */
        .submenu-list li {
            list-style: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="cabecalho">
            <div class="titulo" onclick="redirecionarParaIndex()" style="cursor: pointer;">Web II Movies</div>
            <div class="submenu" onclick="toggleSubMenu('submenu-genero')">
                Filtros
                <ul class="submenu-list" id="submenu-genero">
                    <?php
                        $url = "http://localhost:3001/genero/listar";
                        $response = json_decode(file_get_contents($url,false));
                        echo '<li class="submenu-item" onclick="filtrarFilmes(\'MeusFilmes\')">Meus filmes</li>';
                        foreach ($response as $genero) {
                            echo '<li class="submenu-item" onclick="filtrarFilmes(\'' . $genero->nome . '\')">' . $genero->nome . '</li>';
                        }

                    ?>
                    <!-- <li class="submenu-item" onclick="filtrarFilmes('MeusFilmes')">Todos</li>
                    <li class="submenu-item" onclick="filtrarFilmes('Ação')">Ação</li>
                    <li class="submenu-item" onclick="filtrarFilmes('Comédia')">Comédia</li>
                    <li class="submenu-item" onclick="filtrarFilmes('Terror')">Terror</li>
                    <li class="submenu-item" onclick="filtrarFilmes('Comprados')">Comprados</li> -->
                    <!-- Adicionar mais gêneros conforme necessário. Só coloquei esses de exemplo no primeiro momento -->
                </ul>
            </div>
            <div class="submenu" onclick="redirecionarParaAddUser()">Adicionar Usuário</div>

            <?php
                $url = "http://localhost:3001/usuario/nome";
                $token = $_GET['token'];

                // Cabeçalho da requisição
                $options = [
                    'http' => [
                        'header' => "Authorization: Bearer $token"
                    ]
                ];
                $context = stream_context_create($options);

                $response = json_decode(file_get_contents($url,false, $context));
                $nome = $response->nome;

                if ($response != null) {
                    echo '<div class="submenu">';
                    echo $nome;
                    echo '</div>';
                    echo '<div class="submenu" onclick="logout()">Logout</div>';
                } else {
                    echo '<div class="submenu" onclick="acessarComoAdmin()">
                    Acessar
                    </div>';
                }
            ?>
           
        </div>
        <div class="catalogo-filmes">
            <?php

            // Array de filmes
            $token = $_GET['token'];
            $limit = $_GET['limit'];
            $offset = $_GET['offset'];
            $genero = $_GET['genero'] ?? 'Todos';
            $generoCodificado = urlencode($genero);

            $url = "http://localhost:3001/filme/listar/$limit/$offset/$generoCodificado";

            // Cabeçalho da requisição
            $options = [
                'http' => [
                    'header' => "Authorization: Bearer $token"
                ]
            ];
            $context = stream_context_create($options);

            $response = json_decode(file_get_contents($url,false, $context));

            if ($response != null) {
                // Exibindo os filmes
                foreach ($response as $filme) {

                    $urlFormatada = 'https://image.tmdb.org/t/p/original' . $filme->imagem;

                    echo '<form action="moviePage.php?token=' . $token . '" method="POST">';
                    echo '<input type="hidden" name="id" value="' . htmlspecialchars($filme->id) . '">';
                    echo '<input type="hidden" name="nome" value="' . htmlspecialchars($filme->nome) . '">';
                    // echo '<input type="hidden" name="genero" value="' . htmlspecialchars($filme->genero) . '">';
                    echo '<input type="hidden" name="descricao" value="' . htmlspecialchars($filme->descricao) . '">';
                    echo '<input type="hidden" name="imagem" value="' . htmlspecialchars($urlFormatada) . '">';
                    echo '<input type="hidden" name="nota" value="' . htmlspecialchars($filme->nota) . '" style="display: none;">';
                    echo '<input type="hidden" name="preco" value="' . htmlspecialchars($filme->preco) . '">';

                    echo '<button type="submit" class="filme">';
                    echo '<img class=\'cartaz\' src="' . $urlFormatada . '">';
                    echo '<div class=\'descricao\'>';
                    echo '<h2 class=\'tituloCartaz\'>' . $filme->nome . '</h2>';

                    echo '</div>';
                    echo '</button>';

                    echo '</form>';
                }
            }
            ?>
        </div>
        <div>
            <div>
                <button onclick="carregar_mais('voltar')">Voltar</button>
                <button onclick="carregar_mais('avancar')">Avançar</button>
            </div>
        </div>
        <script>
            // Funções JavaScript

            function toggleSubMenu(submenuId) {
                var submenu = document.getElementById(submenuId);
                submenu.style.display = submenu.style.display === 'block' ? 'none' : 'block';
            }

            function redirecionarParaIndex() {
                window.location.href = 'moviesList.php';
            }

            // Função para filtrar os filmes 
            function filtrarFilmes(genero) {
                let localizacaoAtual = window.location.href.split('&genero=')[0];
                window.location.href = localizacaoAtual + '&genero=' + genero;
            }

            function redirecionarParaAddUser() {
                window.location.href = window.location.href.split('/moviesList.php')[0] + '/addUser.php?token=' + encodeURIComponent(localStorage.getItem('refreshToken'));
            }

            function carregar_mais(direcao){
                // JavaScript para enviar o token para o servidor PHP
                var token = localStorage.getItem('refreshToken');

                // Envia o token para o servidor PHP usando uma requisição GET
                var offset = window.location.href.split('offset=')[1].split('&')[0];
                var limit = window.location.href.split('limit=')[1].split('&')[0];
                if (direcao == 'voltar'){
                    offset = parseInt(offset) - parseInt(limit);
                } else {
                    offset = parseInt(offset) + parseInt(limit);
                }
                var url = window.location.href.split('?')[0]+'?token='+encodeURIComponent(token)+'&limit='+limit+'&offset='+offset;
                window.location.href = url;
            }

            function logout() {
                localStorage.removeItem('refreshToken');
                window.location.href = 'index.html';
            }
            // Event listener para fechar os submenus quando clicar fora
            window.addEventListener('click', function(event) {
                var submenu = document.getElementById('submenu-genero');
                var target = event.target;
                if (!target.classList.contains('submenu') && !target.classList.contains('submenu-item')) {
                    submenu.style.display = 'none';
                }
            });

            // Quando carregar a página carregar os filmes
            window.onload = function() {
                // * Se url não tiver o parametro ?token= então redirecionar para o login
                if (!window.location.href.includes('?token=')) {
                    // JavaScript para enviar o token para o servidor PHP
                    var token = localStorage.getItem('refreshToken');

                    // Envia o token para o servidor PHP usando uma requisição GET
                    var url = window.location.href+'?token='+encodeURIComponent(token)+'&limit=12&offset=0';
                    window.location.href = url;
                }
            }
        </script>
    </div>

    <footer>
        <div class="container">
            <p class="rodape">Web II Movies - Todos os direitos reservados &copy; 2023</p>
        </div>
    </footer>

</body>

</html>