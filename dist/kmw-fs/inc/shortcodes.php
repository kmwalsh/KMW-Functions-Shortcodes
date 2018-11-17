<?php

/**
 * Custom WordPress shortcodes for things such as logged in/out content, the current year, social media icons, etc.
 *  
 * @package KMW-FS\Shortcodes
 */

if ( ! function_exists( 'kmw_get_logged_out_content' ) ) {

	add_shortcode( 'logged_out', 'kmw_get_logged_out_content' );

	/**
	 * WordPress shortcode with start and end tags. Produces text visible only to Logged Out users. **Note:** This is only for small tidbits like a login form on the sidebar etc. There are much better ways to protect content with much more granular permissions than this offers, this is basically just for "calls to action" and other very simple stuff.
	 * 
	 * @example: ```[logged_out]stuff only logged out users see[/logged_out]```
	 * @param array $atts WordPress shortcode atts. Empty.
	 * @param string $content The content you want only logged out users to see.
	 */ 

	function kmw_get_logged_out_content( $atts, $content = null ) {
		extract( shortcode_atts( array(), $atts ) );

		if( is_user_logged_in() ) {
			echo '';
		} else {
			return do_shortcode($content);
		}
	}

}

if ( ! function_exists( 'kmw_get_logged_in_content' ) ) {

	add_shortcode( 'logged_in', 'kmw_get_logged_in_content' );

	/**
	 * WordPress shortcode with start and end tags. Produces text visible only to Logged In users. **Note:** This is only for small tidbits like a login form on the sidebar etc. There are much better ways to protect content with much more granular permissions than this offers, this is basically just for "calls to action" and other very simple stuff.
	 * 
	 * @example: ```[logged_in]stuff only logged in users see[/logged_in]```
	 * @param array $atts WordPress shortcode atts. Empty.
	 * @param string $content The content you want only logged in users to see. Accepts shortcodes.
	 */ 

	function kmw_get_logged_in_content( $atts, $content = null ) {
		extract( shortcode_atts( array(), $atts ) );

		if ( ! is_user_logged_in() ) {
			echo '';
		} else {
			return do_shortcode($content);
		}
	}
}


if ( ! function_exists( 'kmw_get_button' ) ) {

	add_shortcode('button', 'kmw_get_button'); 

	/**
	 * WordPress shortcode with start and end tags. Produces buttons with optional subtitle. 
	 * 
	 * @example: ```[button link="#!" target="_self, _blank" subtitle=""]Primary[/button]```
	 * @param array $atts WordPress shortcode attributes. Contains three arguments. `$link`, where you want the button to go. `$target`, whether you want the button to open in a new window, use _blank or _new. And finally `$subtitle`, the smaller text contained within the button.
	 * @param string $content The content you want in the button. Accepts shortcodes.
	 */ 

	function kmw_get_button($atts, $content = null) {
		extract( shortcode_atts( array(
			'link' => '#',
			'target' => '_self',
			'subtitle' => '',
		), $atts ) );
		return '<a href="'.$link.'" target="'.$target.'" class="button">' . do_shortcode($content) . '<span>'.$subtitle.'</span></a>';
	}
}

/* ====================================
SC3. SOCIAL MEDIA ICONS
--------------------------------------------------------------------- */

if ( ! function_exists( 'kmw_get_social' ) ) {

	add_shortcode ('kmw_social', 'kmw_get_social');

	/**
	 * Social media icons. Default social media networks: Twitter, Facebook, GitHub, Codepen, Instagram, Pinterest, Reddit, LinkedIn, SoundCloud, YouTube, RSS, E-Mail
	 * 
	 * @example: ```[kmw_social]```
	 * @link: https://fontawesome.com/
	 */ 
	function kmw_get_social() {
		ob_start();
		?>

<ul class="soc">
	<li title="LinkedIn"><a target="_blank" class="soc-linkedin" href="#!"><i class="fa fa-linkedin"></i></a></li>
	<li title="CodePen"><a target="_blank" class="soc-codepen" href="#!"><i class="fa fa-codepen"></i></a></li>
	<li title="GitHub"><a target="_blank" class="soc-github" href="#!"><i class="fa fa-github"></i></a></li>
	<li title="Twitter"><a target="_blank" class="soc-twitter" href="#!"><i class="fa fa-twitter"></i></a></li>
	<li title="Facebook"><a target="_blank" class="soc-facebook" href="#!"><i class="fa fa-facebook"></i></a></li>
	<li title="Pinterest"><a target="_blank" class="soc-pinterest" href="#!"><i class="fa fa-pinterest"></i></a></li>
	<li title="Soundcloud"><a target="_blank" class="soc-soundcloud" href="#!"><i class="fa fa-soundcloud"></i></a></li>
	<li title="YouTube"><a target="_blank" class="soc-youtube" href="#!"><i class="fa fa-youtube"></i></a></li>
	<li title="Instagram"><a class="soc-instagram" href="#!"><i class="fa fa-instagram"></i></a></li>
	<li title="Reddit"><a target="_blank" class="soc-reddit" href="#!"><i class="fa fa-reddit"></i></a></li>
	<li title="E-Mail"><a target="_blank" class="soc-email1 soc-icon-last" href="mailto:test@test.com"><i class="fa fa-envelope"></i></a></li>
	<li title="RSS"><a target="_blank" class="soc-twitter" href="#!"><i class="fa fa-rss"></i></a></li>
</ul>

	<?php
		return ob_get_clean();
	}
}

add_shortcode('kmw_googlemap', 'kmw_get_googlemap');

if ( ! function_exists( 'kmw_get_googlemap' ) ) {
	/**
	 * Google maps embed code. Useful so you don't have to change the Google map twenty times if the code changes, etc.
	 * 
	 * @example: ```[kmw_googlemap height="" width=""]```
	 * @param array $atts WordPress shortcode attributes `$width` and `$height` for the map. Can accept pixel, percentage, or whatever else you'd like.
	 */ 

	function kmw_get_googlemap($atts) {
		extract( shortcode_atts( array(
			// place your map in below - this map is for grand central in nyc which you probably do not want
			'map' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.422731017018!2d-73.97941808417562!3d40.752726179327475!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25a21fb011c85%3A0x37513b7f1821408b!2sGrand+Central+Terminal!5e0!3m2!1sen!2sus!4v1542444290363',
			// you can also change the defaults of how the map shows up when the user/editor does not enter those atts into the shortcode
			'width' => '100%',
			'height' => '450px',
		), $atts ) );
		ob_start(); ?>

			<iframe class="kmw-googlemap" src="<?php echo $map; ?>" style="width: <?php echo $width; ?>; height: <?php echo $height; ?>; border:0" allowfullscreen frameborder="0"></iframe>

		<?php
		return ob_get_clean();
	}
}

if ( ! function_exists( 'kmw_get_phone' ) ) 
{

	add_shortcode('kmw_phone', 'kmw_get_phone');

	/**
	 * Phone number shortcode: in-content or click to call for mobile. 
	 * Desktop or click-to-call for mobile Again, useful so you don't have to change it twenty times if the phone number changes (which it can -- call forwarding/tracking services are a great reason to make use of this code). **Note: You should *only* include the mobile number *once*.**
	 * 
	 * @example: ```[kmw_get_phone mobile="true or false"]```
	 * @param string $atts WordPress shortcode atttributes. `mobile` Whether this instance is the floating phone number that only appears for mobile browsers. `number` The number type. Default types are phone or fax.
	 * 
	 * @link: http://katemwalsh.com/fixed-position-click-to-call-mobile-phone-number-code/
	 * 
	 * @todo Support any phone number input here through shortcode and regex or something to clean non numerics and then reformat number for consistent display.
	 * 
	 */ 

	function kmw_get_phone($atts) {
		extract( shortcode_atts( array(
			'icons' => true,
			'mobile' => 'false',
			'type' => 'phone',
			'number' => null,
		), $atts ) );

		if ( $mobile === "true" ) {
			ob_start(); ?>
				<span class="kmw-phone" id="floating-mobile-phone" >
					<?php if ( $icons === true ) : ?>
						<i class="fa fa-phone"></i> 
					<?php endif; ?>
					<a href="tel:+555555555">(555) 555-5555</a>
				</span>
			<?php
			return ob_get_clean(); 
		} else {
			if ( $type === "phone" ) {
				ob_start(); ?>
					<span class="kmw-phone">
						<?php if ( $icons === true ) : ?>
							<i class="fa fa-phone"></i> 
						<?php endif; ?>
						<span class="desktop-phone">(555) 555-5555</span>
					</span>
				<?php
				return ob_get_clean(); 
			} 
			if ( $type === "fax" ) {
				ob_start(); ?>
					<span class="kmw-phone">
						<?php if ( $icons === true ) : ?>
							<i class="fa fa-fax"></i>
						<?php endif; ?>
						<span class="desktop-phone">(555) 555-5555</span>
					</span>
				<?php
				return ob_get_clean(); 
			}
		}
	}

}

if ( ! function_exists( 'kmw_sitemap_full' ) ) {

	add_shortcode('kmw_sitemap', 'kmw_sitemap_full');

	/**
	 * HTML sitemap: Categories + Pages, two column. 
	 * HTML sitemap pages are useful for human visitors. This is a two-part shortcode because I usually use two separate shortcodes, each in one column. It's also useful to sometimes display just the pages or just the categories (outside of widgets etc.).
	 * 
	 * @example: ```[kmw_sitemap]```
	 * 
	 */ 
	function kmw_sitemap_full(){
		ob_start();
		?>

			<div class="kmw-sitemap">
				<div class="kmw-sitemap-column">
					<h2>Pages</h2>
					<?php echo kmw_sitemap_pages(); ?>
				</div>
				<div class="kmw-sitemap-column">
					<h2>Categories</h2>
					<?php echo kmw_sitemap_categories(); ?>
				</div>
			</div>


		<?php
		return ob_get_clean();
	}
}


if ( ! function_exists( 'kmw_sitemap_categories' ) ) {

	add_shortcode('kmw_categories', 'kmw_sitemap_categories');

	/**
	 * HTML sitemap: Categories. 
	 * HTML sitemap pages are useful for human visitors. This is a two-part shortcode because I usually use two separate shortcodes, each in one column. It's also useful to sometimes display just the pages or just the categories (outside of widgets etc.). ```[kmw_categories]``` simply fetches a list of your blog categories.
	 * 
	 * @example: ```[kmw_categories]```
	 * 
	 */ 
	function kmw_sitemap_categories(){
		$args = array(		
			'orderby'            => 'name',
			'order'              => 'ASC',
			'style'              => 'list',
			'hide_empty'         => 1,
			'title_li'           => false,
			'echo'               => 0
		);
		ob_start(); 
		?>

			<ul class="kmw-sitemap-categories">
				<?php echo wp_list_categories($args); ?>
			</ul>

		<?php
		return ob_get_clean(); 
	}
}


if ( ! function_exists( 'kmw_sitemap_pages' ) ) {

	add_shortcode('kmw_pages', 'kmw_sitemap_pages');

	/**
	 * HTML sitemap: Pages.
	 * HTML sitemap pages are useful for human visitors. This is a two-part shortcode because I usually use two separate shortcodes, each in one column. It's also useful to sometimes display just the pages or just the categories (outside of widgets etc.). This function duplicates the primary menu since you might have "off-menu" pages you don't want to display. If you want a straight list of all pages regardless of the menu, you'll want [wp_list_pages()](http://codex.wordpress.org/Function_Reference/wp_list_pages).
	 * 
	 * @example: ```[kmw_sitemap]```
	 * @param string $theme_location Note: you need to change this to the location of your primary menu.
	 * 
	 */ 
	function kmw_sitemap_pages() {
		ob_start();
		echo wp_nav_menu(array(
		'theme_location' => 'primary',
		'container' => false,
		'menu_class' => 'kmw-sitemap-ul'));
		return ob_get_clean();
	}
}


if ( ! function_exists( 'kmw_get_info' ) ) {

	add_shortcode('kmw_bloginfo', 'kmw_get_info');
	
	/**
	 * get_bloginfo() as shortcode. 
	 * Uses ```get_bloginfo()``` to return data about the website. See [get_bloginfo() on the Codex](https://codex.wordpress.org/Function_Reference/get_bloginfo) for a full list of what can be returned with the key. Useful for placing the site's name in content. If your site rebrands later, you won't need to change the name in a million places *or* mess with MySQL replacements.
	 * 
	 * @link: https://codex.wordpress.org/Function_Reference/get_bloginfo
	 * @example: ```[site_info key="name"]```
	 * @param string $atts WordPress shortcode attributes. Contains `key`, the key of the `get_bloginfo()` key you wish to return.
	 * 
	 */
	function kmw_get_info($atts) {
		extract(shortcode_atts(array(
				'key' => 'name',
			), $atts));

		return get_bloginfo($key);
	}
}


if ( ! function_exists( 'kmw_get_year' ) ) {
	add_shortcode('kmw_year', 'kmw_get_year');
	
	/**
	 * Current year as shortcode. Just uses PHP to fetch the current year. Possibly useful for copyright notices, freshening content, etc.
	 * 
	 * @example: ```[kmw_year]```
	 * 
	 */ 
	function kmw_get_year() {
		$text = date('Y');
		return $text;
	}
}