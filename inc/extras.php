<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * @package RED_Starter_Theme
 */

/**
 * Change the placeholder text in the Post editing screen.
 */
function qod_change_title_here_text( $input ) {
	global $post_type;

	if ( is_admin() && 'post' == $post_type ) {
		return 'Enter first and last name of the quoted person here';
	}

	return $input;
}
add_filter( 'enter_title_here', 'qod_change_title_here_text' );

/**
 * Filter the Product post type archive.
 */
 function qod_modify_queries( $query ) {
	if ( ( is_home() || is_single() ) && !is_admin() && $query->is_main_query() ) {
		$query->set( 'orderby', 'rand' );
		$query->set( 'order', 'ASC' );
		$query->set( 'posts_per_page', 1 );
	} if ( ( is_archive() ) && !is_admin() && $query->is_main_query() ) {
		$query->set( 'posts_per_page', 5 );
	}
 }
 add_action( 'pre_get_posts', 'qod_modify_queries' );
