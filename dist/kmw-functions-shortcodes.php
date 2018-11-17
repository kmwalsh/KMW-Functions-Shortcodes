<?php
/**
 * Plugin Name: KMW Functions & Shortcodes
 * Plugin URI: http://katemwalsh.com
 * Description: Some useful custom functions.
 * Author: KMW
 * Author URI: http://katemwalsh.com
 * Version: 0.1.0
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

	/**
	 * Enqueue scripts and styles for this plugin.
	 */ 
	function kmw_fs_scripts() {
		
		// plugin javascript
		wp_register_script( 'kmw-fs-scripts', plugins_url( 'kmw-fs/js/script.min.js', __FILE__ ), array( 'jQuery' ), '1.0.0', true );
		wp_enqueue_script( 'kmw-fs-scripts' );
		
		// plugin css styles
		wp_enqueue_style( 'kmw-fs-style', plugins_url( 'kmw-fs/css/app.css', __FILE__ ) );
		
		// font awesome
		wp_enqueue_style( 'font-awesome', plugins_url( 'kmw-fs/css/font-awesome.min.css', __FILE__ ) );
		
	}
}