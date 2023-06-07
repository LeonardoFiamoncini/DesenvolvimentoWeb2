<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Comprar o Filme</title>
    <style>
        /* Estilos para a página de detalhes do filme */
        body {
            background-color: #333333;
            color: #ffffff;
            font-family: monospace, Arial, sans-serif;
            margin: 0;
        }

        .container {
            margin: 20px;
        }

        .filme-detalhes {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            margin-top: 80px;
            /* Espaço para evitar que os detalhes fiquem escondidos atrás do cabeçalho */
        }

        .filme-imagem {
            flex: 0 0 400px;
            margin-right: 30px;
            border-radius: 5px;
            overflow: hidden;
        }

        .filme-imagem img {
            width: 100%;
            height: auto;
        }

        .filme-info {
            flex: 1;
        }

        .filme-info h2 {
            font-size: 24px;
            margin-top: 0;
            color: #fff;
        }

        .filme-info p {
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

        /* Estilos para o botão "Comprar" */
        .botao-comprar {
            padding: 10px 20px;
            font-family: monospace, Arial, sans-serif;
            font-size: 16px;
            color: #ffffff;
            background-color: #0075ff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .botao-comprar:hover {
            background-color: #005ec1;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="cabecalho">
            <div class="titulo">Detalhes do Filme</div>
            <div class="submenu" onclick="toggleSubMenu('submenu-genero')">
                Filtrar por Gênero
                <ul class="submenu-list" id="submenu-genero">
                    <li class="submenu-item" onclick="filtrarFilmes('')">Todos</li>
                    <li class="submenu-item" onclick="filtrarFilmes('Ação')">Ação</li>
                    <li class="submenu-item" onclick="filtrarFilmes('Comédia')">Comédia</li>
                    <li class="submenu-item" onclick="filtrarFilmes('Terror')">Terror</li>
                    <!-- Adicionar mais gêneros conforme necessário. Só coloquei esses de exemplo no primeiro momento -->
                </ul>
            </div>
        </div>
        <div class="filme-detalhes">
            <div class="filme-imagem">
                <?php
                if ($_SERVER["REQUEST_METHOD"] === "POST") {
                    $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
                    $genero = isset($_POST['genero']) ? $_POST['genero'] : '';
                    $descricao = isset($_POST['descricao']) ? $_POST['descricao'] : '';
                    $imagem = isset($_POST['imagem']) ? $_POST['imagem'] : '';

                    echo '<img src="' . htmlspecialchars($imagem) . '" alt="' . htmlspecialchars($nome) . '">';
                }
                ?>
            </div>
            <div class="filme-info">
                <?php
                if ($_SERVER["REQUEST_METHOD"] === "POST") {
                    echo '<h2>' . htmlspecialchars($nome) . '</h2>';
                    echo '<p>Gênero: ' . htmlspecialchars($genero) . '</p>';
                    echo '<p>Descrição: ' . htmlspecialchars($descricao) . '</p>';
                    // Adicione aqui o código para exibir as outras informações do filme
                } else {
                    echo '<p>Nenhum detalhe do filme recebido.</p>';
                }
                ?>
                <br><br><button class="botao-comprar" type="button">Comprar</button>
            </div>
        </div>

        <script>
            // Funções JavaScript
            function toggleSubMenu(submenuId) {
                var submenu = document.getElementById(submenuId);
                submenu.style.display = submenu.style.display === 'block' ? 'none' : 'block';
            }

            function filtrarFilmes(genero) {
                var filmes = document.getElementsByClassName('filme');
                for (var i = 0; i < filmes.length; i++) {
                    if (genero === '' || filmes[i].classList.contains(genero.toLowerCase())) {
                        filmes[i].style.display = 'block';
                    } else {
                        filmes[i].style.display = 'none';
                    }
                }
            }

            // Event listener para fechar os submenus quando clicar fora
            window.addEventListener('click', function(event) {
                var submenu = document.getElementById('submenu-genero');
                var target = event.target;
                if (!target.classList.contains('submenu') && !target.classList.contains('submenu-item')) {
                    submenu.style.display = 'none';
                }
            });
        </script>
    </div>
    <footer>
        <div class="container">
            <p class="rodape">Comprar o Filme - Todos os direitos reservados &copy; 2023</p>
        </div>
    </footer>
</body>
</html>
