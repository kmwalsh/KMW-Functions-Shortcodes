<?php
/**
 * Plugin Name: KMW Functions & Shortcodes
* Plugin URI: http://katemwalsh.com
 * Description: Some useful custom functions.
 * Author: KMW
 * Author URI: http://katemwalsh.com
 * Version: 0.1.0
 
	CONTENTS
	Anything marked with * needs to be customized for your site.
	
	SECTION I: Helpers & Functions (kmw-fs/helpers-functions.php)
	---------------------------------------------------------------------------
		HF1. TRUNCATE
		HF2. *404 & ERROR TEXT
		HF3. WP E-MAIL NAME
		HF4. STRIP WP SCRIPT VERSIONS
		HF5. STRIP WP VERSION
		HF6. BOOT NON-ADMIN FROM WP-ADMIN
		HF7. GOOGLE ANALYTICS
		HF8. POST REVISIONS
		HF9. CONTRIBUTOR UPLOADS
		HF10. DROPDOWN SORTING
		HF11. RELATED POSTS BY AUTHOR
*/
require_once('kmw-fs/helpers-functions.php');

/*
	SECTION II: Shortcodes (kmw-fs/helpers-functions.php)
	---------------------------------------------------------------------------
		SC1. LOGGED IN & LOGGED OUT CONTENT
		SC2. FANCY BUTTONS
		SC3. *SOCIAL MEDIA ICONS
		SC4. *GOOGLE MAPS
		SC5. *PHONE NUMBER
		SC6. *HTML SITEMAP
		SC7. SITE INFO
		SC8. CURRENT YEAR
 */
require_once('kmw-fs/shortcodes.php');


/*	
	SECTION III: CSS, JavaScript
	--------------------------------------------------------------------------- */
function kmw___fs_scripts() {
	wp_register_script( 'kmw-fs-js', plugins_url( 'js/script.js', __FILE__ ), array( 'jQuery' ), '1.0.0', true );
	
	wp_enqueue_style( 'kmw-fs-css', plugins_url( 'css/style.css', __FILE__ ) );
	wp_enqueue_script( 'kmw-fs-js' );
}
add_action( 'wp_enqueue_scripts', 'kmw___fs_scripts' );