<?php

define('PATH', '../');
define('IMG_ADM_PATH', '../images/');

Error_reporting ( 0 );
require_once PATH.'assets/php/conexao.php';
require_once PATH.'seguranca.php';


$tipo_permissao	=	2;
protectPage ($tipo_permissao);

$pdo = conectar ();


if(@trim($_GET['a'])=='exc' && filter_var(trim(@$_GET['n']),FILTER_VALIDATE_INT)){
	$qry = "delete from tb_foto where COD_ANIMAL = " . trim($_GET['n']) . " ";
	$pdo->query ($qry);
	
	$qry = "delete from tb_animal where COD_ANIMAL = " . trim($_GET['n']) . " LIMIT 1";
	$pdo->query ($qry);
	$_SESSION['mensagem']	=	'dado-removido';
	die('<script>window.location.href="./";</script>');
}

$qry = "select 
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
			
		GROUP BY f.COD_ANIMAL	
		ORDER BY a.DT_CADASTRO DESC";


$lista 	= $pdo->query ($qry);
$num 	= $pdo->query ($qry)->rowCount();
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

<script type="text/javascript" >
$(function(){
	
	$('.btnExcluir').click(function(){excluirItem($(this).attr('id').split('_')[1]);});
});

var excluirItem = function(id_Item){
	var msg = 'Tem certeza de que deseja excluir o registro? ';
	if(confirm(msg)){
		window.location.href='./?a=exc&n='+id_Item;
	}
	return false;
}
//-->
</script>
	
</head>
<body>
	
	
	<h1>
		Gestor de Animais
	</h1>
	<div id="conteudo" style="text-align: justify;" >
	<br/><br/>
	<a class="btn btn-success" href="cadastrar.php?tot=<?=$num?>">
		<i class="fa fa-plus" aria-hidden="true"> </i>&nbsp;Cadastrar
	</a>
	
	<a class="btn btn-default btn-lg" href="<?=PATH?>sair.php" style="float:right;"> 
		<i class="fa fa-sign-out" aria-hidden="true">Sair</i>
	</a>
	
	
<table class="demo-tbl">

	<thead>
		<tr>
			<th>Nome</th>
			<th>Esp&eacute;cie</th>
			<th>Sexo</th>
			<th>Data de Cadastro</th>
			<th>Foto (capa)</th>
			
			<th align="center" >Editar</th>
			<th align="center" >Excluir</th>
		</tr>
	</thead>
	<tbody>
	<?php 
		if ($lista) {
			while ( $row = $lista->fetch ( PDO::FETCH_ASSOC ) ):
			
			
			$cod_animal			= 		$row['COD_ANIMAL'];			
			$cod_usuario		= 		$row['COD_USUARIO'];			
			$nom_animal			= 		$row['NOM_ANIMAL'];		
			$desc_animal		= 		$row['DESC_ANIMAL'];
			$desc_perfil		= 		$row['DESC_PERFIL'];			
			$ind_sexo			= 		$row['IND_SEXO'];			
			$idade				= 		$row['IDADE'];			
			$cor				= 		$row['COR'];			
			$ind_porte			= 		$row['IND_PORTE'];			
			$dt_cadastro		= 		$row['DT_CADASTRO'];			
			$dt_adocao			= 		$row['DT_ADOCAO'];			
			$cod_especie		= 		$row['COD_ESPECIE'];	
					
			$cod_estado			= 		$row['COD_ESTADO'];			
			$cod_cidade			= 		$row['COD_CIDADE'];	
			$nom_estado			= 		$row['NOM_ESTADO'];			
			$nom_cidade			= 		$row['NOM_CIDADE'];	
			
			$nom_especie		= 		$row['NOM_ESPECIE'];
			$nom_usuario		= 		$row['NOM_USUARIO']!=''?$row['NOM_USUARIO']:'-';
			
			
			$ind_sexo=='1'?
				$sexo	=	'MACHO':
				$sexo	=	'F&Ecirc;MEA';
				
			@list($data,$hora) = @explode(' ',$dt_cadastro);
			$dt_cadastro = @implode('/',array_reverse(explode('-',$data)));
			
			@list($data,$hora) = @explode(' ',$dt_adocao);
			$dt_adocao = @implode('/',array_reverse(explode('-',$data)));
			
	?>
		<tr>
			<td valign="middle"><?php echo $nom_animal;  ?></td>
			<td valign="middle"><?php echo $nom_especie;  ?></td>
			<td valign="middle"><?php echo $sexo;  ?></td>
			<td valign="middle"><?php echo $dt_cadastro;  ?></td>
			<td valign="middle"><?php echo $dt_cadastro;  ?></td>
			
			
			<td valign="middle" align="center" >
				
				<a class='btn btn-warning' href='editar.php?n=<?=$cod_animal?>' >
					<i class='fa fa-pencil' aria-hidden='true'></i> &nbsp;Editar
				</a>
			</td>
			<td valign="middle" align="center" >
				
				<a class='btn btn-danger btnExcluir' href='#' id='btnExcluir_<?php echo $cod_animal; ?>'>
					<i class='fa fa-trash-o fa-lg' aria-hidden='true'></i> &nbsp;Excluir
				</a>
			</td>
		</tr>
	<?php 
		endwhile; 
	}
	?>
	</tbody>
	<tfoot>
		<tr>
			<th>Nome</th>
			<th>Esp&eacute;cie</th>
			<th>Sexo</th>
			<th>Data de Cadastro</th>
			<th>Foto (capa)</th>
			
			<th align="center" >Editar</th>
			<th align="center" >Excluir</th>
		</tr>
	</tfoot>
</table>



	</div>
	

</body>
</html>