<?php 
/* ====================================
HELPERS & FUNCTIONS
===================================== */ 
/* ====================================
HF1. TRUNCATE
--------------------------------------------------------------------- */

if ( ! function_exists( 'kmw__truncate' ) ) {
	function kmw__truncate($text, $chars = 25) {
		if (strlen($text) > $chars) {
			$text = $text." ";
			$text = substr($text,0,$chars);
			$text = substr($text,0,strrpos($text,' '));
			$text = $text."...";
		}
		return $text;
	}
}

/* ====================================
HF2. 404 & ERROR TEXT
--------------------------------------------------------------------- */
if ( ! function_exists( 'kmw_none_404_help_text' ) ) {
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
		$myvariable = ob_get_clean();
		return $myvariable;
	}
}

/* ====================================
HF3. WP E-MAIL NAME
--------------------------------------------------------------------- */
add_filter( 'wp_mail_from_name', 'kmw__wp_mail_from_name', 999);

if ( ! function_exists( 'kmw__wp_mail_from_name' ) ) {
	function kmw__wp_mail_from_name( $original_email_from ) {
		$name = get_bloginfo('name');
		return $name;
	}
}


/* ====================================
HF4. STRIP WP SCRIPT VERSIONS
--------------------------------------------------------------------- */
add_filter( 'style_loader_src', 'kmw__remove_wp_ver_css_js', 999 );
add_filter( 'script_loader_src', 'kmw__remove_wp_ver_css_js', 999 );

if ( ! function_exists( 'kmw__remove_wp_ver_css_js' ) ) {
	function kmw__remove_wp_ver_css_js( $src ) {
		if ( strpos( $src, 'ver=' ) )
			$src = remove_query_arg( 'ver', $src );
		return $src;
	}
}


/* ====================================
HF5. STRIP WP VERSION
--------------------------------------------------------------------- */
add_filter('the_generator', 'kmw__remove_version');

if ( ! function_exists( 'kmw__remove_version' ) ) {
	function kmw__remove_version() {
		return '';
	}
}


/* ====================================
HF6. STRIP ADMIN BAR FOR NON-ADMIN
--------------------------------------------------------------------- */
add_action('after_setup_theme', 'kmw__remove_admin_bar');

if ( ! function_exists( 'kmw__remove_admin_bar' ) ) {
	function kmw__remove_admin_bar() {
		if (!current_user_can('administrator') && !is_admin()) {
		  show_admin_bar(false);
		}
	}
}


/* ====================================
HF6. BOOT NON-ADMIN FROM WP-ADMIN 
DISABLED by default


add_action( 'init', 'kmw__blockusers_init' );

if ( ! function_exists( 'kmw__remove_version' ) ) {
	function kmw__blockusers_init() {
		if ( is_admin() && ! current_user_can( 'administrator' ) && !( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
			wp_redirect( home_url() );
			exit;
		}
	}
}
--------------------------------------------------------------------- */


/* ====================================
HF7. GOOGLE ANALYTICS
--------------------------------------------------------------------- */
add_action('wp_footer', 'kmw__add_googleanalytics');

if ( ! function_exists( 'kmw__add_googleanalytics' ) ) {
	function kmw__add_googleanalytics() {
		if ( ! is_admin() ) {
		ob_start(); ?>
		
<script>
// add Google Analytics code here
</script>

		<?php
			$return = ob_get_clean();
			print $return;
		}
	}
}


/* ====================================
HF8. POST REVISIONS
--------------------------------------------------------------------- */
if ( ! defined('WP_POST_REVISIONS')) {
	define('WP_POST_REVISIONS', 10);
}


/* ====================================
HF9. DROPDOWN SORTING
--------------------------------------------------------------------- */
// display the filter/dropdown sorting
function kmw__sort_category_header( $taxtype ) {
	$output = '<div class="filter-categories">';
			$output .= kmw__sort_categories( $taxtype );
	$output .= '</div>';
	return $output;
}

// fetch the categories where you sort
function kmw__sort_categories( $taxtype ) {
	$args = array(
		'parent'        => 0,
		'orderby'            => 'name',
		'order'              => 'ASC',
		'style'              => 'list',
		'hide_empty'         => 0,
		'title_li'           => '',
		'number'             => null,
		'taxonomy'           => $taxtype,
	);
	$get_tax_name = get_taxonomy($taxtype);
	$cats = get_categories( $args ); 
	ob_start(); ?>
		<div class="dropdown-sorter">
			<span class="button dropdown-button">
				<?php echo $get_tax_name->label; ?>
				<ul>
				<?php foreach ( $cats as $category ) { ?>
					<li><a href="<?php echo get_term_link( $category ); ?>"><?php echo $category->name; ?></a></li>
				<?php } ?>
				</ul>
			</span>
		</div>		
	<?php 
	$return = ob_get_clean();
	return $return;
}


/* ====================================
HF10. RELATED POSTS BY AUTHOR
--------------------------------------------------------------------- */
if ( !function_exists( 'kmw__get_author_related' ) ) {
	function kmw__get_author_related( $count=3) {
		global $post;
		$orig_post = $post;
		
		$tags = wp_get_post_tags($post->ID);
		if ($tags) {
			$args=array(
				'post__not_in' => array($post->ID),
				'posts_per_page'=> $count, // Number of related posts that will be shown.
				'ignore_sticky_posts'=>1
			);
			$my_query = new WP_Query( $args );
			if( $my_query->have_posts() ) { 
			ob_start(); 
			?>
				<div id="related-posts" class="related-posts">
					<h2><?php _e( 'You may also like...', 'kmw-fs' ); ?></h2>
					<ul>
						<?php while( $my_query->have_posts() ) { $my_query->the_post(); ?>
							<li>
							<div class="related-image">
								<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
								<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_post_thumbnail('medium'); ?></a>
								<?php } ?>
							</div><!--related-image-->
						<a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
					</div><!--related-text-->
							</li>
						<?php }
				echo '</ul></div>';
			}
		}
		$post = $orig_post;		
		wp_reset_query();
		$return = ob_get_clean();
		return $return;
	}
}