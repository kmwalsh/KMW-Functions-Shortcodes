<?php

/**
 * @package KMW-FS\WordPress Clean-Up
 */

/**
* disable emojis
* http://wordpress.stackexchange.com/a/185578
*/

if ( ! function_exists( 'kmw_disable_wp_emojicons' ) ) 
{

    add_action( 'init', 'kmw_disable_wp_emojicons' );
	/**
	 * Disable WP Emojis
	 */ 

    function kmw_disable_wp_emojicons() 
    {
        // all actions related to emojis
        remove_action( 'admin_print_styles', 'print_emoji_styles' );
        remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
        remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
        remove_action( 'wp_print_styles', 'print_emoji_styles' );
        remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
        remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
        remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

        // filter to remove TinyMCE emojis
        add_filter( 'tiny_mce_plugins', 'kmw_disable_emojicons_tinymce' );
    }

}


if ( ! function_exists( 'kmw_disable_emojicons_tinymce' ) ) 
{
	/**
	 * Disable WP Emojis in TinyMCE Editor
	 */ 

    function kmw_disable_emojicons_tinymce( $plugins ) 
    {
        if ( is_array( $plugins ) ) {
            return array_diff( $plugins, array( 'wpemoji' ) );
        } else {
            return array();
        }
    }

}


if ( ! function_exists( 'kmw_remove_wp_ver_css_js' ) ) 
{

    add_filter( 'style_loader_src', 'kmw_remove_wp_ver_css_js', 999 );
    add_filter( 'script_loader_src', 'kmw_remove_wp_ver_css_js', 999 );

	/**
	 * Strip WordPress script versions on the front end
     * 
     * @param string $src The style/script loader src in WP filter script_loader_src
	 */ 
	function kmw_remove_wp_ver_css_js( $src ) {
		if ( strpos( $src, 'ver=' ) )
			$src = remove_query_arg( 'ver', $src );
		return $src;
    }
    
}

if ( ! function_exists( 'kmw_remove_wp_version' ) ) 
{

    add_filter('the_generator', 'kmw_remove_wp_version');

	/**
	 * Strip WordPress version on the front end
	 */ 
	function kmw_remove_wp_version() {
		return '';
	}
}

if ( ! function_exists( 'kmw_remove_admin_bar' ) ) 
{

    add_action('after_setup_theme', 'kmw_remove_admin_bar');

	/**
	 * Strip WP admin bar for any non-admin user on the front end
	 */ 
    function kmw_remove_admin_bar() 
    {
        if ( ! current_user_can('administrator') && ! is_admin() )
        {
		  show_admin_bar(false);
		}
    }
    
}