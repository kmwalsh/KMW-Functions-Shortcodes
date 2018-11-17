<?php
/**
 * Plugin Name: KMW Functions & Shortcodes
 * Plugin URI: https://github.com/kmwalsh/KMW-Functions-Shortcodes
 * Description: Some useful custom functions, shortcodes, content formatting filters, and WordPress clean-up/tweaks.
 * Author: K. M. Walsh
 * Author URI: http://katemwalsh.com
 * Version: 2.0.0
 * 
 * @package KMW-FS
 */

require_once('kmw-fs/inc/content-format-filters.php');
require_once('kmw-fs/inc/persistent-analytics.php');
require_once('kmw-fs/inc/shortcodes.php');
require_once('kmw-fs/inc/template-functions.php');
require_once('kmw-fs/inc/wordpress-clean.php');
require_once('kmw-fs/inc/wordpress-tweak.php');


if ( ! function_exists( 'kmw_fs_scripts' ) ) {

	add_action( 'wp_enqueue_scripts', 'kmw_fs_scripts' );
	add_action( 'wp_enqueue_scripts', 'kmw_fs_styles' );

	/**
	 * Enqueue scripts and styles for this plugin.
	 */ 
	function kmw_fs_styles() {
		
		// font awesome
		wp_enqueue_style( 'font-awesome', plugins_url( 'kmw-fs/css/font-awesome.min.css', __FILE__ ) );
		
		// plugin css styles
		wp_register_style( 'kmw-fs-style', plugins_url( 'kmw-fs/css/app.css', __FILE__ ) );
		wp_enqueue_style( 'kmw-fs-style' );
		
	}
	/**
	 * Enqueue scripts and styles for this plugin.
	 */ 
	function kmw_fs_scripts() {
		
		// plugin javascript
		wp_register_script( 'test', plugin_dir_url( __FILE__ ) . 'kmw-fs/js/script.min.js', array( 'jquery' ), NULL, true );
		wp_enqueue_script( 'test' );		
		
	}
}