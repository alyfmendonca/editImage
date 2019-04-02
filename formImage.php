<!DOCTYPE html>
<html>

<head>
<?php 
    /* esse bloco de código em php verifica se existe a sessão, pois o usuário pode
    simplesmente não fazer o login e digitar na barra de endereço do seu navegador 
    o caminho para a página principal do site (sistema), burlando assim a obrigação de 
    fazer um login, com isso se ele não estiver feito o login não será criado a session, 
    então ao verificar que a session não existe a página redireciona o mesmo
    para a index.php.*/
    session_start();
    if($_SESSION['admin'] == "0" or (!isset ($_SESSION['usuario']) == true) and (!isset ($_SESSION['senha']) == true))
    {
        unset($_SESSION['usuario']);
        unset($_SESSION['senha']);
        header('location:index.php');
    }
    
    $logado = $_SESSION['usuario'];
?>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script src="lz-string.min.js"></script> 
    <script src="formImage.js"></script>
    <link rel="stylesheet" href="formImage.css">
</head>

<body>
    <div class="content-form">
            <form id="formImage" action="imageProcess.php">
                <input type="file" id="file" onchange="preview();" required />
                <img width="400px" height="400px" id="imgPreview" src="#" hidden/>
                <br/>
                <label>Nome da Imagem:<input required type="text" id="nomImg" onblur="imgOnBlur();"/></label>
                <span></span>
                <span>Dimensões</span>
                <label>Largura:<input required type="number" id="dimLarg" onblur="dimensLarg();"/></label>
                <label>Altura:<input required type="number" id="dimAlt" onblur="dimensAlt();"/></label>
                <button class="btn btn-primary">Customizar imagem</button>
            </form>
    </div>
</body>

</html>