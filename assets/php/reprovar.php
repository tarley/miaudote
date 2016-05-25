<?php
require_once 'conexao.php';

// Conexao
$pdo = conectar();

// Globais
$id = $_POST['id'];

// Locais
$imagens = array();
$dir = '../../images/uploads'; /* Diretorio das imagens */

//Selecao das imagens no disco
$sql = "SELECT url FROM tb_foto WHERE cod_animal = :id";

$stm = $pdo->prepare($sql);	
$stm->bindValue(':id', $id, PDO::PARAM_INT);
if($stm->execute()){
	while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {		
		foreach($row as $value){
			array_push($imagens, substr($value, 18));			
		}		
	}
}

// Apaga dados do banco
try {
	$sql = "DELETE FROM tb_foto WHERE cod_animal = :id";
	
	$stm = $pdo->prepare($sql);	
	$stm->bindValue(':id', $id, PDO::PARAM_INT);
	
	if($stm->execute()){	
		$sql = "DELETE FROM tb_animal WHERE cod_animal = :id";
		
		$stm = $pdo->prepare($sql);
		$stm->bindValue(':id', $id, PDO::PARAM_INT);
		
		if ($stm->execute()){
			// Apaga upload de fotos no disco
			if(!empty($imagens)) {
				if ($handle = opendir($dir)) {
					while (false !== ($file = readdir($handle)))
					{						
						if(in_array($file, $imagens)){
							unlink($dir.'/'.$file);
						}						
					}
					closedir($handle);
				}				
			}			
			enviaEmail('Reprovado', $_POST['id']);
			echo "Cadastro reprovado com sucesso";
		} else {
			echo "Falha ao reprovar cadastro";
		}
	} else {
		echo "Falha ao reprovar cadastro";
	}
} catch (Exception $e) {
        echo $e->getMessage();
    }
?>