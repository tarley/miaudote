$(function(){
	
	$(document).on('click','#confirmarAdocao,#cancelarAdocao', function(){
		
		
		var form_action = $(this).attr("id"); 
		
		var acao = "";

		var dados_form ="";
		
		var id = $(this).data("value");
		
		if(form_action =="confirmarAdocao"){
			
			acao  = "confirmar";
			msg   ="Deseja confirmar o processo de adoção deste animal?";
			
		}else{
			
			acao  = "cancelar";
			msg   = "Deseja cancelar o processo de adoção deste animal?";
				
		}
		
		var id_animal = $(this).data("animal");
		var id_usuario = $(this).data("usuario");
		
		bootbox.confirm("<div><div><span class='glyphicon glyphicon-question-sign questao'></span><br><br><label class='msg_erro'>"+msg+"</label></div></div>", function(result) {
			
			if(result == true){					
				$.ajax({		  
				  url: "server/painel_adocao.php?acao="+acao+"&id="+id_animal+"&usuario="+id_usuario,
				  type:"post",

					success: function(resultado) {
											
						var resposta = (resultado.replace(/^\s+|\s+$/g,""));
						
						switch (resposta){
							case "confirmacao_ok":
								
								bootbox.dialog({
								  message: "<div><label class='msg_sucess'>Confirmação do processo de adoção realizada com sucesso !!!</label></div>",
								  title: "<span class='glyphicon glyphicon-ok-sign sucesso'></span>",
								  buttons: {
									main: {
									  label: "OK",
									  className: "btn-primary",
									  callback: function() {
										close();
									  }
									}
								  }
								});
								break;
								
							case "cancelamento_ok": 
							
								bootbox.dialog({
								  message: "<div><label class='msg_sucess'>Cancelamento do processo de adoção realizado com sucesso !!!</label></div>",
								  title: "<span class='glyphicon glyphicon-ok-sign sucesso'></span>",
								  buttons: {
									main: {
									  label: "OK",
									  className: "btn-primary",
									  callback: function() {
										close();
									  }
									}
								  }
								});
								break;
							
							case "confirmacao_n_ok":
								
								bootbox.dialog({
								message: "<div><label class='msg_erro'>A confirmação do processo de adoção não pôde ser realizada !!</label></div>",
									title: "<span class='glyphicon glyphicon-remove-sign erro'></span>",
									buttons: {
										main: {
										  label: "OK",
										  className: "btn-primary",
										  callback: function() {
											close();
										  }
										}
									}
								});
														
								break;
							
							case "cancelamento_n_ok":
							
								bootbox.dialog({
									message: "<div><label class='msg_erro'>O cancelamento do processo de adoção nao pôde ser realizado!!</label></div>",
										title: "<span class='glyphicon glyphicon-remove-sign erro'></span>",
										buttons: {
											main: {
											  label: "OK",
											  className: "btn-primary",
											  callback: function() {
												close();
											  }
											}
										}
								});
							break;

						}
					}

				});	
			}
		}) 	
	})
})