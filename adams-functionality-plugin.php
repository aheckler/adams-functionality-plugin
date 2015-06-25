<?php
/**
 * Plugin Name:    Adam's Functionality Plugin
 * Plugin URI:     https://github.com/aheckler/functionality-plugin
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
