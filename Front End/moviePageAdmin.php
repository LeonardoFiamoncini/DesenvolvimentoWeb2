<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Web II Movies</title>
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
            <div class="titulo" onclick="redirecionarParaIndex()" style="cursor: pointer;">Web II Movies</div>
            <div class="submenu" onclick="acessarComoUser()">
                Acessar como User
            </div>
        </div>
        <div class="filme-detalhes">
            <div class="filme-imagem">
                <?php
                if ($_SERVER["REQUEST_METHOD"] === "POST") {
                    $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
                    $genero = isset($_POST['genero']) ? $_POST['genero'] : '';
                    $duracao = isset($_POST['duracao']) ? $_POST['duracao'] : '';
                    $avaliacao = isset($_POST['avaliacao']) ? $_POST['avaliacao'] : '';
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
                    echo '<p>Duração: ' . htmlspecialchars($duracao) . '</p>';
                    echo '<p>Avaliação: ' . htmlspecialchars($avaliacao) . '</p>';
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
            function acessarComoUser() {
                window.location.href = 'index.php';
            }

            function redirecionarParaIndex() {
                window.location.href = 'moviesListAdmin.php';
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
