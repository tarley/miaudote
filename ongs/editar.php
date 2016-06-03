<?php
define ( 'PATH', '../' );
define ( 'IMG_ADM_PATH', '../images/' );

require_once PATH.'assets/php/conexao.php';
require_once PATH.'seguranca.php';

$tipo_permissao	=	2;
protectPage ($tipo_permissao);

$pdo = conectar ();

$tipo_permissao	=	2;
protectPage ($tipo_permissao);

if(!filter_var(trim(@$_GET['n']),FILTER_VALIDATE_INT) || trim(@$_GET['n']) < 1){
	// Se n�o vier um ID v�lido
	header('Location: ./');
	exit();
}else{
	// Busca dados do animal
	$id	 	= (int)trim($_GET['n']);
	$qry = "select 
			u.cod_usuario,
			u.nom_usuario,
			u.email,
			u.senha,
			u.telefone,
			u.perfil
			from tb_usuario u	
			where cod_usuario = " .$id. " limit 1";

	$lista 	= $pdo->query($qry);
	$num 	= $pdo->query($qry)->rowCount();
	
	if(!$num){
		header('Location: ./');
		exit();		
	}else{
		$row = $lista->fetch ( PDO::FETCH_ASSOC );
		$cod_uusario	= 		$row['cod_usuario'];			
		$nom_usuario	= 		$row['nom_usuario'];			
		$email			= 		$row['email'];			
		$senha		    = 		$row['senha'];
		$telefone		= 		$row['telefone'];			
		$perfil			= 		$row['perfil'];				
	}
	
}	
	
	
if($_POST && trim($_GET['a']) == 's'){

	
	// Altera os dados
	$id					= (int)trim($_GET['n']);
	//$cod_uusario	= $_POST['COD_USUARIO'];
	$nom_usuario	= $_POST['NOM_USUARIO'];
	$email			= $_POST['EMAIL_USUARIO'];		
	$senha		    = $_POST['SENHA'];
	$telefone		= $_POST['TELEFONE'];	
	$perfil			= $_POST['PERFIL'];		
	

	$qry = "update tb_usuario set 
								 	nom_usuario='{$nom_usuario}',
								 	email='{$email}',
								  	senha='{$senha}',
								  	telefone ='{$telefone}',
								  	perfil='{$perfil}'						  	
			where cod_usuario ='".$id."'";
	
	$pdo->query ($qry);
	die('<script>window.location.href="./";</script>');
	

}

?>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
<head>
<title>Miaudote - Gestor Animais</title>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="images/icons/favicon.ico">
<link rel="apple-touch-icon" href="images/icons/favicon.png">
<link rel="apple-touch-icon" sizes="72x72"
	href="images/icons/favicon-72x72.png">
<link rel="apple-touch-icon" sizes="114x114"
	href="images/icons/favicon-114x114.png">
<!--Loading bootstrap css
<link type="text/css" rel="stylesheet"
	href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,700">
<link type="text/css" rel="stylesheet"
	href="http://fonts.googleapis.com/css?family=Oswald:400,700,300">-->
<link type="text/css" rel="stylesheet"
	href="<?=PATH?>assets/css/aprovacao/jquery-ui-1.10.4.custom.min.css">
<link type="text/css" rel="stylesheet"
	href="<?=PATH?>assets/css/aprovacao/font-awesome.min.css">
<link type="text/css" rel="stylesheet"
	href="<?=PATH?>assets/css/aprovacao/bootstrap.min.css">

<link type="text/css" rel="stylesheet"
	href="<?=PATH?>assets/css/aprovacao/animate.css">
<link type="text/css" rel="stylesheet"
	href="<?=PATH?>assets/css/aprovacao/all.css">
<link type="text/css" rel="stylesheet"
	href="<?=PATH?>assets/css/aprovacao/main.css">
<link type="text/css" rel="stylesheet"
	href="<?=PATH?>assets/css/aprovacao/style-responsive.css">

<link type="text/css" rel="stylesheet"
	href="<?=PATH?>assets/css/aprovacao/zabuto_calendar.min.css">
<link type="text/css" rel="stylesheet"
	href="<?=PATH?>assets/css/aprovacao/pace.css">
<link type="text/css" rel="stylesheet"
	href="<?=PATH?>assets/css/aprovacao/jquery.news-ticker.css">
<link type="text/css" rel="stylesheet"
	href="<?=PATH?>assets/css/aprovacao/jplist-custom.css">
<link rel="stylesheet"
	href="<?=PATH?>assets/fonts/font-awesome/css/font-awesome.css">


<script src="<?=PATH?>assets/js/aprovacao/jquery-1.10.2.min.js"></script>
<script src="<?=PATH?>assets/js/script-animais.js"></script>
<script type="text/javascript">
$(function(){
	
	$('#form').submit(function(){
		
		var msg =	'Erros encotnrados: \n\n';
		var err =	0;
		 
		if($('#NOM_USUARIO').val()==''){
			msg	+=	'- informe um nome v�lido! \n';
			err	=	1;	
		}	
		
		if($('#EMAIL').val()==''){
			msg	+=	'- informe um e-mail v�lido! \n';
			err	=	1;	
		}
		
		if($('#SENHA').val()==''){
			msg	+=	'- informe uma senha! \n';
			err	=	1;	
		}
		
		if($('#CNPJ').val()==''){
			msg	+=	'- informe um CNPJ valido! \n';
			err	=	1;	
		}
		
		
		
		if(err==1){
			alert(msg);
			return false;
		}else{
			return true;
		}
	});
});       
</script>
</head>
<body>
	<div id="alertMsg"></div>


	<h1>
		Gestor de ONGs - Editar - <!-- ?=$nom_usuario?-->
	</h1>

	<div id="conteudo" style="text-align: justify;" >
		<br/><br/>
		<a class="btn btn-default btn-lg" href="./" style="float:left;"> 
			<i class="fa fa-arrow-left" aria-hidden="true"> </i>&nbsp;Voltar
		</a>
			
		<a class="btn btn-default btn-lg" href="<?=PATH?>sair.php" style="float:right;"> 
			<i class="fa fa-sign-out" aria-hidden="true">Sair</i>
		</a>
	<center>	
		<form method="post" action="?n=<?php echo trim(@$_GET['n']); ?>&a=s" name="form" id="form"  >
		<div style="clear:both;height:30px;"></div>
			<div class="input-group">
				Nome da ONG: <br> <input type="text" id="NOM_USUARIO"
					name="NOM_USUARIO" class="form-control" value="<?=$nom_usuario?>" style="width: 400px;" /> <br />
				<br />
			</div>
			<div class="input-group">
				E-mail: <br> <input type="email" id="EMAIL" value="<?=$email?>"name="EMAIL_USUARIO"
					class="form-control" /		style="width: 400px;" /> <br />
				<br/>
			</div>
			<div class="input-group">
				Senha: <br> <input type="text" id="SENHA" value="<?=$senha?>"name="SENHA"
					class="form-control" / 		style="width: 400px;" /> <br>
				<br>
			</div>
			<div class="input-group">
				CNPJ: <br> <input type="text" id="TELEFONE" value="<?=$telefone?>" name="TELEFONE"
					class="form-control" style="width: 400px;" /> <br />
				<br/>
			</div>
			<div class="input-group">
				Perfil: <br> <input type="text" id="PERFIL" value="<?=$perfil?>" name="PERFIL"
					class="form-control" style="width: 400px;" /> <br />
				<br/>
			</div>
			
			<br><br>
			<br>
			<table align="center" border="0" >
				<tr>
					<td ><input type="button" value="Cancelar" onclick="javascript: window.location.href='./';" name="btnCancel" id="btnCancel" style="width:69px; height: 27px;" /></td>
					<td>&nbsp;&nbsp;&nbsp;<input type="hidden" value="<?=$id?>" name="id_dado" id="id_dado" /></td>
					<td ><input type="submit" value="Salvar" name="btnSalvar" id="btnSalvar" /></td>
				</tr>
			</table>
		</form>
	</center>
	</div>
</body>
</html>
