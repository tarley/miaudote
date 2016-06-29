<?php
	//include("../assets/php/conexao.php");

	
	error_reporting(E_ALL);
	
	$acao        = (isset($_GET['acao']))? $_GET['acao'] : 'acao_indefinida';
	$id   		 = (isset($_GET['id']))? $_GET['id'] : 'id_indefinido';
	$cod_usuario = (isset($_GET['usuario']))? $_GET['usuario'] : 'usuario_indefinido';
	
	if(($acao =="aprovar") or($acao=="reprovar")){	

		$pdo = conectar();
		try{
			if($acao =="aprovar"){				
				$dt_cadastro = $date = date("Y-m-d");
				
				$statement   = $pdo->prepare( 'update tb_animal set dt_cadastro  = :dtcadastro where cod_animal = :id and cod_usuario = :usuario');
				
			}else if($acao =="reprovar"){
				$statement = $pdo->prepare('delete from tb_animal where  cod_animal = :id and cod_usuario = :usuario');
			}

			switch ($acao) {
				case "aprovar":
					$statement->bindParam(':dtcadastro',$dt_cadastro);
					$statement->bindParam(':id',$id);
					$statement->bindParam(':usuario',$cod_usuario);	
					break;
					
				case "reprovar":
					$statement->bindParam(':id',$id);
					$statement->bindParam(':usuario',$cod_usuario);
					break;
			}
			if($statement->execute()){			
					echo ($acao=="reprovar")?"reprovacao_ok":"aprovacao_ok";
				}else{
					echo ($acao=="reprovar")?"reprovacao_n_ok":"aprovacao_n_ok";
				}
			}catch(PDOException $e){
				echo 'Error: '. $e->getMessage();
			}
				
	}

	
	function lista_perfil($argumento,$id_ong,$id_animal,$tipo_consulta){ // Esta funcão retorna retorna os animaos cadsatrados no sistema. Podendo ser por usuario ou por id do animal e por usuario.
	
		if($argumento == 'listar'){
			
			$pdo = conectar();
			
		
			
			switch ($tipo_consulta) {
				
				case "aprovacao":
					$qry = "select 
					        'aprovacao' as acao,
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
							ifnull(a.dt_adocao,'n_adotado') as dt_adocao,
							a.ind_sexo,
							u.email,
							u.telefone,
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
					where    a.dt_cadastro is null
					GROUP BY a.cod_animal";
				break;
				
				
				case 	"adocao":
						$qry = "select 
								'adocao' as acao,
								a.cod_usuario,
								u.nom_usuario,
								u.email,
								u.telefone,
								a.cod_animal,
								a.nom_animal,
								a.desc_animal,
								e.cod_especie,
								e.nom_especie,
								ifnull(a.dt_adocao,'n_adotado') as dt_adocao,
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
					and   a.dt_cadastro is not null
					GROUP BY a.cod_animal";
				
				break;
				
				case "perfil":
							$qry = "select
									'perfil' as acao,							    
									a.cod_usuario,
									u.nom_usuario,
									a.cod_animal,
									a.nom_animal,
									a.desc_animal,
									ifnull(a.dt_adocao,'n_adotado') as dt_adocao,
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
									u.email,
									u,telefone,
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
					and   a.cod_animal  =?
					GROUP BY a.cod_animal";				
				
				default:				
						$qry = "select
								'default' as acao,
								a.cod_usuario,
								u.nom_usuario,
								u.email,
								u.telefone,
								a.cod_animal,
								a.nom_animal,
								ifnull(a.dt_adocao,'n_adotado') as dt_adocao,
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
						where a.animal =?
						GROUP BY a.cod_animal";
			}
			
			switch ($tipo_consulta){
				case "aprovar":
					$resultado = $pdo->prepare($qry);
					$resultado->execute();
				
				break;
				
				case "adocao":
					$resultado = $pdo->prepare($qry);
					$resultado->execute(array($id_ong));
				break;
				
				case "perfil":
					$resultado = $pdo->prepare($qry);
					$resultado->execute(array($id_ong,$cod_animal));
				break;
				default:
					$resultado = $pdo->prepare($qry);
					$resultado->execute(array($id_ong));
				
			}
			
			$resultado = $pdo->prepare($qry);
			$resultado->execute(array($id_ong));
						
						
				if ($resultado) {	
					while ($row = $resultado->fetch ( PDO::FETCH_ASSOC )):
					
					$acao               =       $row['acao'];
					$cod_animal			= 		$row['cod_animal'];			
					$cod_usuario		= 		$row['cod_usuario'];
					$nom_usuario		=       $row['nom_usuario'];			
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
					$email				=       $row['email'];	
					$telefone           =       $row['telefone'];
					$dt_adocao			=       $row['dt_adocao'];			
					$nom_especie		= 		$row['nom_especie'];

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
									<div class='tab-content' style ="min-height:600px">
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
										<div id='content' >
											<ul id='tabs' class='nav nav-tabs' data-tabs='tabs'>							
												<li class='active'><a href='#caracteristicas<?php echo $cod_animal?>' data-toggle='tab'>Características</a></li>
												<li><a href='#contato<?php echo $cod_animal?>' data-toggle='tab'>Contato</a></li>
											</ul>
											<div id='my-tab-content' class='tab-content'style ='min-height:240px;'>
											
												<div class='tab-pane active' id='caracteristicas<?php echo $cod_animal?>'>
													<ul id="dados-animal">
													<li><b>Nome:</b>&nbsp;<?php echo $nom_animal?></li>

													<li><b>Sobre mim:&nbsp;</b> <p><?php echo $desc_perfil?></p></li>
													<li><b>Idade:</b>&nbsp;<?php  echo $idade." anos(s)"?></li>
											
													<li><b>Sexo:</b>&nbsp;<?php echo $ind_sexo?></li>
					
													<li><b>Porte:</b>&nbsp;<?php echo $ind_porte?> </li>
	
													<li>*Todos os animais do Miaudote são castrados.  </li>
													</ul>	
												</div>
												<div class='tab-pane' id='contato<?php echo $cod_animal?>'>
													<ul id="dados-animal">
														<li>Telefone:&nbsp;<?php echo $telefone ?></li>
														<li>E-mail : &nbsp;<?php echo $email ?>  </li>
													</ul>		
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class='panel-body' id='panel-foot-body'>
								<?php
								if($acao =="adocao"){
										if($dt_adocao =="n_adotado"){
	
											echo"<div class='col-md-5'>
												<a href='#' id='confirmarAdocao' data-animal ='".$cod_animal."' data-usuario ='".$cod_usuario."'>
													<span  class='btn btn-success'>Confirmar Adoção</span>
												</a>
											</div>";
								
										}else{
											echo
											"<div class='col-md-5'>
												<a href='#' id='cancelarAdocao' data-animal ='".$cod_animal."' data-usuario ='".$cod_usuario."'>
													<span  class='btn btn-danger'>Cancelar Adoção</span>
												</a>
											</div>";
										}

								
								}else if($acao =="aprovacao"){
									echo"<div class='panel-body' id='panel-foot-body'>
										<div class='row'>
											<div class='col-md-5'>
												<a href='#'  id='reprovarAnimal'data-animal =".$cod_animal." data-usuario=".$cod_usuario.">
												  <span type='button' class='btn btn-danger'>Reprovar</span>
												</a>
											</div>
											<div class='col-md-3'>
												<a href='#' id='aprovarAnimal' data-animal =".$cod_animal." data-usuario=".$cod_usuario.">
													<span  class='btn btn-success'>Aprovar</span>
												</a>
											</div>
										</div>
									</div>";
									
								}else{
									
								}		
								?>	
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