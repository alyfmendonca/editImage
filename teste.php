
<?php 

  $con = mysql_connect("localhost", "root", "") or die ("Sem conexão com o servidor");
  $select = mysql_select_db("imagens_editor") or die("Sem acesso ao DB");


  $photo = $_POST['photo'];
  $dados = $_POST['dados'];
  

    
  function grava_imagem($photo){
    $result = mysql_query('INSERT INTO imagem (photo, altura, largura) VALUES ("'.$photo[0]["image"].'", '.$photo[0]["alt"].', '.$photo[0]["larg"].')') or die(mysql_error()); 
  }

  grava_imagem($photo);
  $id = mysql_insert_id();
  grava_campos($id, $photo, $dados);
  
  function grava_campos($id, $image, $dados){

    foreach ($dados as $item) {
      $result = mysql_query('INSERT INTO campos (id_image, nome, cord_x, cord_y, font_size, font_name, font_color) VALUES ('.$id.' , "'.$item["nome"].'", '.$item["cordX"].', '.$item["cordY"].', '.$item["fontSize"].', "'.$item["fontName"].'", "'.$item["fontColor"].'")') or die(mysql_error());
    }
    return true;

  }

  
?>