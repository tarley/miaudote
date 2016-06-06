<?php
define('PATH', '../');
define('IMG_ADM_PATH', '../images/');

Error_reporting (0);
require_once PATH.'assets/php/conexao.php';
require_once PATH.'assets/php/upload.php';
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
	$porte	 			= $_POST['porte'];
	$cor	 			= $_POST['cor'];
	$idade	 			= $_POST['idade'];
	
	$qry = "insert into tb_animal 
			(COD_USUARIO, NOM_ANIMAL, DESC_ANIMAL, DESC_PERFIL,
			IND_SEXO, IDADE, COR,
			IND_PORTE, COD_ESPECIE, COD_CIDADE)
	values (".$_SESSION['usuarioID'].",'{$nome}', '{$descricao}', '{$perfil}',
			'{$sexo}', '{$idade}', '{$cor}',
			'{$porte}', '{$especie}', '{$cidade}') ";
	
	$pdo->query($qry);
	$id = $pdo->lastInsertId();
	
	// Prepara a inclus�o das fotos
	$qry_foto 	= 	"insert into tb_foto (COD_ANIMAL, URL, ID_FOTO_PRI) values ";
	$up_fotos	=	0;
	
	for($i=1;$i<=5;$i++){
		if(!empty($_FILES['foto'.$i]['size'])){
			$files_foto = $_FILES['foto'.$i];
					
			$upload    = new Upload($files_foto,387,600,'../images/uploads/'); 
			$arquivo   = $upload->salvar();
					
			if($arquivo=='Erro'){
				$_SESSION['mensagem']	=	'dados-salvos';
				die("asd");	
			}else{
				$up_fotos++;
		    	$i==1?
				$qry_foto	.=	"('".$id."','../images/uploads/".$arquivo."', 'S'),":
				$qry_foto	.=	"('".$id."','../images/uploads/".$arquivo."', 'N'),";
			}
		}
	}
	
	
	// Inclui as fotos
	$tamanho_sql =	strlen($qry_foto);
	if($up_fotos>0){
		
		$qry_foto =	substr($qry_foto,0,$tamanho_sql-1);		
		$pdo->query ($qry_foto);

	}
	
	// Se chegar aqui, redireciona
	$_SESSION['mensagem']	=	'dados-salvos';
	//die('<script>window.location.href="./cadastrar.php";</script>');
	
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
		
		var msg =	'Erros encotrados: \n\n';
		var err =	0;
		 
		if($('#nome').val()==''){
			msg	+=	'- informe um nome v�lido! \n';
			err	=	1;	
		}	
		
		if($('#descricao').val()==''){
			msg	+=	'- informe uma descri��o v�lido! \n';
			err	=	1;	
		}
		
		if($('#idade').val()==''){
			msg	+=	'- informe a idade! \n';
			err	=	1;	
		}
		
		if($('#cor').val()==''){
			msg	+=	'- informe a cor! \n';
			err	=	1;	
		}
		
		if($('#estado').val()==''){
			msg	+=	'- informe o estado! \n';
			err	=	1;	
		}
		
		if($('#cidade').val()==''){
			msg	+=	'- informe a cidade! \n';
			err	=	1;	
		}
		*
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

<?php
	
	switch ($_SESSION['idPermissao']){
		case 1:
				include(PATH.'shared/_painel_ong.php');
			break;
		case 2:
				include(PATH.'shared/_painel_moderador.php');
			break;
	}
	?>

	<div id="alertMsg"></div>
	<br>
	<br>
	</br>
	</br>

	<h1>
		Gestor de Animais - Cadastrar novo
	</h1>
	<div id="conteudo" style="text-align: justify;" >
	<br/><br/>
	<a class="btn btn-default btn-lg" href="./" style="float:left;"> 
		<i class="fa fa-arrow-left" aria-hidden="true"> </i>&nbsp;Voltar
	</a>

	<div style="clear:both;height:30px;"></div>
	
	<form method="post" action="?n=<?php echo trim(@$_GET['n']); ?>&a=s" name="form" id="form"  class='form-horizontal' enctype="multipart/form-data" >
			
				<h4>Informações do animal</h4>
			
				<div class='form-group'><label class='col-sm-3 control-label'>Nome</label>
					<div class='col-sm-9 controls'>
						<div class='row'>
							<div class='col-md-9 col-xs-12'><input type='text' placeholder='digite o nome' class='form-control' name='nome'/></div>
						</div>
					</div>
				</div>
				

				<div class='form-group'><label class='col-sm-3 control-label'>Espécie</label>

					<div class='col-sm-9 controls'>
						<div class='row'>
							<div class='col-md-5 col-xs-12'>
								<select class='form-control' name='especie'>
									<option selected >Selecione ...</option>
									<option value = "1"> Cão  </option>
									<option value = "2">Gato  </option>
								</select>
							</div>
						</div>
					</div>
				</div>

			
				<div class='form-group'><label class='col-sm-3 control-label'>Frase de apresentação</label>

					<div class='col-sm-9 controls'>
						<div class='row'>
							<div class='col-md-9 col-xs-12'><input type='text' placeholder='defina seu animal em  no maximo 4 palavras' class='form-control'name='descricao'/></div>
						</div>
					</div>
				</div>
				
				<div class='form-group'><label class='col-sm-3 control-label'>cor</label>
					<div class='col-sm-9 controls'>
						<div class='row'>
							<div class='col-md-9 col-xs-12'><input type='text' placeholder='digite a cor do animal' class='form-control' name='cor'/></div>
						</div>
					</div>
				</div>
				<div class='form-group'><label class='col-sm-3 control-label'>Idade</label>

					<div class='col-sm-9 controls'>
						<div class='row'>
							<div class='col-md-9 col-xs-12'><input type='number' placeholder='' class='form-control'name='idade'/></div>
						</div>
					</div>	
				</div>
				
				<div class='form-group'><label class='col-sm-3 control-label'>Porte</label>

					<div class='col-sm-9 controls'>
						<div class='row'>
							<div class='col-md-5 col-xs-12'>
								<select class='form-control' name='porte'>
									<option selected >Selecione ...   </option>
									<option value ='1'> Pequeno  </option>
									<option value ='2'  >Médio  </option>
									<option value ='3' >Grande  </option>
								</select>
							</div>
						</div>
					</div>	
				</div>

				<div class='form-group'><label class='col-sm-3 control-label'>Sexo</label>

					<div class='col-sm-9 controls'>
						<div class='row'>
							<div class='col-md-5 col-xs-12'>
								<select class='form-control' name='sexo'>
									<option selected >Selecione ...</option>
									<option value='1'>Fêmea     </option>
									<option value='2'>Macho     </option>
								</select>
							</div>
						</div>
					</div>
				</div>
				
				
				<div class='form-group'><label class='col-sm-3 control-label'>Estado</label>

					<div class='col-sm-9 controls'>
						<div class='row'>
							<div class='col-md-5 col-xs-12'>
								<select class='form-control' id="estado" name='estado'>
									<option selected >Selecione ...</option>
									
									<?php
									$pdo = conectar();
									$qry_ 	= "select cod_estado,sg_uf from tb_estado order by SG_UF asc";
									$ls 	= $pdo->query ($qry_);
									
									while ( $lin = $ls->fetch ( PDO::FETCH_ASSOC ) ):
										echo "<option value='".$lin['cod_estado']."'>".$lin['sg_uf']."</option>";
									endwhile; 
									?>	
								</select>
							</div>
						</div>
					</div>
				</div>
				
				<div class='form-group'><label class='col-sm-3 control-label'>cidade</label>

					<div class='col-sm-9 controls'>
						<div class='row'>
							<div class='col-md-5 col-xs-12'>
								<select class='form-control' id="cidade" name='cidade'>
									<option selected >Selecione ...</option>
								</select>
							</div>
						</div>
					</div>
				</div>
				
				
				<div class='form-group'><label class='col-sm-3 control-label'>Perfil</label>

					<div class='col-sm-9 controls'>
						<div class='row'>
							<div class='col-md-9 col-xs-12'>
								<textarea type="text"  id="perfil" 	name="perfil" placeholder="Descreva seu animal.Apresentação,caracteristicas ou qualquer informação relevante" class="form-group" style="width:100%;height:100px;"/></textarea>
							</div>
						</div>
					</div>	
				</div>
				
				<hr/>
				<span id='cadastrarAnimal' class='btn btn-green btn-block'>Cadastrar Animal</span>

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
		

</body>
</html>

<?php
msgAlert();
fechaConexao();
?>