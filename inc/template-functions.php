<?php
/**
 * Additional features to allow styling of the templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package     Mark
 * @link        https://themebeans.com/themes/mark
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array (Maybe) filtered body classes.
 */
function mark_body_classes( $classes ) {
	global $post;

	$classes[] = 'clearfix';

	if ( get_theme_mod( 'mark_portfolio_modal' ) ) {
		$classes[] = 'modal-active';
	}

	if ( is_front_page() && 'posts' !== get_option( 'show_on_front' ) ) {
		$classes[] = 'york-front-page';
	}

	return $classes;
}
add_filter( 'body_class', 'mark_body_classes' );
