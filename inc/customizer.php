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
function webstart_customize_register($wp_customize)
{
	$wp_customize->get_setting('blogname')->transport         = 'postMessage';
	$wp_customize->get_setting('blogdescription')->transport  = 'postMessage';
	$wp_customize->get_setting('header_textcolor')->transport = 'postMessage';

	if (isset($wp_customize->selective_refresh)) {
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
add_action('customize_register', 'webstart_customize_register');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function webstart_customize_partial_blogname()
{
	bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function webstart_customize_partial_blogdescription()
{
	bloginfo('description');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function webstart_customize_preview_js()
{
	wp_enqueue_script('webstart-customizer', get_template_directory_uri() . '/js/customizer.js', array('customize-preview'), _S_VERSION, true);
}
add_action('customize_preview_init', 'webstart_customize_preview_js');

/**
 * コンテンツ幅のメニューを追加
 */
function my_customizer_menu($wp_customize)
{

	$wp_customize->add_panel(
		'pc_panel',
		array(
			'title'    => 'コンテンツ幅',
			'priority' => 1,
		)
	);

	$wp_customize->add_section(
		'pc_section',
		array(
			'title'    => 'PC',
			'panel'    => 'pc_panel',
			'priority' => 1,
		)
	);

	$wp_customize->add_section(
		'tb_section',
		array(
			'title'    => 'タブレット',
			'panel'    => 'pc_panel',
			'priority' => 2,
		)
	);

	// $wp_customize->add_section(
	// 	'sp_section',
	// 	array(
	// 		'title'    => 'スマートフォン',
	// 		'panel'    => 'sp_panel',
	// 		'priority' => 3,
	// 	)
	// );

	$wp_customize->add_setting('my_contentWidth');
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'my_control',
			array(
				'label'    => '最大幅（px）',
				'section'  => 'pc_section',
				'settings' => 'my_contentWidth',
				'priority' => 1,
			)
		)
	);

	$wp_customize->add_setting('my_contentWidthTb');
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'my_control_tb',
			array(
				'label'    => '最大幅（px）',
				'section'  => 'tb_section',
				'settings' => 'my_contentWidthTb',
				'priority' => 2,
			)
		)
	);

	// $wp_customize->add_control(
	// 	new WP_Customize_Control(
	// 		$wp_customize,
	// 		'my_control',
	// 		array(
	// 			'label'    => '最大幅（px）',
	// 			'section'  => 'sp_section',
	// 			'settings' => 'my_contentWidthSp',
	// 			'priority' => 1,
	// 		)
	// 	)
	// );
}
add_action('customize_register', 'my_customizer_menu');

function webstart_add_contentWidth_css()
{
	// 設定した最大幅を取得
	$contentWidth = get_theme_mod('my_contentWidth');
	$contentWidthTb = get_theme_mod('my_contentWidthTb');
	// $contentWidthSp = get_theme_mod('my_contentWidthSp');
?>
	<style type="text/css">
		.content-width {
			max-width: <?php echo $contentWidth; ?>px;
		}

		@media screen and (max-width: 767px) {
			.content-width {
				max-width: <?php echo $contentWidthTb; ?>px;
			}
		}

		/* @media screen and (max-width: 599px) {
			.content-width {
				max-width: <?php echo $contentWidthSp; ?>px;
			}
		} */
	</style>
<?php
}
add_action('wp_head', 'webstart_add_contentWidth_css');
