<?php

/* ====================================
II. SHORTCODES
===================================== */
/* ====================================
SC1. LOGGED IN & LOGGED OUT CONTENT
--------------------------------------------------------------------- */
add_shortcode( 'logged_out', 'kmw__get_logged_out_content' );

if ( ! function_exists( 'kmw__get_logged_out_content' ) ) {
	function kmw__get_logged_out_content( $atts, $content = null  ) {
		if( is_user_logged_in() ){
			echo '';
		} else {
			$output = do_shortcode($content);
			return $output;
		}
	}
}

add_shortcode( 'logged_in', 'kmw__get_logged_in_content' );


if ( ! function_exists( 'kmw__get_logged_in_content' ) ) {
	function kmw__get_logged_in_content( $atts, $content = null  ) {
		if( !is_user_logged_in() ){
			echo '';
		} else {
			return do_shortcode($content);
		}
	}
}

/* ====================================
SC2. FANCY BUTTONS
--------------------------------------------------------------------- */
add_shortcode('button', 'kmw__get_button'); 

if ( ! function_exists( 'kmw__get_button' ) ) {
	function kmw__get_button($atts, $content = null) {
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
add_shortcode ('kmw_social','kmw__get_social');

if ( ! function_exists( 'kmw__get_social' ) ) {
	function kmw__get_social() {
		ob_start(); ?>
	<ul class="soc">
		<li title="LinkedIn"><a target="_blank" class="soc-linkedin" href="#!"><i class="fa fa-linkedin"></i></a></li>
		<li title="CodePen"><a target="_blank" class="soc-codepen" href="#!"><i class="fa fa-codepen"></i></a></li>
		<li title="GitHub"><a target="_blank" class="soc-github" href="#!"><i class="fa fa-github"></i></a></li>
		<li title="Twitter"><a target="_blank" class="soc-twitter" href="#!"><i class="fa fa-twitter"></i></a></li>
		<li title="Facebook"><a target="_blank" class="soc-facebook" href="#!"><i class="fa fa-facebook"></i></a></li>
		<li title="Pinterest"><a target="_blank" class="soc-pinterest" href="#!"><i class="fa fa-pinterest"></i></a></li>
		<li title="Soundcloud"><a target="_blank" class="soc-soundcloud" href="#!"><i class="fa fa-soundcloud"></i></a></li>
		<li title="YouTube"><a target="_blank" class="soc-youtube" href="#!"><i class="fa fa-youtube"></i></a></li>
		<li title="Google"><a target="_blank" class="soc-google" href="#!"><i class="fa fa-google"></i></a></li>
		<li title="Instagram"><a class="soc-instagram" href="#!"><i class="fa fa-instagram"></i></a></li>
		<li title="Reddit"><a target="_blank" class="soc-reddit" href="#!"><i class="fa fa-reddit"></i></a></li>
		<li title="E-Mail"><a target="_blank" class="soc-email1 soc-icon-last" href="mailto:test@test.com"><i class="fa fa-envelope"></i></a></li>
		<li title="RSS"><a target="_blank" class="soc-twitter" href="#!"><i class="fa fa-rss"></i></a></li>
	</ul>
	<?php
		$return = ob_get_clean();
		return $return;
	}
}

/* ====================================
SC4. GOOGLE MAPS
--------------------------------------------------------------------- */
add_shortcode('kmw_googlemap', 'kmw__get_googlemap');

if ( ! function_exists( 'kmw__get_googlemap' ) ) {
	function kmw__get_googlemap($atts) {
		extract( shortcode_atts( array(
			'width' => '100%',
			'height' => '450px',
		), $atts ) );
		return '<iframe src="PLACE_GOOGLE_MAPS_EMBED" style="width: ' . $width . '; height: ' . $height . '; border:0" allowfullscreen frameborder="0"></iframe>';
	}
}


/* ====================================
SC5. PHONE NUMBER
--------------------------------------------------------------------- */ 
add_shortcode('kmw_phone', 'kmw__get_phone');

if ( ! function_exists( 'kmw__get_phone' ) ) {
	function kmw__get_phone($atts) {
		extract( shortcode_atts( array(
			'mobile' => 'false',
		), $atts ) );
		if ( $mobile === "true" ) {
			return '<a id="floating-mobile-phone" href="tel:+555555555">(555) 555-5555</a>';
		} else {
			return '<span class="desktop-phone">(555) 555-5555</span>';
		}
	}
}

/* ====================================
SC6. HTML SITEMAP
--------------------------------------------------------------------- */
add_shortcode('kmw_categories', 'kmw__sitemap_categories');

if ( ! function_exists( 'kmw__sitemap_categories' ) ) {
	function kmw__sitemap_categories(){
		$args = array(		
			'orderby'            => 'name',
			'order'              => 'ASC',
			'style'              => 'list',
			'hide_empty'         => 1,
			'title_li'           => false,
			'echo'               => 0
		);
		return "<ul>".wp_list_categories($args)."</ul>";
	}
}

add_shortcode('kmw_sitemap', 'kmw__sitemap_pages');

if ( ! function_exists( 'kmw__sitemap_pages' ) ) {
	function kmw__sitemap_pages(){
		return wp_nav_menu(array(
		'theme_location' => 'THEME_PRIMARY_LOCATION',
		'container' => false,
		'menu_class' => 'menu-ul'));
	}
}


/* ====================================
SC7. SITE INFO
--------------------------------------------------------------------- */
add_shortcode('bloginfo', 'kmw__get_info');

if ( ! function_exists( 'kmw__get_info' ) ) {
	function kmw__get_info($atts) {
		extract(shortcode_atts(array(
				'key' => 'name',
			), $atts));

		return get_bloginfo($key);
	}
}


/* ====================================
SC8. CURRENT YEAR
--------------------------------------------------------------------- */
add_shortcode('kmw_year', 'kmw__get_year');

if ( ! function_exists( 'kmw__get_year' ) ) {
	function kmw__get_year() {
		$text = date('Y');
		return $text;
	}
}