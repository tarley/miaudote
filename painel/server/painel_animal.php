<?php
	error_reporting(E_ALL);

	
	$acao        = (isset($_GET['acao']))? $_GET['acao'] : 'acao_indefinida';
	$id   		 = (isset($_GET['id']))? $_GET['id'] : 'id_indefinido';
	$cod_usuario = (isset($_GET['usuario']))? $_GET['usuario'] : 'usuario_indefinido';

	$animal      = (isset($_GET['animal']))? $_GET['animal'] : 'usuario_indefinido';
	$nome_foto   = (isset($_GET['nome_foto']))? $_GET['nome_foto'] : 'usuario_indefinido';
	$cod_foto    = (isset($_GET['cod_foto']))? $_GET['cod_foto'] : 'usuario_indefinido';


	
	if(($acao =="cadastrar") or($acao=="editar") or($acao =="deletar")){
		
		include("../../assets/php/conexao.php");

		
		$pdo = conectar();
		
		if($acao <> "deletar"){
		
			$nome	 			= filter_var(utf8_decode($_POST['nome']));
			$especie			= filter_var($_POST['especie']);
			$descricao	 		= filter_var($_POST['descricao']);
			$idade	 			= filter_var($_POST['idade']);
			$porte	 			= filter_var($_POST['porte']);
			$cor	 			= filter_var($_POST['cor']);
			$sexo             	= filter_var($_POST['sexo']);
			//$estado             = filter_var($_POST['estado']);
			$cidade             = filter_var($_POST['cidade']);
			$perfil             = filter_var($_POST['perfil']);
			//$dt_cadastro        = $date = date("Y-m-d");
			
			
			
		}

		try{
			
			if($acao =="cadastrar"){
				$statement = $pdo->prepare('insert into tb_animal (cod_usuario,nom_animal,desc_animal, cod_especie, cor,  desc_perfil, idade, ind_porte,ind_sexo, cod_cidade) values 
																  (:usuario,   :nome,     :descricao,  :especie,    :cor, :perfil,  :idade,:porte,       :sexo,    :cidade )');
			}else if($acao =="editar"){
				$statement = $pdo->prepare( 'update tb_animal set 				
											 nom_animal     = :nome,
											 desc_animal    = :descricao,
											 cod_especie    = :especie,
											 cor            = :cor,
											 desc_perfil    = :perfil,
											 idade          = :idade,
											 ind_porte      = :porte,
											 ind_sexo       = :sexo,
											 cod_cidade     = :cidade
											 where cod_animal =:id and
												   cod_usuario =:usuario');
			}else{
				$statementFoto = $pdo->prepare('delete from tb_foto where  cod_animal = :id');
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
				case "cadastrar":
					
					$statement->bindParam(':usuario',$cod_usuario);	
					$statement->bindParam(':nome',  $nome);
					$statement->bindParam(':especie', $especie);
					$statement->bindParam(':descricao', $descricao);
					$statement->bindParam(':idade', $idade);
					$statement->bindParam(':porte', $porte);
					$statement->bindParam(':cor', $cor);
					$statement->bindParam(':sexo', $sexo);
					$statement->bindParam(':cidade', $cidade);
					$statement->bindParam(':perfil', $perfil);
					break;
					
				case "editar":
					$statement->bindParam(':id',$id);
					$statement->bindParam(':usuario',$cod_usuario);
					
					$statement->bindParam(':nome',  $nome);
					$statement->bindParam(':especie', $especie);
					$statement->bindParam(':descricao', $descricao);
					$statement->bindParam(':idade', $idade);
					$statement->bindParam(':porte', $porte);
					$statement->bindParam(':cor', $cor);
					$statement->bindParam(':sexo', $sexo);
					$statement->bindParam(':cidade', $cidade);
					$statement->bindParam(':perfil', $perfil);	
					
					break;
					
				case "deletar":
					sleep(1);
					
					if ($acao=="deletar"){
						$statementFoto->bindParam(':id',$id);
					}
					
					$statement->bindParam(':id',$id);
					$statement->bindParam(':usuario',$cod_usuario);
	
					
					break;
			}
			
			if ($acao=="deletar"){
				if($statementFoto->execute()){//deleta imagens 
					
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
						echo ($acao=="deletar")?"del_ok":"ok";
					}
					
				}	echo "del_n_ok";
			}

			if($statement->execute()){			
				echo ($acao=="deletar")?"del_ok":"ok";
			}else{
				echo ($acao=="deletar")?"del_nr":"nr";
			}

		}catch(PDOException $e) {
			echo 'Error: '. $e->getMessage();
		}
				
	}else if($acao=="deletar_foto"){
		
		include("../../assets/php/conexao.php");
		$pdo = conectar();
		
		$statement = $pdo->prepare('delete from tb_foto where cod_animal = :animal and cod_foto = :cod_foto');
		$statement->bindParam(':animal',$animal);
		$statement->bindParam(':cod_foto',$cod_foto);
		
		if($statement->execute()){
			if(unlink("../".$nome_foto)){
				echo "foto_excluida_ok";
				
			}else{
				echo "foto_n_excluida";
			}
			
		}
		
	}

	
?>
