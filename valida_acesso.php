<?php
	include "seguranca.php";	
	
	global $usuario;
	global $senha;
	// Verifica se um formul�rio foi enviado
	if ($_SERVER ['REQUEST_METHOD'] == 'POST') {
		
		$usuario = (isset ( $_POST ['username'] )) ? $_POST ['username'] : '';
		$senha = (isset ( $_POST ['password'] )) ? $_POST ['password'] : '';
		
		Logger("usuario=" . $usuario . " senha=" . $senha);
		
		$resultado = validaUsuario ( $usuario, $senha );
		
		if ($resultado == "OK") {
			
			Logger("Autenticado. idPermissao=" . $_SESSION ['idPermissao']);
			$page = "403.php";
			
			if ($_SESSION ['idPermissao']) {	
				
				$page ="../painel/";
			}

			Logger("Location:" . CONTEXT_NAME . $page);
			header("Location:" . CONTEXT_NAME . $page);
		} else {
			kick_out ( $resultado );
		}
	}
?>