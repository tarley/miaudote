<?php
	error_reporting(E_ALL);

	require_once('../assets/php/conexao.php');

	$pdo = conectar ();

	include("upload.php");
	

if(@trim($_GET['a'])=='exc' && filter_var(@trim($_GET['n']),FILTER_VALIDATE_INT)){
	
	$pdo = conectar ();


	$id_animal	  =	(int)$_GET['n'];
	$id_del		  =	(int)$_GET['id_'];
	$arquivo_foto = $_GET['foto'];
	
	$qry = "delete from tb_foto where COD_FOTO=".$id_del." AND COD_ANIMAL=".$id_animal." LIMIT 1";
	//die($qry);
	if($pdo->query ($qry)){
		unlink($arquivo_foto);	
		echo $arquivo_foto."_arquivo deletado com sucesso";

	};
	$_SESSION['mensagem']	=	'dado-removido';
	die('<script>window.location.href="index.php?page=editar&n='.trim($_GET['n']).'";</script>');
}

if($_POST){
	
	// Altera os dados
	$id				    = (int)trim($_GET['animal']);;//(int)trim($_GET['n']);
	$nome	 			= utf8_decode($_POST['nome']);
	$descricao			= utf8_decode($_POST['descricao']);
	$perfil				= utf8_decode($_POST['perfil']);
	$sexo				= $_POST['sexo'];
	$especie			= $_POST['especie'];
	$porte	 			= $_POST['porte'];
	$cor	 			= $_POST['cor'];
	$idade	 			= $_POST['idade'];
	$cidade	 			= $_POST['cidade'];
	
	echo 	$id	,$nome ,$descricao,$perfil	,$sexo ,$especie ,$porte ,$cor,$idade,$cidade;
	
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
	// Prepara a inclus�o das fotos
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
	
	die('<script>window.location.href="index.php?page=animal";</script>');

}
	// Busca dados do animal
	$id	 	 = (int)trim($_GET['animal']);
	$usuario = (int)trim($_GET['usuario']);
	$qry 	= "select 
					A.*,
					E.NOM_ESPECIE,
					US.NOM_USUARIO,
					F.URL,
					F.ID_FOTO_PRI,
					CI.COD_CIDADE,
					CI.NOM_CIDADE,
					ES.COD_ESTADO,
					ES.NOM_ESTADO
					
				FROM TB_ANIMAL AS A
					INNER JOIN TB_ESPECIE AS E
					ON E.COD_ESPECIE = A.COD_ESPECIE
					
					INNER JOIN TB_USUARIO AS US
					ON US.COD_USUARIO = A.COD_USUARIO
					
					LEFT JOIN TB_FOTO AS F
					ON F.COD_ANIMAL = A.COD_ANIMAL
					
					INNER JOIN TB_CIDADE AS CI
					ON CI.COD_CIDADE = A.COD_CIDADE
					
					INNER JOIN TB_ESTADO AS ES
					ON ES.COD_ESTADO = CI.COD_ESTADO
					
				 where a.cod_animal = " .$id. " and a.cod_usuario = ".$usuario."";
	
	$lista 	= $pdo->query ($qry);
	$num 	= $pdo->query ($qry)->rowCount();
	
	if(!$num){
		//die('<script>window.location.href="editar.php?n='.trim($_GET['n']).'";</script>');
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
		$porte			    = 		$row['IND_PORTE'];			
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
								<br><span style="color:red;">(A primeira foto selecionada ser� a foto de capa)</span>
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
				$htlm_fotos	.= '<a href="#" class="btnExcluir_foto" id="excluirFoto" data-usuario="'.$cod_usuario.'" data-foto="'.$id_foto.'" data-animal="'.$cod_animal.'" data-value="'.$arquivo.'" ><img src="../images/del.gif"></a><br>       <br>';
				$htlm_fotos	.= '<img src="'.$arquivo.'"	style="max-width:200px;max-height:150px;margin:15px 0;">';
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

?>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="script/bootstrap.min.js"></script>
<script src="assets/js/animal.js"></script>
<script src="assets/js/bootbox.min.js"></script>
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

			bootbox.dialog({
			  message: msg,
			  title: "<span class='glyphicon glyphicon-remove-sign erro'></span>",
			  buttons: {
				main: {
				  label: "OK",
				  className: "btn-primary",
				  callback: function() {
					close();
				  }
				}
			  }
			});

			return false;
		}else{
			return true;
		}
	});
/*	
	$('.btnExcluir_foto').click(function(){
		excluirItem($(this).attr('id').split('_')[1],$(this).data("value"));
	}).css('cursor','pointer');*/
});
/*
var excluirItem = function(id_Item,foto){
	var msg = 'Tem certeza de que deseja excluir o registro? ';
	if(confirm(msg)){
		var vlw =	$('#id_dado').val();
		window.location.href='index.php?page=editar&id='+id_Item+'&foto='+foto+'&a=exc';
	}
	return false;
}*/
//-->       
</script>
</head>
<body>
	<div id="conteudo" style="text-align: justify;" >
	<br/><br/>
	<a href='index.php?page=animal' id='aprovarAnimal'><span  class="btn btn-success">Voltar</span></a>
	
	<div style="clear:both;height:30px;"></div>
	
	<center>
		<form method="post" action="index.php?page=editar&usuario=<?php echo $cod_usuario?>&animal=<?php echo $cod_animal?>" name="form" id="form"  enctype="multipart/form-data" >
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
						echo "<option value='".$lin['COD_CIDADE']."' ".$selected.">".utf8_encode($lin['NOM_CIDADE'])."</option>";
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
					<td  ><input type="button" value="Cancelar" onclick="javascript: window.location.href='index.php?';" name="btnCancel" id="btnCancel" style="width:69px; height: 27px;" /></td>
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