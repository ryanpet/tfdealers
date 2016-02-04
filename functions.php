<?php
/****************************************************************
    clean wp_head() - http://wpengineer.com/1438/wordpress-header/
****************************************************************/
function woof_head_cleanup() {
	remove_action( 'wp_head', 'feed_links_extra', 3 ); /* Display the links to the extra feeds such as category feeds. */
	remove_action( 'wp_head', 'feed_links', 2 ); /* Display the links to the general feeds: Post and Comment Feed. */
	remove_action( 'wp_head', 'rsd_link' ); /* Display the link to the Really Simple Discovery service endpoint, EditURI link. */ 
	remove_action( 'wp_head', 'wlwmanifest_link' ); /* Display the link to the Windows Live Writer manifest file. */
	remove_action( 'wp_head', 'index_rel_link' ); /* index link */            
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); /* prev link */
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); /* start link */ 
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0); /* Display relational links for the posts adjacent to the current post. */
	remove_action( 'wp_head', 'wp_generator' ); /* Display the XHTML generator that is generated on the wp_head hook, WP version. */
}
add_action('init', 'woof_head_cleanup'); /* launching operation cleanup */

/**************************************************************** 
	remove script and css ?ver
****************************************************************/
function woof_remove_cssjs_ver( $src ) {
    if( strpos( $src, '?ver=' ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}
add_filter( 'style_loader_src', 'woof_remove_cssjs_ver', 10, 2 );
add_filter( 'script_loader_src', 'woof_remove_cssjs_ver', 10, 2 );

/****************************************************************
    remove WP version from RSS
****************************************************************/
function woof_rss_version() { return ''; }
add_filter('the_generator', 'woof_rss_version');

/****************************************************************
    Adding WP 3+ Functions & Theme Support
****************************************************************/
/****************************************************************
    Adding WP 3+ Functions & Theme Support
****************************************************************/
function woof_theme_support() {
	add_theme_support('post-thumbnails');      // wp thumbnails 
	add_theme_support('automatic-feed-links'); // rss thingy
	add_theme_support( 'menus' );            // wp menus
}
add_action('after_setup_theme','woof_theme_support');

/****************************************************************
    Filters wp_title to print a neat <title> tag based on what is being viewed.
****************************************************************/
function woof_wp_title( $title, $sep ) {
	global $page, $paged;

	if ( is_feed() )
		return $title;

	// Add the blog name
	$title .= get_bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " $sep $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		$title .= " $sep " . sprintf( __( 'Page %s', 'underscore-ground-up' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'woof_wp_title', 10, 2 );

/****************************************************************
	WordPress Bootstrap navwalker
****************************************************************/
require_once('assets/inc/wp_bootstrap_navwalker.php');

/****************************************************************
	Register nav menus
****************************************************************/
register_nav_menus( array(
    'primary' => __( 'Primary Menu', 'Woof' ),
) );

/****************************************************************
    Sidebars
****************************************************************/
function woof_register_sidebars() {
    register_sidebar(array(
    	'id' => 'widget-sidebar',
    	'name' => 'Sidebar',
    	'description' => 'Sidebar',
    	'before_widget' => '<li>',
    	'after_widget' => '</li>',
    	'before_title' => '<h5 class="widget-title">',
    	'after_title' => '</h5>',
    )); 
}
add_action( 'widgets_init', 'woof_register_sidebars' );

/****************************************************************
    Login
****************************************************************/
function my_custom_login() {
	echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('stylesheet_directory') . '/assets/admin/custom-login-styles.css" />';
}
add_action('login_head', 'my_custom_login');

function my_login_logo_url() {
	return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_logo_url_title() {
	return 'Treefrogs Dealers';
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );

function login_error_override() {
    return 'Incorrect login details.';
}
add_filter('login_errors', 'login_error_override');

function login_checked_remember_me() {
	add_filter( 'login_footer', 'rememberme_checked' );
}
add_action( 'init', 'login_checked_remember_me' );

function rememberme_checked() {
	echo "<script>document.getElementById('rememberme').checked = true;</script>";
}


?>