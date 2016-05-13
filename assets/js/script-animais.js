$(document).ready(function(){
	
	//alert('');
	// interação na busca do site
	$('#estado').change(function(){
		if( $(this).val() ) {
		
			$('#cidade').html('<option value="">Carregando...</option>').attr('readonly','readonly');	
			
			var vlw 	=	$(this).val();
			
			if(vlw !=''){
				$.getJSON('../assets/php/aja_busca_dados.php',{estado: $(this).val(), ajax: 'true', tipo: 'cidade'}, function(j){
				
					if(j!=null){
						var options = '<option value="">-- Informe a cidade --</option>';	
						for (var i = 0; i < j.length; i++) {
							options += '<option value="' + j[i].id_cidade + '">' + j[i].cidade + '</option>';
						}	
						$('#cidade').html(options).attr('readonly',false);	
					}else{
						$('#cidade').html('<option value="">Nenhuma cidade encontrada para este estado!</option>').attr('readonly',false);	
					}
				});
			}
				
		} else {
			$('#cidade').html('<option value="">-- Informe a cidade --</option>').attr('readonly',false);
		}
	});
	
	
});