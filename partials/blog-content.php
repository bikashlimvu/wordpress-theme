<?php
/**
 * Blog content block
 */

$content = get_field( 'content' );
?>
<section class="content">
	<div class="content__container">
		<div class="content__row">
			<div class="content__text">
				<?php echo wp_kses_post( $content ); ?>
			</div>
		</div>
	</div>
</section>
