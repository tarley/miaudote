$(function(){
	jQuery(document).ready(function(){
		var acao;
		var galery = $("#galery");
		var lista = galery.find("#galery-image");
		var itens="";
		
		$.getJSON('assets/php/util.php?acao=getDestaque',function(data){
			$.each(data,function(k,v){
				itens += "<figure id ='perfil' class='effect-oscar wowload fadeIn '>";
				itens +="<img src='images/profile/user_1/pet_"+v.COD_ANIMAL+"/book/"+v.NOM_FOTO+".jpg' />";
				itens += "<figcaption>";
				itens += "<h2>"+v.NOM_ANIMAL+"</h2>";
				itens += "<p>"+v.DESC_ANIMAL+"</br>";
				itens += "<a id='getPerfil' href='#search' data-value='"+v.COD_ANIMAL+"'class='scrollDinamic' >Ver perfil</a></p>";
				itens += "</figcaption>";
				itens += "</figure>";			
			});
			lista.html(itens);
		});
	})
	
	$(document).on('click','#getPerfil', function(){		
				
		var cod_animal = $(this).data("value");
		var galery = $("#search");
		var lista = galery.find("#resultSearch");
		var itens="";
		
		
		$.getJSON('assets/php/util.php?acao=getPerfil&cod_animal='+cod_animal,function(data){
			$.each(data,function(k,v){

				itens +="<div class='drop-shadow lifted' style='position:relative;margin:0 auto;width:800px;height:500px;border:0px solid;background-image: url(images/fundo-pata.jpg');>";
				itens +="<img id='details-img'src='images/profile/user_1/pet_"+v.COD_ANIMAL+"/book/"+v.NOM_FOTO+".jpg'/>";
				itens +="</div>";

				/*##########################################*/
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
				itens +="<li>Telefone fixo:"+v.TELEFONE+"</li>";
				itens +="</ul>";
				itens +="<hr>"
				itens +="</div>";
				/*##############################################*/
			});
			lista.html(itens);
		});	
				 
	});

});


