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

// Add site icons from https://realfavicongenerator.net/
function akh_add_site_icons() {
	$tags = array();
	
	$tags[] = '<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png?v=zXdg2aG2mj">';
	$tags[] = '<link rel="icon" type="image/png" href="/favicon-32x32.png?v=zXdg2aG2mj" sizes="32x32">';
	$tags[] = '<link rel="icon" type="image/png" href="/favicon-16x16.png?v=zXdg2aG2mj" sizes="16x16">';
	$tags[] = '<link rel="manifest" href="/manifest.json?v=zXdg2aG2mj">';
	$tags[] = '<link rel="mask-icon" href="/safari-pinned-tab.svg?v=zXdg2aG2mj" color="#5bbad5">';
	$tags[] = '<link rel="shortcut icon" href="/favicon.ico?v=zXdg2aG2mj">';
	$tags[] = '<meta name="apple-mobile-web-app-title" content="Adam Heckler">';
	$tags[] = '<meta name="application-name" content="Adam Heckler">';
	$tags[] = '<meta name="theme-color" content="#ffffff">';
	
	foreach ( $tags as $tag ) {
		echo $tag . PHP_EOL;
	}
}
add_action( 'wp_head', 'akh_add_site_icons' );
add_action( 'admin_head', 'akh_add_site_icons' );
