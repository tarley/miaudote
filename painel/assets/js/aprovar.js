$(function(){
	
	$(document).on('click','#aprovarAnimal,#reprovarAnimal', function(){
		
		
		var form_action = $(this).attr("id"); 
		
		var acao = "";
		
		var dados_form ="";
		
		var id = $(this).data("value");
		
		if(form_action =="aprovarAnimal"){
			
			acao  = "aprovar";
			msg   ="Deseja aprovar este animal?";
			
		}else{
			
			acao  = "reprovar";
			msg   = "Deseja reprovar este animal? todos os dados vinculados ao mesmo serão excluidos";
				
		}
		
		var id_animal = $(this).data("animal");
		var id_usuario = $(this).data("usuario");
		
		bootbox.confirm("<div><div><span class='glyphicon glyphicon-question-sign questao'></span><br><br><label class='msg_erro'>"+msg+"</label></div></div>", function(result) {
			
			if(result == true){					
				$.ajax({		  
				  url: "server/painel_aprovacao.php?acao="+acao+"&id="+id_animal+"&usuario="+id_usuario,
				  type:"post",

					success: function(resultado) {
											
						var resposta = (resultado.replace(/^\s+|\s+$/g,""));
						
						switch (resposta){
							case "aprovacao_ok":
								
								bootbox.dialog({
								  message: "<div><label class='msg_sucess'>Aprovação realizada com sucesso !!!</label></div>",
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
								
								location.reload();
								break;
								
							case "reprovacao_ok": 
							
								bootbox.dialog({
								  message: "<div><label class='msg_sucess'>Reprovação realizada com sucesso !!!</label></div>",
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
								
								location.reload();
								break;
								
							
							case "aprovacao_n_ok":
								
								bootbox.dialog({
								message: "<div><label class='msg_erro'>Aprovação nao pode ser realizada !!</label></div>",
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
							
							case "reprovacao_n_ok":
							
								bootbox.dialog({
									message: "<div><label class='msg_erro'>Reprovacao não pode ser realizada !!</label></div>",
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