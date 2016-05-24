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
		
		switch ($_SESSION['idPermissao']){
			
			case 1:
					header("Location:animais/");
				break;
				
			case 2:
					header("Location:aprovacao.php");
				break;	
			case 3:
				header("Location:ongs/");
				
				break;
				
			
		}
		
	}else{
		kick_out($permissao);
	}
 
}
?>