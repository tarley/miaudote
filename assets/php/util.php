<?php
	require_once 'conexao.php';
		function getdados($acao){
			$pdo = conectar();
		if(isset($acao)){
				//sleep(2);
			
			if($acao == 'getDestaques'){
				
				$listar ="select 	a.cod_animal,
									a.nom_animal,
									a.desc_animal,
									f.cod_foto,
									f.nom_foto,
									f.url,
									f.id_foto_pri
												
									from 	tb_animal a , tb_foto f
									where 	a.cod_animal = f.cod_animal
									and   	f.id_foto_pri = 's'";
		
				$stmdestaque = $pdo->prepare($listar);
				$stmdestaque-> execute();
				if(!$stmdestaque){
					echo "não há destaques a serem exibidos";
				}else{	
					while($rowdestaque = $stmdestaque->fetch()){
					echo "<figure id ='perfil' class='effect-oscar wowload fadein'>
							<img src='".substr($rowdestaque['url'],3)."'/>
							<figcaption>
							<h2>".$rowdestaque['nom_animal']."</h2>
							<p>".$rowdestaque['desc_animal']."</br>
							<a href='#conteudo' id='animal-filtro' data-value='".$rowdestaque['cod_animal']."'>Perfil</a>
							</figcaption>
							</figure>";					
					}
				} 
			}/*fim get destaque*/
			
			if($acao == 'getperfil'){
				sleep(2);			
				$codanimal = $_get['cod_animal'];	

				$sql = "select 	a.cod_animal,
								a.nom_animal,
								a.desc_perfil,
								a.idade,
								f.cod_foto,
								f.nom_foto,
								f.url,
								u.telefone,
								u.email,
								u.nom_usuario,							
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
								
				$stm = $pdo->prepare($sql);
				$stm-> bindvalue(1,$codanimal);
				$stm-> execute();
				echo json_encode($stm->fetchall(pdo::fetch_obj));			
		
			}	
		}
	}	

?>