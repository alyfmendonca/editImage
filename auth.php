<?php
    session_start();
	
	$usuario = $_POST['usuario'];
	$senha = $_POST['senha'];

	// $mysqli_connection = new MySQLi('localhost', 'root', '', 'imagens_editor');
	// if($mysqli_connection->connect_error){
	//    echo "Houve um erro na conexão com o banco de dados! Erro: " . $mysqli_connection->connect_error;
	// }else{
	//    echo "Conectado!";
	// }

	//$result = $mysqli_connection->query('SELECT * FROM `login` WHERE usuario = "'.$usuario.'" AND senha = "'.$senha.'"') or die(mysql_error());



	$con = mysql_connect("localhost", "root", "") or die ("Sem conexão com o servidor");
	$select = mysql_select_db("imagens_editor") or die("Sem acesso ao DB");
	 
	// A variavel $result pega as varias $login e $senha, faz uma 
	//pesquisa na tabela de usuarios
	$result = mysql_query('SELECT * FROM `login` WHERE usuario = "'.$usuario.'" AND senha = "'.$senha.'"');
 	
	$admin = mysql_result($result, 0, 3);
	

	if (mysql_num_rows($result) > 0 and $admin == "1") {
		$_SESSION['usuario'] = $usuario;
		$_SESSION['senha'] = $senha;
		$_SESSION['admin'] = $admin;
		header('location:firstPage.php');
		
	}else if (mysql_num_rows($result) > 0 and $admin == "0"){
		$_SESSION['usuario'] = $usuario;
		$_SESSION['senha'] = $senha;
		$_SESSION['admin'] = $admin;
		header('location:firstPage.php');
	} else {
		unset ($_SESSION['usuario']);
		unset ($_SESSION['senha']);
		header('location:index.php');
	}
?>