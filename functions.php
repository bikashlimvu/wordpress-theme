<?php
require_once 'extra/settings.php';
require_once 'extra/cpt.php';
require_once 'extra/blocks.php';
require_once 'extra/dynamic-acf-select.php';

function theme_init() {
	// enqueue base scripts and styles
	add_action( 'wp_enqueue_scripts', 'custom_scripts_and_styles', 999 );

	custom_image_sizes();
}

// let's get this party started
add_action( 'after_setup_theme', 'theme_init' );

/**
 * Custom functions
 */
register_nav_menus(
	array(
		'top_links' => 'Top Links',
	)
);
