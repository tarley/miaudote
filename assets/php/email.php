<?php

function validaEmail($email) {
	$conta = "^[a-zA-Z0-9\._-]+@";
	$domino = "[a-zA-Z0-9\._-]+.";
	$extensao = "([a-zA-Z]{2,4})$";
	$pattern = $conta.$domino.$extensao;
	if(@ereg($pattern, $email))
		return true;
	else
		return false;
}


function enviaEmail($nomeRemetente,$emailRemetente,$msg){
	$mail = new PHPMailer;
	$mail->isSMTP();
	$mail->SMTPDebug = 0;
	$mail->Debugoutput = 'html';
	$mail->Host = 'smtp.gmail.com';
	$mail->Port = 465;
	$mail->SMTPSecure = 'ssl';
	$mail->SMTPAuth = true;
	$mail->CharSet = "UTF-8";
	$mail->Username = "ipotec.ipotec@gmail.com";
	$mail->Password = "senhaaqui";
	$mail->setFrom($emailRemetente,'Projeto SIVET');
	$mail->addAddress($emailRemetente, $nomeRemetente);
	$mail->Subject = 'Projeto SIVET';
	$mail->isHtml(true);

	$body="<table>
		<tr>
			<table width='600px' height= '105px' background='img/header.png' style='background-color:#444'>
					<tbody>
						<tr cellpadding='20' width='500px' height='40px' background='img/logo3.png'>
							<td></td>
						</tr>
					</tbody>
			</table>
		</tr>
		<tr>
			<table width='600px' height= 'auto' style='margin:-5 0 0 0;background-color:#fff'>
					<tbody>
						<tr cellpadding='0' width='500px' height='4px' background='img/oblique-lines.png'>
								<td><td>
						</tr>
					</tbody>
			</table>
		</tr>
		<tr>
			<table width='600px' cellspacing='15' height= 'auto' style='margin:-1 0 0 0;background-color:#ebebe8''>
					<tbody>
						<tr >
							<tr>
								<td width='100px' height ='30px'><b>Enviado por :</b></td><td width='400px'>$nomeRemetente - $emailRemetente</td>
							</tr>
							<tr>
								<td><b>Mensagem :</b></td><td></td>
							</tr>
							<tr>
								<td colspan='2'width='400px'align='justify'> 
									<div style='margin: 20 10 10 10'>
										$msg 
									</div>
								</td>	
							</tr>
					</tbody>
			</table>
		</tr>
		<tr>
			<table width='600px' height= 'auto' style='margin:-1 0 0 0;background-color:#fff'>
					<tbody>
						<tr cellpadding='0' width='500px' height='4px' background='img/footer.png'>
						<td><td>
						</tr>
					</tbody>
			</table>
		</tr>
		<tr>
			<table width='600px' height= '50px' background='img/footer4.png' style='background-color:#444'>
					<tbody>
						<tr cellpadding='20' width='500px' height='40px'>
							<td align='center'>Todos os direitos reservados</td>
						</tr>
					</tbody>
			</table>
		</tr>
	</table>";

	$mail->msgHTML($body);
	$mail->AltBody = $msg;
	if (!$mail->send()) {
		
		// Controla erros
		$err	=	0;
		
		// Trata erros
		// Nome vazio
		if(empty($nomeRemetente)){
			echo "nome_vazio";
			$err=1;
		}
			
		// Nome deve ter mais de 3 caracteres
		if($err==0 && strlen($nomeRemetente)<3){
			echo "nome_curto";
			$err=1;
		}
		
		// Email vazio
		if($err==0 && empty($emailRemetente)){
			echo "email_vazio";
			$err=1;
		}
				
		// Email válido
		if($err==0 && validaEmail($emailRemetente)==false){ 
			echo "email_invalido";
			$err=1;
		}
		
		// Mensagem vazia
		if($err==0 && empty($msg)){
			echo "msg_Vazia";
			$err=1;
		}
		
		// mensagem pequena
		if($err==0 && strlen($msg)<10){
			echo "msg_pequena";
			$err=1;
		}
		
		if($err==0)
			echo "Mailer Error: " . $mail->ErrorInfo;
			
	}else{
		echo"OK";
	};	
}
	
?>