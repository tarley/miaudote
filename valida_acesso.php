<?php
include("seguranca.php");
	  global $usuario;
	  global $senha; 
// Verifica se um formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	$usuario = (isset($_POST['username'])) ? $_POST['username'] : '';
	$senha   = (isset($_POST['password'])) ? $_POST['password'] : '';
  
	$permissao = validaUsuario($usuario, $senha);
	
	if ($permissao == "OK") {
		header("Location:aprovacao.php");
	}else{
		kick_out($permissao);
	}
 
}
?>