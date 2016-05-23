 jQuery(document).ready(function($) {	 
	$(document).on('click','.scroll a, .navbar-brand, .gototop', function(event){ 
		var id = $(this).data("toggle");
		if(id!="ignoreScroll"){
			if(id!="tab"){
				event.preventDefault();
				$('html,body').animate({scrollTop:$(this.hash).offset().top}, 800);
				$("li").removeClass('active');
				$(this).parents('li').toggleClass('active');
				
				history_link($(this).attr("href"),$(this).attr("id"));	
			}
		}
	 });
  });
	

$(function history_link(href,pagina) {

	
	window.onpopstate = function(event) {

		console.log("pathname: "+location.pathname.search);
		retornar = location.search.substr(6); //Pagina que ira ser carregada
		
		/*Neste trecho, é preciso saber se a url de destino é da pagina de perfil,
		se for, é necessario extrair o id do animal (funcao slice) e utiliza-lo na funcao loadContent para montar o link corretamente*/
		if(retornar.match(/perfil/)){ 
			id_perfil = retornar.slice(10);
			retornar  = retornar.slice(0,6);
		}else{
			id_perfil = "";
		}
		loadContent(retornar,id_perfil);

	};

});


function history_link(href,pagina){
	loadContent(pagina,"");
	history.pushState('','New URL: '+href, href/* este segundo href nao veio de uma variavel*/);
	
}

function loadContent(pagina,id){
	
 
	if(pagina =="perfil"){
		$('#conteudo-sub').fadeIn(500).load(pagina+'.php?&id='+id+'#conteudo');
	}else{
		$('#conteudo-sub').fadeIn(500).load(pagina+'.php');
	}
	
	$('li').removeClass('current');
	$('a[href="index.php?page='+pagina+'"]').parent().addClass('current');
	
}


var wow = new WOW(
  {
    boxClass:     'wowload',   // animated element css class (default is wow)
    animateClass: 'animated', // animation css class (default is animated)
    offset:       0,          // distance to the element when triggering the animation (default is 0)
    mobile:       true,       // trigger animations on mobile devices (default is true)
    live:         true        // act on asynchronously loaded content (default is true)
  }
);
wow.init();


$('.carousel').swipe( {
     swipeLeft: function() {
         $(this).carousel('next');
     },
     swipeRight: function() {
         $(this).carousel('prev');
     },
     allowPageScroll: 'vertical'
 });





