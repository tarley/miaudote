<?php
require_once 'assets/php/conexao.php';


$_SG['conectaServidor'] = true;    // Abre uma conexÃ£o com o servidor MySQL?
$_SG['abreSessao'] = true;         // Inicia a sessÃ£o com um session_start()?
$_SG['caseSensitive'] = false;     // Usar case-sensitive? Onde 'thiago' Ã© diferente de 'THIAGO'
$_SG['validaSempre'] = true;       // Deseja validar o usuÃ¡rio e a senha a cada carregamento de pÃ¡gina?
$_SG['tabela'] = 'tb_usuario'; 
  
// Verifica se precisa iniciar a sessÃ£o
if ($_SG['abreSessao'] == true) {
  session_start();
}

 /*Possiveis valores para a funcao kick_out()
	get_out_01 = "Por favor realize o login para acessar este recurso";
	get_out_02 = "Usuario deve ser informado";
	get_out_03 = "Usuario digitado no formato incorreto";
	get_out_04 = "Senha deve ser informada";
	get_out_05 = "Usuario ou senha incorretos";
 */


function validaUsuario($usuario, $senha){

	global $_SG;
	$pdo = conectar();
	 
    $cS = ($_SG['caseSensitive']) ? 'BINARY' : '';
     
    // Usa a funÃ§Ã£o addslashes para escapar as aspas
    $nusuario = addslashes($usuario);
    $nsenha   = addslashes($senha);
	
	if(empty($nusuario)){
		return "get_out_02";
	}else if(empty($nsenha)){
		return "get_out_04";
	}else{
		$sql = "select cod_usuario,nom_usuario,email,senha,perfil  from  tb_usuario where email = '".$nusuario."'  limit 1";
		$stm = $pdo->prepare($sql);
		$stm-> bindValue(1 ,$nusuario);
		$stm-> bindValue(2 ,$nsenha);
		$stm-> execute();
		$resultado = $stm->fetch(PDO::FETCH_ASSOC);
		
		 
		// Verifica se encontrou algum registro
		if (empty($resultado)) {
			// Nenhum registro foi encontrado => o usuÃ¡rio Ã© invÃ¡lido
		   return "get_out_05";   
		} else {
			 
			// Definimos dois valores na sessÃ£o com os dados do usuÃ¡rio
			$_SESSION['usuarioID'] 		= $resultado['cod_usuario']; // Pega o valor da coluna 'id do registro encontrado no MySQL
			$_SESSION['usuarioNome'] 	= $resultado['nom_usuario']; // Pega o valor da coluna 'nome' do registro encontrado no MySQL
			$_SESSION['idPermissao'] 	= $resultado['perfil'];
			
			 
			if ($_SG['validaSempre'] == true) {
				// Definimos dois valores na sessÃ£o com os dados do login
				$_SESSION['usuarioLogin'] = $usuario;
				$_SESSION['usuarioSenha'] = $senha;
			}
			return "OK" ;
		}
	} 
}
     
/**
* FunÃ§Ã£o que protege uma pÃ¡gina
*/

function protectPage($tipo_permissao){
    global $_SG;
	
    if (!isset($_SESSION['usuarioID']) OR !isset($_SESSION['usuarioNome'])){
       
       kick_out("get_out_01");
    } else if (!isset($_SESSION['usuarioID']) OR !isset($_SESSION['usuarioNome'])){
        // HÃ¡ usuÃ¡rio logado, verifica se precisa validar o login novamente
        if ($_SG['validaSempre'] == true){
            // Verifica se os dados salvos na sessÃ£o batem com os dados do banco de dados
            if (!validaUsuario($_SESSION['usuarioLogin'], $_SESSION['usuarioSenha'])){
                // Os dados nÃ£o batem, manda pra tela de login
               kick_out("get_out_07");
            }
        }
        
        if($_SESSION['idPermissao']!=$tipo_permissao)
        	kick_out("get_out_07"); // usuário não tem permissão neste módulo
        	
    }
}
     
function kick_out($permissao) {
    global $_SG;
    //Remove as variÃ¡veis da sessÃ£o (caso elas existam)
    unset($_SESSION['usuarioID'], $_SESSION['usuarioNome'], $_SESSION['usuarioLogin'], $_SESSION['usuarioSenha']);
     // Manda pra tela de login
     header("Location:index.php?page=login&acesso=$permissao");
}

function msgAlert(){
	
	$mensagem=@$_SESSION['mensagem'];
	switch($mensagem){
	
		case 'dados-salvos':
			$_SESSION['mensagem']	=	'';
			echo '<script>$("#alertMsg").fadeIn(300).html("Os dados foram salvos com sucesso.");setTimeout(function(){$("#alertMsg").fadeOut(300);},4000);</script>';			
			break;
			
		case 'dado-removido':
			$_SESSION['mensagem']	='';
			echo '<script>$("#alertMsg").fadeIn(300).html("Os dados foram removidos com sucesso.");setTimeout(function(){$("#alertMsg").fadeOut(300);},4000);</script>';			
			break;
				
		case 'usuario-removido':
			$_SESSION['mensagem']	=	'';
			echo '<script>$("#alertMsg").fadeIn(300).html("Usuário removido com sucesso.");setTimeout(function(){$("#alertMsg").fadeOut(300);},4000);</script>';			
		break;
	}
}
?>
