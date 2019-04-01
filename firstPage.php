<!DOCTYPE html>
<html>
<?php 
    include 'getImages.php';
?>
<head>

<?php 
    /* esse bloco de código em php verifica se existe a sessão, pois o usuário pode
    simplesmente não fazer o login e digitar na barra de endereço do seu navegador 
    o caminho para a página principal do site (sistema), burlando assim a obrigação de 
    fazer um login, com isso se ele não estiver feito o login não será criado a session, 
    então ao verificar que a session não existe a página redireciona o mesmo
    para a index.php.*/
    session_start();
    if((!isset ($_SESSION['usuario']) == true) and (!isset ($_SESSION['senha']) == true))
    {
        unset($_SESSION['usuario']);
        unset($_SESSION['senha']);
        header('location:index.php');
    }
    
    $logado = $_SESSION['usuario'];
?>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Edição de fotos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" id="gfont-css" href="//fonts.googleapis.com/css?family=Open+Sans%3A300%2C400%2C600%2C700%2C800&amp;ver=5.0.3" type="text/css" media="all">
    <script src="main.js"></script>
</head>
<body>
    <div class="images-box">
    <?php
        if($_SESSION['admin'] == "1"){
            echo '<a href="formImage.php" >';
            echo '<div class="card-image">';
            echo '<img class="image-to-edit" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAAMFBMVEX///8AAABhYWFlZWX8/PzNzc2KioqRkZHBwcHGxsYkJCRqamqNjY20tLRTU1OIiIgtkQnaAAACKElEQVR4nO3dwU7CUBBAUUtLW2yF//9b48KkwBA372W8wz1rjXPzqBQW048PSaplncfrOK/ZY/Qy3YZftyl7mB7Ow9E5e5z2voZ7X9kDtXYeHhU7xekpcBhqXYt7ULhnD9VUEDgM2UO1dAkLL9ljNbSEhUv2WA1tYeGWPVZDp7DwlD1WQxbyWchnIZ+FfBbyWchnIZ+FfBbyWchnIZ+FfBbyWchnIZ+FfBbyWchnIZ+FfBbyWchnIZ+FfBbyWchnIZ+FfBbyWchnIZ+FfBbyWchnIZ+FfBbyWchnIZ+FfBby1S8cw8IxYZLLsp06GD/Dws+xxx/blpd74KY5nINoDncyPm+nJAs2az7uF6V72o9a6wR/PJxitF+U7v5avP39Czi3u8Lsabo4Bq7Zw3Rx3Bte553waD4UxndVdMe7wmv2MF1c3+oM61+H9f+X1n8/LPkyne8K69+X1v9s8QafD6udYvj0jCl6RAPT/vLZGcW/a+vo/3xf2kv977wt5LOQz0I+C/ks5LOQz0I+C/ks5LOQz0I+C/ks5LOQz0I+C/ks5LOQz0I+C/ks5LOQz0I+C/ks5LOQz0I+C/ks5LOQz0I+C/ks5LOQz0I+C/ks5LOQz0I+C/ks5KtfuIWFW/ZYDS1h4ZI9VkOXsDBjr1o3YWH2UE1FCwv37KGaivajvtxtyPS8WTPcTkn2uB812C9Kd659gj8Oz7GJnwNTwbqP13Ff//5BSUL5BiGCKXb9HFKDAAAAAElFTkSuQmCC" />';
            echo '<p>Adicionar imagem</p>';
            echo '</div>';
            echo '</a>';
        }

        $imagens = exibe_imagens();
        $n = mysql_num_rows($imagens);
        for($i = 0; $i < $n; $i++){
            echo '<div class="card-image">';
            echo '<img class="image-to-edit" src="'.mysql_result($imagens, $i, 1).'" />';
            echo '<p>Nome da imagem</p>';
            echo '<form action="editImage.php" method="post" >';
            echo '<input type="hidden" name="image_id" value="'.mysql_result($imagens, $i, 0).'" >';
            echo '<button type="submit">Editar</button>';
            echo '</form>';
            echo '</div>';
        }
        
    ?>
    </div>
</body>
</html> 