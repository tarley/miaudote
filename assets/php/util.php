<?php
	require_once 'conexao.php';
	$pdo = conectar();
	
	Error_reporting(0);
	if(isset($_GET['acao'])){
		$acao = $_GET['acao'];
		
	}else{
		echo"Nуo hс aчуo selecionada";
	}
	
	if(isset($acao)){		
		if($acao == 'getDestaque'){
			$listar =$pdo->query("SELECT 	A.COD_ANIMAL,
											A.NOM_ANIMAL,
											A.DESC_ANIMAL,
											F.COD_FOTO,
											F.NOM_FOTO,
											F.ID_FOTO_PRI
											
								FROM 		TB_ANIMAL A , TB_FOTO F
								WHERE 		A.COD_ANIMAL = F.COD_ANIMAL
								AND   		F.ID_FOTO_PRI = 'S'");
								
			
			if ($listar ==""){
				echo 0;
			}else{	
				echo json_encode($listar->fetchAll(PDO::FETCH_OBJ));
			}
		}

		if($acao == 'getPerfil'){
			sleep(2);			
			$codAnimal = $_GET['cod_animal'];	

			$sql = "SELECT 	A.COD_ANIMAL,
							A.NOM_ANIMAL,
							A.DESC_PERFIL,
							A.IDADE,
							F.COD_FOTO,
							F.NOM_FOTO,
							U.TELEFONE,
							U.EMAIL,
							U.NOM_USUARIO,							
							case 
							  when IND_PORTE = 1 then 'Pequeno'
							  when IND_PORTE = 2 then 'Medio'
							  when IND_PORTE = 3 then 'Grade'
							  when IND_PORTE = 4 then 'Gigante'
							  else 'Indefinido'


							end as IND_PORTE,
							case 
							  when IND_SEXO  = 1 then 'Femea'
							  when IND_SEXO  = 2 then 'Macho'
							  else 'Indefinido'

							end as IND_SEXO							

							
					FROM 	TB_ANIMAL A, TB_FOTO F,TB_USUARIO U
					WHERE 	A.COD_ANIMAL = ?
					AND     A.COD_USUARIO = U.COD_USUARIO
					AND     A.COD_ANIMAL = F.COD_ANIMAL AND
							F.ID_FOTO_PRI = 'S'";  
							
			$stm = $pdo->prepare($sql);
			$stm-> bindValue(1,$codAnimal);
			$stm-> execute();
			echo json_encode($stm->fetchAll(PDO::FETCH_OBJ));			
	
		}
		
		
		if($acao == 'getCidade' ){
			$sg_uf = $_GET['cod_estado'];
			$sg_uf = trim(str_replace(".", "", $sg_uf));
			$sql = "select   distinct
							 a.cod_cidade,
							 a.cod_estado,
							 c.nom_cidade
					  from  tb_animal a 
					  inner join tb_estado e on  (a.cod_estado = e.cod_estado)
					  inner join tb_cidade c on  (a.cod_cidade = c.cod_cidade)
					  where  e.sg_uf =?";  
							
			$stm = $pdo->prepare($sql);
			$stm-> bindValue(1,$sg_uf);
			$stm-> execute();
			
			echo json_encode($stm->fetchAll(PDO::FETCH_OBJ));
			
			
		}
	}
	
?>