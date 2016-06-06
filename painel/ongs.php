<?php
	include("assets/php/ong.php");

?>
	<div class="panel-group">
	  <div class="panel panel-default">
		<div class="panel-heading">
		  <h4 class="panel-title">
			<a data-toggle="collapse" href="#collapse0"><i class="glyphicon glyphicon-plus-sign"/> Adicionar usuario</a>
		  </h4>
		</div>
		<div id="collapse0" class="panel-collapse collapse">
		  <div class="panel-body">
		  
				<form action='#' id="novo-usuario" class='form-horizontal' method="post">
					<h4>Informações do usuario</h4>
				
					<div class='form-group'><label class='col-sm-3 control-label'>Nome</label>
						<div class='col-sm-9 controls'>
							<div class='row'>
								<div class='col-md-9 col-xs-12'><input type='text' placeholder='digite o nome' class='form-control' name='nome'/></div>
							</div>
						</div>
					</div>

					<hr/>
					<h4>Informações de contato</h4>
					
					<div class='form-group'><label class='col-sm-3 control-label'>Email</label>

						<div class='col-sm-9 controls'>
							<div class='row'>
								<div class='col-md-9 col-xs-12'><input type='email' placeholder='email@exemplo.com' class='form-control'name='email'/></div>
							</div>
						</div>
					</div>

					<div class='form-group'><label class='col-sm-3 control-label'>Telefone</label>

						<div class='col-sm-9 controls'>
							<div class='row'>
								<div class='col-md-9 col-xs-12'><input type='text' placeholder='digite o telefone' class='form-control'name='telefone'/></div>
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
										<option selected >Selecione ...</option>
										<option >Moderador    </option>
										<option >Usuario comum</option>
									</select>
								</div>
							</div>
						</div>
					</div>

					<div class='form-group'><label class='col-sm-3 control-label'>Senha</label>
						<div class='col-sm-9 controls'>
							<div class='row'>
								<div class='col-md-5 col-xs-12'><input type='password' placeholder='digite a senha' class='form-control'name='senha'/></div>
							</div>
						</div>
					</div>
					<div class='form-group'><label class='col-sm-3 control-label'>Confirmação de Senha</label>
						<div class='col-sm-9 controls'>
							<div class='row'>
								<div class='col-md-5 col-xs-12'><input type='password' placeholder='confirme a senha' class='form-control'name='confirmaSenha'/></div>
							</div>
						</div>
					</div>
					<hr/>
				
					<span id='cadastrarUsuario' class='btn btn-green btn-block'>Cadastrar usuário</span>
				</form>
		  </div>
		  <div class='panel-footer'> </div>
		</div>
	  </div>
	</div>
	
	<hr>	


	<div id="lista-usuario">
		<?php ong("listar","")?>
	</div>

























