<?php
	//error_reporting(E_ALL);
	if(!isset($pdo)){
		require_once 'assets/php/conexao.php';
		$pdo = conectar();
		
	}
	
	$identificador = $_GET['id'];
	try{	
		$sql = "select 	a.cod_animal,
				a.nom_animal,
				a.desc_perfil,
				a.idade,
				f.cod_foto,
				f.nom_foto,
				f.url,
				u.telefone,
				u.email,
				
				case 
				  when ind_porte = 1 then 'pequeno'
				  when ind_porte = 2 then 'medio'
				  when ind_porte = 3 then 'grade'
				  when ind_porte = 4 then 'gigante'
				  else 'indefinido'


				end as ind_porte,
				case 
				  when ind_sexo  = 1 then 'femea'
				  when ind_sexo  = 2 then 'macho'
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
						echo"<div class='drop-shadow lifted' style='position:relative;margin:0 auto;width:800px;min-height:500px;border:0px solid';>
								<img  class='img-responsive' alt='#' id='details-img' src='".substr($row ['url'],3)."'/>
							</div>
							<div id='content'>
								<ul id='tabs' class='nav nav-tabs' data-tabs='tabs'>
									<li class='active'><a href='#sobre-mim' data-toggle='tab'>Sobre Mim</a></li>
									<li><a href='#caracteristicas' data-toggle='tab'>Características</a></li>
									<li><a href='#contato' data-toggle='tab'>Contato</a></li>
								</ul>
								<div id='my-tab-content' class='tab-content' style ='min-height:100px;'>
									<br><br>
									<div class='tab-pane active' id='sobre-mim'>
										
										<p>$row[desc_perfil]</p>
									</div>
									<div class='tab-pane' id='caracteristicas'>
										<ul>
										<li>Idade: $row[idade]. ano(s) </li>
										<li>Sexo : $row[ind_sexo] </li>
										<li>Porte: $row[ind_porte]  </li>
										<br><br>
										<li>*Todos os animais do Miaudote são castrados.  </li>
										</ul>	
									</div>
									<div class='tab-pane' id='contato'>
										<ul>
											<li>Telefone:$row[telefone]</li>
											<li>E-mail : $row[email]  </li>
										</ul>		
									</div>
								</div>
							</div>";
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




