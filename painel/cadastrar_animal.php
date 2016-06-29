<?php
error_reporting(E_ALL);
$pdo = conectar ();
include("upload.php");



if(@$_POST){
	
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
	die('<script>window.location.href="index.php?page=animal";</script>');
	
}

?>
<script src="assets/js/jquery-1.11.js"></script>
<script src="script/bootstrap.min.js"></script>
<script src="assets/js/script.js"></script>
<script src="assets/js/bootbox.min.js"></script>
	
<!-- os cruds :P -->
<script src="assets/js/animal.js"></script>

<script>

$(function(){	
	
	$('#form').submit(function(){
		
		var msg =	'<b style="color:red">Erros encotrados :</b> \n\n';
		var err =	0;
		 
		if($('#nome').val()==''){
			msg	+=	'- informe um nome valida! \n';
			err	=	1;	
		}	
		
		if($('#descricao').val()==''){
			msg	+=	'- informe uma descriçãoo válida! \n';
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
		
		if ($('#estado').val().trim() === '') {
			msg	+=	'- informe o estado! \n';
			err	=	1;	
		}
		
		if($('#cidade').val()== 0){
			msg	+=	'- informe a cidade! \n';
			err	=	1;	
		}
		
		if($('#perfil').val()=='' ){
			msg	+=	'- Informe o perfil do animal! \n';
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
		}
		
	});
		
	
	$('.btnExcluir_foto').click(function(){
		excluirItem($(this).attr('id').split('_')[1],$(this).data("value"));
	}).css('cursor','pointer');
});


</script>

</head>
	<div id="conteudo" style="text-align: justify;" >
	<div style='margin-top:30px;margin-bottom:30px'>
		<a href='index.php?page=animal' ><span  class="btn btn-success">Voltar </span></a>
	</div>
	<hr>
	<center>
	<form method="post" action="#" name="form" id="form"  class='form-horizontal' enctype="multipart/form-data" >
			
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
								<select class='form-control' id="especie"name='especie'>
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
							<div class='col-md-9 col-xs-12'><input type='text' id="descricao" placeholder='defina seu animal em  no maximo 4 palavras' class='form-control'name='descricao'/></div>
						</div>
					</div>
				</div>
				
				<div class='form-group'><label class='col-sm-3 control-label'>cor</label>
					<div class='col-sm-9 controls'>
						<div class='row'>
							<div class='col-md-9 col-xs-12'><input type='text' placeholder='digite a cor do animal' class='form-control' id="cor" name='cor'/></div>
						</div>
					</div>
				</div>
				<div class='form-group'><label class='col-sm-3 control-label'>Idade</label>

					<div class='col-sm-9 controls'>
						<div class='row'>
							<div class='col-md-9 col-xs-12'><input type='number' placeholder='' class='form-control' id="cor" name='idade'/></div>
						</div>
					</div>	
				</div>
				
				<div class='form-group'><label class='col-sm-3 control-label'>Porte</label>

					<div class='col-sm-9 controls'>
						<div class='row'>
							<div class='col-md-5 col-xs-12'>
								<select class='form-control' id="porte" name='porte'>
									<option selected value= '' >Selecione ...   </option>
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
								<select class='form-control' id="sexo" name='sexo'>
									<option selected value='' >Selecione ...</option>
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
									<option selected value =''>Selecione ...</option>
									
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
				
				<div class='form-group'><label class='col-sm-3 control-label'>Cidade</label>

					<div class='col-sm-9 controls'>
						<div class='row'>
							<div class='col-md-5 col-xs-12'>
								<select class='form-control' id="cidade" name='cidade'>
									<option selected value='' >Selecione ...</option>
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
				

			<div class="input-group">			
				<h1 style="font-size:15pt;">Foto: Tamanho mínimo recomendado 800x600 e formato JPG
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
			<div id="botaoConfirmar" style="margin-top:40px;margin-bottom:40px">
				<button class="btn btn-green btn-block" type="submit">Cadastrar animal</button>
			</div>

	</form>
	</center>

<?php
msgAlert();
?>