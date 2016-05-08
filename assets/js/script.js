 jQuery(document).ready(function($) {	 
	$(document).on('click','.scroll a, .navbar-brand, .gototop', function(event){ 
		var id = $(this).data("toggle");
		if(id!="ignoreScroll"){
			if(id!="tab"){
				event.preventDefault();
				$('html,body').animate({scrollTop:$(this.hash).offset().top}, 800);
				$("li").removeClass('active');
				$(this).parents('li').toggleClass('active');
			}
		}
	 });
  });
	




$(function() {
	$('.navigation a ').click(function(e) {

		href = $(this).attr("href");
		pagina = $(this).attr("id");
		
		loadContent(pagina,"avancar");
		

		history.pushState('','New URL: '+href, href);
		e.preventDefault();
	});
	
	window.onpopstate = function(event) {

		console.log("pathname: "+location.pathname.search);
		retornar = location.search.substr(6);
		loadContent(retornar,"voltar");
	};

});

function loadContent(pagina,destino){
	
	if(destino =="avancar"){
		$('#conteudo-sub').fadeIn(1000).load(pagina+'.php');
	}else{
		$('#conteudo-sub').fadeIn(1000).load(pagina+'.php');
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





