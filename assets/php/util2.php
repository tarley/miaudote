<?php
	require_once 'conexao.php';
	$pdo = conectar();
		$listar =$pdo->query('SELECT A.CDANIMAL,A.NMANIMAL,F.CDFOTO,F.NMFOTO,TXTDESCRICAO FROM ANIMAL A, FOTO F  WHERE A.CDANIMAL = F.CDANIMAL');
		echo json_encode($listar->fetchAll(PDO::FETCH_OBJ));
		
?>