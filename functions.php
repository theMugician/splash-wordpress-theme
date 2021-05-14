<?php
/**
 * splash functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Splash
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'splash_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function splash_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on splash, use a find and replace
		 * to change 'splash' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'splash', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'splash' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'splash_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'splash_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function splash_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'splash_content_width', 640 );
}
add_action( 'after_setup_theme', 'splash_content_width', 0 );


/**
 * Register footer widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function splash_footer_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer', 'splash' ),
			'id'            => 'footer',
			'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'splash' ),
			'before_widget' => '<section id="%1$s" class="widget col-3 %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget__title">',
			'after_title'   => '</h3>',
		)
	);
}
add_action( 'widgets_init', 'splash_footer_widgets_init', 0 );

/**
 * Enqueue scripts and styles.
 */
function splash_scripts() {
	wp_enqueue_style( 'splash-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'splash-style', 'rtl', 'replace' );
	wp_enqueue_style( 'bootstrap-carousel-css', get_template_directory_uri() . '/assets/css/bootstrap-carousel.css' );

	//Add prism pre syntax
	//if ( is_single() && has_tag( 'code' ) ) { 
	  wp_enqueue_style('prism-css', get_template_directory_uri() . '/assets/css/prism.css');
	  wp_enqueue_script('prism-js', get_template_directory_uri() . '/assets/js/prism.js');
	//}

	wp_enqueue_script( 'splash-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), _S_VERSION, true );
  wp_enqueue_script( 'bootstrap-carousel-js', get_template_directory_uri() . '/assets/js/bootstrap-carousel.min.js' , array('jquery'));
  wp_enqueue_script('init-bootstrap-carousel', get_template_directory_uri() . '/assets/js/init-carousel.js', array('bootstrap-carousel-js'));

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'splash_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Gutenberg setup.
 */
require get_template_directory() . '/inc/gutenberg.php';

/**
 * Splash metabox Class for creating custom metaboxes.
 */
require get_template_directory() . '/inc/pricing-plans.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load class for creating option pages.
 */
if ( !class_exists( 'RationalOptionPages' ) ) {
	require_once(get_template_directory() . '/inc/RationalOptionPages.php');
}