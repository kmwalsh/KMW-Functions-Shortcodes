<?php

/**
 * Template-related functions intended to be used in your own PHP theme templates. Some of them have shortcodes, too, but they're mostly intended to be theme templates.
 * 
 * @package KMW-FS\Template Functions
 */

if ( ! function_exists( 'kmw_none_404_help_text' ) ) {

	add_shortcode('kmw_help_text', 'kmw_none_404_help_text');
	
	/**
	 * More useful WordPress 404 & error text.
	 * 
	 * For use in the 404 template and sometimes the "none" template, depending on the site type. **MUST-CUSTOMIZE: Pay attention to the URLs -- e.g., sitemap, contact. They might be different for you and I can't guess what your page names/permalinks are.**
	 * 
	 * @example: ```<?php echo kmw_none_404_help_text(); ?>```
	 */ 

	function kmw_none_404_help_text() {
		ob_start();
		?> 

		<div class="help-404">
		
			<ul class="help-404-list">
				<li><a href="javascript:history.go(-1)">Try going back a page.</a></li>
				<li>Check the <a href="/sitemap/">sitemap</a>. This displays a list of all pages.</li>
				<li>Head back to the <a href="/">main page</a> and start again.</li>
				<li><a href="/contact/">Contact us</a> if you need assistance.</li>				
				<li>Try searching:</li>
			</ul>
			
			<?php get_search_form(); ?>
		</div>

		<?php
		return ob_get_clean();
	}

}


if ( ! function_exists( 'kmw_truncate' ) ) {

	add_shortcode('kmw_truncate', 'kmw_truncate_shortcode');

	/**
	 * Truncate text.
	 * Shortens a longer text (for example: the excerpt, the content, a custom meta value) to a number of characters you specify.  The number is optional and defaults to 25.
	 * 
	 * @link: http://stackoverflow.com/questions/9219795/truncating-text-in-php
	 * @param string $content The text you wish to truncate.
	 * @param int $chars The number of characters where you wish to truncate.
	 * 
	 */
	function kmw_get_truncate($content, $chars) {
		
		if (strlen($content) > $chars) {
			$content = $content." ";
			$content = substr($content,0,$chars);
			$content = substr($content,0,strrpos($content,' '));
			$content = $content."...";
		}
		
		return $content;
	}

	/**
	 * Truncate text as a shortcode.
	 * 
	 * @uses kmw_get_truncate()
	 * @param string $atts WordPress shortcode atts.
	 * @param string $content WordPress self-closing shortcode content.
	 * @param int $chars Number of characters to truncate to.
	 * 
	 */
	function kmw_truncate_shortcode($atts = null, $content = null, $chars = 25 ) {
		extract( shortcode_atts( array(
			'chars' => 25,
		), $atts ) );

		return kmw_get_truncate($content, $chars);
	}

	/**
	 * Truncate text as a PHP template function.
	 * 
	 * @uses kmw_get_truncate()
	 * @param string $content Template-based content.
	 * @param int $chars Number of characters to truncate to.
	 * 
	 */
	function kmw_truncate($content, $chars = 25 ) {
		echo kmw_get_truncate($content, $chars);
	}
}

if ( ! function_exists( 'kmw_sort_categories' ) ) {

	/**
	 * Faux-dropdown sorting for WordPress categories.
	 * 
	 * @example: ```<?php echo kmw_sort_categories('category'); ?>```
	 * @param string $taxonomy The name of the WordPress taxonomy you wish to display.
	 */

	function kmw_sort_categories( $taxonomy='category' ) {

		$args = array(
			'parent'        => 0,
			'orderby'            => 'name',
			'order'              => 'ASC',
			'style'              => 'list',
			'hide_empty'         => 0,
			'title_li'           => '',
			'number'             => null,
			'taxonomy'           => $taxonomy,
		);

		$get_tax_name = get_taxonomy( $taxonomy );
		$cats = get_categories( $args ); 

		ob_start(); ?>

			<div class="kmw-sc">

				<h2 class="kmw-sc-header kmw-js-sc-toggle">
					<span class="kmw-sc-header-text"><?php echo $get_tax_name->label; ?></span>
					<i class="fa fa-angle-down kmw-sc-caret"></i>
				</h2>

				<div class="kmw-sc-dropdown">

					<ul class="kmw-sc-list">
						<?php foreach ( $cats as $category ) { ?>
							<li class="kmw-sc-item"><a href="<?php echo get_term_link( $category ); ?>"><?php echo $category->name; ?></a></li>
						<?php } ?>
					</ul>

				</div>

			</div>	

		<?php 
		return ob_get_clean();

	}

}