<?php
require_once 'assets/php/conexao.php';


$_SG['conectaServidor'] = true;    // Abre uma conexão com o servidor MySQL?
$_SG['abreSessao'] = true;         // Inicia a sessão com um session_start()?
$_SG['caseSensitive'] = false;     // Usar case-sensitive? Onde 'thiago' é diferente de 'THIAGO'
$_SG['validaSempre'] = true;       // Deseja validar o usuário e a senha a cada carregamento de página?
$_SG['tabela'] = 'tb_usuario'; 
  
// Verifica se precisa iniciar a sessão
if ($_SG['abreSessao'] == true) {
  session_start();
}

 /*Possiveis valores para a funcao kick_out()
	get_out_01 = "Por favor realize o login para acessar este recurso";
	get_out_02 = "Usuario deve ser informado";
	get_out_03 = "Usuario digitado no formato incorreto";
	get_out_04 = "Senha deve ser informada";
	get_out_05 = "Usuario ou senha incorretos";
	get_out_06 = "Por favor realize o login para acessar este recurso";
 */


function validaUsuario($usuario, $senha) {

	global $_SG;
	$pdo = conectar();
	 
    $cS = ($_SG['caseSensitive']) ? 'BINARY' : '';
     
    // Usa a função addslashes para escapar as aspas
    $nusuario = addslashes($usuario);
    $nsenha   = addslashes($senha);
	
	if(empty($nusuario)){
		return "get_out_02";
	}else if(empty($nsenha)){
		return "get_out_04";
	}else{
		$sql = "select cod_usuario,nom_usuario,email,senha  from  ".$_SG['tabela']." where ".$cS."email = ? and ".$cS."senha = ? limit 1";
		$stm = $pdo->prepare($sql);
		$stm-> bindValue(1, $nusuario);
		$stm-> bindValue(2 ,$nsenha);
		$stm-> execute();
		$resultado = $stm->fetch(PDO::FETCH_ASSOC);
		
		 
		// Verifica se encontrou algum registro
		if (empty($resultado)) {
			// Nenhum registro foi encontrado => o usuário é inválido
		   return "get_out_05";   
		} else {
			 
			// Definimos dois valores na sessão com os dados do usuário
			$_SESSION['usuarioID'] = $resultado['cod_usuario']; // Pega o valor da coluna 'id do registro encontrado no MySQL
			$_SESSION['usuarioNome'] = $resultado['nom_usuario']; // Pega o valor da coluna 'nome' do registro encontrado no MySQL
			 
			if ($_SG['validaSempre'] == true) {
				// Definimos dois valores na sessão com os dados do login
				$_SESSION['usuarioLogin'] = $usuario;
				$_SESSION['usuarioSenha'] = $senha;
			}
			return "OK" ;
		}
	} 
}
     
/**
* Função que protege uma página
*/

function protectPage(){
    global $_SG;
	
    if (!isset($_SESSION['usuarioID']) OR !isset($_SESSION['usuarioNome'])) {
        // Não há usuário logado, manda pra página de login
       kick_out("get_out_01");
    } else if (!isset($_SESSION['usuarioID']) OR !isset($_SESSION['usuarioNome'])) {
        // Há usuário logado, verifica se precisa validar o login novamente
        if ($_SG['validaSempre'] == true) {
            // Verifica se os dados salvos na sessão batem com os dados do banco de dados
            if (!validaUsuario($_SESSION['usuarioLogin'], $_SESSION['usuarioSenha'])) {
                // Os dados não batem, manda pra tela de login
               kick_out("get_out_01");
            }
        }
    }
}
     
function kick_out($permissao) {
    global $_SG;
    // Remove as variáveis da sessão (caso elas existam)
    unset($_SESSION['usuarioID'], $_SESSION['usuarioNome'], $_SESSION['usuarioLogin'], $_SESSION['usuarioSenha']);
     // Manda pra tela de login
     header("Location:index.php?page=login&acesso=$permissao");
}
?>