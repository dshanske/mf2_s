<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package mf2_s
 */


/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
  */
function mf2_s_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">' . PHP_EOL;
	}
}
add_action( 'wp_head', 'mf2_s_pingback_header' );
