<?php
/*
Plugin Name: WP REST API multilanguage (over WMPL)
Plugin URI: http://elemind.com/
Description: Makes WP REST API return the right language stuff, requires WPML.
Version: 0.1
Author: elemind.com
Author URI: http://elemind.com
License: GPL
*/

// Activation check
add_action( 'admin_init', 'activation_check' );
function activation_check() {
	if (
		is_admin() &&
		current_user_can('activate_plugins') &&
		(
			!is_plugin_active('sitepress-multilingual-cms/sitepress.php') ||
            (
                !is_plugin_active('rest-api/plugin.php') &&
                !is_plugin_active('json-rest-api/plugin.php')
            )
		)
	) {
        add_action('admin_notices','activation_notice');
        deactivate_plugins( plugin_basename( __FILE__ ) );
        if ( isset( $_GET['activate'] ) ) {
            unset( $_GET['activate'] );
        }
    }
}

function activation_notice(){
	echo '<div class="error"><p>Sorry, WP REST API multilanguage (over WMPL) requires the <a href="https://wpml.org/">WPML</a> plugin and <a href="https://wordpress.org/plugins/rest-api/">WP REST API</a> to be installed and active.</p></div>';
}

// Hook to WP REST API bootstrap
add_action( 'rest_api_init', 'wpml_wp_rest_api_init', 5);
add_action( 'wp_json_server_before_serve', 'wpml_wp_rest_api_init' , 5);

function wpml_wp_rest_api_init( $server ) {
	global $sitepress;

	$default = $sitepress->get_default_language();
	$langs = array_keys(icl_get_languages('skip_missing=0&orderby=KEY&order=DIR&link_empty_to=str'));//Get all available langauges (only the keys, en,ja,fr, etc).

	$cur_lang = (isset($_GET['lang'])) ? $_GET['lang'] : $default;

	if( !in_array($cur_lang, $langs ) ) {
	  $cur_lang = $default;
	}
	$sitepress->switch_lang( $cur_lang );
}