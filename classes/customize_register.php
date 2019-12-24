<?php
/**
 * Customizer settings for this theme.
 */

function customize_register( $wp_customize )
{
	// $wp_customize->add_setting( 'header_cart_page_id', array(
	// 	'capability' => 'edit_theme_options',
	// 	'sanitize_callback' => 'themeslug_sanitize_dropdown_pages',
	// ) );
	
	// $wp_customize->add_control( 'header_cart_page_id', array(
	// 	'type' => 'dropdown-pages',
	// 	'section' => 'options', // Add a default or your own section
	// 	'label'    => __( 'Show cart in header', 'twentytwenty' ),
	// 	'description' => __( 'This is a custom dropdown pages option.' ),
	// ) );
	
	// function themeslug_sanitize_dropdown_pages( $page_id, $setting ) {
	// 	// Ensure $input is an absolute integer.
	// 	$page_id = absint( $page_id );
	
	// 	// If $page_id is an ID of a published page, return it; otherwise, return the default.
	// 	return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
	// }

	function sanitize_checkbox( $checked ) {
		return ( ( isset( $checked ) && true === $checked ) ? true : false );
	}

	$wp_customize->add_setting(
		'enable_header_cart',
		array(
			'capability'        => 'edit_theme_options',
			'default'           => true,
			'sanitize_callback' => 'sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'enable_header_cart',
		array(
			'type'     => 'checkbox',
			'section'  => 'options',
			'priority' => 10,
			'label'    => __( 'Show cart in header', 'twentytwenty' ),
		)
	);

}
add_action( 'customize_register', 'customize_register' );
