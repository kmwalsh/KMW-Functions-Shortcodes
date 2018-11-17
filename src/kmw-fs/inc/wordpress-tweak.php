<?php

/**
 * WordPress tweaks such as the email from name, search results per page, removal of archives, etc.
 * 
 * @package KMW-FS\WordPress Tweaks
 */

/**
 * Enable shortcodes in Widgets.
 */
add_filter('widget_text', 'do_shortcode');

if ( ! defined('WP_POST_REVISIONS')) {

	/**
	 * Define WordPress revisions.
	 */
	define('WP_POST_REVISIONS', 10);
}


if ( ! function_exists( 'kmw_wp_mail_from_name' ) ) {
	
	add_filter( 'wp_mail_from_name', 'kmw_wp_mail_from_name', 999);

	/**
	 * Set WordPress email name.
	 * Set the WordPress email name to reduce the potential problems with deliverability and remove "WordPress" from the from name.
	 * 
	 * @param string $original_email_from The original email we are filtering on wp_mail_from_name.
	 */ 
	function kmw_wp_mail_from_name( $original_email_from ) {
		$name = get_bloginfo('name');
		return $name;
	}

}


if ( ! function_exists( 'kmw_set_search_per_page' ) ) {

	add_filter( 'pre_get_posts', 'kmw_set_search_per_page');

	/**
	 * Set number of posts per page on search results. Default 25.
	 * 
	 * @param string $query The WordPress query, which we are checking to see if it is a search query.
	 */ 
	function kmw_set_search_per_page( $query ) {

		if ( $query->is_search && is_search() ) {
			$query->set('posts_per_page', '25');
		}

		return $query;
	}

}

 
if ( ! function_exists( 'kmw_remove_wp_author_date_archives' ) ) {

	add_action('template_redirect', 'kmw_remove_wp_author_date_archives');

	/**
	 * Remove author and date archive pages.
	 */ 
	function kmw_remove_wp_author_date_archives() {
		global $wp_query;

		if ( is_author() || is_date() )
		{
			$wp_query->set_404();
		}

	}

}

if ( ! function_exists( 'kmw_remove_tags_categories' ) ) {

	// Uncomment the line below to enable this functionality
	// add_action( 'init', 'kmw_remove_tags_categories' );

	/**
	 * Remove post tags, categories: DISABLED.
	 * Remove post tags and category core WordPress functionality. Useful if you are building a site without a blog. Disabled by default.
	 */ 

	function kmw_remove_tags_categories() {
		unregister_taxonomy_for_object_type( 'post_tag', 'post' );
		unregister_taxonomy_for_object_type( 'category', 'post' );
	}

}

if ( ! function_exists( 'kmw_remove_thumbnail_support' ) ) {

	// Uncomment the line below to enable this functionality
	// add_action('init','kmw_remove_thumbnail_support');

	/**
	 * Remove featured image/thumbnail support.
	 * Remove Thumbnail/Featured Image support for posts and page types. Disabled by deafult.
	 */ 
	function kmw_remove_thumbnail_support(){
		remove_post_type_support('post','thumbnail');
		remove_post_type_support('page','thumbnail');
	}

}

if ( ! function_exists( 'kmw_remove_version' ) ) {
	
	// Uncomment the line below to enable this functionality
	// add_action( 'init', 'kmw_blockusers_init' );

	/**
	 * Boot non-admin from wp-admin.
	 * Redirects any URL with wp-admin for everyone but administrator-level users. Useful for building a site with users who should have no admin access. Defaults to disabled. This **requires a front-end login solution** (e.g., Theme My Login). Otherwise you'll be locked out of your WordPress admin until you edit out the boot again. 
	 */ 
	function kmw_blockusers_init() {
		if ( is_admin() && ! current_user_can( 'administrator' ) && ! ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
			wp_redirect( home_url() );
			exit;
		}
	}
}

if ( ! function_exists( 'kmw_remove_admin_bar' ) ) {

	add_action('after_setup_theme', 'kmw_remove_admin_bar');

	/**
	* Strip admin bar from front end for all users except administrators.
	*/
	function kmw_remove_admin_bar() {

		if ( ! current_user_can( 'administrator' ) && ! is_admin() ) {
			show_admin_bar(false);
		}

	}

}

if ( ! function_exists( 'kmw_remove_wp_login_logo' ) ) {

	add_action( 'login_enqueue_scripts', 'kmw_remove_wp_login_logo' );
  
	/**
	* Strip WordPress logo from login page.
	*/
	function kmw_remove_wp_login_logo() { ?>
		<style type="text/css">
			.login h1 a {
				background-image: none;
				display: none;
				padding-bottom: 30px;
			}
		</style>
	<?php }
  
	}
	
  
  
  if ( ! function_exists( 'kmw_remove_dashboard_meta' ) ) {
  
	add_action( 'admin_init', 'kmw_remove_dashboard_meta' );

	/**
	* Strip default WordPress dashboard widgets for cleaner experience.
	*/
	function kmw_remove_dashboard_meta() {
	
		# standard WordPress metaboxes =============================

		remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_primary', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_secondary', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
		remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );
		remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' );
	
		# custom WordPress metaboxes ===============================

		# Broken Link Checker plugin
		# remove_meta_box( 'blc_dashboard_widget', 'dashboard', 'normal' );
	
		# themefusion news for Avada
		# remove_meta_box( 'themefusion_news', 'dashboard', 'normal' );
	
		# rocketgenius widget for Gravity Forms
		# remove_meta_box( 'rg_forms_dashboard', 'dashboard', 'side' );
	}
  
}
  
/**
* Strip default WordPress welcome panel.
*/
remove_action( 'welcome_panel', 'wp_welcome_panel' );
  
if ( ! function_exists( 'kmw_custom_dashboard_widget' ) ) {

	add_action( 'admin_footer', 'kmw_custom_dashboard_widget' );

	/**
	 * Custom welcome widget.
	 * Adds hidden content to admin_footer, then shows with jQuery, and inserts after welcome panel.
	 * 
	 * @author Ren Ventura <EngageWP.com>
	 * @link http://www.engagewp.com/how-to-create-full-width-dashboard-widget-wordpress
	 */
	function kmw_custom_dashboard_widget() {
		// Bail if not viewing the main dashboard page
		if ( get_current_screen()->base !== 'dashboard' ) {
		return;
		}
		$homeurl = get_bloginfo('url') . '/';
		?>

		<div id="custom-id" class="welcome-panel" style="display: none;">
		<div class="welcome-panel-content">
			<h2>Welcome to <?php echo get_bloginfo('name'); ?>!</h2>
			<p class="about-description">Your site is running on <b>WordPress</b>.</p>
			<div class="welcome-panel-column-container">
			<div class="welcome-panel-column">
				<h3>Get Started</h3>
				<ul>
				<li><a href="<?php echo $homeurl; ?>wp-admin/profile.php" class="welcome-icon welcome-edit-page">Edit your Profile and Settings</a></li>
				<li><a href="<?php echo $homeurl; ?>wp-admin/post-new.php" class="welcome-icon welcome-write-blog">Add a blog post</a></li>
				<li><a href="<?php echo $homeurl; ?>" class="welcome-icon welcome-view-site">View your site</a></li>
				</ul>
			</div>
			<div class="welcome-panel-column">
				<h3>WordPress Help and Information</h3>
				<ul>
				<li><a target="_blank" href="https://codex.wordpress.org/" class="welcome-icon welcome-learn-more">WordPress: The Codex</a></li>
				<li><a target="_blank" href="https://wordpress.org/support/" class="welcome-icon dashicons-info">WordPress Support Forums</a></li>
				<li><div class="welcome-icon dashicons-editor-help"><a target="_blank" href="http://www.wpbeginner.com/beginners-guide/how-to-properly-ask-for-wordpress-support-and-get-it/">How to Ask for WordPress Help</a></div></li>
				</ul>
			</div>
			<div class="welcome-panel-column welcome-panel-last">
				<h3>More Help</h3>
				<p style="margin-right:25px;">If you need further assistance, please contact your organization's Web Development or Information Technology department.</p>
			</div>
			</div>
		</div>
		</div>

		<script>
		jQuery(document).ready(function($) {
			$('#dashboard-widgets-wrap').before($('#custom-id').show());
		});
		</script>

	<?php }

}
  
if ( ! function_exists( 'kmw_replace_howdy' ) ) {

	add_filter( 'admin_bar_menu', 'kmw_replace_howdy',25 );

	/**
	 * Remove "Howdy" in the WP admin bar.
	 */
	function kmw_replace_howdy( $wp_admin_bar ) {
		$my_account=$wp_admin_bar->get_node('my-account');
		$newtitle = str_replace( 'Howdy,', 'Hello,', $my_account->title );
		$wp_admin_bar->add_node( 
			array(
				'id' => 'my-account',
				'title' => $newtitle,
			) 
		);
	}

}

if ( ! function_exists( 'kmw_admin_bar_remove' ) ) {

	add_action('wp_before_admin_bar_render', 'kmw_admin_bar_remove', 0);

	/**
	 * Remove WP icon in upper right corner of WP admin bar.
	 */
	function kmw_admin_bar_remove() {
		global $wp_admin_bar;
		/* Remove their stuff */
		$wp_admin_bar->remove_menu('wp-logo');
	}

}

if ( ! function_exists( 'kmw_footer_remove_wp_version' ) ) {

	add_action( 'admin_menu', 'kmw_footer_remove_wp_version' );

	/**
	 * Remove WP version in lower right corner of WP Admin.
	 */
	function kmw_footer_remove_wp_version() {
		remove_filter( 'update_footer', 'core_update_footer' ); 
	}

}

if ( ! function_exists( 'kmw_wp_admin_footer_remove_thanks' ) ) {

	add_action( 'admin_init', 'kmw_wp_admin_footer_remove_thanks' );

	/**
	 * Remove "Thank you" in lower left corner of WP Admin.
	 */
	function kmw_wp_admin_footer_remove_thanks() {
		add_filter( 'admin_footer_text', 'kmw_edit_text', 11 );
	}

	/**
	 * Replace "Thank you" in lower left corner of WP Admin with custom text (default blank).
	 */
	function kmw_edit_text($content) {
		return " ";
	}

}