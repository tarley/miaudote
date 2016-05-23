<?php
define ( 'PATH', '../' );
define ( 'IMG_ADM_PATH', '../images/' );

require_once PATH.'assets/php/conexao.php';
require_once PATH.'seguranca.php';


$tipo_permissao	=	2;
protectPage ($tipo_permissao);

$pdo = conectar();

if(@$_POST && trim(@$_GET['a']) == 's'){
	
	$nome	 			= utf8_decode($_POST['NOM_USUARIO']);
	$email			    = $_POST['EMAIL_USUARIO'];
	$senha	 			= $_POST['SENHA'];
	$telefone	 		= $_POST['TELEFONE'];
	$perfil             = $_POST['PERFIL'];
	
	try{
		/*$qry = "insert into tb_usuario (NOM_USUARIO,EMAIL,SENHA) 	values ('{$nome}', '{$email}', '{$senha}') ";
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $pdo->prepare($qry);
		$stmt ->execute();*/
		
	
		$statement = $pdo->prepare('insert into tb_usuario (NOM_USUARIO,EMAIL,SENHA,TELEFONE,PERFIL) 	values (:nome,:email,:senha,:telefone,:perfil)');

		 $nome     = filter_var($_POST['NOM_USUARIO']);
		 $email    = filter_var($_POST['EMAIL_USUARIO']);
		 $senha    = filter_var($_POST['SENHA']);
		 $telefone    = filter_var($_POST['TELEFONE']);

		 $statement->bindParam(':nome',  $nome);
		 $statement->bindParam(':email', $email);
		 $statement->bindParam(':senha', $senha);
		 $statement->bindParam(':telefone', $telefone);
		 $statement->bindParam(':perfil', $perfil);
		 
		 // Executa a sentença já com os valores
		 if($statement->execute()){
		  // Definimos a mensagem de sucesso
		   @$_SESSION['messagem'] = 'dados-salvos';
		   die('<script>window.location.href="./";</script>');
		 }else{
		   // Definimos a mensagem de erro
		   @$_SESSION['messagem'] = 'Falha ao cadastrar usuário';
		 }
		
	}catch(PDOException $e) {
		echo 'Error: '. $e->getMessage();
	}	
}

?>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
<head>
<title>Miaudote - Gestor ONGs</title>
<meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="images/icons/favicon.ico">
<link rel="apple-touch-icon" href="images/icons/favicon.png">
<link rel="apple-touch-icon" sizes="72x72"
	href="images/icons/favicon-72x72.png">
<link rel="apple-touch-icon" sizes="114x114"
	href="images/icons/favicon-114x114.png">
<!--Loading bootstrap css-->
<link type="text/css" rel="stylesheet"
	href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,700">
<link type="text/css" rel="stylesheet"
	href="http://fonts.googleapis.com/css?family=Oswald:400,700,300">
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
			msg	+=	'- informe um nome válido! \n';
			err	=	1;	
		}	
		
		if($('#EMAIL').val()==''){
			msg	+=	'- informe um e-mail válido! \n';
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


	<h1>Gestor de ONGs - Cadastrar novo</h1>
	<div id="conteudo" style="text-align: justify;">
		<br />
		<br /> <a class="btn btn-default btn-lg" href="./"
			style="float: left;"> <i class="fa fa-arrow-left" aria-hidden="true">
		</i>&nbsp;Voltar
		</a> <a class="btn btn-default btn-lg" href="<?=PATH?>sair.php"
			style="float: right;"> <i class="fa fa-sign-out" aria-hidden="true">Sair</i>
		</a>

		<div style="clear: both; height: 30px;"></div>

		<center>
			<form method="post" action="?n=<?php echo trim(@$_GET['n']); ?>&a=s"
				name="form" id="form" enctype="multipart/form-data">
				<div class="input-group">
					Nome da ONG: <br> <input type="text" id="NOM_USUARIO"
						name="NOM_USUARIO" class="form-control" style="width: 400px;" /> <br />
					<br />
				</div>
				<div class="input-group">
					E-mail: <br> <input type="email" id="EMAIL" name="EMAIL_USUARIO"
						class="form-control" /		style="width: 400px;" /> <br />
					<br/>
				</div>
				<div class="input-group">
					Senha: <br> <input type="password" id="SENHA" name="SENHA"
						class="form-control" / 			style="width: 400px;" /> <br>
					<br>
				</div>
				<div class="input-group">
					Telefone: <br> <input type="text" id="TELEFONE" name="TELEFONE"
						class="form-control" style="width: 400px;" /> <br />
					<br />
				</div>
				<div class="input-group">
					Permissao: <br> <input type="text" id="PERFIL" name="PERFIL"
						class="form-control" style="width: 400px;" /> <br />
					<br />
				</div>
				<div style="clear: both; height: 30px;"></div>
				<div class="input-group">
					<table align="center" border="0" cellspacing="10" cellpadding="20">
						<tr>
							<td><input type="button" value="Cancelar"
								onclick="javascript: window.location.href='./';"
								name="btnCancel" id="btnCancel" /></td>
							<td>&nbsp;&nbsp;&nbsp;</td>
							<td><input type="submit" value="Salvar" name="btnSalvar"
								id="btnSalvar" /></td>

						</tr>
					</table>
				</div>
			</form>
		</center>

</body>
</html>
<?php
msgAlert();
?>
