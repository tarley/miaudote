<?php
	//error_reporting(E_ALL);
	if(!isset($pdo)){
		require_once 'assets/php/conexao.php';
		$pdo = conectar();
		
	}
	
	$identificador = $_GET['id'];
	try{	
		$sql = "select 	a.cod_animal,
				concat(Upper(substr(a.nom_animal, 1,1)), lower(substr(a.nom_animal, 2,length(a.nom_animal)))) as nom_animal,
				a.desc_perfil,
				a.idade,
				f.cod_foto,
				f.nom_foto,
				f.url,
				u.telefone,
				u.email,
				
				case 
				  when ind_porte = 0 then 'Pequeno'
				  when ind_porte = 1 then 'Médio'
				  when ind_porte = 2 then 'Grande'
				  when ind_porte = 4 then 'gigante'
				  else 'indefinido'


				end as ind_porte,
				case 
				  when ind_sexo  = 1 then 'Fêmea'
				  when ind_sexo  = 2 then 'Macho'
				  else 'indefinido'

				end as ind_sexo							
		from 	tb_animal a, tb_foto f,tb_usuario u
		where 	a.cod_animal = ?
		and     a.cod_usuario = u.cod_usuario
		and     a.cod_animal = f.cod_animal and
				f.id_foto_pri = 's'";

		$resultado = $pdo->prepare($sql);
		$resultado->execute(array($identificador));
	}
    catch(PDOException $e) {
        // imprimimos a nossa excecao
        echo $e->getMessage();
    }
	
?>


<div id='perfil-pet'>
	<div class='panel panel-default'>
		<div class='panel-body'>
			<?php
				if($resultado){
					while($row = $resultado->fetch()) {
						?><div class=' lifted' style='position:relative;margin:0 auto;width:800px;min-height:500px;border:0px solid';>
							
								<div class="row">
									<div class='col-md-12' style=''>
										<div style='height:350px;background-color:'>
									
											<section id='sliderhome'>
												<div id='meuSlider' class='carousel slide' data-ride='carousel'>
													<?php
														$ls = $pdo->prepare("select url,id_foto_pri from tb_foto where cod_animal ='".$row['cod_animal']."' order by id_foto_pri");
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
															  echo "<li data-target='#meuSlider' data-slide-to='".$numBolinha."' $active></li>";
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
															
															echo "<div class='item $active'><img src='".substr($lin['url'],3)."'  alt='Slider ".$row['cod_animal']."' /></div>";											

															endwhile; 
														?>	
													</div>

													<a class='left carousel-control ignoreScroll' href='#meuSlider' data-slide='prev'>
													<span class='glyphicon glyphicon-chevron-left'></span></a>
													<a class='right carousel-control ignoreScroll' href='#meuSlider' data-slide='next'>
													<span class='glyphicon glyphicon-chevron-right'></span></a>
												</div>
											</section>
												
										</div>
									</div>
								</div>
							</div>
														<br>
							<br>
							<hr>
							<div id='content'>
								<ul id='tabs' class='nav nav-tabs' data-tabs='tabs'>							
									<li class='active'><a href='#caracteristicas' data-toggle='tab'>Características</a></li>
									<li><a href='#contato' data-toggle='tab'>Contato</a></li>
								</ul>
								<div id='my-tab-content' class='tab-content' style ='min-height:180px;'>
									<br><br>
									
									<div class='tab-pane active' id='caracteristicas'>
										<ul>
										<li><b>Nome:</b> <?php echo$row['nom_animal']?> </li>
										<br>
										<li><b>Sobre mim:</b> <p><?php echo utf8_encode($row['desc_perfil'])?></p></li>
										<li><b>Idade:</b><?php echo $row['idade']." ano(s)"?> </li>
										<br>
										<li><b>Sexo:</b> <?php echo $row['ind_sexo'] ?> </li>
										<br>
										<li><b>Porte:</b><?php echo $row['ind_porte']?>  </li>
										<br><br>
										<li>*Todos os animais do Miaudote são castrados.  </li>
										</ul>	
									</div>
									<div class='tab-pane' id='contato'>
										<ul>
											<li>Telefone:<?php echo$row['telefone']?></li>
											<li>E-mail :<?php echo $row['email']?>  </li>
										</ul>		
									</div>
								</div>
							</div><?php
					}
					// Desconecta
				$pdo = null;
				}else{
					echo'Dados não encontrados';
				}
		?>
		</div>
	</div>
</div>




