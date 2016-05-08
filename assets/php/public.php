<?php
	error_reporting(E_ALL);
	require_once 'conexao.php';
	$sg_uf = $_GET['cod_estado'];
	if($acao == 'getCidade'){
		
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
?>