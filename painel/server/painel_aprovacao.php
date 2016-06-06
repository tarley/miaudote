<?php
	include("../../assets/php/conexao.php");
	include("/../public.php");
	
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
				

				$statementFoto = $pdo->prepare('delete from tb_foto where  cod_animal = :id and cod_usuario = :usuario');				
				
				$statement = $pdo->prepare('delete from tb_animal where  cod_animal = :id and cod_usuario = :usuario');
				
				
				$imagens = array();
				$dir = '../../images/uploads'; /* Diretorio das imagens */

				//Selecao das imagens no disco
				$sql = "SELECT url FROM tb_foto WHERE cod_animal = :id";

				$stm = $pdo->prepare($sql);	
				$stm->bindValue(':id', $id, PDO::PARAM_INT);
				if($stm->execute()){
					while ($row = $stm->fetch(PDO::FETCH_ASSOC)){		
						foreach($row as $value){
							array_push($imagens, substr($value, 18));			
						}		
					}
				}
				
			}

			switch ($acao) {
				case "aprovar":
					$statement->bindParam(':dtcadastro',$dt_cadastro);
					$statement->bindParam(':id',$id);
					$statement->bindParam(':usuario',$cod_usuario);	
					break;
					
				case "reprovar":
					if($acao ="reprovar"){
						
						$statementFoto->bindParam(':id',$id);
						$statementFoto->bindParam(':usuario',$cod_usuario);
					
					}
				
					$statement->bindParam(':id',$id);
					$statement->bindParam(':usuario',$cod_usuario);
					break;
			}
			
			
			if ($acao=="reprovar"){
				if($statementFoto->execute()){//deleta imagens do animal antes de deleta-lo
					
					if(!empty($imagens)) {
						if ($handle = opendir($dir)) {	
							while (false !== ($file = readdir($handle))){						
								if(in_array($file, $imagens)){
									unlink($dir.'/'.$file);
								}						
							}
							closedir($handle);
						}				
					}			
					if($statement->execute()){			
						echo ($acao=="reprovar")?"reprovacao_ok":"aprovacao_ok";
					}
					
				}else{
					//echo "reprovacao_n_ok";
				}

				
			}else{
				//echo ($acao=="reprovar")?"reprovacao_ok":"aprovacao_ok";	
			}

			}catch(PDOException $e){
				echo 'Error: '. $e->getMessage();
			}
				
	}
?>
