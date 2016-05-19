<?php
require_once 'conexao.php';

$pdo = conectar();

$id = $_POST['id'];

$data = date('Y-m-d');

$sql = "UPDATE tb_animal SET dt_cadastro = :data WHERE cod_animal = :id";

try {
	$stm = $pdo->prepare($sql);
	$stm->bindValue(':data', $data, PDO::PARAM_STR);
	$stm->bindValue(':id', $id, PDO::PARAM_INT);
	
	if($stm->execute()){
		echo "Cadastro aprovado com sucesso";
	} else {
		echo "Falha ao aprovar cadastro";
	}
} catch (Exception $e) {
        echo $e->getMessage();
    }
?>