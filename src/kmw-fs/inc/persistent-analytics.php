<?php

/**
 * Persistent analytics.
 * "Safer" than anything theme-based and even plugin-based. Because you're loading this file as a mu-plugin, it will *always* run even if you change the theme and even if you deactivate your other SEO plugins. Helps you avoid losing your precious GA data!
 * 
 * @package KMW-FS\Persistent Analytics
 */

if ( ! function_exists( 'kmw_add_googleanalytics' ) ) {
	
	add_action('wp_footer', 'kmw_add_googleanalytics');

	/**
	 * Add Google Analytics to site.
	 */ 
	function kmw_add_googleanalytics() {
		if ( ! is_admin() ) {
		ob_start(); ?>

<!-- Google Analytics added by KMW-FS -->
<script>
// add Google Analytics code here
</script>

		<?php
			$return = ob_get_clean();
			print $return;
		}
	}
	
}