<?php
/**
 * Hero Slider
 * 
 ** This module requires ACF plugin **
 ** Note: This module can also be converted to a static slider by removing code for ACF ** 
 *
 */
?>

<section class="hero-image">
	<div class="hero-image__container">
		<div class="hero-image__slider js-slider">
			<ul class="hero-image__slider--track js-slider--track"
				aria-live="polite">
				<?php
				$use_slider_overlay = get_field( 'use_slider_overlay' );
				$overlay_colour     = get_field( 'overlay_colour' );

				if ( have_rows( 'image_slider' ) ) :
					while ( have_rows( 'image_slider' ) ) :
						the_row();
						$layout  = get_sub_field( 'layout' );
						$img     = get_sub_field( 'image' );
						$imgDesk = $img['sizes']['hero-slider'];
						$imgMob  = $img['sizes']['hero-slider-mobile'];
						$imgAlt  = isset( $img['alt'] ) ? $img['alt'] : '';
						?>
						<li class="hero-image__slider--slide"
							aria-roledescription="slide">
							<img class="desktop lazy-image" alt="<?php echo esc_attr( $imgAlt ); ?>"
								src="<?php echo esc_url( $imgDesk ); ?>">
							<img class="mobile lazy-image" alt="<?php echo esc_attr( $imgAlt ); ?>"
								src="<?php echo esc_url( $imgMob ); ?>">
							<div class="hero-image__slider--content hero-image__slider--<?php echo esc_attr( $layout ); ?>">
								<div class="hero-image__slider--layout">
									<div class="hero-image__slider--text">
										<?php
										$slider_header = get_sub_field( 'slider_header' );
										$slider_text   = get_sub_field( 'slider_text' );
										$slider_button = get_sub_field( 'slider_button' );
										?>
										<h1><?php echo esc_html( $slider_header ); ?></h1>
										<?php
										if ( $slider_text ) :
											?>
											<?php echo wp_kses_post( wpautop( $slider_text ) ); ?>
											<?php
										endif;

										if ( $slider_button ) :
											$link_url    = $slider_button['url'];
											$link_title  = $slider_button['title'];
											$link_target = $slider_button['target'] ? $slider_button['target'] : '_self';
											?>
											<a class="button" href="<?php echo esc_url( $link_url ); ?>"
											   target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
											<?php
										endif;
										?>
									</div>
								</div>
							</div>
							<?php if ( $use_slider_overlay ) : ?>
								<div class="hero-image__slider__bg-layer" style="background-color: <?php echo esc_attr( $overlay_colour ); ?>"></div>
							<?php endif; ?>
						</li>
						<?php
					endwhile;
				endif;
				?>
			</ul>
		</div>
		<div class="hero-image__slider--dots">
			<?php
			if ( have_rows( 'image_slider' ) ) :
				$i = 0;
				while ( have_rows( 'image_slider' ) ) :
					the_row();
					?>
					<span class="hero-image__slider--dot js-slider--dot" data-value="<?php echo esc_attr( $i ); ?>"></span>
					<?php
					$i ++;
				endwhile;
			endif;
			?>
		</div>

	</div>
</section>
