<?php
error_reporting(E_ALL);
	include("../assets/php/conexao.php");
	
	$pdo = conectar();
		
	$acao = (isset($_GET['acao']))? $_GET['acao'] : 'acao_indefinida';
	
	if($acao == 'getCidade'){
		
		$sg_uf = $_GET['cod_estado'];
		
		$consulta = $pdo->prepare("select   distinct
											 c.cod_cidade,
											 e.cod_estado,
											 c.nom_cidade
											from  tb_cidade c 
											inner join tb_estado e on  (c.cod_estado = e.cod_estado)
											where e.cod_estado = :uf");
		$consulta->bindValue(':uf',$sg_uf,PDO::PARAM_STR);
		$consulta->execute();
		
		echo 	"<select class='filter' name='selectThis' id='selectThis'>
					<option value=''>Selecione uma cidade ...</option>";
					while ( $rowEstado = $consulta->fetch ( PDO::FETCH_ASSOC ) ) {
							echo "<option value='" . $rowEstado ["cod_cidade"] . "'>" . utf8_encode ( $rowEstado ["nom_cidade"] ) . "</option>";
						}"
				</select>";
	}
	

?>
