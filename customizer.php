<?php
/**
 * Informer Theme Customizer
 *
 * @package Informer
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function theme_informer_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	/************** Remove sections and panel *************/
	$wp_customize->remove_section( 'static_front_page' );
	$wp_customize->remove_section( 'custom_css' );
	$wp_customize->remove_section( 'header_image' );
	$wp_customize->remove_section( 'background_image' );
	$wp_customize->remove_section( 'colors' );
	$wp_customize->remove_panel('widgets');

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'theme_informer_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'theme_informer_customize_partial_blogdescription',
		) );
	}
   /**************************** Own customizer option *******************************/
	$wp_customize->add_section('pjl-message-section', array(
		'title' => 'Rubrik Meddelande'
	));
	$wp_customize->add_setting('pjl-message-show', array(
		'default' => 'No'
	));
	$wp_customize->add_control( new WP_Customize_Control($wp_customize, 'pjl-message-show-control', array(
		'label' => 'Visa detta meddelande',
		'section' => 'pjl-message-section',
		'settings' => 'pjl-message-show',
		'type' => 'select',
		'choices' => array('No' => 'Nej', 'Yes' => 'Ja')
	)));
	$wp_customize->add_setting('pjl-message-headline', array(
		'default' => 'Meddelande - rubrik'
	));
	$wp_customize->add_control( new WP_Customize_Control($wp_customize, 'pjl-message-headline-control', array(
		'label' => 'Rubrik',
		'section' => 'pjl-message-section',
		'settings' => 'pjl-message-headline'
	)));

	$wp_customize->add_setting('pjl-message-txt', array(
		'default' => 'Meddelande paragraf'
	));
	$wp_customize->add_control( new WP_Customize_Control($wp_customize, 'pjl-message-text-control', array(
		'label' => 'Brödtext',
		'section' => 'pjl-message-section',
		'settings' => 'pjl-message-txt',
		'type' => 'textarea'
	)));

	$wp_customize->add_setting('pjl-message-link');
	$wp_customize->add_control( new WP_Customize_Control($wp_customize, 'pjl-message-link-control', array(
		'label' => 'Länk',
		'section' => 'pjl-message-section',
		'settings' => 'pjl-message-link',
		'type' => 'dropdown-pages'
	)));

	$wp_customize->add_setting('pjl-message-img');
	$wp_customize->add_control( new WP_Customize_Cropped_Image_Control($wp_customize, 'pjl-message-img-control', array(
		'label' => 'Bild',
		'section' => 'pjl-message-section',
		'settings' => 'pjl-message-img',
	)));
}
add_action( 'customize_register', 'theme_informer_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function theme_informer_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function theme_informer_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function theme_informer_customize_preview_js() {
	wp_enqueue_script( 'theme-informer-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'theme_informer_customize_preview_js' );
