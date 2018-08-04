$( document ).ready(function() {
	//Typed text effect
	var typed = new Typed('.hero-typed-text', {
		stringsElement: '.hero-text',
		typeSpeed: 40
	});

	//Mouse scroll effect on hero banner
	$('.mouse-scroll').click(function(){
		$('html, body').animate({
		scrollTop: $("#about-me").offset().top
	}, 1000);
	});

});
