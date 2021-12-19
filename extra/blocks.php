<?php
/**
 * * Register Blocks
 * @see https://www.billerickson.net/building-gutenberg-block-acf/#register-block
 *
 * @param $categories
 * @return array
 */
function custom_block_category( $categories ) {
	return array_merge(
		$categories,
		array(
			array(
				'slug'  => 'content',
				'title' => __( 'Content', 'content' ),
			),
		)
	);
}
add_filter( 'block_categories', 'custom_block_category', 10, 2 );

function custom_register_blocks() {

	if ( ! function_exists( 'acf_register_block' ) ) {
		return;
	}

	acf_register_block(
		array(
			'name'            => 'content',
			'title'           => __( 'Content' ),
			'render_template' => 'partials/content.php',
			'category'        => 'content',
			'icon'            => 'format-video',
			'mode'            => 'edit',
			'keywords'        => array( 'content' ),
		)
	);

	acf_register_block(
		array(
			'name'            => 'hero slider',
			'title'           => __( 'Hero Slider' ),
			'render_template' => 'partials/hero-slider.php',
			'category'        => 'content',
			'icon'            => 'format-image',
			'mode'            => 'edit',
			'keywords'        => array( 'content' ),
		)
	);
}

add_action( 'acf/init', 'custom_register_blocks', 10, 2 );

function custom_gutenberg_blocks( $post_type ) {
	$blocks_array = array(
		'core/block', // <!-- Needed for reusable Blocks -->
		'acf/hero-slider',
	);

	global $post;
	if ( 'post' !== $post->post_type ) {
		array_push( $blocks_array, 'acf/content' );
	}

	return $blocks_array;
}
add_filter( 'allowed_block_types', 'custom_gutenberg_blocks' );
