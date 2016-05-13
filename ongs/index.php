<?php

define('PATH', '../');
define('IMG_ADM_PATH', '../images/');

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
		Gestor de ONGs
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
			<th>Email</th>
			<th>Senha</th>
			<th>CNPJ</th>
			
			
			<th align="center" >Editar</th>
			<th align="center" >Excluir</th>
		</tr>
	</thead>
	<tbody>

		<tr>
			<td valign="middle"></td>
			<td valign="middle"></td>
			<td valign="middle"></td>
			<td valign="middle"></td>
			
			
			
			<td valign="middle" align="center" >
				
				<a class='btn btn-warning' href='editar.php?n=<?=$COD_USUARIO?>' >
					<i class='fa fa-pencil' aria-hidden='true'></i> &nbsp;Editar
				</a>
			</td>
			<td valign="middle" align="center" >
				
				<a class='btn btn-danger btnExcluir' href='#' id='btnExcluir_<?php echo $COD_USUARIO; ?>'>
					<i class='fa fa-trash-o fa-lg' aria-hidden='true'></i> &nbsp;Excluir
				</a>
			</td>
		</tr>

	</tbody>
	<!-- tfoot>
		<tr>
			<th>Nome ONG</th>
			<th>Email</th>
			<th>Perfil</th>
			
			
			<th align="center" >Editar</th>
			<th align="center" >Excluir</th>
		</tr>
	</tfoot-->
</table>



	</div>
	

</body>
</html>