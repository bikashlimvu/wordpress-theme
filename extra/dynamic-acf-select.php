<?php

/**
 * Dynamically select form in ACF
 *
 * @param array $field, the field settings array
 * @return array $field
 */
function custom_dynamic_acf_select( $field ) {

	// Populate Select ACF Field called 'select_form'
	$form_fields = array(
		'form_select_form',
	);

	if ( ! in_array( $field['name'], $form_fields ) ) {
		return $field;
	}

	// Get form list from Contact Form 7
	if ( ! function_exists( 'wpcf7' ) ) {
		return $field;
	}

	$forms = get_posts(
		array(
			'post_type'   => 'wpcf7_contact_form',
			'posts_per_page' => -1,
		)
	);

	// Build list of choices
	$field['choices'] = array( 0 => '(None)' );
	foreach ( $forms as $form ) {
		$field['choices'][ $form->ID ] = $form->post_title;
	}
	return $field;
}
add_filter( 'acf/load_field', 'custom_dynamic_acf_select' );
