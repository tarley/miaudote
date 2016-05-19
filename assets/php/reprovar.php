<?php
require_once 'conexao.php';

$pdo = conectar();

$id = $_POST['id'];

$sql = "DELETE FROM tb_animal WHERE cod_animal = :id";

try {
	$stm = $pdo->prepare($sql);	
	$stm->bindValue(':id', $id, PDO::PARAM_INT);
	
	if($stm->execute()){
		echo "Cadastro reprovado com sucesso";
	} else {
		echo "Falha ao reprovar cadastro";
	}
} catch (Exception $e) {
        echo $e->getMessage();
    }
?>