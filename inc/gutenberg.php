<?php
/**
 * Vigor Gutenberg Settings
 *
 * @package Splash
 */

/**
 * Add Gutenberg settings to theme.
 *
 */	
function splash_add_custom_gutenberg_color_palette() {
	add_theme_support(
		'editor-color-palette',
		[
			[
				'name'  => esc_html__( 'Yellow', 'splash' ),
				'slug'  => 'yellow',
				'color' => '#ffd100',
			],
			[
				'name'  => esc_html__( 'White', 'splash' ),
				'slug'  => 'white',
				'color' => '#fff',
			],
			[
				'name'  => esc_html__( 'Black', 'splash' ),
				'slug'  => 'black',
				'color' => '#000',
			],
		]
	);
}
add_action( 'after_setup_theme', 'splash_add_custom_gutenberg_color_palette' );

// Add support for Block Styles.
//add_theme_support( 'wp-block-styles' );

// Add support for full and wide align images.
add_theme_support( 'align-wide' );

function splash_add_custom_gutenberg_fonts() {
	add_theme_support(
	  'editor-font-sizes', 
	  array(
	    array(
	      'name'      => __( 'Extra small', 'splash' ),
	      'shortName' => __( 'XS', 'splash' ),
	      'size'      => 12,
	      'slug'      => 'extra-small'
		  ),	  	
	    array(
	      'name'      => __( 'Small', 'splash' ),
	      'shortName' => __( 'S', 'splash' ),
	      'size'      => 16,
	      'slug'      => 'small'
		  ),	    
		  array(
	      'name'      => __( 'Normal', 'splash' ),
	      'shortName' => __( 'N', 'splash' ),
	      'size'      => 20,
	      'slug'      => 'normal'
		  ),
		  array(
	      'name'      => __( 'Medium', 'splash' ),
	      'shortName' => __( 'M', 'splash' ),
	      'size'      => 22,
	      'slug'      => 'medium'
	    )
		  array(
	      'name'      => __( 'Large', 'splash' ),
	      'shortName' => __( 'L', 'splash' ),
	      'size'      => 24,
	      'slug'      => 'medium'
	    )	    
	  )
	);
}
add_action( 'after_setup_theme', 'splash_add_custom_gutenberg_fonts' );
