<?php
/*
Plugin Name: Redirect by Custom Field
Description: Changes the URLs pointing to pages and posts which have a <code>redirect</code> custom field, using that entry as the URL instead.
Author: mitcho (Michael 芳貴 Erlewine)
Version: 1.0
Author URI: http://mitcho.com/
Donate link: http://tinyurl.com/donatetomitcho
*/

if ( !defined('REDIRECT_BY_CUSTOM_FIELD_HTTP_STATUS') )
	define( 'REDIRECT_BY_CUSTOM_FIELD_HTTP_STATUS', 301 );

// This section will redirect URL's when the real permalink is hit directly.
// Note: I didn't use rewrite because I didn't want to have to keep track of all redirect mappings.
add_action('template_redirect', 'redirect_header', 1);
function redirect_header() {
	global $wp_query;
	if ( is_singular() &&
		 ($id = get_queried_object_id()) &&
		 ($link = get_redirect_url($id)) ) {
		wp_redirect($link, REDIRECT_BY_CUSTOM_FIELD_HTTP_STATUS);
		exit;
	}
}

// This section will replace every instance of the permalink with the redirect URL.
add_filter('page_link', 'redirect_by_custom_field', 10, 2);
add_filter('post_link', 'redirect_by_custom_field', 10, 2);
function redirect_by_custom_field($link, $postarg = null) {
	global $post;
	if ( is_admin() )
		return $link;
	
	if (is_object($postarg))
		$id = $postarg->ID;
	else if (is_int($postarg))
		$id = $postarg;
	else if (is_object($post))
		$id = $post->ID;
	else
		return $link;
	
	if ( $redirect = get_redirect_url($id) )
		return $redirect;
	
	return $link;
}

// id must be int
function get_redirect_url($id) {
	static $placeholders;

	if ( $redirect = get_post_meta( absint($id), 'redirect', true ) ) {

		if ( !isset($placeholders) ) {
			$placeholders = apply_filters( 'redirect_by_custom_field_placeholders', 
				array(
					'%home%' => get_home_url(),
					'%site%' => get_site_url(),
				)
			);
		}

		return str_replace( array_keys($placeholders),
			array_values($placeholders),
			is_array($redirect) ? $redirect[0] : $redirect );
	}
	return false;
}

add_filter('get_sample_permalink_html', 'redirect_display_modifier', 10, 4);
function redirect_display_modifier($return, $id, $new_title, $new_slug) {
	if ( $redirect = get_redirect_url($id) )
		$return = "<strong>" . __("Redirect:", 'redirect-by-custom-field') . "</strong> " . esc_html($redirect) . "<style>#titlediv {margin-bottom: 30px;}</style><br/>" . $return;
	return $return;
}

function redirect_add_filter_button() {
	$redirect_hide = get_user_option( 'redirect_hide' );
		
	echo "<label style='padding:10px;padding-bottom:4px;'><input type='checkbox' id='redirect_hide' name='redirect_hide' ";
	checked( !!$redirect_hide, true );
	echo " value='1'> " . __("Hide redirects", 'redirect-by-custom-field') . "</label>";
}
function redirect_request_filter($query) {
	if ( !get_user_option( 'redirect_hide' ) )
		return $query;

	if ( !isset($query['meta_query']) )
		$query['meta_query'] = array();
	$query['meta_query'][] = array(
		'key' => 'redirect',
		'compare' => 'NOT EXISTS',
		'value' => 'rar'
	);

	return $query;
}

add_action( 'load-edit.php', 'redirect_register_admin_hooks' );
function redirect_register_admin_hooks() {
	$user = wp_get_current_user();
	if ( isset($_REQUEST['action']) && $_REQUEST['action'] == -1 )
		update_user_option( $user->ID, 'redirect_hide', isset($_REQUEST['redirect_hide']) );
	
	add_action( 'restrict_manage_posts', 'redirect_add_filter_button' );
	add_filter( 'request', 'redirect_request_filter' );
}
