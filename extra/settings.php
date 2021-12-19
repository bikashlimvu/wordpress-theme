<?php
if ( ! function_exists( 'get_manifest_asset' ) ) :
	/**
	 * Serve theme styles via a hashed filename instead of WordPress' default style.css.
	 *
	 * Checks for a hashed filename as a value in a JSON object.
	 * If it exists: the hashed filename is enqueued in place of style.css.
	 * Fallback: the default style.css will be passed through.
	 *
	 * @param string $asset is WordPress’ required, known location for CSS: style.css
	 * @return string The asset manifest file
	 */
	function custom_get_manifest_asset( $asset ) {
		$map          = get_template_directory() . '/dist/manifest.json';
		$manifest_obj = new SplFileObject( $map );
		if ( $manifest_obj->isFile() ) {
			$manifest_json = $manifest_obj->fread( $manifest_obj->getSize() );
			$manifest      = json_decode( $manifest_json, true );
			if ( is_array( $manifest ) && isset( $manifest[ $asset ] ) ) {
				return $manifest[ $asset ];
			}
		}
		return $asset;
	}
endif;

/*********************
 * SCRIPTS & ENQUEUEING
 *********************/
function custom_scripts_and_styles() {

	global $wp_styles; // call global $wp_styles variable to add conditional wrapper around ie stylesheet the WordPress way

	if ( ! is_admin() ) {
		// deregister jquery
		wp_deregister_script( 'jquery' );

		// register main stylesheet
		wp_register_style( 'custom-stylesheet', get_template_directory_uri() . '/dist/' . custom_get_manifest_asset( 'main.css' ), array(), 1.0, 'all' );
		wp_enqueue_script( 'bundle', get_stylesheet_directory_uri() . '/dist/' . custom_get_manifest_asset( 'main.js' ), '', 1.0, true );

		wp_enqueue_style( 'custom-stylesheet' );

		// register global Contact Form 7 Assets only when required
		if ( function_exists( 'wpcf7_enqueue_scripts' ) ) {
			wpcf7_enqueue_scripts();
		}
		if ( function_exists( 'wpcf7_enqueue_styles' ) ) {
			function wpcf7_enqueue_styles_footer() {
				wp_enqueue_style(
					'contact-form-7',
					wpcf7_plugin_url( 'includes/css/styles.css' ),
					array(),
					WPCF7_VERSION,
					'all'
				);
			}
			add_action( 'get_footer', 'wpcf7_enqueue_styles_footer' );
		}
	}
}

function custom_image_sizes() {
	// Image Size
	add_image_size( 'image-size', 400, 400, array( 'center', 'center' ) );
}

function page_navi() {
	global $wp_query;
	$bignum = 999999999;
	if ( $wp_query->max_num_pages <= 1 ) {
		return;
	}
	echo '<nav class="pagination">';
	echo paginate_links(
		array(
			'base'      => str_replace( $bignum, '%#%', esc_url( get_pagenum_link( $bignum ) ) ),
			'format'    => '',
			'current'   => max( 1, get_query_var( 'paged' ) ),
			'total'     => $wp_query->max_num_pages,
			'prev_text' => '&larr;',
			'next_text' => '&rarr;',
			'type'      => 'list',
			'end_size'  => 3,
			'mid_size'  => 3,
		)
	);
	echo '</nav>';
}

/**
 * Check if the page is a child page or has children
 * @return bool
 */
function custom_check_page_children() {
	global $post;
	if ( $post ) {
		$children = get_pages( array( 'child_of' => $post->ID ) );
		return ( is_page() && $post->post_parent || is_page() && count( $children ) > 0 );
	}

	return false;
}


/**
 * @param $block_name
 * @return bool
 */
function custom_check_blocks( $block_name ) {
	$post = get_post();

	if ( $post && has_blocks( $post->post_content ) ) {
		$blocks = parse_blocks( $post->post_content );

		return $blocks[0]['blockName'] === $block_name;
	}

	return false;
}
