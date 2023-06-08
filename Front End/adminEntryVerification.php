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
        if ($_POST["username"] == "sandyeleonardo" && $_POST["password"] == "web2") {
            echo "<script>window.location.href = 'moviesListAdmin.php';</script>";
        } else {
            echo "<div class='container'>
                    <p>Usuário inválido.</p>  
                    <br>
                    <div>
                        <a href='javascript:history.go(-1)'>Tente novamente</a>
                        <a href='index.php'>Voltar para Home</a><br><br><br>
                    </div>
                </div>";
        }
    ?>
    	<footer>
		<div class="container">
			<p class="rodape">Web II Movies - Todos os direitos reservados &copy; 2023</p>
		</div>
	</footer>
</body>

</html>
