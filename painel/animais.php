<?php
	error_reporting(E_ALL);
	include("assets/php/painel_animais.php");

?>
	
	<div class="panel-group">
		
	  <div class="panel panel-default">
		<div class="panel-heading">
		  <h4 class="panel-title">
			<a data-toggle="collapse" href="#collapse0"><i class="glyphicon glyphicon-plus-sign"/> Adicionar animal</a>
		  </h4>
		</div>
		<div id="collapse0" class="panel-collapse collapse">
		  <div class="panel-body">

				<div class='tab-content'>
					<div class='tab-pane active' id='dados'>

						<form action='#' id="novo-animal" class='form-horizontal' method="post">
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
											<select class='form-control' name='especie'>
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
										<div class='col-md-9 col-xs-12'><input type='text' placeholder='defina seu animal em  no maximo 4 palavras' class='form-control'name='descricao'/></div>
									</div>
								</div>
							</div>
							
							<div class='form-group'><label class='col-sm-3 control-label'>cor</label>
								<div class='col-sm-9 controls'>
									<div class='row'>
										<div class='col-md-9 col-xs-12'><input type='text' placeholder='digite a cor do animal' class='form-control' name='cor'/></div>
									</div>
								</div>
							</div>
							<div class='form-group'><label class='col-sm-3 control-label'>Idade</label>

								<div class='col-sm-9 controls'>
									<div class='row'>
										<div class='col-md-9 col-xs-12'><input type='number' placeholder='' class='form-control'name='idade'/></div>
									</div>
								</div>	
							</div>
							
							<div class='form-group'><label class='col-sm-3 control-label'>Porte</label>

								<div class='col-sm-9 controls'>
									<div class='row'>
										<div class='col-md-5 col-xs-12'>
											<select class='form-control' name='porte'>
												<option selected >Selecione ...   </option>
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
											<select class='form-control' name='sexo'>
												<option selected >Selecione ...</option>
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
												<option selected >Selecione ...</option>
												
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
							
							<div class='form-group'><label class='col-sm-3 control-label'>cidade</label>

								<div class='col-sm-9 controls'>
									<div class='row'>
										<div class='col-md-5 col-xs-12'>
											<select class='form-control' id="cidade" name='cidade'>
												<option selected >Selecione ...</option>
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
							<span id='cadastrarAnimal' class='btn btn-green btn-block'>Cadastrar Animal</span>
						</form>
					</div>
				</div>
		  </div>
		  <div class='panel-footer'>Panel Footer</div>
		</div>
	  </div>
	</div>
	
	<div id="lista-usuario">
		<?php animal("listar",1,"")?>
	</div>
	