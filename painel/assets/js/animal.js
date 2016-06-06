
jQuery(document).ready(function($) {
	
$(document).on('click','#cadastrarAnimal , #editarAnimal', function(){

		var form_action = $(this).attr("id"); 
		
		var acao = "";
		
		var dados_form ="";
		
		var id = $(this).data("value");
		
		if(form_action =="cadastrarAnimal"){
			
			acao       = "cadastrar";
			dados_form = $('#novo-animal').serialize();
			
		}else{
			
			acao       = "editar";
			dados_form = $('#edita-animal'+id).serialize();
			
		}
	
		
		$.ajax({		  
		  url: "server/painel_animal.php?acao="+acao+"&id="+id+"&usuario=1",
		  type:"post",
		  data: dados_form,	 
		  
		}).success(function(resultado) { 
		// se tudo ocorrer bem entra aqui
			var resposta = (resultado.substring(0,2));
			switch (resposta){
				case "ok":// cadastro realizado
					retorno_usuario("sucesso");
					break;
					
				case "nn":// nome nao informado
					$('#name').focus();
					alert("usuario cadastrado com sucesso");
					break;

				case "nc"://nome curto
				    $('#name').focus();
					alert("usuario cadastrado com sucesso");
					break;

				case "ev": //email vazio
				    $('#email').focus();
					alert("usuario cadastrado com sucesso");
					break;

				case "ei": //email invalido
					$('#email').focus();
					alert("usuario cadastrado com sucesso");
					break;
					
					
				case "sn": //senha nao informadao
					$('#email').focus();
					alert("usuario cadastrado com sucesso");
					break;
				case "si": // senhas nao correspondem
					$('#email').focus();
					alert("usuario cadastrado com sucesso");
					break;
				
				default:
					retorno_usuario(resultado);//cadastro nao realizado
				break;	
			}
	
		}).error(function(event, request, settings){ // se der erro entra aqui		
			$(".ReturnUser").append('<li>Error requesting page' + settings.url +'</li>');		
		});
	})
	
	
	/*Excluir um usuario*/
	
	
	$(document).on('click','#excluirAnimal', function(){
		
		var id_animal = $(this).data("animal");
		var id_usuario = $(this).data("usuario");
		
		bootbox.confirm("<div><div><span class='glyphicon glyphicon-question-sign questao'></span><br><br><label class='msg_erro'>Deseja excluir este animal?</label></div></div>", function(result) {
			
			if(result ==true){					
				$.ajax({		  
				  url: "server/painel_animal.php?acao=deletar&id="+id_animal+"&usuario="+id_usuario,
				  type:"post",

					success: function(resultado) {
						
						var resposta = (resultado.substring(0,6));
						
						switch (resposta){
							case "del_ok":
								retorno_usuario("del_sucesso");
								break;
								
							case "del_nr": 
								retorno_usuario("del_n_sucesso");
								break;

						}
					}

				});	
			}
		}) 	
	})
	
	
	$(document).on('click','#excluirFoto', function(){
		
		var id_animal  = $(this).data("animal");
		var nome_foto  = $(this).data("value");
		var cod_foto   = $(this).data("foto"); 
		var id_usuario = $(this).data("usuario"); 
		
		
		
		bootbox.confirm("<div><div><span class='glyphicon glyphicon-question-sign questao'></span><br><br><label class='msg_erro'>Deseja excluir este animal?</label></div></div>", function(result) {
			
			if(result ==true){					
				$.ajax({		  
				  url: "server/painel_animal.php?acao=deletar_foto&animal="+id_animal+"&nome_foto="+nome_foto+"&cod_foto="+cod_foto+"&usuario="+id_usuario,
				  type:"post",

					success: function(resultado) {
						
						var resposta = (resultado.substring(0,6));
						
						switch (resposta){
							case "del_ok":
								retorno_usuario("del_sucesso");
								break;
								
							case "del_nr": 
								retorno_usuario("del_n_sucesso");
								break;

						}
					}

				});	
			}
		}) 	
	})
	
	
	

})
	
	