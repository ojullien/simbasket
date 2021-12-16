<?php

/**
 * Theme functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package simbasket
 * @version 1.0
 */

declare(strict_types=1);

/**
 * Loads La Similienne de Nantes - Basket files.
 */
require_once get_stylesheet_directory() . '/inc/api.php';
require_once get_stylesheet_directory() . '/inc/mimes.php';
require_once get_stylesheet_directory() . '/inc/theming.php';
require_once get_stylesheet_directory() . '/inc/tracking.php';

/**
 * Add Actions
 */
add_action('wp_enqueue_scripts', '\simbasket\theming\enqueueScripts'); // Add theme stylesheet and custom scripts
add_action('login_enqueue_scripts', '\simbasket\theming\enqueueLoginScripts'); // Add login stylesheet and custom scripts

/**
 * Add Filters
 */
add_filter('xmlrpc_enabled', '__return_false'); // Disables XML RPC API
add_filter('rest_authentication_errors', '\simbasket\api\setAuthenticationForREST'); // Forces authentication on REST API
add_filter('upload_mimes', '\simbasket\mimes\updateAllowedMimes'); // Updates allowed mime types and file extensions.
add_filter('feed_links_show_comments_feed', '__return_false'); // Removes comments feed
//add_filter('post_comments_feed_link','remove_comments_rss'); see https://developer.wordpress.org/reference/functions/post_comments_feed_link/
add_filter('the_generator', '__return_empty_string'); // Removes WordPress version number from head and rss
add_filter('style_loader_src', '\simbasket\tracking\removeWordPressVersionTag', 10, 2); // Remove the version parameter, ver=, from enqueued CSS script
add_filter('script_loader_src', '\simbasket\tracking\removeWordPressVersionTag', 10, 2); // Remove the version parameter, ver=, from enqueued JS script
add_filter('login_headerurl', '\simbasket\theming\updateLoginHeaderUrl'); // Filter the url of the logo in WordPress login page.
add_filter('login_headertext', '\simbasket\theming\updateLoginHeaderText'); // Filters the title attribute of the header logo in WordPress login page.
