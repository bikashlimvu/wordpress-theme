<?php
$form_style = false;
$form_id    = 's';
if ( isset( $args['style'] ) && ! empty( $args['style'] ) ) {
	$form_style = 'search-form--sidebar';
	$form_id    = 'search';
}
?>
<form role="search" method="get" class="search-form <?php echo esc_attr( $form_style ); ?>" action="<?php echo esc_attr( home_url( '/' ) ); ?>">
	<div>
		<label for="<?php echo esc_attr( $form_id ); ?>" class="sr-only">Search Form</label>
		<input type="search" id="<?php echo esc_attr( $form_id ); ?>" name="<?php echo esc_attr( $form_id ); ?>" placeholder="Search" value="<?php echo get_search_query(); ?>"/>
		<button type="submit"><span class="sr-only">Search</span></button>
	</div>
</form>
