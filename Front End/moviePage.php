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

        .moeda-wrapper {
            margin-top: 20px;
        }

        .moeda-wrapper label {
            display: block;
            margin-bottom: 10px;
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

        .valor-dinamico {
            font-size: 18px;
            margin-top: 10px;
            color: #ddd;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="cabecalho">
            <div class="titulo" onclick="redirecionarParaIndex()" style="cursor: pointer;">Web II Movies</div>
            <div class="submenu" onclick="acessarComoAdmin()">Acessar como Admin</div>
        </div>
        <div class="filme-detalhes">
            <div class="filme-imagem">
                <?php
                if ($_SERVER["REQUEST_METHOD"] === "POST") {
                    $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
                    // $genero = isset($_POST['genero']) ? $_POST['genero'] : '';
                    $nota = isset($_POST['nota']) ? $_POST['nota'] : '';
                    $descricao = isset($_POST['descricao']) ? $_POST['descricao'] : '';
                    $imagem = isset($_POST['imagem']) ? $_POST['imagem'] : '';
                    $preco = isset($_POST['preco']) ? $_POST['preco'] : '';
                    echo '<img src="' . htmlspecialchars($imagem) . '" alt="' . htmlspecialchars($nome) . '">';
                }
                ?>
            </div>
            <div class="filme-info">
                <?php
                if ($_SERVER["REQUEST_METHOD"] === "POST") {
                    echo '<h2>' . htmlspecialchars($nome) . '</h2>';
                    // echo '<p>Gênero: ' . htmlspecialchars($genero) . '</p>';
                    echo '<p>Nota: ' . htmlspecialchars($nota) . '</p>';
                    echo '<p>Descrição: ' . htmlspecialchars($descricao) . '</p><br><br>';

                    echo '<div class="moeda-wrapper">';
                    echo '<label>Escolha a moeda desejada para realizar a compra:</label>';
                    echo '<label><input type="radio" name="moeda" value="BRL" onchange="atualizarValorDinamico(this)"> Real Brasileiro (BRL)</label>';
                    echo '<label><input type="radio" name="moeda" value="USD" onchange="atualizarValorDinamico(this)"> Dólar Americano (USD)</label>';
                    echo '<label><input type="radio" name="moeda" value="EUR" onchange="atualizarValorDinamico(this)"> Euro (EUR)</label>';
                    echo '<label><input type="radio" name="moeda" value="CHF" onchange="atualizarValorDinamico(this)"> Franco Suíço (CHF)</label>';
                    echo '<label><input type="radio" name="moeda" value="JPY" onchange="atualizarValorDinamico(this)"> Iene (JPY)</label>';
                    echo '<label><input type="radio" name="moeda" value="GBP" onchange="atualizarValorDinamico(this)"> Libra Esterlina (GBP)</label>';
                    echo '</div>';

                    echo '<br><br><button class="botao-comprar" type="button">Comprar - <strong><span id="valor-dinamico"></span></strong></button>';
                } else {
                    echo '<p>Nenhum detalhe do filme recebido.</p>';
                }
                ?>
            </div>
        </div>

        <script>
            // Funções JavaScript
            function acessarComoAdmin() {
                window.location.href = 'adminEntry.html';
            }

            function redirecionarParaIndex() {
                window.location.href = 'index.php';
            }

            function atualizarValorDinamico(radio) {
                const moedaSelecionada = radio.value;
                const preco = <?php echo json_encode($preco); ?>;
                let novoValor = '';

                if (moedaSelecionada === 'BRL') {
                    novoValor = Number(preco).toFixed(2);
                    novoValor = moedaSelecionada + ' ' + novoValor;
                    document.getElementById('valor-dinamico').textContent = novoValor;
                    return;
                }

                const data_inicial = '<?php echo date('m-d-Y', strtotime('-7 days')); ?>';
                const data_final = '<?php echo date('m-d-Y'); ?>';

                const url = 'https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/odata/CotacaoMoedaPeriodo(moeda=@moeda,dataInicial=@dataInicial,dataFinalCotacao=@dataFinalCotacao)?@moeda=\'' + encodeURIComponent(moedaSelecionada) + '\'&@dataInicial=\'' + encodeURIComponent(data_inicial) + '\'&@dataFinalCotacao=\'' + encodeURIComponent(data_final) + '\'&$top=1&$orderby=dataHoraCotacao%20desc&$format=json&$select=cotacaoCompra';

                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        const cotacao = data.value[0].cotacaoCompra;

                        if (cotacao) {
                            novoValor = moedaSelecionada + ' ' + (preco / cotacao).toFixed(2);
                        }

                        document.getElementById('valor-dinamico').textContent = novoValor;
                    })
                    .catch(error => {
                        console.error('Erro ao obter a cotação da moeda:', error);
                    });
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