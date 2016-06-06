
function retorno_usuario(tipoRetorno){
	

	if(tipoRetorno =='sucesso'){
		bootbox.dialog({
		  message: "<div><label class='msg_sucess'>Dados salvos com sucesso</label></div>",
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
		
		
	}else if(tipoRetorno=='alerta'){
		bootbox.dialog({
		  message: "<div><label class='msg_sucess'>Cadastro realizado com sucesso</label></div>",
		  title: "<span class='glyphicon glyphicon-alert alerta'></span>",
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
	}else if (tipoRetorno=='erro'){
		bootbox.dialog({
		  message: "<div><label class='msg_erro'>Cadastro realizado com sucesso</label></div>",
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
	}else if (tipoRetorno=='nc'){
		bootbox.dialog({
		  message: "<div><label class='msg_erro'>Dados não foram salvos</label></div>",
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
	}else if (tipoRetorno=='del_sucesso'){
		bootbox.dialog({
		  message: "<div><label class='msg_erro'>Exclusão realizada com sucesso</label></div>",
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
	}else if (tipoRetorno=='del_n_sucesso'){
		bootbox.dialog({
		  message: "<div><label class='msg_erro'>Exclusão nao pode ser realizada</label></div>",
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
	}
}

	
	

$(document).on('change','#estado', function(){	
	
	var cod_estado = $("#estado option:selected").val();
	
	if( cod_estado) {			
		
		$.ajax({		  
		  url: "server/public_server.php?acao=getCidade&cod_estado="+cod_estado,
		  type:"post",
			success: function(options) {
				var a = options;
				$('#cidade').html(options).show();
				
			}
		});

		
	} else {
		$('#cidade').html('<option value="">-- Escolha um estado --</option>');
	}
	
});

$(document).on('change','.fileupload', function(){
	
	var id = $(this).attr('name');
		
	var url = window.location.hostname === 'blueimp.github.io' ?
                '//jquery-file-upload.appspot.com/' : 'server/php/';
    $('#fileupload').fileupload({
        url: url,
        dataType: 'json',
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
                $('<p/>').text(file.name).appendTo(id);
            });
        },
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress .progress-bar').css(
                'width',
                progress + '%'
            );
        }
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
});





