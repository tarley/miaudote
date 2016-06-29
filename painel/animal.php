<?php
	error_reporting(E_ALL);
	include("server/painel_animal.php");
	//include("server/public_server.php");

?>
	<div style='margin-top:30px;margin-bottom:30px'>
		<a href='index.php?page=cadastrar_animal' id='#'><span  class="btn btn-success">Adicionar</span></a>
	</div>
	<hr>

	<!--#####edição#####-->
	<?php
		
	$id_ong=$_SESSION['usuarioID'];		
	$pdo = conectar();
	
	$qry = "select
			a.cod_usuario,
			u.nom_usuario,
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
					 inner join tb_usuario u  on (a.cod_usuario = u.cod_usuario)
	where a.cod_usuario =?
	GROUP BY a.cod_animal";
				
	$resultado = $pdo->prepare($qry);
	$resultado->execute(array($id_ong));
						
			
	if ($resultado) {	
		while ($row = $resultado->fetch ( PDO::FETCH_ASSOC )):
		
		
		$cod_animal			= 		$row['cod_animal'];			
		$cod_usuario		= 		$row['cod_usuario'];
		$nom_usuario        =       $row['nom_usuario'];
		$nom_animal			= 		$row['nom_animal'];		
		$desc_animal		= 		$row['desc_animal'];
		$desc_perfil		= 		$row['desc_perfil'];			
		$ind_sexo			= 		$row['ind_sexo'];		
		$desc_sexo			= 		$row['desc_sexo'];					
		$idade				= 		$row['idade'];			
		$cor				= 		$row['cor'];			
		$ind_porte			= 		$row['ind_porte'];	
		$desc_porte			= 		$row['desc_porte'];							
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
						  <li>				<a 	 href='#' data-target='#fotos-animal<?php echo $cod_animal ?>' id='tab-user' data-toggle='tab'>Fotos</a></li>
						</ul>
						<div class='tab-content'style ='height:400px'>
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
																<td><?php echo ucwords($nom_cidade)." - ".$sg_uf ?></td>
															</tr>
															<tr>
																<td>Perfil</td>
																<td><span class='label label-success'><?php echo ucFirst($desc_perfil)?></span></td>
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

							<div class='tab-pane' id='fotos-animal<?php echo $cod_animal?>'>
								<div class="row">
									<div class='col-md-8 col-md-offset-2' style=''>
										<div style='height:400px;background-color:'>
											<section id='sliderhome'>
												<div id='meuSlider<?php echo $cod_animal?>' class='carousel slide' data-ride='carousel'>
													<?php
														$ls = $pdo->prepare("select url,id_foto_pri from tb_foto where cod_animal ='".$cod_animal."' order by id_foto_pri");
														$ls->execute();
														$colcount = $ls->rowCount();													
														$numBolinha = 0;
													?>
												
												
													<ol class='carousel-indicators'>
														<?php
															while($numBolinha < $colcount ):
															  if($numBolinha == 0){
																$active = 'class="active"';
															  }else {
																  $active ='';
															  }
															  echo "<li data-target='#meuSlider".$cod_animal."' data-slide-to='".$numBolinha."' $active></li>";
															  $numBolinha++;															
															endwhile;
														?>

													</ol>
													<div class='carousel-inner'>
													
														<?php
															while ( $lin = $ls->fetch ( PDO::FETCH_ASSOC ) ):
															if($lin['id_foto_pri']=='S'){
																$active ='active';
															}else{
																$active ='';
															}
															
															echo "<div class='item $active'><img src='".$lin['url']."'  alt='Slider ".$cod_animal."' /></div>"	;											

															endwhile; 
														?>	
													</div>

													<a class='left carousel-control' href='#meuSlider<?php echo $cod_animal?>' data-slide='prev'>
													<span class='glyphicon glyphicon-chevron-left'></span></a>
													<a class='right carousel-control' href='#meuSlider<?php echo $cod_animal?>' data-slide='next'>
													<span class='glyphicon glyphicon-chevron-right'></span></a>
												</div>
											</section>
										</div>
									</div>
								</div>
							</div>	
						</div>
					</div>
					<div class='panel-body'>
						<div class='row'>
							<div class='col-md-5'>
							
							</div>
							<div class='col-md-5'>
								<a href='index.php?page=editar&usuario=<?php echo $cod_usuario?>&animal=<?php echo $cod_animal ?>' class='btn btn-info btn-lg'>
								  <span class='glyphicon glyphicon-edit minhaclasse'></span>
								</a>
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
	}?>