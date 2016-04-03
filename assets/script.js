 jQuery(document).ready(function($) {	 
	$(document).on('click','.scroll a, .navbar-brand, .gototop', function(event){ 
		/*Colocar um if verificando o valor do ID da tag <a ,se for o ID para criar a janela, deve se evitar o codigo abaixo, senao, pode executar */
	
		event.preventDefault();
		$('html,body').animate({scrollTop:$(this.hash).offset().top}, 600,'swing');
		$(".scroll li").removeClass('active');
		$(this).parents('li').toggleClass('active');
    });
	
});


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





