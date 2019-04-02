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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" id="gfont-css" href="//fonts.googleapis.com/css?family=Open+Sans%3A300%2C400%2C600%2C700%2C800&amp;ver=5.0.3" type="text/css" media="all">
    <script src="main.js"></script>
</head>
<body>
    <div class="images-box">
    <?php
        if($_SESSION['admin'] == "1"){
            echo '<a href="formImage.php" >';
            echo '<div class="card-image">';
            echo '<div class="circle-plus"> <i class="fas fa-plus soma-icon""></i></div>';
            echo '<p>Adicionar imagem</p>';
            echo '</div>';
            echo '</a>';
        }

        $imagens = exibe_imagens();
        $n = mysql_num_rows($imagens);
        for($i = 0; $i < $n; $i++){
            echo '<div class="card-image">';
            echo '<img class="image-to-edit" src="'.mysql_result($imagens, $i, 1).'" />';
            echo '<p>'.mysql_result($imagens, $i, 4).'</p>';
            echo '<form action="editImage.php" method="post" >';
            echo '<input type="hidden" name="image_id" value="'.mysql_result($imagens, $i, 0).'" >';
            echo '<button type="submit">Editar</button>';
            echo '</form>';
            echo '</div>';
        }

    ?>
    </div>

    
    
        <?php
            if($_SESSION['admin'] == "1"){
                echo '<h2> Imagens para aprovação </h2>';
                echo '<div class="images-box">';
                $imagensta = exibe_imagens_para_aprovacao();
                $n = mysql_num_rows($imagensta);
                for($i = 0; $i < $n; $i++){
                    echo '<div class="card-image">';
                    echo '<img class="image-to-edit" src="'.mysql_result($imagensta, $i, 1).'" />';
                    echo '<p>'.mysql_result($imagensta, $i, 6).'</p>';
                    echo '<p> User: '.mysql_result($imagensta, $i, 5).'</p>';
                    echo '<button type="submit" onclick="aprovar('.mysql_result($imagensta, $i, 0).');">Aprovar</button>';
                    echo '</div>';
                }
                echo '</div>';
            }else {
                echo '<h2> Imagens para Download </h2>';
                echo '<div class="images-box">';
                $imagensta = exibe_imagens_para_download($logado);
                if(!$imagensta){

                }else {
                    
                    $n = mysql_num_rows($imagensta);
                    for($i = 0; $i < $n; $i++){
                        echo '<div class="card-image">';
                        echo '<img class="image-to-edit" src="'.mysql_result($imagensta, $i, 1).'" />';
                        echo '<p>'.mysql_result($imagensta, $i, 6).'</p>';
                        echo '<input type="hidden" name="image_id" value="'.mysql_result($imagensta, $i, 0).'" >';
                        echo '<button type="submit" onclick="downloadCanvas();">Download</button>';
                        echo '<a id="download" style="display: none"  download="'.mysql_result($imagensta, $i, 6).'.png" href="'.mysql_result($imagensta, $i, 1).'"></a>';
                        echo '</div>';
                    }
                    echo '</div>';
                }
                
            }
            
        ?>
</body>
<script>
    function aprovar(id){

        $.post("teste.php", { dados: id, photo: 'a', operacao: 'U'  }).done(function(data) {
            if(data){
                //alert(data);
                window.location.replace("firstPage.php");
            } else {
                alert('Ocorreu um erro');
            }
            
            //window.location.replace("teste.php");
        }).fail(function() {
            alert("error");
        });
    }
    //Baixar o canvas
    function downloadCanvas() {
        //Salva
        var link = document.getElementById("download");
        link.click();



    }
</script>
</html> 