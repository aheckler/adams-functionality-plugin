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

// Disable WP Rocket's page caching
add_filter( 'do_rocket_generate_caching_files', '__return_false' );

// Change Jetpack Related Posts headline
function akh_change_jp_rp_headline( $headline ) {
	$headline = sprintf( '<h3 class="jp-relatedposts-headline"><em>%s</em></h3>', esc_html__( 'Related Posts', 'jetpack' ) );
	return $headline;
}
add_filter( 'jetpack_relatedposts_filter_headline', 'akh_change_jp_rp_headline' );

// Show list of categories on Categories page
function akh_output_linked_cat_list( $content ) {
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
add_filter( 'the_content', 'akh_output_linked_cat_list' );

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

// Remove frontend edit links
function akh_remove_edit_links( $link ) {
    if ( ! is_admin() ) {
        return '';
    }
    return $link;
    }
add_filter( 'get_edit_post_link', 'akh_remove_edit_links' );
