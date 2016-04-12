$(function(){
	$("#enviarEmail").click(function(){ // quando o usuário clica no link executa o ajax
	
		/* criando uma div de carregamento temporário  e inserindo */
		if ( $(".sucess_report").length ){ /*Verificar se a resposta de sucesso enviada anteriormente ao usuario ainda esta la, se estiver ele apaga para "reiniciar"o processo*/
			$(".sucess_report").remove();
		}
		
		if ( $(".error_report").length ){ /*Verificar se a resposta de erro enviada anteriormente ao usuario ainda esta la, se estiver ele apaga para "reiniciar"o processo*/
			$(".error_report").remove();
		}
		
		$('#enviarEmail').attr('disabled', 'disabled') /*Desabilita o botão de enviar para evitar multiplas requisições*/;
		
		$(".ReturnUser").append('<div class="load_report"><span><img src="images/load6.gif"/>&nbsp; &nbsp; Enviando mensagem...</span></div>');
	    
		var dados = $('#contactForm').serialize();
		$.ajax({
		  
		  url: "assets/php/contatoEnviar.php", // url da logica que você irá executar
		  type:"POST", 
		  data: dados // aqui recebe um objeto com quantos parametros voce quiser assim você pode enviar dados dinamicamente
		}).success(function(resultado) { 
		// se tudo ocorrer bem entra aqui
			$(".load_report").fadeOut(300).remove();//	ocultando div de carregamento quando o ajax carregar e logo após apagando o mesmo		
			switch (resultado){
				case "OK":
					$(".ReturnUser").append("<div class='sucess_report'><span><i class='glyphicon glyphicon-exclamation-sign' ></i>&nbsp;Mensagem enviada com sucesso</span></div>");
					break;
					
				case "nome_vazio":
					$('#name').focus();
					$(".ReturnUser").append("<div class='error_report'><span><i class='glyphicon glyphicon-info-sign'></i>&nbsp;Nome deve ser informado</span></div>");
					break;

				case "nome_curto":
				    $('#name').focus();
					$(".ReturnUser").append("<div class='error_report'><span><i class='glyphicon glyphicon-info-sign'></i>&nbsp;Nome deve conter mais que 3 letras</span></div>");
					break;

				case "email_vazio":
				    $('#email').focus();
					$(".ReturnUser").append("<div class='error_report'><span><i class='glyphicon glyphicon-info-sign'></i>&nbsp;E-mail deve ser informado</span></div>");	
					break;

				case "email_invalido":
					$('#email').focus();
					$(".ReturnUser").append("<div class='error_report'><span><i class='glyphicon glyphicon-info-sign'></i>&nbsp; Insira um e-mail válido</span></div>");	
					break;

				case "msg_Vazia":
				    $('#comment').focus();
					$(".ReturnUser").append("<div class='error_report'><span><i class='glyphicon glyphicon-info-sign'></i>&nbsp; Insira uma mensagem</span></div>");
					break;
					
				case "msg_pequena":
					$('#comment').focus();
					$(".ReturnUser").append("<div class='error_report'><span><i class='glyphicon glyphicon-info-sign'></i>&nbsp;Mensagem deve conter mais que 10 letras</span></div>");
					break;
				default:
					$(".ReturnUser").append("<div class='error_report'><span><i class='glyphicon glyphicon-info-sign'></i>&nbsp;"+resultado+ "</span></div>");	
				break;	
			}					
			$('#enviarEmail').removeAttr('disabled'); /*Habilita novamente o botão de enviar email*/
		}).error(function(event, request, settings){ // se der erro entra aqui		
			$(".ReturnUser").append('<li>Error requesting page' + settings.url +'</li>');		
		});
	})
});