<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web II Movies</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <?php
    // URL de destino
    $url = 'http://localhost:3001/auth/login';

    // Dados do corpo da requisição
    $data = array(
        'email' => $_POST["email"] ,
        'senha' => $_POST["password"] 
    );

    // Converter os dados para JSON
    $jsonData = json_encode($data);

    // Configurar as opções do contexto
    $options = array(
        'http' => array(
            'method'  => 'POST',
            'header'  => 'Content-type: application/json',
            'content' => $jsonData
        )
    );

    // Criar o contexto da requisição
    $context = stream_context_create($options);

    // Enviar a requisição e obter a resposta
    $response = file_get_contents($url, false, $context);

    // Verificar por erros
    // if ($response === false) {
    //     echo 'Erro na requisição';
    // } else {
    //     // Exibir a resposta
    //     echo $response;
    // }

    if ($response === false) {
        echo "<div class='container'>
        <p>Usuário inválido.</p>  
        <br>
        <div>
            <a href='javascript:history.go(-1)'>Tente novamente</a>
            <a href='index.php'>Voltar para Home</a><br><br><br>
        </div>
        </div>";

    } else {
        $token =  json_decode($response, true);
        $token = $token[0];
        echo '<script>
            var token = ' . json_encode($token) . ';
            localStorage.setItem("refreshToken", token);
        </script>';
        // echo "<script>window.location.href = 'moviesListAdmin.php';</script>";
    }
    ?>
    <footer>
        <div class="container">
            <p class="rodape">Web II Movies - Todos os direitos reservados &copy; 2023</p>
        </div>
    </footer>
</body>

</html>