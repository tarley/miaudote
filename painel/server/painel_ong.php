<?php
	error_reporting(E_ALL);
	
	$acao = (isset($_GET['acao']))? $_GET['acao'] : 'acao_indefinida';
	$id   = (isset($_GET['id']))? $_GET['id'] : 'id_indefinido';
	
	if(($acao =="cadastrar") or($acao=="editar") or($acao =="deletar")){	
		include("/../../assets/php/conexao.php");
		
		$pdo = conectar();
		
		if($acao <> "deletar"){
		
			$nome	 			= filter_var(utf8_decode($_POST['nome']));
			$email			    = filter_var($_POST['email']);
			$senha	 			= filter_var($_POST['senha']);
			$confirmasenha	 	= filter_var($_POST['confirmaSenha']);
			$telefone	 		= filter_var($_POST['telefone']);
			$perfil             = filter_var($_POST['permissao']);
		}
		
		try{
			
			if($acao =="cadastrar"){
				$statement = $pdo->prepare('insert into tb_usuario (nom_usuario,email,senha,telefone,perfil) values (:nome,:email,:senha,:telefone,:perfil)');
			}else if($acao =="editar"){
				$statement = $pdo->prepare( 'update tb_usuario set
											 nom_usuario = :nome,
											 email       = :email,
											 senha       = :senha,
											 telefone    = :telefone,
											 perfil      = :perfil
											 where cod_usuario =:id');
			}else{
				$statement = $pdo->prepare('delete from tb_usuario where cod_usuario = :id');
			
			}
			
			switch ($acao) {
				case "cadastrar":
					$statement->bindParam(':nome',  $nome);
					$statement->bindParam(':email', $email);
					$statement->bindParam(':senha', $senha);
					$statement->bindParam(':telefone', $telefone);
					$statement->bindParam(':perfil', $perfil);
					break;
					
				case "editar":
					$statement->bindParam(':id',$id);
					$statement->bindParam(':nome',  $nome);
					$statement->bindParam(':email', $email);
					$statement->bindParam(':senha', $senha);
					$statement->bindParam(':telefone', $telefone);
					$statement->bindParam(':perfil', $perfil);
					break;
					
				case "deletar":
					sleep(1);
					$statement->bindParam(':id',$id);
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
	

	function ong($argumento,$id_ong){ // Esta funcão retorna retorna as ongs cadastradas no sistema. Podendo ser apenas uma ,buscada por id ou todas, dependendo da combinacao de parametros. 
		if($argumento == 'listar'){			
			
			$pdo = conectar ();

			$qry = "select 
					u.cod_usuario,
					u.nom_usuario,
					u.email,
					u.senha,
					u.telefone,
					u.perfil
						
					from tb_usuario u			
					GROUP BY u.cod_usuario";
					
			$lista 	= $pdo->query ($qry);	

					
			if ($lista) {	
				while ( $row = $lista->fetch ( PDO::FETCH_ASSOC )):
				echo"
					<div class='panel-group'>
						<div class='panel panel-default'>
							<div class='panel-heading'>
							  <h4 class='panel-title'>
								<a data-toggle='collapse' href='#collapse".$row['cod_usuario']."'>".$row['nom_usuario']."</a>
							  </h4>
							</div>
							<div id='collapse".$row['cod_usuario']."' class='panel-collapse collapse'>
								<div class='panel-body'>
									<ul class='nav nav-tabs' id='myTab'>
									  <li class='active'><a  href='#' data-target='#dados".$row['cod_usuario']."' id='tab-user' data-toggle='tab'>Dados Perfil</a></li>
									  <li>				<a 	 href='#' data-target='#editar-perfil".$row['cod_usuario']."' id='tab-user' data-toggle='tab'>Editar Perfil</a></li>
									</ul>
									<div class='tab-content'>
										<div class='tab-pane active' id='dados".$row["cod_usuario"]."'>
											<div class='row'>
												<div class='col-md-9' style=''>
													<div class='container-fluid' id='conteudo_ong'>
														<div class='row'>
															<div class='col-md-12'>
																<div id='view-profile' class='tab-pane fade in active'>
																	<div class='form-group '>
																	<div id='img-perfil'class='text-center mbl'><img src='http://lorempixel.com/400/250/business/1/' alt='' class='img-responsive'/></div>
																		<div class=''><a href='#' class='btn btn-green'><i class='fa fa-upload'></i>&nbsp;
																				Upload</a>
																		</div>
																	</div>

																	<table id='view-profile' class='table table-striped table-hover'>
																		<tbody >
																		<tr >
																			<td>Nome</td>
																			<td>".$row['nom_usuario']."</td>
																		</tr>
																		<tr>
																			<td>Email</td>
																			<td>".$row['email']."</td>
																		</tr>
																		<tr>
																			<td>Telefone</td>
																			<td>".$row['telefone']."</td>
																		</tr>
																		<tr>
																			<td>Permissao</td>
																			<td><span class='label label-success'>".$row['perfil']."</span></td>
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
									  
										<div class='tab-pane' id='editar-perfil".$row["cod_usuario"]."'>
																			  
											<div id='tab-edit' class='tab-pane fade in'>
												<form action='#' id='edita-usuario".$row['cod_usuario']."' class='form-horizontal'>
													<h4>Informações do usuario</h4>
												
													<div class='form-group'><label class='col-sm-3 control-label'>Nome</label>
														<div class='col-sm-9 controls'>
															<div class='row'>
																<div class='col-md-9 col-xs-12'><input type='text' placeholder='digite o nome' class='form-control' name='nome' value='".$row['nom_usuario']."' /></div>
															</div>
														</div>
													</div>

													<hr/>
													<h4>Informações de contato</h4>
													
													<div class='form-group'><label class='col-sm-3 control-label'>Email</label>

														<div class='col-sm-9 controls'>
															<div class='row'>
																<div class='col-md-9 col-xs-12'><input type='email' placeholder='email@exemplo.com' class='form-control'name='email'value='".$row['email']."'/></div>
															</div>
														</div>
													</div>

													<div class='form-group'><label class='col-sm-3 control-label'>Telefone</label>

														<div class='col-sm-9 controls'>
															<div class='row'>
																<div class='col-md-9 col-xs-12'><input type='text' placeholder='digite o telefone' class='form-control'name='telefone'value='".$row['telefone']."'/></div>
															</div>
														</div>
													</div>

													<hr/>
													<h4>Informações de Segurança</h4>
													
													<div class='form-group'><label class='col-sm-3 control-label'>Permissão</label>

														<div class='col-sm-9 controls'>
															<div class='row'>
																<div class='col-md-5 col-xs-12'>

																	<select class='form-control' name='permissao'>

																		<option  value =''          >Selecione ...</option>
																		<option  value ='moderador' >Moderador</option>
																		<option  value ='usuario'   >Usuario comum</option>

																	</select>
																</div>
															</div>
														</div>
													</div>

													
													<div class='form-group'><label class='col-sm-3 control-label'>Senha</label>
														<div class='col-sm-9 controls'>
															<div class='row'>
																<div class='col-md-5 col-xs-12'><input type='password' placeholder='digite a senha' class='form-control'name='senha' value='".$row['senha']."'/></div>
															</div>
														</div>
													</div>
													<div class='form-group'><label class='col-sm-3 control-label'>Confirmação de Senha</label>
														<div class='col-sm-9 controls'>
															<div class='row'>
																<div class='col-md-5 col-xs-12'><input type='password' placeholder='confirme a senha' class='form-control'name='confirmaSenha' value=''/></div>
															</div>
														</div>
													</div>
													<hr/>
													<span id='editarUsuario' data-value=".$row['cod_usuario']." class='btn btn-green btn-block'>Salvar Alterações</span>
												</form>
											</div>
										</div>
									</div>
								</div>
								<div class='panel-body' id='panel-foot-body'>
									<div class='row'>
										<div class='col-md-5'>
										
										</div>
										<div class='col-md-5'>
											<!--<a href='#' data-link=".$row['nom_usuario']." class='btn btn-info btn-lg'>
											  <span class='glyphicon glyphicon-edit minhaclasse'></span>
											</a>-->
										</div>
										<div class='col-md-1'>
											<a href='#' id='excluirUsuario' data-link =".$row['cod_usuario']." class='btn btn-danger btn-lg'>
												<span class='glyphicon glyphicon-trash minhaclasse'></span>
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>";
				endwhile; 
			}

		}else{ /*se nao for para listar todas as ongs,entao mostra a partir de um do $id_ong*/
			$pdo = conectar ();

				$qry = "select 
						u.cod_usuario,
						u.nom_usuario,
						u.email,
						u.senha,
						u.telefone,
						u.perfil
							
						from tb_usuario u
						where u.cod_usuario =?
						GROUP BY u.cod_usuario";
						
				$resultado = $pdo->prepare($qry);
				$resultado->execute(array($id_ong));
						
				//$lista 	= $pdo->query ($qry);	
						
				if ($resultado) {	
					while ( $row = $resultado->fetch ( PDO::FETCH_ASSOC )):
					echo"					 
					 <ul class='nav nav-tabs' id='myTab'>
					  <li class='active'><a  href='#' data-target='#dados".$row['cod_usuario']."' id='tab-user' data-toggle='tab'>Dados Perfil</a></li>
					  <li>				<a 	 href='#' data-target='#editar-perfil".$row['cod_usuario']."' id='tab-user' data-toggle='tab'>Editar Perfil</a></li>
					</ul>
					<div class='tab-content'>
						<div class='tab-pane active' id='dados".$row["cod_usuario"]."'>
							<div class='row'>
								<div class='col-md-9' style=''>
									<div class='container-fluid' id='conteudo_ong'>
										<div class='row'>
											<div class='col-md-12'>
												<div id='view-profile' class='tab-pane fade in active'>
													<div class='form-group '>
													<div id='img-perfil'class='text-center mbl'><img src='http://lorempixel.com/400/250/business/1/' alt='' class='img-responsive'/></div>
														<div class=''><a href='#' class='btn btn-green'><i class='fa fa-upload'></i>&nbsp;
																Upload</a>
														</div>
													</div>

													<table id='view-profile' class='table table-striped table-hover'>
														<tbody >
														<tr >
															<td>Nome</td>
															<td>".$row['nom_usuario']."</td>
														</tr>
														<tr>
															<td>Email</td>
															<td>".$row['email']."</td>
														</tr>
														<tr>
															<td>Telefone</td>
															<td>".$row['telefone']."</td>
														</tr>
														<tr>
															<td>Permissao</td>
															<td><span class='label label-success'>".$row['perfil']."</span></td>
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
					  
						<div class='tab-pane' id='editar-perfil".$row["cod_usuario"]."'>
															  
							<div id='tab-edit' class='tab-pane fade in'>
								<form action='#' id='edita-usuario".$row['cod_usuario']."' class='form-horizontal'>
									<h4>Informações do usuario</h4>
								
									<div class='form-group'><label class='col-sm-3 control-label'>Nome</label>
										<div class='col-sm-9 controls'>
											<div class='row'>
												<div class='col-md-9 col-xs-12'><input type='text' placeholder='digite o nome' class='form-control' name='nome' value='".$row['nom_usuario']."' /></div>
											</div>
										</div>
									</div>

									<hr/>
									<h4>Informações de contato</h4>
									
									<div class='form-group'><label class='col-sm-3 control-label'>Email</label>

										<div class='col-sm-9 controls'>
											<div class='row'>
												<div class='col-md-9 col-xs-12'><input type='email' placeholder='email@exemplo.com' class='form-control'name='email'value='".$row['email']."'/></div>
											</div>
										</div>
									</div>

									<div class='form-group'><label class='col-sm-3 control-label'>Telefone</label>

										<div class='col-sm-9 controls'>
											<div class='row'>
												<div class='col-md-9 col-xs-12'><input type='text' placeholder='digite o telefone' class='form-control'name='telefone'value='".$row['telefone']."'/></div>
											</div>
										</div>
									</div>

									<hr/>
									<h4>Informações de Segurança</h4>
									
									<div class='form-group'><label class='col-sm-3 control-label'>Permissão</label>

										<div class='col-sm-9 controls'>
											<div class='row'>
												<div class='col-md-5 col-xs-12'>

													<select class='form-control' name='permissao'>

														<option  value =''          >Selecione ...</option>
														<option  value ='moderador' >Moderador</option>
														<option  value ='usuario'   >Usuario comum</option>

													</select>
												</div>
											</div>
										</div>
									</div>

									
									<div class='form-group'><label class='col-sm-3 control-label'>Senha</label>
										<div class='col-sm-9 controls'>
											<div class='row'>
												<div class='col-md-5 col-xs-12'><input type='password' placeholder='digite a senha' class='form-control'name='senha' value='".$row['senha']."'/></div>
											</div>
										</div>
									</div>
									<div class='form-group'><label class='col-sm-3 control-label'>Confirmação de Senha</label>
										<div class='col-sm-9 controls'>
											<div class='row'>
												<div class='col-md-5 col-xs-12'><input type='password' placeholder='confirme a senha' class='form-control'name='confirmaSenha' value=''/></div>
											</div>
										</div>
									</div>
									<hr/>
									<span id='editarUsuario' data-value=".$row['cod_usuario']." class='btn btn-green btn-block'>Salvar Alterações</span>
								</form>
							</div>
						</div>
					</div>";
					endwhile; 
				}
			
			
		}
	}

?>










