<?php
	error_reporting(0);
	include("/../../../assets/php/conexao.php");
	
	$acao        = (isset($_GET['acao']))? $_GET['acao'] : 'acao_indefinida';
	$id   		 = (isset($_GET['id']))? $_GET['id'] : 'id_indefinido';
	$cod_usuario = (isset($_GET['usuario']))? $_GET['usuario'] : 'usuario_indefinido';
	
	//echo $id ."--".$cod_usuario;
	
	if(($acao =="cadastrar") or($acao=="editar") or($acao =="deletar")){	

		
		$pdo = conectar();
		
		if($acao <> "deletar"){
		
			$nome	 			= filter_var(utf8_decode($_POST['nome']));
			$especie			= filter_var($_POST['especie']);
			$descricao	 		= filter_var($_POST['descricao']);
			$idade	 			= filter_var($_POST['idade']);
			$porte	 			= filter_var($_POST['porte']);
			$cor	 			= filter_var($_POST['cor']);
			$sexo             	= filter_var($_POST['sexo']);
			//$estado             = filter_var($_POST['estado']);
			$cidade             = filter_var($_POST['cidade']);
			$perfil             = filter_var($_POST['perfil']);
			$dt_cadastro        = $date = date("Y-m-d");
			
			//echo $id."-".$cod_usuario."-".$nome."-".$especie."-".$descricao."-".$idade."-".$porte."-".$cor."-".$sexo."-".$cidade."-".$perfil;
			
		}
		
		
		try{
			
			if($acao =="cadastrar"){
				$statement = $pdo->prepare('insert into tb_animal (cod_usuario,nom_animal,desc_animal, cod_especie, cor,  desc_perfil, idade, ind_porte,ind_sexo, cod_cidade, dt_cadastro) values 
																  (:usuario,   :nome,     :descricao,  :especie,    :cor, :perfil,  :idade,:porte,       :sexo,    :cidade ,  :dt_cadastro)');
			}else if($acao =="editar"){
				$statement = $pdo->prepare( 'update tb_animal set 				
											 nom_animal     = :nome,
											 desc_animal    = :descricao,
											 cod_especie    = :especie,
											 cor            = :cor,
											 desc_perfil    = :perfil,
											 idade          = :idade,
											 ind_porte      = :porte,
											 ind_sexo       = :sexo,
											 cod_cidade     = :cidade
											 where cod_animal =:id and
												   cod_usuario =:usuario');
			}else{
				$statement = $pdo->prepare('delete from tb_animal where  cod_animal = :id and cod_usuario = :usuario');
			
			}
			
			switch ($acao) {
				case "cadastrar":
					
					$statement->bindParam(':usuario',$cod_usuario);	
					$statement->bindParam(':nome',  $nome);
					$statement->bindParam(':especie', $especie);
					$statement->bindParam(':descricao', $descricao);
					$statement->bindParam(':idade', $idade);
					$statement->bindParam(':porte', $porte);
					$statement->bindParam(':cor', $cor);
					$statement->bindParam(':sexo', $sexo);
					$statement->bindParam(':cidade', $cidade);
					$statement->bindParam(':perfil', $perfil);
					$statement->bindParam(':dt_cadastro', $dt_cadastro);
					break;
					
				case "editar":
					$statement->bindParam(':id',$id);
					$statement->bindParam(':usuario',$cod_usuario);
					
					$statement->bindParam(':nome',  $nome);
					$statement->bindParam(':especie', $especie);
					$statement->bindParam(':descricao', $descricao);
					$statement->bindParam(':idade', $idade);
					$statement->bindParam(':porte', $porte);
					$statement->bindParam(':cor', $cor);
					$statement->bindParam(':sexo', $sexo);
					$statement->bindParam(':cidade', $cidade);
					$statement->bindParam(':perfil', $perfil);	
					
					break;
					
				case "deletar":
					sleep(1);
					$statement->bindParam(':id',$id);
					$statement->bindParam(':usuario',$cod_usuario);
	
					
					break;
			}

			if($statement->execute()){			
				echo ($acao=="deletar")?"del_ok":"ok";
			}else{
				echo ($acao=="deletar")?"del_nr":"nr";
			}

		}catch(PDOException $e) {
			echo 'Error: '. $e->getMessage();
		}
				
	}

	
	function animal($argumento,$id_ong,$id_animal){ // Esta funcão retorna retorna os animaos cadsatrados no sistema. Podendo ser por usuario ou por id do animal e por usuario.
	
		if($argumento == 'listar'){
			
			$pdo = conectar();
			
			$qry = "select 	a.cod_usuario,
					a.cod_animal,
					a.nom_animal,
					a.desc_animal,
					e.cod_especie,
					e.nom_especie,
					a.cor,
					a.desc_perfil,
					a.idade,
					c.cod_cidade,
					c.nom_cidade,
					uf.sg_uf,
					uf.cod_estado,
					ind_sexo,
					case
						when a.ind_sexo = 1 then 'Fêmea'
						when a.ind_sexo = 2 then 'Macho'
					end as desc_sexo ,
							
					ind_porte,
					case
						when a.ind_porte = 0 then 'Pequeno'
						when a.ind_porte = 1 then 'Medio'
						when a.ind_porte = 2 then 'Grande'
						else 'indefinido'
					end as desc_porte
					
	
			from tb_animal a inner join tb_especie e  on(a.cod_especie = e.cod_especie)
							 inner join tb_cidade  c  on(a.cod_cidade  = c.cod_cidade)
							 inner join tb_estado  uf on (c.cod_estado = uf.cod_estado)
			where a.cod_usuario =?
			GROUP BY a.cod_animal";
						
			$resultado = $pdo->prepare($qry);
			$resultado->execute(array($id_ong));
						
						
				if ($resultado) {	
					while ($row = $resultado->fetch ( PDO::FETCH_ASSOC )):
					
					
					$cod_animal			= 		$row['cod_animal'];			
					$cod_usuario		= 		$row['cod_usuario'];			
					$nom_animal			= 		$row['nom_animal'];		
					$desc_animal		= 		$row['desc_animal'];
					$desc_perfil		= 		$row['desc_perfil'];			
					$ind_sexo			= 		$row['ind_sexo'];		
					$desc_sexo			= 		$row['desc_sexo'];					
					$idade				= 		$row['idade'];			
					$cor				= 		$row['cor'];			
					$ind_porte			= 		$row['ind_porte'];	
					$desc_porte			= 		$row['desc_porte'];					
					//$dt_cadastro		= 		$row['dt_cadastro'];			
					//$dt_adocao		=       $row['dt_adocao'];			
					$cod_especie		= 		$row['cod_especie'];								
					$cod_estado			= 		$row['cod_estado'];			
					$cod_cidade		    = 		$row['cod_cidade'];			
					$nom_cidade			= 		$row['nom_cidade'];	
					$sg_uf			    = 		$row['sg_uf'];	
					
					$nom_especie		= 		$row['nom_especie'];
					//$foto				= 		$row['url'];
					//$nom_usuario		= 		$row['nom_usuario']!=''?$row['nom_usuario']:'-';

					 ?>
					 
					<div class='panel-group'>
						<div class='panel panel-default'>
							<div class='panel-heading'>
							  <h4 class='panel-title'>
								<a data-toggle='collapse' href='#collapse<?php echo $cod_animal?>'><?php echo ucwords(strtolower($nom_animal)) ?></a>
							  </h4>
							</div>
							<div id='collapse<?php echo $cod_animal ?>' class='panel-collapse collapse'>
								<div class='panel-body'>
									<ul class='nav nav-tabs' id='myTab'>
									  <li class='active'><a  href='#' data-target='#dados<?php echo $cod_animal ?>' id='tab-user' data-toggle='tab'>Dados Perfil</a></li>
									  <li>				<a 	 href='#' data-target='#editar-animal<?php echo $cod_animal ?>' id='tab-user' data-toggle='tab'>Editar Perfil</a></li>
									  <li>				<a 	 href='#' data-target='#fotos-animal<?php echo $cod_animal ?>' id='tab-user' data-toggle='tab'>Fotos</a></li>
									</ul>
									<div class='tab-content'>
										<div class='tab-pane active' id='dados<?php echo $cod_animal?>'>
											<div class='row'>
												<div class='col-md-9' style=''>
													<div class='container-fluid' id='conteudo_ong'>
														<div class='row'>
															<div class='col-md-12'>
																<div id='dados<?php echo $cod_animal ?>' class='tab-pane fade in active'>
																	<div class='form-group '>

																	</div>

																	<table id='dados<?php echo $cod_animal ?>' class='table table-striped table-hover'>
																		<tbody >
																		<tr >
																			<td>Nome</td>
																			<td><?php echo ucwords(strtolower($nom_animal))?></td>
																		</tr>
																		<tr>
																			<td>Especie</td>
																			<td><?php echo ucfirst(strtolower($nom_especie))?></td>
																		</tr>
																		<tr>
																			<td>Apresentação</td>
																			<td><?php echo ucfirst(strtolower(utf8_encode($desc_animal)))?></td>
																		</tr>
																		<tr>
																			<td>Cor</td>
																			<td><?php echo ucfirst(strtolower($cor))?></td>
																		</tr>
																		<tr>
																			<td>Idade</td>
																			<td><?php echo $idade ?></td>
																		</tr>
																		<tr>
																			<td>Porte</td>
																			<td><?php echo $desc_porte ?></td>
																		</tr>
																		<tr>
																			<td>Sexo</td>
																			<td><?php echo $desc_sexo?></td>
																		</tr>
																		<tr>
																			<td>Localização</td>
																			<td><?php echo ucwords(utf8_encode($nom_cidade))." - ".$sg_uf ?></td>
																		</tr>
																		<tr>
																			<td>Perfil</td>
																			<td><span class='label label-success'><?php echo utf8_encode(ucFirst($desc_perfil))?></span></td>
																		</tr>
																		
																		</tbody>
																	</table>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div> 
									  
										<div class='tab-pane' id='editar-animal<?php echo $cod_animal ?>'>
										
											<form action='#' id='edita-animal<?php echo $cod_animal ?>' class='form-horizontal'>
											
						
												<h4>Informações do animal</h4>
											
												<div class='form-group'><label class='col-sm-3 control-label'>Nome</label>
													<div class='col-sm-9 controls'>
														<div class='row'>
															<div class='col-md-9 col-xs-12'><input type='text' placeholder='digite o nome' class='form-control' name='nome' value="<?php echo ucwords(strtolower($nom_animal))?>"/></div>
														</div>
													</div>
												</div>

												<div class='form-group'><label class='col-sm-3 control-label'>Espécie</label>

													<div class='col-sm-9 controls'>
														<div class='row'>
															<div class='col-md-5 col-xs-12'>
																<select class='form-control' name='especie'>
																										
																	<option selected >Selecione ...</option>";
																		<?php
																		$qry_ 		= "select cod_especie,nom_especie from tb_especie order by cod_especie asc";
																		$ls 		= $pdo->query ($qry_);
																		
																		while ( $lin = $ls->fetch ( PDO::FETCH_ASSOC ) ):
																			$cod_especie==$lin['cod_especie']? $selected = 'selected': $selected ='';	
																			echo "<option value='".$lin['cod_especie']."' ".$selected.">".ucwords(strtolower($lin['nom_especie']))."</option>";
																		endwhile; 
																		?>
																</select>
															</div>
														</div>
													</div>
												</div>
												<div class='form-group'><label class='col-sm-3 control-label'>Frase de apresentação</label>

													<div class='col-sm-9 controls'>
														<div class='row'>
															<div class='col-md-9 col-xs-12'><input type='text' placeholder='defina seu animal em  no maximo 4 palavras' class='form-control'name='descricao'value ="<?php echo ucfirst($desc_animal) ?>"/></div>
														</div>
													</div>
												</div>
												
												<div class='form-group'><label class='col-sm-3 control-label'>Cor</label>
													<div class='col-sm-9 controls'>
														<div class='row'>
															<div class='col-md-9 col-xs-12'><input type='text' placeholder='digite a cor do animal' class='form-control' name='cor'value ="<?php echo ucfirst($cor) ?>"/></div>
														</div>
													</div>
												</div>
												<div class='form-group'><label class='col-sm-3 control-label'>Idade</label>

													<div class='col-sm-9 controls'>
														<div class='row'>
															<div class='col-md-9 col-xs-12'><input type='number' placeholder='' class='form-control'name='idade'value="<?php echo $idade ?>"/></div>
														</div>
													</div>	
												</div>
												
												<div class='form-group'><label class='col-sm-3 control-label'>Porte</label>

													<div class='col-sm-9 controls'>
														<div class='row'>
															<div class='col-md-5 col-xs-12'>
																<select class='form-control' name='porte'>
																
																
																	<option selected >Selecione ...   </option>
																	<option value ='1'<?php echo ($ind_porte == "0")? 'selected' :'';  ?>> Pequeno  </option>
																	<option value ='2'<?php echo ($ind_porte == "1")? 'selected' :'';  ?>> Médio  </option>
																	<option value ='3'<?php echo ($ind_porte == "2")? 'selected' :'';  ?> >Grande  </option>
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
																	
																	<option value='1' <?php echo ($ind_sexo == "1")? 'selected' :'';  ?>>Fêmea     </option>
																	<option value='2' <?php echo ($ind_sexo == "2")? 'selected':''; ?>>Macho     </option>
																</select>
															</div>
														</div>
													</div>
												</div>
												
												
												<div class='form-group'><label class='col-sm-3 control-label'>Estado</label>

													<div class='col-sm-9 controls'>
														<div class='row'>
															<div class='col-md-5 col-xs-12'>
																<select class='form-control' id='estado' name='estado'>
																	<option selected >Selecione ...</option>";
																		<?php
																		$qry_ 		= "select cod_estado,sg_uf from tb_estado order by SG_UF asc";
																		$ls 		= $pdo->query ($qry_);
																		
																		while ( $lin = $ls->fetch ( PDO::FETCH_ASSOC ) ):
																			$cod_estado==$lin['cod_estado']?
																				$selected	=	'selected':
																				$selected	=	'';
																				
																			echo "<option value='".$lin['cod_estado']."' ".$selected.">".$lin['sg_uf']."</option>";
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

															<select name="cidade" id="cidade" class="form-control">
																<option value=""> Informe a cidade</option>
																<?php
																$qry_ 		= "select cod_cidade,nom_cidade from tb_cidade where cod_estado = ".$cod_estado." limit 10000";
																$ls 		= $pdo->query ($qry_);

																while ( $linh = $ls->fetch ( PDO::FETCH_ASSOC ) ):
																	$cod_cidade == $linh['cod_cidade']?$selected = 'selected': $selected = '';
																	echo "<option value='".$linh['cod_cidade']."' ".$selected.">".utf8_encode($linh['nom_cidade'])."</option>";
																endwhile; 
																?>	
																
															</select>

															</div>
														</div>
													</div>
												</div>

												<div class='form-group'><label class='col-sm-3 control-label'>Perfil</label>

													<div class='col-sm-9 controls'>
														<div class='row'>
															<div class='col-md-9 col-xs-12'>
																<textarea type="text"  id="perfil" 	name="perfil" placeholder="Descreva seu animal.Apresentação,caracteristicas ou qualquer informação relevante" 
																class="form-group" style="width:100%;height:100px;"><?php echo utf8_encode(ucFirst($desc_perfil)) ?></textarea>
															</div>
														</div>
													</div>	
													
												</div>
												
												<hr/>
												<span id='editarAnimal' data-value =<?php echo $cod_animal ?> class='btn btn-green btn-block'>Editar Animal</span>
											</form>
										</div>

										<div class='tab-pane' id='fotos-animal<?php echo $cod_animal?>'>
											<div style='height:600px;background-color:'>											
											</div>
										</div>					
									</div>
								</div>
								<div class='panel-body' id='panel-foot-body'>
									<div class='row'>
										<div class='col-md-5'>
										
										</div>
										<div class='col-md-5'>
											<!--<a href='#' data-link=".$row['nom_animal']." class='btn btn-info btn-lg'>
											  <span class='glyphicon glyphicon-edit minhaclasse'></span>
											</a>-->
										</div>
										<div class='col-md-1'>
											<a href='#' id='excluirAnimal' data-animal =<?php echo $cod_animal?> data-usuario =<?php echo $cod_usuario?> class='btn btn-danger btn-lg'>
												<span class='glyphicon glyphicon-trash minhaclasse'></span>
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php 

					endwhile;
				}
	
		}
	}
	
?>
