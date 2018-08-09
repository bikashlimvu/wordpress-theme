<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:


// if ( !function_exists( 'chld_thm_cfg_parent_css' ) ):
//     function chld_thm_cfg_parent_css() {
//         wp_enqueue_style( 'chld_thm_cfg_parent', trailingslashit( get_template_directory_uri() ) . 'style.css', array(  ) );
//
//     }
// endif;
// add_action( 'wp_enqueue_scripts', 'chld_thm_cfg_parent_css', 10 );

function theme_stylesheet() {
    wp_enqueue_style( 'theme-stylesheet', get_template_directory_uri() .'/css/site.css');
}

add_action( 'wp_enqueue_scripts', 'theme_stylesheet' );

// END ENQUEUE PARENT ACTION

function theme_scripts()
{
    // Register the script like this for a theme:
    wp_register_script( 'script', get_template_directory_uri() . '/js/dependencies/typed.min.js' );
    wp_deregister_script('jquery');
	// wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js', array(), null, true);
    wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js", false, null);
   wp_enqueue_script('jquery');

    // wp_register_script( 'custom-script', get_stylesheet_directory_uri() . '/js/script.js' );

    // For either a plugin or a theme, you can then enqueue the script:
    wp_enqueue_script( 'script' );

    // wp_enqueue_script( 'custom-script' );

}
add_action( 'wp_enqueue_scripts', 'theme_scripts' );



function my_custom_js() {

    wp_enqueue_script( 'my-script', get_template_directory_uri() . '/js/site.min.js', array( 'jquery' ), '1.0.0', true );
    // echo '<script type="text/javascript" src="'. get_template_directory_uri() .'/js/site.min.js"></script>';
}
// Add hook for front-end <head></head>
add_action( 'wp_footer', 'my_custom_js' );
