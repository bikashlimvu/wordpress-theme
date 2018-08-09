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

	$( '.wpcf7-form-control' ).on( 'keyup', function() {
		if( $(this).val() ) {
			var target = $(this).parents('.form-field').children('.input-label');
			$(target).addClass('not-empty');
		} else {
			var target = $(this).parents('.form-field').children('.input-label');
			$(target).removeClass('not-empty');
		}
	});

	$( '.wpcf7-form-control' ).on( 'focusin', function() {
		var target = $(this).parents('.form-field').children('.input-label');
		$(target).addClass('not-empty');
	});

	$( '.wpcf7-form-control' ).on( 'focusout', function() {
		var target = $(this).parents('.form-field').children('.input-label');
		$(target).removeClass('not-empty');
	});

});
