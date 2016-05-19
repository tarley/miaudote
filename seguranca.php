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
	get_out_06 = "Por favor realize o login para acessar este recurso";
 */


function validaUsuario($usuario, $senha) {

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
		$sql = "select cod_usuario,nom_usuario,email,senha  from  ".$_SG['tabela']." where ".$cS."email = ?  limit 1";
		//$sql = "select cod_usuario,nom_usuario,email,senha,id_permissao  from  ".$_SG['tabela']." where ".$cS."email = ? and ".$cS."senha = ? limit 1";
		$stm = $pdo->prepare($sql);
		$stm-> bindValue(1, $nusuario);
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
			//$_SESSION['idPermissao'] 	= $resultado['id_permissao'];
			
			if($usuario=="ong@email.com"){
				$_SESSION['idPermissao'] =	1;
			}else{
				$_SESSION['idPermissao'] =	2;
			}
			 
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
	
    if (!isset($_SESSION['usuarioID']) OR !isset($_SESSION['usuarioNome'])) {
        // NÃ£o hÃ¡ usuÃ¡rio logado, manda pra pÃ¡gina de login
       kick_out("get_out_01");
    } else if (!isset($_SESSION['usuarioID']) OR !isset($_SESSION['usuarioNome'])) {
        // HÃ¡ usuÃ¡rio logado, verifica se precisa validar o login novamente
        if ($_SG['validaSempre'] == true) {
            // Verifica se os dados salvos na sessÃ£o batem com os dados do banco de dados
            if (!validaUsuario($_SESSION['usuarioLogin'], $_SESSION['usuarioSenha'])) {
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
    // Remove as variÃ¡veis da sessÃ£o (caso elas existam)
    unset($_SESSION['usuarioID'], $_SESSION['usuarioNome'], $_SESSION['usuarioLogin'], $_SESSION['usuarioSenha']);
     // Manda pra tela de login
     header("Location:index.php?page=login&acesso=$permissao");
}

function up_arquivo_foto($upload,$patch){
		
	@set_time_limit(0);
	$extensao	=	@strtolower(@end(explode('.',$upload['name'])));
	$array_formato	=	array("png","jpg","gif","jpeg","bmp");
							  
	if($upload['size']>1000000){
		echo '<script>alert("A imagem não pode ter mais de 1Mb.");</script>';
		return 'Erro';
	}else{
		if(in_array($extensao,$array_formato)){
		
		    $imagem_nome 	= md5(time(uniqid($upload['name']))).md5(uniqid(time())). "." .$extensao;			    		    
		    $imagem_dir 	= $patch.$imagem_nome;		    
		    @move_uploaded_file($upload["tmp_name"], $imagem_dir) or die ("Erro de permissão. path:".$imagem_dir);		        			
			
			$imgGrava 	= $patch.$imagem_nome;
				
			return $imgGrava;
		}else{
			return "";
		}
	}
}

function msgAlert(){
	
	$mensagem	=	@$_SESSION['mensagem'];
	switch($mensagem){
	
		case 'dados-salvos':
				$_SESSION['mensagem']	=	'';
				echo '<script>$("#alertMsg").fadeIn(300).html("Os dados foram salvos com sucesso.");setTimeout(function(){$("#alertMsg").fadeOut(300);},4000);</script>';			
			break;
			
		case 'dado-removido':
				$_SESSION['mensagem']	=	'';
				echo '<script>$("#alertMsg").fadeIn(300).html("Os dados foram removidos com sucesso.");setTimeout(function(){$("#alertMsg").fadeOut(300);},4000);</script>';			
			break;
				
		case 'usuario-removido':
				$_SESSION['mensagem']	=	'';
				echo '<script>$("#alertMsg").fadeIn(300).html("Usuário removido com sucesso.");setTimeout(function(){$("#alertMsg").fadeOut(300);},4000);</script>';			
			break;
	}
}
?>
