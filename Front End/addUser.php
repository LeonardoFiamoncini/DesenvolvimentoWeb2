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
        $token = $_GET['token'];
    ?>
    <div class="container">
        <h1>Adicionar Usuário</h1>
        <form action="addUserAction.php" method="post">
            <input type="hidden" name="token" value="<?php echo $token; ?>">
            <label for="nome">nome: </label>
            <input type="text" name="nome" placeholder="Digite aqui seu nome" required><br><br>
            <label for="email">email: </label>
            <input type="text" name="email" placeholder="Digite aqui seu email" required><br><br>
            <label for="password">senha: </label>
            <input type="password" name="password" placeholder="Digite aqui sua senha" required>
            <br><br>

            <label for="saldo" class="saldo">saldo: </label>
            <input type="number" name="saldo" placeholder="Digite aqui seu saldo" required>
            <br><br>
            <input type="submit" value="Adicionar" class="centered"><br><br>
        </form>
    </div>
    <footer>
        <div class="container">
            <p class="rodape">Web II Movies - Todos os direitos reservados &copy; 2023</p>
        </div>
    </footer>
</body>

</html>
