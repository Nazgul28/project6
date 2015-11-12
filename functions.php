<?php
/**
 * RED Starter Theme functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package RED_Starter_Theme
 */

if ( ! function_exists( 'qod_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function qod_setup() {
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// Switch search form, comment form, and comments to output valid HTML5.
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

}
endif; // qod_setup
add_action( 'after_setup_theme', 'qod_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * @global int $content_width
 */
function qod_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'qod_content_width', 640 );
}
add_action( 'after_setup_theme', 'qod_content_width', 0 );

/**
 * Filter the stylesheet_uri to output the minified CSS file.
 */
function qod_minified_css( $stylesheet_uri, $stylesheet_dir_uri ) {
	if ( file_exists( get_template_directory() . '/build/css/style.min.css' ) ) {
		$stylesheet_uri = $stylesheet_dir_uri . '/build/css/style.min.css';
	}

	return $stylesheet_uri;
}
add_filter( 'stylesheet_uri', 'qod_minified_css', 10, 2 );

/**
 * Enqueue scripts and styles.
 */
function qod_scripts() {
	wp_enqueue_script ('angular', get_template_directory_uri() . '/build/js/angular/angular.min.js', array(), false, true);
	wp_enqueue_style( 'qod-style', get_stylesheet_uri() );
	wp_enqueue_style( 'font-awesome-cdn', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css', array(), '4.4.0' );

	wp_enqueue_script( 'qod-skip-link-focus-fix', get_template_directory_uri() . '/build/js/skip-link-focus-fix.min.js', array(), '20130115', true );

	wp_enqueue_script ('qod-api', get_template_directory_uri(). '/js/api.js', array('jquery'), false, true);
	wp_localize_script ('qod-api', 'api_vars', array(
		'root_url' => esc_url_raw( rest_url()),
		'home_url' => esc_url_raw( home_url()),
		'nonce' => wp_create_nonce ('wp_rest'),
		'success' => 'Thanks, your quote submission was received!',
		'failure' => 'Your submission could not be processed.' 
		));
}
add_action( 'wp_enqueue_scripts', 'qod_scripts' );

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Custom metaboxes generated using the CMB2 library.
 */
require get_template_directory() . '/inc/metaboxes.php';

/**
 * All the WP API things if the REST API plugin is active.
 */
if ( is_plugin_active( 'rest-api/plugin.php' ) ) :
	require get_template_directory() . '/inc/api.php';
endif;
