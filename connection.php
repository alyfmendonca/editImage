<!-- Arquivo de conexão com o banco de dados -->
<?php
	// $mysqli_connection = new MySQLi('localhost', 'root', '', 'imagens_editor');
	// if($mysqli_connection->connect_error){
	 //   echo "Houve um erro na conexão com o banco de dados! Erro: " . $mysqli_connection->connect_error;
	// }else{
	 //   echo "Conectado!";
	// }

	//$result = $mysqli_connection->query('SELECT * FROM `login` WHERE usuario = "'.$usuario.'" AND senha = "'.$senha.'"') or die(mysql_error());



	//$con = mysql_connect("localhost", "root", "") or die ("Sem conexão com o servidor");
	//$select = mysql_select_db("imagens_editor") or die("Sem acesso ao DB");
	 

	function escreve_banco_imagem($image, $altura, $largura){
		global $mysqli_connection;
		$mysqli_connection->query('INSERT INTO imagem (photo, altura, largura) VALUES ("tata", 70, 20)') or die(mysql_error()); 
		 
		$photo = "tata";
		$id_image = pega_id_imagem($photo);	
		var_dump($id_image);	

		$mysqli_connection->query('INSERT INTO campos (id_image, name, cord_x, cord_y, font_size, font_name) VALUES ('.$id_image.', "teste", 20, 30, 60, "arial")') or die(mysql_error());

	}

	function pega_id_imagem($photo){
		global $mysqli_connection;
		$pega_id = $mysqli_connection->query('SELECT * FROM `imagem` WHERE photo = "'.$photo.'"') or die(mysql_error());
		foreach ($pega_id as $resultado) {
			return $resultado['id'];
		}
	}
	
	
	function create_user($usuario, $senha, $admin){
		global $mysqli_connection;
		$mysqli_connection->query('INSERT INTO login (usuario, senha, admin) VALUES ("'.$usuario.'", "'.$senha.'", '.$admin.')') or die(mysql_error());	
	}

	function verifica_usuario($usuario, $senha){
		global $mysqli_connection;
		$pega_id = $mysqli_connection->query('SELECT * FROM `login` WHERE usuario = "'.$usuario.'" AND senha = "'.$senha.'"') or die(mysql_error());
	}

	function exibe_imagens(){
		$result = mysql_query('SELECT * FROM `imagem`');
		return $result;
	}
		

?>