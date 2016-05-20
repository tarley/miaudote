<?php
require_once 'conexao.php';

function enviaEmail($status, $codanimal) {
	$pdo = conectar();	
	$sql = "SELECT nom_animal, cod_usuario FROM tb_animal WHERE cod_animal = :codanimal";
	$stm = $pdo->prepare($sql);
	$stm->bindValue(':codanimal', $codanimal, PDO::PARAM_INT);
	
	if($stm->execute()) {
		$nomanimal = $stm->fetchColumn(); // nome animal
		$codusuario = $stm->fetchColumn(1); // codigo usuario		
		
		// Busca usuario
		$sql = "SELECT email FROM tb_usuario WHERE cod_usuario = :codusuario";
		$stm = $pdo->prepare($sql);
		$stm->bindValue(':codusuario', $codusuario, PDO::PARAM_INT);
		
		if ($stm->execute()) {
			$to = $stm->fetchColumn(); // email destinatário
		
			if ($status == 'Aprovado') {
				$subject = "O cadastro de seu pet foi aprovado - Miaudote.com.br";
				
				$message = "
						<html>
							<head>
								<title></title>
							</head>
							<body>
								<p>Parabéns! O cadastro de seu animalzinho ".$nomanimal." foi aprovado</p>
								<br/>								
								<p>A equipe Miaudote agradeçe sua confiança em nosso trabalho.</p>
							</body>
						</html>
						";
				
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				$headers .= 'From: <miaudote@example.com>' . "\r\n";
			} elseif ($status == 'Reprovado') {
				
			
			}
			
			mail($to,$subject,$message,$headers);
		}		
	}	
}

?>