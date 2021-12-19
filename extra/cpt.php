<?php
/**
 * Register Custom Post Types
 */

// CPT
function custom_post_type() {
	$labels = array(
		'name'                  => __( 'Post', 'themeSlug' ),
		'singular_name'         => __( 'Post', 'themeSlug' ),
		'menu_name'             => __( 'Post', 'themeSlug' ),
		'all_items'             => __( 'All Post', 'themeSlug' ),
		'add_new'               => __( 'Add New', 'themeSlug' ),
		'add_new_item'          => __( 'Add New Post', 'themeSlug' ),
		'edit_item'             => __( 'Edit Post', 'themeSlug' ),
		'new_item'              => __( 'New Item', 'themeSlug' ),
		'view_item'             => __( 'View Post', 'themeSlug' ),
		'search_items'          => __( 'Search Post', 'themeSlug' ),
		'not_found'             => __( 'No Post Found', 'themeSlug' ),
		'not_found_in_trash'    => __( 'No Post in trash', 'themeSlug' ),
		'parent_item_colon'     => __( 'Parent Post', 'themeSlug' ),
		'archives'              => __( 'Post Archives', 'themeSlug' ),
		'insert_into_item'      => __( 'Insert into Post', 'themeSlug' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Post', 'themeSlug' ),
		'filter_items_list'     => __( 'Filter Post List', 'themeSlug' ),
		'items_list_navigation' => __( 'Post list navigation', 'themeSlug' ),
		'items_list'            => __( 'Post List', 'themeSlug' ),
	);
	$args   = array(
		'label'               => __( 'Post', 'text_domain' ),
		'description'         => __( 'Post', 'text_domain' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor' ),
		'hierarchical'        => false,
		'public'              => false,
		'publicly_queryable'  => false,
		'show_ui'             => true,
		'show_in_rest'        => true,
		'show_in_menu'        => true,
		'menu_position'       => 6,
		'menu_icon'           => 'dashicons-format-status',
		'exclude_from_search' => false,
		'capability_type'     => 'post',
		'rewrite'             => array(
			'slug'       => 'cpt',
			'with_front' => true,
		),
	);

	register_post_type( 'cpt', $args );
}

add_action( 'init', 'custom_post_type' );