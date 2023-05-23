<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desenvolvimento Web II</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <div class="container">
        <?php
        if (isset($_POST["moeda"])) {

            if ($_POST["quantia"] >= 0) {
                date_default_timezone_set('America/Sao_Paulo');
                $data_inicial = date('m-d-Y', strtotime('-7 days'));
                $data_final = date('m-d-Y');


                $url = 'https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/odata/CotacaoMoedaPeriodo(moeda=@moeda,dataInicial=@dataInicial,dataFinalCotacao=@dataFinalCotacao)?@moeda=\'' . $_POST["moeda"] . '\'&@dataInicial=\'' . $data_inicial . '\'&@dataFinalCotacao=\'' . $data_final . '\'&$top=1&$orderby=dataHoraCotacao%20desc&$format=json&$select=cotacaoCompra,dataHoraCotacao';

                $dadosRetornados = json_decode(file_get_contents($url), true);

                $cotacao = $dadosRetornados["value"][0]["cotacaoCompra"];
                
                $data_cotacao = substr($dadosRetornados["value"][0]["dataHoraCotacao"], 0, 10);

                $data_cotacao = date("d/m/Y", strtotime($data_cotacao));

                $quantia = $_POST["quantia"];

                $resultado = $quantia / $cotacao;

                $padrao = numfmt_create("pt_BR", NumberFormatter::CURRENCY);

                echo "<h1>Conversor de Moedas</h1><br><br>";

                echo "Quantia original: " . numfmt_format_currency($padrao, $quantia, "BRL") . "<br><br>";
                echo "Quantia convertida: " . numfmt_format_currency($padrao, $resultado, $_POST["moeda"]);

                echo "<br><br><br>Taxa de câmbio referente à compra: $cotacao";
                echo "<br><br><br>Cotação atualizada do dia $data_cotacao<br>(Obtida diretamente da API do Banco Central do Brasil)<br><br>";
                
            } else echo "<p>ERRO! Número negativo informado!</p><br>";
        } else echo "<p>Erro de autenticação!</p><br>";

        echo "<a href='javascript:history.go(-1)'>Voltar</a>";

        ?>
    </div>
</body>

</html>