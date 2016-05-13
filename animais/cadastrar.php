<?php

define('PATH', '../');
define('IMG_ADM_PATH', '../images/');

Error_reporting ( 0 );
require_once PATH.'assets/php/conexao.php';
require_once PATH.'seguranca.php';

$tipo_permissao	=	2;
protectPage ($tipo_permissao);

$pdo = conectar ();



if(@$_POST && trim(@$_GET['a']) == 's'){
	
	$nome	 			= utf8_decode($_POST['nome']);
	$cidade	 			= $_POST['cidade'];
	$descricao			= utf8_decode($_POST['descricao']);
	$perfil				= utf8_decode($_POST['perfil']);
	$sexo				= $_POST['sexo'];
	$especie			= $_POST['especie'];
	
	$qry = "insert into tb_animal 
			(COD_USUARIO, NOM_ANIMAL, DESC_ANIMAL, DESC_PERFIL,
			IND_SEXO, COD_ESPECIE, DT_CADASTRO, COD_CIDADE)
	values (".$_SESSION['usuarioID'].",'{$nome}', '{$descricao}', '{$perfil}',
			'{$sexo}', '{$especie}', now(), '{$cidade}') ";
	
	$pdo->query ($qry);
	$id 	= $pdo->lastInsertId();
	
	// Prepara a inclusão das fotos
	$qry_foto 			= 	"insert into tb_foto (COD_ANIMAL, URL, ID_FOTO_PRI) values ";
	$up_fotos		=	0;
	
	for($i=1;$i<=5;$i++){
		if(!empty($_FILES['foto'.$i]['size'])){
			$files_foto = $_FILES['foto'.$i];
		    $arquivo 	= up_arquivo_foto($files_foto,'../images/uploads/');
		   
		    
			if($arquivo=='Erro'){
		    	// Se chegar aqui, redireciona
				$_SESSION['mensagem']	=	'dados-salvos';
				//die('<script>window.location.href="./editar.php?n='.$id.'";</script>');
				die("asd");
				
			}else{
				$up_fotos++;
		    	
		    	$i==1?
		    		$qry_foto	.=	"('".$id."','".$arquivo."', '1'),":
		    		$qry_foto	.=	"('".$id."','".$arquivo."', '0'),";
			}
		}
	}
	
	// Inclui as fotos
	$tamanho_sql	=	strlen($qry_foto);
	if($up_fotos>0){
		$qry_foto			=	substr($qry_foto,0,$tamanho_sql-1);
		$pdo->query ($qry_foto);
	}
	
	// Se chegar aqui, redireciona
	$_SESSION['mensagem']	=	'dados-salvos';
	die('<script>window.location.href="./cadastrar.php";</script>');
	
}

?>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
<head>
<title>Miaudote - Gestor Animais</title>
<meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="images/icons/favicon.ico">
<link rel="apple-touch-icon" href="images/icons/favicon.png">
<link rel="apple-touch-icon" sizes="72x72" 	href="images/icons/favicon-72x72.png">
<link rel="apple-touch-icon" sizes="114x114" href="images/icons/favicon-114x114.png">
<!--Loading bootstrap css-->
<link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,700">
<link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Oswald:400,700,300">
<link type="text/css" rel="stylesheet" href="<?=PATH?>assets/css/aprovacao/jquery-ui-1.10.4.custom.min.css">
<link type="text/css" rel="stylesheet" href="<?=PATH?>assets/css/aprovacao/font-awesome.min.css">
<link type="text/css" rel="stylesheet" href="<?=PATH?>assets/css/aprovacao/bootstrap.min.css">

<link type="text/css" rel="stylesheet" href="<?=PATH?>assets/css/aprovacao/animate.css">
<link type="text/css" rel="stylesheet" href="<?=PATH?>assets/css/aprovacao/all.css">
<link type="text/css" rel="stylesheet" href="<?=PATH?>assets/css/aprovacao/main.css">
<link type="text/css" rel="stylesheet" href="<?=PATH?>assets/css/aprovacao/style-responsive.css">

<link type="text/css" rel="stylesheet" href="<?=PATH?>assets/css/aprovacao/zabuto_calendar.min.css">
<link type="text/css" rel="stylesheet" href="<?=PATH?>assets/css/aprovacao/pace.css">
<link type="text/css" rel="stylesheet" href="<?=PATH?>assets/css/aprovacao/jquery.news-ticker.css">
<link type="text/css" rel="stylesheet" href="<?=PATH?>assets/css/aprovacao/jplist-custom.css">
<link rel="stylesheet" href="<?=PATH?>assets/fonts/font-awesome/css/font-awesome.css">

	
<script src="<?=PATH?>assets/js/aprovacao/jquery-1.10.2.min.js"></script>
<script src="<?=PATH?>assets/js/script-animais.js"></script>
<script type="text/javascript" >
$(function(){
	
	$('#form').submit(function(){
		
		var msg =	'Erros encotnrados: \n\n';
		var err =	0;
		 
		if($('#nome').val()==''){
			msg	+=	'- informe um nome válido! \n';
			err	=	1;	
		}	
		
		if($('#descricao').val()==''){
			msg	+=	'- informe uma descrição válido! \n';
			err	=	1;	
		}
		
		if($('#estado').val()==''){
			msg	+=	'- informe o estado! \n';
			err	=	1;	
		}
		
		if($('#cidade').val()==''){
			msg	+=	'- informe a ciudade! \n';
			err	=	1;	
		}
		
		var conta_foto	=	0; 
		$('.foto-animal').each(function(){
			
			var vlw	= $(this).val();
			if(vlw==''){
				conta_foto++;
			}
		});
		
		if(conta_foto==5){
			msg	+=	'- informe pelo menos uma foto! \n';
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
		Gestor de Animais - Cadastrar novo
	</h1>
	<div id="conteudo" style="text-align: justify;" >
	<br/><br/>
	<a class="btn btn-default btn-lg" href="./" style="float:left;"> 
		<i class="fa fa-arrow-left" aria-hidden="true"> </i>&nbsp;Voltar
	</a>
	
	<a class="btn btn-default btn-lg" href="<?=PATH?>sair.php" style="float:right;"> 
		<i class="fa fa-sign-out" aria-hidden="true">Sair</i>
	</a>
	
	<div style="clear:both;height:30px;"></div>
	
	<center>
	<form method="post" action="?n=<?php echo trim(@$_GET['n']); ?>&a=s" name="form" id="form"  enctype="multipart/form-data" >
			<div class="input-group">

				Nome:
				<br>
				<input type="text" 			id="nome" 		name="nome"  class="form-control" style="width:400px;"/>
				<br/><br/>
			</div>
			<div class="input-group">
				Descri&ccedil;&atilde;o:
				<br>
				<textarea type="text" 		id="descricao" 	name="descricao"  class="form-control"/		style="width:400px;height:100px;"/></textarea>
				<br/><br/>
			</div>
			<div class="input-group">
				Perfil:
				<br>
				<textarea type="text" 		id="perfil" 	name="perfil" class="form-control"/ 			style="width:400px;height:100px;"/></textarea>
				<br><br>
			</div>
			<div class="input-group">
				Sexo:
				<br>
				<select name="sexo" id="sexo" class="form-control" style="width:400px;"/>
					<option value='1'>Macho</option>
					<option value='2'>F&ecirc;mea</option>
				</select>
				<br/><br/>
			</div>
			<div class="input-group">
				Esp&eacute;cie:	
				<br>
				<select name="especie" id="especie" class="form-control" style="width:400px;"/>
					<?php
					$qry_ 		= "select * from tb_especie order by NOM_ESPECIE asc";
					$ls 		= $pdo->query ($qry_);
					
					while ( $lin = $ls->fetch ( PDO::FETCH_ASSOC ) ):
						echo "<option value='".$lin[COD_ESPECIE]."'>".$lin[NOM_ESPECIE]."</option>";
					endwhile; 
					?>
				</select>
				<br/><br/>
			</div>
			
			<div class="input-group">
				Estado:
				<br>
				<select name="estado" id="estado" class="form-control" style="width:400px;"/>
					<option value=""> Informe o estado</option>
					<?php
					$qry_ 		= "select * from tb_estado order by SG_UF asc";
					$ls 		= $pdo->query ($qry_);
					
					while ( $lin = $ls->fetch ( PDO::FETCH_ASSOC ) ):
						echo "<option value='".$lin['COD_ESTADO']."'>".$lin['SG_UF']."</option>";
					endwhile; 
					?>
				</select>
				<br/><br/>
			</div>
			<div class="input-group">
				Cidade:	
				<br>
				<select name="cidade" id="cidade" class="form-control" style="width:400px;"/>
					<option value=""> Informe o estado</option>
				</select>
				<br/><br/>
			</div>
			<div class="input-group">			
				<h1 style="font-size:15pt;">Foto: Tamanho e formato 800x600 px JPG
				<br><span style="color:red;">(A primeira foto selecionada ser&aacute; a foto de capa)</span>
				</h1><br>
				Foto(1): 	
				<br>
				<input type="file" 		id="foto1" 	name="foto1" class="foto-animal form-control"/>
				<br/><br/>
			</div>
			<div class="input-group">
				Foto(2): 	
				<br>
				<input type="file" 		id="foto3" 	name="foto2" class="foto-animal form-control"/>
				<br/><br/>
			</div>
			<div class="input-group">
				Foto(3): 	
				<br>
				<input type="file" 		id="foto3" 	name="foto3" class="foto-animal form-control"/>
				<br/><br/>
			</div>
			<div class="input-group">
				Foto(4): 	
				<br>
				<input type="file" 		id="foto4" 	name="foto4" class="foto-animal form-control"/>
				<br/><br/>
			</div>
			<div class="input-group">
				Foto(5): 	
				<br>
				<input type="file" 		id="foto5" 	name="foto5" class="foto-animal form-control"/>
				<br/><br/>
			</div>
			<div style="clear:both;height:30px;"></div>
			<div class="input-group">
			<table align="center" border="0" cellspacing="10" cellpadding="20">
				<tr>
					<td>
						<input type="button" value="Cancelar" onclick="javascript: window.location.href='./';" name="btnCancel" id="btnCancel" />
					</td>
					<td>
						&nbsp;&nbsp;&nbsp;
					</td>
					<td>
						<input type="submit" value="Salvar" name="btnSalvar" id="btnSalvar" />
					</td>
					
				</tr>
			</table>
			</div>
		
		
		</form>
		</center>
		

</body>
</html>

<?php
msgAlert();
fechaConexao();
?>