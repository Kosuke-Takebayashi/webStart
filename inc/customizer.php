<?php
/**
 * webStart Theme Customizer
 *
 * @package webStart
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function webstart_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'webstart_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'webstart_customize_partial_blogdescription',
			)
		);
	}
}
add_action( 'customize_register', 'webstart_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function webstart_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function webstart_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function webstart_customize_preview_js() {
	wp_enqueue_script( 'webstart-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), _S_VERSION, true );
}
add_action( 'customize_preview_init', 'webstart_customize_preview_js' );

/**
 * メニューを追加
 */
function my_customizer_menu($wp_customize)
{

	$wp_customize->add_panel(
		'my_panel',
		array(
			'title'    => 'パネル名',
			'priority' => 1,
		)
	);

	$wp_customize->add_section(
		'my_section',
		array(
			'title'    => 'セクション名',
			'panel'    => 'my_panel',
			'priority' => 1,
		)
	);

	$wp_customize->add_setting('my_setting');
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'my_control',
			array(
				'label'    => 'コントロールの見出し',
				'section'  => 'my_section',
				'settings' => 'my_setting',
				'priority' => 1,
			)
		)
	);
}
add_action('customize_register', 'my_customizer_menu');
