<?php
/**
 * Plugin Name:    Adam's Functionality Plugin
 * Plugin URI:     https://github.com/aheckler/adams-functionality-plugin/
 * Description:    Custom code for AdamHeckler.com.
 * Version:        1.0
 * Author:         Adam Heckler
 * Author URI:     https://www.adamheckler.com/
 * License:        GPLv2 or later
 * License URI:    http://www.gnu.org/licenses/gpl-2.0.txt
 */

// Exit if this file is called directly
if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

// Disable Jetpack module auto-activation
add_filter( 'jetpack_get_default_modules', '__return_empty_array' );

// Disable Akismet debug logging
add_filter( 'akismet_debug_log', '__return_false' );

// Close comments on attachment pages
function akh_close_comments_on_attachment_pages( $open, $post_id ) {
	$post = get_post( $post_id );
	if ( 'attachment' === $post->post_type ) {
		$open = false;
	}
	return $open;
}
add_filter( 'comments_open', 'akh_close_comments_on_attachment_pages', 10, 2 );

// Disable XML-RPC pingbacks
function akh_disable_pingbacks( $methods ) {
    unset( $methods['pingback.ping'] );
    return $methods;
}
add_filter( 'xmlrpc_methods', 'akh_disable_pingbacks' );

// Use Jetpack for two-factor authentication
add_filter( 'jetpack_remove_login_form', '__return_true' );
add_filter( 'jetpack_sso_bypass_login_forward_wpcom', '__return_true' );
