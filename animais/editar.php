<?php

define('PATH', '../');
define('IMG_ADM_PATH', '../images/');

Error_reporting ( 0 );
require_once PATH.'assets/php/conexao.php';
require_once PATH.'assets/php/upload.php';
require_once PATH.'seguranca.php';

$tipo_permissao	=	2;
protectPage ($tipo_permissao);

$pdo = conectar ();


if(@trim($_GET['a'])=='exc' && filter_var(@trim($_GET['n']),FILTER_VALIDATE_INT)){

	$id_animal	  =	(int)$_GET['n'];
	$id_del		  =	(int)$_GET['id_'];
	$arquivo_foto = $_GET['foto'];
	
	$qry = "delete from tb_foto where COD_FOTO=".$id_del." AND COD_ANIMAL=".$id_animal." LIMIT 1";
	//die($qry);
	if($pdo->query ($qry)){
		unlink($arquivo_foto);	
		echo $arquivo_foto."_arquivo deletad com sucesso";

	};
	$_SESSION['mensagem']	=	'dado-removido';
	die('<script>window.location.href="editar.php?n='.trim($_GET['n']).'";</script>');
}

if($_POST && trim($_GET['a']) == 's'){
	
	// Altera os dados
	$id					= (int)trim($_GET['n']);
	$nome	 			= utf8_decode($_POST['nome']);
	$descricao			= utf8_decode($_POST['descricao']);
	$perfil				= utf8_decode($_POST['perfil']);
	$sexo				= $_POST['sexo'];
	$especie			= $_POST['especie'];
	$porte	 			= $_POST['porte'];
	$cor	 			= $_POST['cor'];
	$idade	 			= $_POST['idade'];
	$cidade	 			= $_POST['cidade'];
	
	$tem_fotos_capa		= $_POST['tem_fotos_capa'];	
	
	$qry = "UPDATE tb_animal set 
				NOM_ANIMAL='{$nome}',
				DESC_ANIMAL='{$descricao}',
				DESC_PERFIL='{$perfil}',
				IND_SEXO='{$sexo}',
				COD_ESPECIE='{$especie}',
				IDADE='{$especie}',
				COR='{$cor}',
				IND_PORTE='{$especie}',
				COD_CIDADE='{$cidade}'						  	
			where COD_ANIMAL='".$id."'";
	
	$pdo->query ($qry);
	
	// Altera as fotos
	// Prepara a inclusão das fotos
	$qry_foto 			= 	"insert into tb_foto (COD_ANIMAL, URL, ID_FOTO_PRI) values ";
	$up_fotos		=	0;
	
	if($num > 0 ){
		
		for($i=$num;$i<=5;$i++){
			if(!empty($_FILES['foto'.$i]['size'])){
				$files_foto = $_FILES['foto'.$i];
						
				$upload    = new Upload($files_foto,387,600,'../images/uploads/'); 
				$arquivo   = $upload->salvar();
				
				//echo $arquivo;
				
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
		
		
	}else{
		for($i=1;$i<=5;$i++){
			if(!empty($_FILES['foto'.$i]['size'])){
				$files_foto = $_FILES['foto'.$i];
						
				$upload    = new Upload($files_foto,387,600,'../images/uploads/'); 
				$arquivo   = $upload->salvar();
				
				//echo $arquivo;
				
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

	}
	
	
	
	// Inclui as fotos
	$tamanho_sql =	strlen($qry_foto);
	if($up_fotos>0){
	
		$qry_foto =	substr($qry_foto,0,$tamanho_sql-1);

		$pdo->query ($qry_foto);

	}

}



if(!filter_var(trim(@$_GET['n']),FILTER_VALIDATE_INT) || trim(@$_GET['n']) < 1){
	// Se não vier um ID válido
	header('Location: ./');
	exit();
}else{
	// Busca dados do animal
	$id	 	= (int)trim($_GET['n']);
	$qry 	= "select 
					a.*,
					e.NOM_ESPECIE,
					us.NOM_USUARIO,
					f.URL,
					f.ID_FOTO_PRI,
					ci.COD_CIDADE,
					ci.NOM_CIDADE,
					es.COD_ESTADO,
					es.NOM_ESTADO
					
				from tb_animal As a
					INNER JOIN tb_especie AS e
					ON e.COD_ESPECIE = a.COD_ESPECIE
					
					INNER JOIN tb_usuario AS us
					ON us.COD_USUARIO = a.COD_USUARIO
					
					LEFT JOIN tb_foto AS f
					ON f.COD_ANIMAL = a.COD_ANIMAL
					
					INNER JOIN tb_cidade AS ci
					ON ci.COD_CIDADE = a.COD_CIDADE
					
					INNER JOIN tb_estado AS es
					ON es.COD_ESTADO = ci.COD_ESTADO
					
				 where a.COD_ANIMAL = " .$id. " limit 1 ";
	
	$lista 	= $pdo->query ($qry);
	$num 	= $pdo->query ($qry)->rowCount();
	
	if(!$num){
		header('Location: ./');
		exit();		
	}else{
		
		$row = $lista->fetch ( PDO::FETCH_ASSOC );
		
		$cod_animal			= 		$row['COD_ANIMAL'];			
		$cod_usuario		= 		$row['COD_USUARIO'];			
		$nom_animal			= 		$row['NOM_ANIMAL'];			
		$desc_animal		= 		$row['DESC_ANIMAL'];
		$desc_perfil		= 		$row['DESC_PERFIL'];			
		$ind_sexo			= 		$row['IND_SEXO'];			
		$idade				= 		$row['IDADE'];			
		$cor				= 		$row['COR'];			
		$porte			= 		$row['IND_PORTE'];			
		$dt_cadastro		= 		$row['DT_CADASTRO'];			
		$dt_adocao			= 		$row['DT_ADOCAO'];			
		$cod_especie		= 		$row['COD_ESPECIE'];			
		$cod_estado			= 		$row['COD_ESTADO'];			
		$cod_cidade			= 		$row['COD_CIDADE'];	
		$nom_estado			= 		$row['NOM_ESTADO'];			
		$nom_cidade			= 		$row['NOM_CIDADE'];	
		
		// Busca as fotos do animal e monta o layout das fotos
		$qry_ 				= 	"select f.* from tb_foto As f WHERE f.COD_ANIMAL='$cod_animal'";
		$lista_				= 	$pdo->query ($qry_);
		$num_fotos 			= 	$pdo->query ($qry_)->rowCount();
		$htlm_fotos			=	'';
		
		$titulo_capa		=	'<h1 style="font-size:15pt;">Foto: Tamanho e formato 800x600 px JPG
								<br><span style="color:red;">(A primeira foto selecionada será a foto de capa)</span>
								</h1><br>';
		$titulo_capa		.=	'<input type="hidden" value="false" name="tem_fotos_capa" id="tem_fotos_capa" />';
		
		if($num > 0){
			$i 			= 1;
			$capa		=	'false';
			
			
			while ( $row_ = $lista_->fetch (PDO::FETCH_ASSOC )):
			
				$id_foto	= 	$row_['COD_FOTO'];
				$arquivo	=	$row_['URL'];

				
				if($row_['ID_FOTO_PRI'] == 'S'){
					$capa_				=	'<br><div style="width:100px;margin:20px auto;background-color:red;padding:5px;color:#FFF;">Foto de capa</div>';
					$titulo_capa		=	'<h1 style="font-size:15pt;">Foto: Tamanho minimo recomendado : 400 x 400 pixels
											<br><span style="color:red;">(Para trocar a foto de capa, &eacute; necess&aacute;rio deletar a capa atual)</span>
											</h1><br>';
					$titulo_capa		.=	'<input type="hidden" value="true" name="tem_fotos_capa" id="tem_fotos_capa" />';
				}else{
					$capa_				=	'';
				}
				
				$htlm_fotos	.= '<div style="width:250px;min-height:150px;margin:10px;padding:15px;float:left;border:1px solid #ccc;background-color:#fcfbfb;">';			
				$htlm_fotos	.= '	<img src="'.IMG_ADM_PATH.'del.gif" class="btnExcluir_foto" id="btnExcluir_'.$id_foto.'" data-value="'.$arquivo.'"" ><br>';
				$htlm_fotos	.= '	<img src="'.$arquivo.'"	style="max-width:200px;max-height:150px;margin:15px 0;">';
				$htlm_fotos	.= $capa_;
				$htlm_fotos	.= '</div>';
				
			endwhile;
			$htlm_fotos	.= '<div style="clear:both;"></div>';
		}
		
		$opcoes_fotos	=	'';
		
		if($num_fotos ==0){
			for($i=1;$i<=(5-$num_fotos);$i++){
			$opcoes_fotos	.=	'Foto('.$i.'): 	
								 <br>
								 <input type="file" id="foto'.$i.'" name="foto'.$i.'" class="foto-animal"/>
								 <br/><br/>';
			}
			
		}else{
			for($i=($num_fotos);$i<5;$i++){
			$opcoes_fotos	.=	'Foto('.($i+1).'): 	
								 <br>
								 <input type="file" id="foto'.($i+1).'" name="foto'.($i+1).'" class="foto-animal"/>
								 <br/><br/>';
			}
		}

		
	}
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
		
		var msg =	'Erros encotrados: \n\n';
		var err =	0;
		 
		if($('#nome').val()==''){
			msg	+=	'- informe um nome válido! \n';
			err	=	1;	
		}	
		
		if($('#descricao').val()==''){
			msg	+=	'- informe uma descrição válido! \n';
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
	
	$('.btnExcluir_foto').click(function(){
		excluirItem($(this).attr('id').split('_')[1],$(this).data("value"));
	}).css('cursor','pointer');
});

var excluirItem = function(id_Item,foto){
	var msg = 'Tem certeza de que deseja excluir o registro? ';
	if(confirm(msg)){
		var vlw =	$('#id_dado').val();
		window.location.href='editar.php?a=exc&n='+vlw+'&id_='+id_Item+'&foto='+foto;
	}
	return false;
}
//-->       
</script>
</head>
<body>
	<div id="alertMsg"></div>
	

	<h1>
		Gestor de Animais - Editar - <?=$nom_animal?>
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
				<input type="text" 			id="nome" 		name="nome"  class="form-control" value="<?=$nom_animal?>" style="width:400px;"/>
				<br/><br/>
			</div>
			<div class="input-group">
				Descri&ccedil;&atilde;o:
				<br>
				<textarea type="text" 		id="descricao" 	name="descricao"  class="form-control"/		style="width:400px;height:100px;"/><?=$desc_animal?></textarea>
				<br/><br/>
			</div>
			<div class="input-group">
				Perfil:
				<br>
				<textarea type="text" 		id="perfil" 	name="perfil" class="form-control"/ 			style="width:400px;height:100px;"/><?=$desc_perfil?></textarea>
				<br><br>
			</div>
			<div class="input-group">
				Idade:
				<br>
				<input type="number" 			id="idade" 		name="idade" min="1" max="20" class="form-control" value="<?=$idade?>" style="width:400px;"/>
				<br/><br/>
			</div>
			<div class="input-group">
				Cor:
				<br>
				<input type="text" 			id="cor" 		name="cor" class="form-control" value="<?=$cor?>" style="width:400px;"/>
				<br/><br/>
			</div>
			<div class="input-group">
				Porte:
				<br>
				<select name="porte" id="porte" class="form-control" style="width:400px;"/>
					<?php
					$porte==0?
						print "<option value='0' selected>Pequeno</option>":
						print "<option value='0' >Pequeno</option>";
						
					$porte==1?
						print "<option value='1' selected>m&eacute;dio</option>":
						print "<option value='1' >m&eacute;dio</option>";	
					
					$porte==2?
						print "<option value='2' selected>Grande</option>":
						print "<option value='2' >Grande</option>";	
					
					?>
				</select>
				<br/><br/>
			</div>
			<div class="input-group">
				Sexo:
				<br>
				<select name="sexo" id="sexo" class="form-control" style="width:400px;"/>
					<?php
					$ind_sexo==1?
						print "<option value='1' selected>Macho</option>":
						print "<option value='1' >Macho</option>";
						
					$ind_sexo==2?
						print "<option value='2' selected>F&ecirc;mea</option>":
						print "<option value='2' >F&ecirc;mea</option>";	
					
					?>
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
						$cod_especie==$lin['COD_ESPECIE']?
							$selected	=	'selected':
							$selected	=	'';
						echo "<option value='".$lin[COD_ESPECIE]."' ".$selected.">".$lin[NOM_ESPECIE]."</option>";
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
						$cod_estado==$lin['COD_ESTADO']?
							$selected	=	'selected':
							$selected	=	'';
							
						echo "<option value='".$lin['COD_ESTADO']."' ".$selected.">".$lin['SG_UF']."</option>";
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
					<?php
					$qry_ 		= "select * from tb_cidade WHERE COD_ESTADO='".$cod_estado."' ORDER BY NOM_CIDADE";
					$ls 		= $pdo->query ($qry_);
					
					while ( $lin = $ls->fetch ( PDO::FETCH_ASSOC ) ):
						$cod_cidade==$lin['COD_CIDADE']?
							$selected	=	'selected':
							$selected	=	'';
							
						echo "<option value='".$lin['COD_CIDADE']."' ".$selected.">".$lin['NOM_CIDADE']."</option>";
					endwhile; 
					?>
				</select>
				<br/><br/>
			</div>
						
			
			Foto: 	
			<br><br>
			<?=$htlm_fotos?>
			<?=$titulo_capa?>
			<?=$opcoes_fotos?>
			
			
			<br/><br/>
			
			<br/>
			<table align="center" border="0" >
				<tr>
					<td  ><input type="button" value="Cancelar" onclick="javascript: window.location.href='./';" name="btnCancel" id="btnCancel" style="width:69px; height: 27px;" /></td>
					<input type="hidden" value="<?=$id?>" name="id_dado" id="id_dado" />
					<td  ><input type="submit" value="Salvar" name="btnSalvar" id="btnSalvar" /></td>
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