<?php 

    $con = mysql_connect("localhost", "root", "") or die ("Sem conexão com o servidor");
    $select = mysql_select_db("imagens_editor") or die("Sem acesso ao DB");


    function exibe_imagens(){
      $result = mysql_query('SELECT * FROM `imagem`');
      return $result;
    }
    function getCampos($id){
      $result = mysql_query('SELECT * FROM `campos` WHERE id_image = "'.$id.'"');
      return $result;
    }
    function getOneImage($id){
      $result = mysql_query('SELECT * FROM `imagem` WHERE id = "'.$id.'"');
      return $result;
    }
?>