$(document).ready(function(){
	$('.porcentagem').hide();
	$(document).on('click','#enviarFoto', function(){
		$('#formUpload').ajaxForm({
			uploadProgress: function(event,position,total,percentComplete){
				var tam_foto = total/1000000;
				if(tam_foto <=50){
					$('.porcentagem').show();
					$('.porcentagem span.valor').css({
						width:percentComplete+'%'
					});
					$('.porcentagem span.valor').html(percentComplete+'%')
				}
			},
			success:function(data){
				$('.porcentagem span.valor').css({
					'background':'#00cc00'
				});
				
				$('.mensagens p').html(data-msg);
				
			},
			error: function(){
				$('.mensagens p').html('Não foi possivel enviar seu arquivo');
				
			},
			dataType:'json',
			url:'upload_file.php',
			resetForm:true
		}).submit();
		
	})
})