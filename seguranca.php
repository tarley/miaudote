<?php
function protectPage() {
	global $_SG;
	
	if (! isset ( $_SESSION ['usuarioID'] ) or ! isset ( $_SESSION ['usuarioNome'] )) {
		// Nуo hс usuсrio logado, manda pra pсgina de login
		kick_out ();
	} else if (! isset ( $_SESSION ['usuarioID'] ) or ! isset ( $_SESSION ['usuarioNome'] )) {
		// Hс usuсrio logado, verifica se precisa validar o login novamente
		if ($_SG ['validaSempre'] == true) {
			// Verifica se os dados salvos na sessуo batem com os dados do banco de dados
			if (! validaUsuario ( $_SESSION ['usuarioLogin'], $_SESSION ['usuarioSenha'] )) {
				// Os dados nуo batem, manda pra tela de login
				kick_out ();
			}
		}
	}
}

/**
 * Funчуo para expulsar um visitante
 */
function kick_out() {
	global $_SG;
	
	// Remove as variсveis da sessуo (caso elas existam)
	unset ( $_SESSION ['usuarioID'], $_SESSION ['usuarioNome'], $_SESSION ['usuarioLogin'], $_SESSION ['usuarioSenha'] );
	
	// Manda pra tela de login
	header ( "Location:../../index.php?page=login&tentativa=tentei" );
}
?>