<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Catálogo de Filmes</title>
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

        .catalogo-filmes {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 80px;
            /* Espaço para evitar que os filmes fiquem escondidos atrás do cabeçalho */
        }

        .filme {
            flex: 0 0 300px;
            margin: 10px;
            background-color: #444;
            border-radius: 5px;
            overflow: hidden;
            transition: transform 0.3s;
            z-index: 1;
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
            <div class="titulo">Catálogo de Filmes</div>
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
        <div class="catalogo-filmes">
            <?php
            // Array de filmes
            $filmes = array(
                array(
                    'nome' => 'Filme 1',
                    'genero' => 'Ação',
                    'descricao' => 'Este é o filme 1. Descrição do filme 1.',
                    'imagem' => 'imagem.png'
                ),
                array(
                    'nome' => 'Filme 2',
                    'genero' => 'Comédia',
                    'descricao' => 'Este é o filme 2. Descrição do filme 2.',
                    'imagem' => 'imagem.png'
                ),
                array(
                    'nome' => 'Filme 3',
                    'genero' => 'Terror',
                    'descricao' => 'Este é o filme 3. Descrição do filme 3.',
                    'imagem' => 'imagem.png'
                ),
                array(
                    'nome' => 'Filme 4',
                    'genero' => 'Ação',
                    'descricao' => 'Este é o filme 4. Descrição do filme 4.',
                    'imagem' => 'imagem.png'
                ),
                array(
                    'nome' => 'Filme 5',
                    'genero' => 'Comédia',
                    'descricao' => 'Este é o filme 5. Descrição do filme 5.',
                    'imagem' => 'imagem.png'
                ),
                // ...
            );

            // Exibindo os filmes
            foreach ($filmes as $filme) {
                echo '<div class="filme ' . strtolower($filme['genero']) . '">';
                echo '<img src="' . $filme['imagem'] . '">';
                echo '<div class="descricao">';
                echo '<h2>' . $filme['nome'] . '</h2>';
                echo '<p>' . $filme['genero'] . '</p>';
                echo '</div>';
                echo '</div>';
            }
            ?>
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

</body>

</html>