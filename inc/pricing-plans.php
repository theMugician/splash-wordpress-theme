<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Splash
 */

/**
 * Registers the splash pricing plan post type.
 *
 */
function splash_pricing_plan_custom_post_type() {
  register_post_type('splash_pricing_plan',
    array(
      'labels'      => array(
        'name'          => __('Pricing Plans', 'textdomain'),
        'singular_name' => __('Pricing Plan', 'textdomain'),
      ),
      'supports' => array( 'title' ),
      'menu_icon'   => 'dashicons-admin-page',
      'public'      => true,
      'has_archive' => true,
      'show_in_rest' => true,
     )
  );
}
add_action('init', 'splash_pricing_plan_custom_post_type');

function splash_pricing_plan_add_meta_box() {
	//Set variables
	$id = 'splash-pricing-plan'; //string
	$title = __('Pricing Plan Info', 'splash');
	$template = plugin_dir_path( __FILE__ ) . './splash-pricing-plan-template.php';
	$screens = array('splash_pricing_plan');
	$context = 'normal';
	$priority = 'high';

	/**
	 * Create instance of Splash_MetaBox.
	 *
	 * @param string   	$id
	 * @param string   	$title
	 * @param filepath  $template
	 * @param array   	$screens
	 * @param string   	$context
	 * @param string  	$priority 
	 */
  $splash_pricing_plan_meta_box = new Splash_MetaBox(
  	$id,
		$title,
		$template,
		$screens,
		$context,
		$priority
  );

	//Add to metabox
  add_meta_box(
		$splash_pricing_plan_meta_box->get_id(), 
		$splash_pricing_plan_meta_box->get_title(),
		$splash_pricing_plan_meta_box->get_callback(), 
		$splash_pricing_plan_meta_box->get_screens(), 
		$splash_pricing_plan_meta_box->get_context(), 
		$splash_pricing_plan_meta_box->get_priority()
  );
}
add_action('add_meta_boxes', 'splash_pricing_plan_add_meta_box');

/**
 * Save fields.
 *
 * @param string   $nonce
 * @param string   $fields
 */
function splash_pricing_plan_save_meta_box() {
	$nonce = 'splash_pricing_plan_nonce';
	$fields = [
		'splash_pricing_plan_title',
		'splash_pricing_plan_button_text',
		'splash_pricing_plan_button_link',
		'splash_pricing_plan_button_specs'
	];
	//Create instance of Splash_SaveMetaBox
  $splash_pricing_plan_save_meta_box = new Splash_SaveMetaBox(
  	$nonce,
  	$fields
  );
}

add_action( 'save_post', 'splash_pricing_plan_save_meta_box' );
