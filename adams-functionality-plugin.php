<?php
/**
 * Plugin Name:    Adam's Functionality Plugin
 * Plugin URI:     https://github.com/aheckler/adams-functionality-plugin/
 * Description:    Custom code for AdamHeckler.com.
 * Version:        1.0
 * Author:         Adam Heckler
 * Author URI:     http://www.adamheckler.com/
 * License:        GPLv2 or later
 * License URI:    http://www.gnu.org/licenses/gpl-2.0.txt
 */

// Exit if this file is called directly
if ( ! defined( 'ABSPATH' ) ) {
    exit();
}

// Turn on auto-updates for everything
add_filter( 'allow_major_auto_core_updates', '__return_true' );
add_filter( 'allow_minor_auto_core_updates', '__return_true' );
add_filter( 'auto_update_plugin', '__return_true' );
add_filter( 'auto_update_theme', '__return_true' );
add_filter( 'auto_update_translation', '__return_true' );

// Disable Jetpack module auto-activation
add_filter( 'jetpack_get_default_modules', '__return_empty_array' );

// Enable RICG's advanced image compression
function enable_ricg_advanced_image_compression() {
    add_theme_support( 'advanced-image-compression' );
}
add_action( 'after_setup_theme', 'enable_ricg_advanced_image_compression' );

// Disable WP Rocket's page caching
add_filter( 'do_rocket_generate_caching_files', '__return_false' );

// Change Jetpack Related Posts headline
function jetpackme_related_posts_headline( $headline ) {
	$headline = sprintf( '<h3 class="jp-relatedposts-headline"><em>%s</em></h3>', esc_html__( 'Related Posts', 'jetpack' ) );
	return $headline;
}
add_filter( 'jetpack_relatedposts_filter_headline', 'jetpackme_related_posts_headline' );

// Show list of categories on Categories page
function output_linked_list_of_categories( $content ) {
	if ( is_page( 'Categories' ) ) {
		$categories_list_id = 'categories-list';
		$wp_list_categories_args = array( 
			'title_li'	=> '', 
			'echo'		=> 0 
		);
		$content .= '<ul id="' . $categories_list_id . '">' . wp_list_categories( $wp_list_categories_args ) . '</ul>';
	}
	return $content;
}
add_filter( 'the_content', 'output_linked_list_of_categories' );

// Fix Jetpack Subscriptions form when output on a page
// https://github.com/Automattic/jetpack/issues/2854
function akh_fix_jp_subs_form() {
	wp_register_script( 'akh_fix_jetpack_subs_form_shortcode', plugins_url( 'js/fix_jetpack_subs_form_shortcode.js', __FILE__ ), array( 'jquery' ), '1.0.0', true );
	wp_enqueue_script( 'akh_fix_jetpack_subs_form_shortcode' );
}
add_action( 'wp_enqueue_scripts', 'akh_fix_jp_subs_form' );
