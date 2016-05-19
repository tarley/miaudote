$(function(){
	

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
				itens+="<div id='perfilAnimal'>"
				itens +="<div class='drop-shadow lifted' style='position:relative;margin:0 auto;width:800px;min-height:500px;border:0px solid;background-image: url(images/fundo-pata.jpg');>";
				itens +="<div id='closePerfil'style='margin-top:20px;float:right;height:30px;width:10%;cursor:pointer'>";
				itens +="<a href='#filtro-menu'><span>Ir a Busca</span></div></a>";
				//itens +="<img class='img-responsive' alt='' id='details-img'src='images/profile/user_1/pet_"+v.COD_ANIMAL+"/book/"+v.NOM_FOTO+".jpg'/>";
				itens +="<img class='img-responsive' alt='' id='details-img' src='"+v.URL+"'  style='max-width:120px;max-height:120px;' />";
				itens +="</div>";
				itens +="<div style='text-align:left;position:relative;margin:0 auto;width:800px;margin-top:20px;height:350px;border:0px solid;'>";
				itens +="<hr>";
				itens +="<br>";
				itens +="<h4>Sobre mim</h4>"
				itens +="<p>"+v.NOM_ANIMAL+"</p>";
				itens +="<p>";
				itens +=v.DESC_PERFIL;
				itens +="</p>";
				itens +="<br>";
				itens +="<h4>Caracteristicas</h4>";
				itens +="<br>";
				itens +="<ul>";
				itens +="<li>Idade: "+v.IDADE+" ano(s) </li>";
				itens +="<li>Sexo : "+v.IND_SEXO+"  </li>";
				itens +="<li>Porte: "+v.IND_PORTE+"</li>";
				itens +="</ul>";
				itens +="<br>";
				itens +="<h4>Contato</h4>";
				itens +="<ul>";	
				itens +="<li>ONG: "+v.NOM_USUARIO+" </li>";
				itens +="<li>Telefone fixo: "+v.TELEFONE+" </li>";
				itens +="<li>E-mail: "+v.EMAIL+" </li>";
				itens +="</ul>";
				itens +="<hr>"
				itens +="</div>";
				itens +="</div>";
			});
			$(".loading-result").fadeOut(300).remove();
			lista.html(itens);
		});
	});	
	
	
	
	$(document).on('click','#animal-filtro', function(){			
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
				itens+="<div id='perfilAnimal'>"
				itens +="<div class='drop-shadow lifted' style='position:relative;margin:0 auto;width:800px;min-height:500px;border:0px solid;background-image: url(images/fundo-pata.jpg');>";
				itens +="<div id='closePerfil'style='margin-top:20px;float:right;height:30px;width:10%;cursor:pointer'>";
				itens +="<a href='#filtro-menu'><span>Ir a Busca</span></div></a>";
				//itens +="<img class='img-responsive' alt='' id='details-img'src='images/profile/user_1/pet_"+v.COD_ANIMAL+"/book/"+v.NOM_FOTO+".jpg'/>";
				itens +="<img class='img-responsive' alt='' id='details-img' src='"+v.URL+"'  style='max-width:120px;max-height:120px;'/>";
				itens +="</div>";
				itens +="<div style='text-align:left;position:relative;margin:0 auto;width:800px;margin-top:20px;height:350px;border:0px solid;'>";
				itens +="<hr>";
				itens +="<br>";
				itens +="<h4>Sobre mim</h4>"
				itens +="<p>"+v.NOM_ANIMAL+"</p>";
				itens +="<p>";
				itens +=v.DESC_PERFIL;
				itens +="</p>";
				itens +="<br>";
				itens +="<h4>Caracteristicas</h4>";
				itens +="<br>";
				itens +="<ul>";
				itens +="<li>Idade: "+v.IDADE+" ano(s) </li>";
				itens +="<li>Sexo : "+v.IND_SEXO+"  </li>";
				itens +="<li>Porte: "+v.IND_PORTE+"</li>";
				itens +="</ul>";
				itens +="<br>";
				itens +="<h4>Contato</h4>";
				itens +="<ul>";	
				itens +="<li>ONG: "+v.NOM_USUARIO+" </li>";
				itens +="<li>Telefone fixo: "+v.TELEFONE+" </li>";
				itens +="<li>E-mail: "+v.EMAIL+" </li>";
				itens +="</ul>";
				itens +="<hr>"
				itens +="</div>";
				itens +="</div>";
			});
			$(".loading-result").fadeOut(300).remove();
			lista.html(itens);
		});
	});	

	// Classe do menu do topo
	$('.menu-topo').click(function(){		
		//$('#master').fadeOut(500);
	});
	
	// A��o do bot�o in�cio
	$('#menu-topo-inicio').click(function(){
		$('#master').fadeOut(500);
	});
	
	// A��o do bot�o quem somos
	$('#menu-topo-quem-somos').click(function(){
		$('#master').fadeIn(500).load('assets/php/util.php?acao=getPagina&pagina=quem-somos');
	});
	
	// A��o do bot�o adote um animal
	$('#menu-topo-adote-um-animal').click(function(){
		$('#master').fadeIn(500).load('assets/php/util.php?acao=getPagina&pagina=adote-um-animal');
	});
	
	$(document).on('click','#animal-filtro', function(){
		$('#conteudo-sub').fadeIn(1000).load('perfil.php?id='+$(this).data("value"));
		window.history.pushState( location.href, "Perfil",'index.php?page=perfil&id='+$(this).data("value"));
		document.title = "Miaudote | Perfil";
		
	})
	
	
});


$(document).on('change','#cod_estado', function(){	
		
	var cod_estado = $("#cod_estado option:selected").val();
	if( cod_estado) {
		$('.carregando').show();
		$.getJSON('assets/php/util.php?acao=getCidade&cod_estado='+cod_estado, function(j){
			var options = '<option value=""></option>';	
			for (var i = 0; i < j.length; i++) {
				options += '<option value=".'  + j[i].nom_cidade +  '">' + j[i].nom_cidade + '</option>';
			}	
			$('#cod_cidade').html(options).show();
			$('.carregando').hide();
		});
	} else {
		$('#cod_cidade').html('<option value="">-- Escolha um estado --</option>');
	}
		
});

function previous(){  
	  
    new_page = parseInt($('#current_page').val()) - 1;  
    //if there is an item before the current active link run the function  
    if($('.active_page').prev('.page_link').length==true){  
        go_to_page(new_page);  
    }  
  
}  
  
function next(){  
    new_page = parseInt($('#current_page').val()) + 1;  
    //if there is an item after the current active link run the function  
    if($('.active_page').next('.page_link').length==true){  
        go_to_page(new_page);  
    }  
  
}  
function go_to_page(page_num){  
    //get the number of items shown per page  
    var show_per_page = parseInt($('#show_per_page').val());  
  
    //get the element number where to start the slice from  
    start_from = page_num * show_per_page;  
  
    //get the element number where to end the slice  
    end_on = start_from + show_per_page;  
  
    //hide all children elements of content div, get specific items and show them  
    $('#galery-image').children().css('display', 'none').slice(start_from, end_on).css('display', 'block');  
  
    /*get the page link that has longdesc attribute of the current page and add active_page class to it 
    and remove that class from previously active page link*/  
    $('.page_link[longdesc=' + page_num +']').addClass('active_page').siblings('.active_page').removeClass('active_page');  
  
    //update the current page input field  
    $('#current_page').val(page_num);  
} 

function aplicarPainacao() {
	//how much items per page to show  
    var show_per_page = 9;  
    //getting the amount of elements inside content div  
    var number_of_items = $('#galery-image').children().size();  
    //calculate the number of pages we are going to have  
    var number_of_pages = Math.ceil(number_of_items/show_per_page);  
  
    //set the value of our hidden input fields  
    $('#current_page').val(0);  
    $('#show_per_page').val(show_per_page);  
  
    //now when we got all we need for the navigation let's make it '  
  
    /* 
    what are we going to have in the navigation? 
        - link to previous page 
        - links to specific pages 
        - link to next page 
    */  
    var navigation_html = '<a class="previous_link" href="javascript:previous();">Prev</a>&nbsp;';  
    var current_link = 0;  
    while((number_of_pages - 1) > current_link){  
        navigation_html += '<a class="page_link" href="javascript:go_to_page(' + current_link +')" longdesc="' + current_link +'">'+ (current_link + 1) +'</a>&nbsp;';  
        current_link++;  
    }  
    navigation_html += '<a class="next_link" href="javascript:next();">Next</a>';  
  
    $('#page_navigation').html(navigation_html);  
  
    //add active_page class to the first page link  
    $('#page_navigation .page_link:first').addClass('active_page');  
  
    //hide all the elements inside content div  
    $('#galery-image').children().css('display', 'none');  
  
    //and show the first n (show_per_page) elements  
    $('#galery-image').children().slice(0, show_per_page).css('display', 'block');
	
}
