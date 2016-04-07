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
			
//			itens = itens + itens;
//			itens = itens + itens;
//			itens = itens + itens;
			itens += "<script type='text/javascript'>aplicarPainacao();</script>";
			
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
				itens +="<div class='container' style='text-align:left;position:relative;margin:0 auto;width:800px;height:500px;border:0px solid;'>";				
				itens +="<hr>";
				itens +="<br \>";
				itens +="<ul class='nav nav-tabs'>";
				itens +="<li class='active'><a href='#tda1'>Sobre mim</a>";
				itens +="<li><a href='#tda2'>Características</a>";
				itens +="<li><a href='#tda3'>Contato</a>";
				itens +="</ul>";
				itens +="<div class='tab-content'>";				
				itens +="<div id='tda1' class='tab-pane fade in active'>";								
				itens +="<br />";				
				itens +="<p>Meu nome: "+v.NOM_ANIMAL+"</p>";				
				itens +="<p>Perfil: "+v.DESC_PERFIL+"</p>";				
				itens +="</div>";				
				itens +="<div id='tda2' class='tab-pane fade'>";							
				itens +="<br />";				
				itens +="<p>Idade: "+v.IDADE+" ano(s)</p>";				
				itens +="<p>Sexo : "+v.IND_SEXO+"</p>";								
				itens +="<p>Porte: "+v.IND_PORTE+"</p>";								
				itens +="</div>";								
				itens +="<div id='tda3' class='tab-pane fade'>";							
				itens +="<br />";				
				itens +="<p>ONG: "+v.NOM_USUARIO+"</p>";				
				itens +="<p>Telefone fixo: "+v.TELEFONE+"</p>";								
				itens +="<p>E-mail: "+v.EMAIL+"</p>";								
				itens +="</div>";								
				itens +="</div>";				
				itens +="</div>";
			});
			$(".loading-result").fadeOut(300).remove();;
			lista.html(itens);
		});
				
	   
	});	
	
	$(document).ready(function(){
	    $(".nav-tabs a").click(function(){
	        $(this).tab('show');
	    });
	});
	
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
    var show_per_page = 3;  
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
