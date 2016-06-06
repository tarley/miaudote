$(function(){
	
	/*#################################################CRUD USUARIO#######################################################*/
	$(document).on('click','#cadastrarUsuario , #editarUsuario', function(){

		var form_action = $(this).attr("id"); 
		
		var acao = "";
		
		var dados_form ="";
		
		var id = $(this).data("value");
		
		if(form_action =="cadastrarUsuario"){
			
			acao       = "cadastrar";
			dados_form = $('#novo-usuario').serialize();
			
		}else{
			
			acao       = "editar";
			dados_form = $('#edita-usuario'+id).serialize();
			
		}
	
		
		$.ajax({		  
		  url: "server/painel_ong.php?acao="+acao+"&id="+id,
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
					retorno_usuario('nr');//cadastro nao realizado
				break;	
			}
	
		}).error(function(event, request, settings){ // se der erro entra aqui		
			$(".ReturnUser").append('<li>Error requesting page' + settings.url +'</li>');		
		});
	})
	
	
	/*Excluir um usuario*/
	
	
	$(document).on('click','#excluirUsuario', function(){
		
		var id = $(this).data("link");
		
		bootbox.confirm("<div><div><span class='glyphicon glyphicon-question-sign questao'></span><br><br><label class='msg_erro'>Deseja excluir este usuário?  Todos os animais vinculados a ele também serão excluidos</label></div></div>", function(result) {
			
			if(result ==true){					
				$.ajax({		  
				  url: "server/painel_ong.php?acao=deletar&id="+id,
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