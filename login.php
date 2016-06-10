<?php global $usuario;
	  global $senha ?>

<title>Miaudote | Login</title>
<div id="remove">
	<div id="acesso">
		<form name="login-form" class="login-form" id="formulario-login" action="valida_acesso.php" method="POST">
			<div class="header">
				<h1 align="center">Bem vindo ao Miaudote</h1>
				<span>Para Login, preencha os campos abaixo</span>
			</div>
			<div class="content">
				<input name="username" type="text" class="input usermail"  value="<?php echo $usuario ?>" placeholder="Email" />
				<div class="user-icon"></div> 
				<input name="password" type="password" class="input password" value="<?php echo $senha ?>"placeholder="Senha" />
				<div class="pass-icon"></div>
				<footer class="clearfix">
					</br>
					<p align="right" class="navigation">					
						<i class=""><a href="index.php?page=recuperar_acesso" id="recuperar_acesso" data-link='recuperar_acesso'>Esqueceu sua senha</a></i>
					</p>
					<?php
						error_reporting(E_ALL);
						$retorno = (isset($_GET['acesso'])) ? $_GET['acesso'] : '';
						if(!empty($retorno)){
							echo "<span class='error_report'>";
							switch ($retorno) {
								case "get_out_01":
									echo "<span class='error_report'>Por favor realize login</span>";
									break;
								case "get_out_02":
									echo "<span class='error_report'>Usuario deve ser informado</span>";
									break;
								case "get_out_03":
									echo "<span class='error_report'>E-mail inválido</span>";
									break;
								case "get_out_04":
									echo "<span class='error_report'>Senha deve ser informada</span>";
									break;
								case "get_out_05":
									echo "<span class='error_report'>Usuário ou senha incorretos</span>";
									break;
								case "get_out_06":
									echo "<span class='error_report'>Por favor realize o login para acessar este recurso</span>";
									break;
								case "get_out_07":
									echo "<span class='error_report'>Usuário n&atilde;o tem permiss&atilde;o neste m&etilde;ste m&otilde;dulo! </span>";
									break;	
								default:
									echo "<span class='error_report'>Por favor, verifique as informações de acesso</span>";
									break;
							}
							echo"</span>";
						}
					?>
				</footer>
			</div>
			<div class="footer">
				<button type="submit" class="button" name="myButton" value="foo">Entrar</button>
			</div>
		</form>
	</div>
</div>


