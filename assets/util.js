$(function(){
	
	jQuery(document).ready(function(){
		var acao;
		var galery = $("#galery");
		var lista = galery.find("#galery-image");
		var itens="";
		
				
		$.getJSON('assets/php/util.php?acao=getDestaque',function(data){
			if(data== 0){
				itens+="<div class='empty-destaque'><img  src='images/cao-triste.png' class='img-responsive'></div>";	
			}else{
				$.each(data,function(k,v){
					itens += "<figure id ='perfil' class='effect-oscar wowload fadeIn'>";
					itens +="<img src='images/profile/user_1/pet_"+v.COD_ANIMAL+"/book/"+v.NOM_FOTO+".jpg' />";
					itens += "<figcaption>";
					itens += "<h2>"+v.NOM_ANIMAL+"</h2>";
					itens += "<p>"+v.DESC_ANIMAL+"</br>";
					itens += "<a href='#search' id='getPerfil' data-value='"+v.COD_ANIMAL+"' class='scroll' >Ver perfil</a></p>";
					itens += "</figcaption>";
					itens += "</figure>";			
				});	
			}
			lista.html(itens);
		});
	})
	
	
	$(document).on('click','#getPerfil', function(){		
				
		var cod_animal = $(this).data("value");
		var galery = $("#search");
		var lista = galery.find("#result-search");
		var itens="";
		
		
		if ($("#result-search").length ) { /*Verifica se existe algum perfil ou informação exibida na div de resultado, se houver ele remove para que digamos, se reinicie o processo a partir do click*/
			$("#result-search").empty();
		}
		
		$("#result-search").append("<div class='loading-result'><img src='images/a1-cao-correndo.gif'><br><br>&nbsp;&nbsp;&nbsp;&nbsp;<img src='images/a2-aguarde.gif'> </div>");
		
				
		$.getJSON('assets/php/util.php?acao=getPerfil&cod_animal='+cod_animal,function(data){
			$.each(data,function(k,v){

				itens +="<div class='drop-shadow lifted' style='position:relative;margin:0 auto;width:800px;height:500px;border:0px solid;background-image: url(images/fundo-pata.jpg');>";
				itens +="<img id='details-img'src='images/profile/user_1/pet_"+v.COD_ANIMAL+"/book/"+v.NOM_FOTO+".jpg'/>";
				itens +="</div>";
				itens +="<div style='text-align:left;position:relative;margin:0 auto;width:800px;height:500px;border:0px solid;'>";
				itens +="<hr>";
				itens +="<h4>Sobre mim</h4>"
				itens +="<p>"+v.NOM_ANIMAL+"</p>";
				itens +="<p>";
				itens +=v.DESC_PERFIL;
				itens +="</p>";
				itens +="<h4>Caracteristicas</h4>";
				itens +="<ul>";
				itens +="<li>Idade: "+v.IDADE+" ano(s) </li>";
				itens +="<li>Sexo : "+v.IND_SEXO+"  </li>";
				itens +="<li>Porte: "+v.IND_PORTE+"</li>";
				itens +="</ul>";
				itens +="<h4>Contato</h4>";
				itens +="<ul>";	
				itens +="<li>ONG: "+v.NOM_USUARIO+" </li>";
				itens +="<li>Telefone fixo: "+v.TELEFONE+" </li>";
				itens +="<li>E-mail: "+v.EMAIL+" </li>";
				itens +="</ul>";
				itens +="<hr>"
				itens +="</div>";
			});
			$(".loading-result").fadeOut(300).remove();;
			lista.html(itens);
		});
				
	   
	});	
});


