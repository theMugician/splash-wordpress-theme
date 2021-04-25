<?php
/**
 * Vigor Gutenberg Settings
 *
 * @package Vigor
 */

/**
 * Add Gutenberg settings to theme.
 *
 */	
function vigor_add_custom_gutenberg_color_palette() {
	add_theme_support(
		'editor-color-palette',
		[
			[
				'name'  => esc_html__( 'Yellow', 'vidor' ),
				'slug'  => 'yellow',
				'color' => '#ffd100',
			],
			[
				'name'  => esc_html__( 'White', 'vidor' ),
				'slug'  => 'white',
				'color' => '#fff',
			],
			[
				'name'  => esc_html__( 'Black', 'vidor' ),
				'slug'  => 'black',
				'color' => '#000',
			],
		]
	);
}
add_action( 'after_setup_theme', 'vigor_add_custom_gutenberg_color_palette' );

// Add support for Block Styles.
add_theme_support( 'wp-block-styles' );

// Add support for full and wide align images.
add_theme_support( 'align-wide' );