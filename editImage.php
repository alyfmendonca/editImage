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
    $image_id = $_POST['image_id'];
    $logado = $_SESSION['usuario'];
?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script src="editImage.js"></script>
    <link rel="stylesheet" href="style.css">


</head>
<body class="editImage">
    <?php 
        $imagem = getOneImage($image_id);
        $campos = getCampos($image_id);


        
    ?>
    
    <canvas id="canvasFinal" ></canvas>
        
    <!-- DIV onde serão carregados os campos -->
    <div id="campos">
            
    </div>

    <!-- Botão finalizar -->    
    <button onclick="finalizar();" id="btn-download" >Finalizar edição</button>

    <!-- <?php 
        
        $n = mysql_num_rows($campos);
        for($i = 0; $i < $n; $i++){
            echo '<label> '.mysql_result($campos, $i, 2).' </label>';
            echo '<input onBlur="changeValue(this);" type="text" name="'.mysql_result($campos, $i, 2).'" ';
        }
    ?> -->


</body>
<script type="text/javascript">
    var user = "<?php echo $_SESSION['usuario'] ?>";
    var dadosImage = [];
    var listCampos = [];
    this.dadosImage.push({
        'image': "<?php echo mysql_result($imagem, 0, 1) ?>",
        'alt': <?php echo mysql_result($imagem, 0, 2) ?>,
        'larg': <?php echo mysql_result($imagem, 0, 3) ?>,
        'nome': "<?php echo mysql_result($imagem, 0, 4) ?>",
    });

    <?php 
        
        $n = mysql_num_rows($campos);
        for($i = 0; $i < $n; $i++){
            echo "
            this.listCampos.push({
                'nome': '".mysql_result($campos, $i, 2)."',
                'cordX': ".mysql_result($campos, $i, 3).",
                'cordY': ".mysql_result($campos, $i, 4).",
                'fontName': '".mysql_result($campos, $i, 6)."',
                'fontSize': ".mysql_result($campos, $i, 5).",
                'fontColor': '".mysql_result($campos, $i, 7)."',
                'fontUrl': '".mysql_result($campos, $i, 8)."'
            });
            renderFonte('".mysql_result($campos, $i, 6)."', '".mysql_result($campos, $i, 8)."');
           ";
        }
    ?>

    


    getDados(listCampos, dadosImage);

    //getDados(campos, imagem);  
</script>
</html>