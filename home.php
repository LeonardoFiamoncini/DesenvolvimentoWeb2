<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desenvolvimento Web II</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<?php 
        if ($_POST["username"] == "sandyeleonardo" && $_POST["password"] == "web2"){
            echo "<script>window.location.href = \"home.html\";</script>";
        } else {
            echo "<body><div class='container'>

            <p>Usuário inválido.</p>  
            <br>
            <a href='javascript:history.go(-1)'>Voltar</a>
            </div></body>";
        }
    ?>
</html>