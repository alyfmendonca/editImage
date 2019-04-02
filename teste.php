
<?php 

  $con = mysql_connect("localhost", "root", "") or die ("Sem conexão com o servidor");
  $select = mysql_select_db("imagens_editor") or die("Sem acesso ao DB");


  $photo = $_POST['photo'];
  $dados = $_POST['dados'];
  $operacao = $_POST['operacao'];

    
  function grava_imagem($photo){
    $result = mysql_query('INSERT INTO imagem (photo, altura, largura, nomimg) VALUES ("'.$photo[0]["image"].'", '.$photo[0]["alt"].', '.$photo[0]["larg"].', "'.$photo[0]["nome"].'")') or die(mysql_error()); 
  }
  
  if($operacao == 'N'){
    //var_dump($photo[0]['nome']);
    grava_imagem($photo);
    $id = mysql_insert_id();
    grava_campos($id, $dados);
  } else if ($operacao == 'A') {
    grava_imagemta($photo);
    $id = mysql_insert_id();
    grava_camposta($id, $dados);
  } else if($operacao == 'U'){
    aprovada($dados);
  }
  
  function grava_campos($id, $dados){

    foreach ($dados as $item) {
      $result = mysql_query('INSERT INTO campos (id_image, nome, cord_x, cord_y, font_size, font_name, font_color) VALUES ('.$id.' , "'.$item["nome"].'", '.$item["cordX"].', '.$item["cordY"].', '.$item["fontSize"].', "'.$item["fontName"].'", "'.$item["fontColor"].'")') or die(mysql_error());
    }
    return true;

  }

  function grava_imagemta($photo){
    $result = mysql_query('INSERT INTO imagemta (photo, altura, largura, aprovada, user, nomimg) VALUES ("'.$photo[0]["image"].'", '.$photo[0]["alt"].', '.$photo[0]["larg"].', 0, "'.$photo[0]["user"].'", "'.$photo[0]["nome"].'")') or die(mysql_error()); 
  }

  function grava_camposta($id, $dados){

    foreach ($dados as $item) {
      $result = mysql_query('INSERT INTO camposta (id_image, nome, cord_x, cord_y, font_size, font_name, font_color) VALUES ('.$id.' , "'.$item["nome"].'", '.$item["cordX"].', '.$item["cordY"].', '.$item["fontSize"].', "'.$item["fontName"].'", "'.$item["fontColor"].'")') or die(mysql_error());
    }
    return true;

  }

  function aprovada($id){
    $result = mysql_query('UPDATE imagemta SET aprovada=1 WHERE id='.$id.' ');
    return $result;
  }

  
?>